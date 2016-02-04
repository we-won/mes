<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class courses_model extends CI_Model
{

	var $mes_courses = 'mes_courses';
	var $error_no;
	var $error_msg;
	
	function __construct()
	{
		parent::__construct();		
		$this->error_no = 0;
		$this->error_msg = '';
	}

	public function get_course( $course_id = 0 )
	{
		if ($course_id == 0) return false;

		$q = $this->db->query("
			SELECT * FROM $this->mes_courses
			WHERE id = $course_id
			LIMIT 1
		");
		
		return $q->row_array();
	}
	
	public function get_courses( $start = 0, $limit = 10, $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT id, code, title, description, created
			FROM $this->mes_courses
			WHERE (code LIKE '%$search%' OR title LIKE '%$search%')
			AND is_active = 1
			LIMIT $start, $limit
		");
		
		return $q->result();
	}


	public function get_max_courses_pages( $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT count(*) as count FROM $this->mes_courses
			WHERE is_active = 1
		");
		
		$return = $q->row_array()['count'];
		return $return;

	}

	public function create_course( $data )
	{
		$this->db->insert( $this->mes_courses, $data ); 

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}

		return [1, 'Course has been added.'];
	}

	public function update_course( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_courses, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete_course( $id )
	{
		$data['is_active'] = 0;
		
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_courses, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

}