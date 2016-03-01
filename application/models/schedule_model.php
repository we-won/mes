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
			SELECT a.subject_id, b.description 
			FROM $this->mes_schedule a
			LEFT JOIN mes_subjects b ON a.subject_id = b.id
			WHERE a.id = $schedule_id
			LIMIT 1
		");
		
		return $q->row_array();

	}
	
	public function get_schedule_time( $schedule_id = 0 )
	{
		if ($schedule_id == 0) return false;

		$q = $this->db->query("
			SELECT day, start_time, end_time FROM mes_subject_schedule WHERE schedule_id = $schedule_id
		");
		
		return $q->result_array();
	}
	
	public function get_schedule_list( $start = 0, $limit = 10, $search = null, $where = null )
	{
		/*$q = $this->db->query("
			SELECT a.subject_id, a.days, a.time, a.created, a.is_active,
			b.title as subject_name
			FROM $this->mes_schedule a
			LEFT JOIN mes_subjects b ON a.subject_id = b.id
			WHERE b.title LIKE '%$search%'
			AND a.is_active <> 0
			LIMIT $start, $limit
		");*/
		
		$q = $this->db->query("
			SELECT a.id, b.title as subject_name, 
			GROUP_CONCAT(d.code1, '(', c.start_time, ' - ', c.end_time, ')' ORDER BY c.day SEPARATOR ', ') as schedule 
			FROM mes_schedule a 
			LEFT JOIN mes_subjects b ON a.subject_id = b.id 
			LEFT JOIN mes_subject_schedule c ON c.schedule_id = a.id 
			LEFT JOIN mes_days d ON d.id = c.day
			AND a.is_active <> 0 
			WHERE b.title LIKE '%$search%' 
			GROUP BY a.id 
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

	public function get_sy_schedules()
	{
		$this->load->model('schoolyear_model');

		$sy_id = $this->schoolyear_model->get_active_sy()['id'];

		$q = $this->db->query("
			SELECT a.id, a.schoolyear_id, a.subject_id,
			b.title as subject_title, b.units
			FROM mes_schedule a
			LEFT JOIN mes_subjects b ON a.subject_id = b.id
			WHERE a.schoolyear_id = $sy_id
			AND a.is_active = 1
		");
		
		return $q->result();
	
	}

}