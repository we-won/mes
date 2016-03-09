<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sections_model extends CI_Model
{

	var $mes_sections = 'mes_sections';
	var $error_no;
	var $error_msg;
	
	function __construct()
	{
		parent::__construct();		
		$this->error_no = 0;
		$this->error_msg = '';

		$this->load->model(['schoolyear_model']);
	}

	public function get_section( $id = 0 )
	{
		if ($id == 0) return false;

		$q = $this->db->query("
			SELECT * FROM $this->mes_sections
			WHERE id = $id
			LIMIT 1
		");
		
		return $q->row_array();
	}
	
	public function get_sections_list( $start = 0, $limit = 10, $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT a.id, a.sy_id, a.course_id, a.year, a.code, a.limit,
			CONCAT (b.title, a.year, a.code) as section
			FROM $this->mes_sections a
			LEFT JOIN mes_courses b ON a.course_id = b.id
			WHERE a.is_active = 1
			AND a.sy_id = ". $where['sy_id'] ."
			AND a.course_id = ". $where['course_id'] ."
			LIMIT $start, $limit
		");
		
		return $q->result();
	}


	public function get_max_sections_list( $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT count(*) as count FROM $this->mes_sections
			WHERE is_active = 1
			AND sy_id = ". $where['sy_id'] ."
			AND course_id = ". $where['course_id'] ."
		");
		
		$return = $q->row_array()['count'];
		return $return;

	}

	public function create_section( $data )
	{
		$this->db->insert( $this->mes_sections, $data ); 

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}

		return [1, 'Section has been added.'];
	}

	public function update_section( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_sections, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete_section( $id )
	{
		$data['is_active'] = 0;
		
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_sections, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}
}