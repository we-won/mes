<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class courses_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->model(['courses_model']);
	}


	public function index()
	{	
		if ($this->nativesession->get('user_id') == NULL) {
			redirect('/');
		}

		$data = [ 
			'title' => ucwords( $this->uri->segment(1) )
		];

		$this->template
			->set_partial('more_css', 'scripts/courses_css')
			->set_partial('more_js', 'scripts/courses_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('courses/courses_listing', $data );
	}

	public function listings()
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'courses_model',
	 		'model' 			=> 'courses_model',
	 		'func_get'			=> 'get_courses',
	 		'func_get_max'		=> 'get_max_courses_pages',
	 		'where'				=> '',
	 		'search' 			=> $search,
	 		'iDisplayLength' 	=> $_GET['iDisplayLength'],
	 		'iDisplayStart' 	=> $_GET['iDisplayStart'],
	 		'sEcho'				=> $_GET['sEcho']
	 	], [ 
	 		'code',
	 		'title',
	 		'description',
	 		'created',
	 		'@view:courses/datatables/action'
	 	] );
	}

	public function new_course()
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'course' ])) {
			$this->form_validation->set_rules('course[code]', 'Code', 'required');
			$this->form_validation->set_rules('course[title]', 'Title', 'required');
			$this->form_validation->set_rules('course[description]', 'Description', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'course' ];

				$result = $this->courses_model->create_course($data);
				if($result[0]) {
					
					$this->nativesession->set_flashdata( '_courses', '<div class="alert alert-success">' . $result[1] . '</div>' );
					redirect(base_url($this->uri->segment(1)));	
				} else {

					$this->nativesession->set_flashdata( '_courses', '<div class="alert alert-danger">' . $result[1] . '</div>' );	
				}
			}

		}

		$data = [ 
			'title' => 'New Course'
		];

		$this->template
			->set_partial('more_css', 'scripts/course_form_css')
			->set_partial('more_js', 'scripts/course_form_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_partial('curriculum_edit_modal', 'modals/curriculum_edit_modal')
			->set_layout('dashboard_template')
			->build('courses/course_form', $data );
	}

	public function edit_course( $id = 0 )
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'course' ])) {
			$this->form_validation->set_rules('course[code]', 'Code', 'required');
			$this->form_validation->set_rules('course[title]', 'Title', 'required');
			$this->form_validation->set_rules('course[description]', 'Description', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'course' ];

				if($this->courses_model->update_course($id, $data)) {
					
					$this->nativesession->set_flashdata( '_courses', '<div class="alert alert-success">Course has been updated.</div>' );
					redirect(base_url( $this->uri->segment(1)));
				} else {

					$this->nativesession->set_flashdata( '_courses', '<div class="alert alert-danger">Unable to update course, please try again.</div>' );	
				}
			}
		}

		$data = [ 
			'title' 	=> 'Update Course',
			'course'	=> $this->courses_model->get_course($id)
		];

		$this->template
			->set_partial('more_css', 'scripts/course_form_css')
			->set_partial('more_js', 'scripts/course_form_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_partial('curriculum_edit_modal', 'modals/mes_sm_modal')
			->set_layout('dashboard_template')
			->build('courses/course_form', $data);
	}

	public function delete_course( $id = 0 )
	{	
		if( $id > 0 )
		{
			$this->courses_model->delete_course( $id );
			$this->nativesession->set_flashdata( '_courses', '<div class="alert alert-success">Course has been removed.</div>' );	
		}
		else
		{
			$this->nativesession->set_flashdata( '_courses', '<div class="alert alert-danger">Cannot remove record.</div>' );	
		}
		
		redirect(base_url( $this->uri->segment(1)));
	}

	public function curriculum_listing($course_id = 0)
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'courses_model',
	 		'model' 			=> 'courses_model',
	 		'func_get'			=> 'get_curriculum_list',
	 		'func_get_max'		=> 'get_max_curriculum_list',
	 		'where'				=> [ 'course_id' => $course_id ],
	 		'search' 			=> $search,
	 		'iDisplayLength' 	=> $_GET['iDisplayLength'],
	 		'iDisplayStart' 	=> $_GET['iDisplayStart'],
	 		'sEcho'				=> $_GET['sEcho']
	 	], [ 
	 		'year',
	 		'semester',
	 		'total_subjects',
	 		'total_units',
	 		'@view:courses/datatables/curriculum_list_action'
	 	] );
	}

	public function edit_curriculum()
	{
		if (!(isset($_POST['year'])) || !(isset($_POST['sem'])) || !(isset($_POST['course']))) return false;

		$course = $_POST['course'];
		$year = $_POST['year'];
		$sem = $_POST['sem'];

		$data['year'] = $year;
		$data['sem'] = $sem;

		$data['subjects'] = $this->courses_model->get_curriculum($course, $year, $sem);

		echo $this->load->view('modals/curriculum_edit_modal_data', compact('data'), TRUE);
	}

	public function save_curriculum()
	{
		if (!(isset($_POST['year'])) || !(isset($_POST['sem'])) || !(isset($_POST['course'])) || !(isset($_POST['subjects']))) return false;

		$course = $_POST['course'];
		$year = $_POST['year'];
		$sem = $_POST['sem'];
		$subjects = $_POST['subjects'];

		echo $this->courses_model->save_curriculum($course, $year, $sem, $subjects);
	}
	
	public function get_courses()
	{
		$data = $this->courses_model->get_courses(0, 5, $_GET['q'], null);
		echo json_encode(['items' => $data]);
	}
}
