<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class enrollment_model extends CI_Model
{

	var $mes_enrollment = 'mes_enrollment';
	var $error_no;
	var $error_msg;
	
	function __construct()
	{
		parent::__construct();		
		$this->error_no = 0;
		$this->error_msg = '';

		$this->load->model(['schoolyear_model']);
	}

	public function get_enrollment( $enrollment_id = 0 )
	{
		if ($enrollment_id == 0) return false;

		$q = $this->db->query("
			SELECT a.id, a.student_id, a.course_id, a.year, a.sy_id, a.added, a.status,
			CONCAT(b.lastname, ', ', b.firstname, ' ', b.middlename) as student_name, b.number as student_number, c.description as course_description
			FROM $this->mes_enrollment a
			LEFT JOIN mes_students b ON a.student_id = b.id
			LEFT JOIN mes_courses c ON a.course_id = c.id
			WHERE a.id = $enrollment_id
			LIMIT 1
		");
		
		return $q->row_array();
	}
	
	public function get_enrollment_list( $start = 0, $limit = 10, $search = null, $where = null )
	{
		$sy_id = $this->schoolyear_model->get_active_sy()['id'];

		$q = $this->db->query("
			SELECT a.id, a.student_id, a.course_id, a.year, a.sy_id, a.added, a.status,
			CONCAT(b.lastname, ', ', b.firstname) as student_name, b.number as student_number, c.title as course_title
			FROM $this->mes_enrollment a
			LEFT JOIN mes_students b ON a.student_id = b.id
			LEFT JOIN mes_courses c ON a.course_id = c.id
			WHERE b.lastname LIKE '%$search%'
			AND a.sy_id = $sy_id
			LIMIT $start, $limit
		");
		
		return $q->result();
	}


	public function get_max_enrollment_pages( $search = null, $where = null )
	{
		$sy_id = $this->schoolyear_model->get_active_sy()['id'];

		$q = $this->db->query("
			SELECT count(*) as count FROM $this->mes_enrollment
			WHERE sy_id = $sy_id
		");
		
		$return = $q->row_array()['count'];
		return $return;

	}

	public function new_enrollment( $data )
	{
		$data['sy_id'] = $sy_id = $this->schoolyear_model->get_active_sy()['id'];
		$data['status'] = E_RESERVED;

		$this->db->insert( $this->mes_enrollment, $data ); 

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}

		return [1, 'Student has been reserved.', $this->db->insert_id()];
	}

	public function enroll_schedule( $id, $scheds )
	{
		$data = array();

		$this->db->where( 'enrollment_id', $id );
		$this->db->delete( 'mes_enrollment_schedule' ); 

		foreach ($scheds as $sched) {
			$data[] = [
				'enrollment_id' => $id,
				'schedule_id' => $sched
			];
		}

		if (sizeof($data) > 0) $this->db->insert_batch( 'mes_enrollment_schedule', $data ); 

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}

		return [1, ''];
	}

	public function update_enrollment( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_enrollment, $data ); 

		return ($this->db->_error_number() <= 0) ? true : false;
	}

	public function cancel_enrollment( $id )
	{
		$data['status'] = E_CANCELED;
		
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_enrollment, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function reenroll( $id )
	{
		$data['status'] = E_RESERVED;
		
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_enrollment, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function get_students($search)
	{
		$sy_id = $this->schoolyear_model->get_active_sy()['id'];
		
		$q = $this->db->query("
			SELECT a.id, a.number, a.firstname, a.middlename, a.lastname, a.created
			FROM mes_students a
			LEFT JOIN mes_enrollment b ON b.student_id = a.id AND sy_id = $sy_id
			WHERE (a.number LIKE '%$search%' OR a.firstname LIKE '%$search%' OR a.middlename LIKE '%$search%' OR a.lastname LIKE '%$search%')
			AND a.is_active <> 0
			AND b.id IS NULL
			LIMIT 5
		");
		
		return $q->result();
	}

	public function get_enrolled_schedule($id)
	{
		$sy_id = $this->schoolyear_model->get_active_sy()['id'];

		$q = $this->db->query("
			SELECT a.id, b.title as subject_title, b.description as subject_description, b.units,
			GROUP_CONCAT(d.code1, '(', c.start_time, ' - ', c.end_time, ')' ORDER BY c.day SEPARATOR ', ') as schedule,
			IF ( e.id IS NOT NULL, 'selected', '' ) as selected
			FROM mes_schedule a 
			LEFT JOIN mes_subjects b ON a.subject_id = b.id 
			LEFT JOIN mes_subject_schedule c ON c.schedule_id = a.id 
			LEFT JOIN mes_days d ON d.id = c.day
			LEFT JOIN mes_enrollment_schedule e ON e.schedule_id = a.id AND e.enrollment_id = $id 
			AND a.is_active <> 0 
			AND a.schoolyear_id = $sy_id 
			GROUP BY a.id
		");
		
		return $q->result();
	}
}