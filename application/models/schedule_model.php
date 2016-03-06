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

		$this->load->model('schoolyear_model');
	}

	public function get_schedule( $schedule_id = 0 )
	{
		if ($schedule_id == 0) return false;

		$q = $this->db->query("
			SELECT a.subject_id, a.course_id, b.description,
			c.description as course_description
			FROM $this->mes_schedule a
			LEFT JOIN mes_subjects b ON a.subject_id = b.id
			LEFT JOIN mes_courses c ON a.course_id = c.id
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
		$sy_id = $this->schoolyear_model->get_active_sy()['id'];
		
		$q = $this->db->query("
			SELECT a.id, b.title as subject_name, b.description as subject_description, 
			GROUP_CONCAT(d.code1, '(', c.start_time, ' - ', c.end_time, ')' ORDER BY c.day SEPARATOR ', ') as schedule 
			FROM mes_schedule a 
			LEFT JOIN mes_subjects b ON a.subject_id = b.id 
			LEFT JOIN mes_subject_schedule c ON c.schedule_id = a.id 
			LEFT JOIN mes_days d ON d.id = c.day
			AND a.is_active <> 0 
			WHERE b.title LIKE '%$search%'
			AND a.schoolyear_id = $sy_id 
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
		$course_id = $data['course_id'] ? $data['course_id'] : 'null';

		$this->db->query("
			INSERT INTO mes_schedule(schoolyear_id, subject_id, course_id) 
			VALUES((SELECT id FROM mes_schoolyear WHERE is_active = 1), {$data['subject_id']}, $course_id) 
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

	public function update_schedule( $id, $data, $day )
	{
		$course_id = $data['course_id'] ? $data['course_id'] : 'null';

		$this->db->query("UPDATE mes_schedule SET subject_id = {$data['subject_id']}, course_id = $course_id WHERE id = $id");
		
		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}
		
		$this->db->query("DELETE FROM mes_subject_schedule WHERE schedule_id = $id");
		
		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}
		
		$sql = "INSERT INTO mes_subject_schedule(schedule_id, day, start_time, end_time) VALUES ";
		
		$i = 0;
		foreach($day['chk'] as $val) {
			if ($i++ > 0) $sql .= ', ';
			$sql .= "($id, $val, '{$day['start_time'][$val - 1]}', '{$day['end_time'][$val - 1]}')";
		}
		
		$this->db->query($sql);
		
		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}
		
		return [1, 'Schedule has been updated.'];
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
		$sy_id = $this->schoolyear_model->get_active_sy()['id'];

		$q = $this->db->query("
			SELECT a.id, b.title as subject_title, b.description as subject_description, 
			GROUP_CONCAT(d.code1, '(', c.start_time, ' - ', c.end_time, ')' ORDER BY c.day SEPARATOR ', ') as schedule 
			FROM mes_schedule a 
			LEFT JOIN mes_subjects b ON a.subject_id = b.id 
			LEFT JOIN mes_subject_schedule c ON c.schedule_id = a.id 
			LEFT JOIN mes_days d ON d.id = c.day
			AND a.is_active <> 0 
			AND a.schoolyear_id = $sy_id 
			GROUP BY a.id 
		");
		
		return $q->result();
	}

	public function get_recommended_schedule($course_id, $year)
	{
		$sy_info = $this->schoolyear_model->get_active_sy();
		$sy_id = $sy_info['id'];
		$sy_sem = $sy_info['sem'];

		$q = $this->db->query("
			SELECT a.id
			FROM mes_schedule a 
			LEFT JOIN mes_curriculum b ON a.course_id = b.course_id AND a.subject_id = b.subject_id
			WHERE a.course_id = $course_id
			AND b.year = $year AND b.semester = $sy_sem
			AND a.schoolyear_id = $sy_id
		");

		return $q->result_array();
	}
}