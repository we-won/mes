<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class schoolyear_model extends CI_Model
{

	var $mes_schoolyear = 'mes_schoolyear';
	var $error_no;
	var $error_msg;
	
	function __construct()
	{
		parent::__construct();		
		$this->error_no = 0;
		$this->error_msg = '';
	}

	public function get_schoolyear( $schoolyear_id = 0 )
	{
		if ($schoolyear_id == 0) return false;

		$q = $this->db->query("
			SELECT * FROM $this->mes_schoolyear
			WHERE id = $schoolyear_id
			LIMIT 1
		");
		
		return $q->row_array();

	}
	
	public function get_schoolyear_list( $start = 0, $limit = 10, $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT id, year, sem, created, is_active
			FROM $this->mes_schoolyear
			WHERE year LIKE '%$search%'
			ORDER BY is_active DESC, year DESC, sem DESC
			LIMIT $start, $limit
		");
		
		return $q->result();
	}


	public function get_max_schoolyear_pages( $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT count(*) as count FROM $this->mes_schoolyear
		");
		
		$return = $q->row_array()['count'];
		return $return;

	}

	public function create_schoolyear( $data )
	{
		$this->db->insert( $this->mes_schoolyear, $data ); 

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}

		return [1, 'Schoolyear has been added.'];
	}

	public function update_schoolyear( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_schoolyear, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete_schoolyear( $id )
	{
		$this->db->where( 'id', $id );
		$this->db->set('is_active', 0);
		$this->db->update( $this->mes_schoolyear, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function update_stat_schoolyear( $id )
	{
		$q = $this->db->query("
			SELECT is_active FROM $this->mes_schoolyear
			WHERE id = $id
		");
		
		$status = $q->row_array()['is_active'];

		if ($status == 0) {
			$this->db->set('is_active', 0);
			$this->db->update( $this->mes_schoolyear ); 
		}

		$this->db->where( 'id', $id );
		$this->db->set('is_active', $status == 1 ? 0 : 1);
		$this->db->update( $this->mes_schoolyear ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function get_active_sy()
	{
		$q = $this->db->query("
			SELECT * FROM $this->mes_schoolyear
			WHERE is_active = 1
		");
		
		return $q->row_array();
	}
}