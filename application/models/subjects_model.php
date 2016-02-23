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

	public function get_subject_prerequisites( $subject_id = 0 )
	{
		if ($subject_id == 0) return false;

		$q = $this->db->query("
			SELECT a.id, a.subject_id, a.prerequisite_id, b.title
			FROM mes_subject_prerequisites a
			LEFT JOIN mes_subjects b ON a.prerequisite_id = b.id
			WHERE a.subject_id = $subject_id
		");
		
		return $q->result_array();
	}
	
	public function get_subjects( $start = 0, $limit = 10, $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT id, code, title, description, units, created
			FROM $this->mes_subjects
			WHERE (description LIKE '%$search%')
			AND is_active = 1 
			$where
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

		return [1, 'subject has been added.', $this->db->insert_id()];
	}

	public function update_subject( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_subjects, $data ); 

		//return ($this->db->affected_rows() > 0) ? true : false;
		return ($this->db->_error_number() > 0) ? false : true; 
	}

	public function delete_subject( $id )
	{
		$data['is_active'] = 0;
		
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_subjects, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function update_prereq( $id, $data )
	{
		$this->db->where( 'subject_id', $id );
		$this->db->delete( 'mes_subject_prerequisites' ); 

		$ids = explode(",", $data['ids']);
		$prereq = array();

		foreach($ids as $req_id) {
			$prereq[] = [
				'subject_id' => $id,
				'prerequisite_id' => $req_id
			];
		}

		$this->db->insert_batch( 'mes_subject_prerequisites', $prereq );

		return true;
	}
	
}