<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class students_model extends CI_Model
{

	var $mes_students = 'mes_students';
	var $error_no;
	var $error_msg;
	
	function __construct()
	{
		parent::__construct();		
		$this->error_no = 0;
		$this->error_msg = '';
	}

	public function get_student( $student_id = 0 )
	{
		if ($student_id == 0) return false;

		$q = $this->db->query("
			SELECT * FROM $this->mes_students
			WHERE id = $student_id
			LIMIT 1
		");
		
		return $q->row_array();

	}
	
	public function get_students( $start = 0, $limit = 10, $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT id, number, firstname, middlename, lastname, created
			FROM $this->mes_students
			WHERE (number LIKE '%$search%' OR firstname LIKE '%$search%' OR middlename LIKE '%$search%' OR lastname LIKE '%$search%')
			AND is_active <> 0
			LIMIT $start, $limit
		");
		
		return $q->result();
	}


	public function get_max_student_pages( $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT count(*) as count FROM $this->mes_students
			WHERE is_active <> 0
		");
		
		$return = $q->row_array()['count'];
		return $return;

	}

	public function create_student( $data )
	{
		$data['created'] = date("Y-m-d H:i:s");

		$this->db->insert( $this->mes_students, $data ); 

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}

		return [1, 'Student has been added.'];
	}

	public function update_student( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_students, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete_student( $id )
	{
		$this->db->where( 'id', $id );
		$this->db->set( 'is_active', 0 );
		$this->db->update( $this->mes_students, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

}