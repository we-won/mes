<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class schedule_model extends CI_Model
{

	var $mes_schedule = 'mes_schedule';
	var $error_no;
	var $error_msg;
	
	function __construct()
	{
		parent::__construct();		
		$this->error_no = 0;
		$this->error_msg = '';
	}

	public function get_schedule( $schedule_id = 0 )
	{
		if ($schedule_id == 0) return false;

		$q = $this->db->query("
			SELECT a.subject_id, a.days, a.time, a.created, a.is_active,
			b.description
			FROM $this->mes_schedule a
			LEFT JOIN mes_subjects b ON a.subject_id = b.id
			WHERE a.id = $schedule_id
			LIMIT 1
		");
		
		return $q->row_array();

	}
	
	public function get_schedule_list( $start = 0, $limit = 10, $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT a.subject_id, a.days, a.time, a.created, a.is_active,
			b.title as subject_name
			FROM $this->mes_schedule a
			LEFT JOIN mes_subjects b ON a.subject_id = b.id
			WHERE b.title LIKE '%$search%'
			AND a.is_active <> 0
			LIMIT $start, $limit
		");
		
		return $q->result();
	}


	public function get_max_schedule_pages( $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT count(*) as count FROM $this->mes_schedule
			WHERE is_active <> 0
		");
		
		$return = $q->row_array()['count'];
		return $return;

	}

	public function create_schedule( $data, $day )
	{
		/*$data['created'] = date("Y-m-d H:i:s");

		$this->db->insert( $this->mes_schedule, $data ); 

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}*/
		
		$this->db->query("
			INSERT INTO mes_schedule(schoolyear_id, subject_id) 
			VALUES((SELECT id FROM mes_schoolyear WHERE is_active = 1), {$data['subject_id']}) 
		");

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}
		
		$schedule_id = $this->db->insert_id();
		
		$sql = "INSERT INTO mes_subject_schedule(schedule_id, day, start_time, end_time) VALUES ";
		
		$i = 0;
		foreach($day['chk'] as $val) {
			if ($i++ > 0) $sql .= ', ';
			$sql .= "($schedule_id, $val, '{$day['start_time'][$val - 1]}', '{$day['end_time'][$val - 1]}')";
		}
		
		$this->db->query($sql);
		
		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}
		
		return [1, 'Schedule has been added.'];
	}

	public function update_schedule( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_schedule, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete_schedule( $id )
	{
		
		$this->db->where( 'id', $id );
		$this->db->set('is_active', 0);
		$this->db->update( $this->mes_schedule, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

}