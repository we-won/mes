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

		$this->db->insert( $this->mes_enrollment, $data ); 

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}

		return [1, 'Student has been reserved.'];
	}

	public function update_enrollment( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_enrollment, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete_enrollment( $id )
	{
		$data['is_active'] = 0;
		
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_enrollment, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function get_curriculum_list( $start = 0, $limit = 10, $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT a.course_id, a.year, a.semester, count(a.id) as total_subjects, sum(b.units) as total_units
			FROM mes_curriculum a 
			LEFT JOIN mes_subjects b ON a.subject_id = b.id AND b.is_active = 1
			WHERE a.course_id = ". $where['course_id'] ."
			GROUP BY a.year, a.semester
		");

		$query_results = $q->result();

		$tmp_result = array();

		foreach ($query_results as $r) {
			$tmp_result[$r->year][$r->semester] = [$r->total_subjects, $r->total_units];
		}

		//return $tmp_result;

		$years = 4;
		$sems = 3;

		$result = array();

		for ($i = 1; $i <= $years; ++$i) {
			for ($j = 1; $j <= $sems; ++$j) {
				$result[] = (object)[
					'year' => $i,
					'semester' => $j,
					'total_subjects' => isset($tmp_result[$i][$j][0]) ? $tmp_result[$i][$j][0] : 0,
					'total_units' => isset($tmp_result[$i][$j][1]) ? $tmp_result[$i][$j][1] : 0,
					'course_id' => $where['course_id']
				];
			}
		}

		return $result;
	}

	public function get_max_curriculum_list( $search = null, $where = null )
	{
		return 12;
	}

	public function get_curriculum( $course_id = 0, $year = 0, $sem = 0 )
	{
		$q = $this->db->query("
			SELECT a.id, a.code, a.title, a.description, IF(b.semester IS NULL, '', 'selected') as selected
			FROM mes_subjects a
			LEFT JOIN mes_curriculum b ON a.id = b.subject_id AND b.course_id = $course_id
			WHERE (b.year = $year AND b.semester = $sem) OR (b.year IS NULL AND b.semester IS NULL)
		");
		
		return $q->result();
	}

	public function save_curriculum( $course_id = 0, $year = 0, $sem = 0, $subjects = null )
	{
		$this->db->delete('mes_curriculum', array('course_id' => $course_id, 'year' => $year, 'semester' => $sem)); 

		if ($subjects != null) {
			
			$data = array();
			$subjects = explode(",", $subjects);

			foreach($subjects as $subject) {
				$data[] =  array(
			      'subject_id' => $subject,
			      'course_id' => $course_id,
			      'year' => $year,
			      'semester' => $sem
			   ); 
			}

			$this->db->insert_batch('mes_curriculum', $data); 
		}	
	}

	public function get_students($search)
	{
		$q = $this->db->query("
			SELECT a.id, a.number, a.firstname, a.middlename, a.lastname, a.created
			FROM mes_students a
			LEFT JOIN mes_enrollment b ON b.student_id = a.id
			WHERE (a.number LIKE '%$search%' OR a.firstname LIKE '%$search%' OR a.middlename LIKE '%$search%' OR a.lastname LIKE '%$search%')
			AND a.is_active <> 0
			AND b.id IS NULL
			LIMIT 5
		");
		
		return $q->result();
	}

}