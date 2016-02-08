<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class subjects_model extends CI_Model
{

	var $mes_subjects = 'mes_subjects';
	var $error_no;
	var $error_msg;
	
	function __construct()
	{
		parent::__construct();		
		$this->error_no = 0;
		$this->error_msg = '';
	}

	public function get_subject( $subject_id = 0 )
	{
		if ($subject_id == 0) return false;

		$q = $this->db->query("
			SELECT * FROM $this->mes_subjects
			WHERE id = $subject_id
			LIMIT 1
		");
		
		return $q->row_array();
	}
	
	public function get_subjects( $start = 0, $limit = 10, $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT id, code, title, description, units, prerequisite, created
			FROM $this->mes_subjects
			WHERE (code LIKE '%$search%' OR title LIKE '%$search%' OR description LIKE '%$search%')
			AND is_active = 1
			LIMIT $start, $limit
		");
		
		return $q->result();
	}


	public function get_max_subjects_pages( $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT count(*) as count FROM $this->mes_subjects
			WHERE is_active = 1
		");
		
		$return = $q->row_array()['count'];
		return $return;
	}

	public function create_subject( $data )
	{
		$this->db->insert( $this->mes_subjects, $data ); 

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}

		return [1, 'subject has been added.'];
	}

	public function update_subject( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_subjects, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete_subject( $id )
	{
		$data['is_active'] = 0;
		
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_subjects, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}
	
}