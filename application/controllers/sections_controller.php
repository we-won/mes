<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sections_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->model(['courses_model', 'sections_model', 'schoolyear_model']);
	}


	public function index()
	{	
		if ($this->nativesession->get('user_id') == NULL) {
			redirect('/');
		}

		$sy_info = $this->schoolyear_model->get_active_sy();

		$data = [ 
			'title' => ucwords( $this->uri->segment(1) ),
			'sy' => $sy_info['year'],
			'sem' => $sy_info['sem']
		];

		$this->template
			->set_partial('more_css', 'scripts/sections_css')
			->set_partial('more_js', 'scripts/sections_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('sections/courses_listing', $data );
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
	 		'@view:sections/datatables/action'
	 	] );
	}

	public function manage_sections($course_id = 0)
	{	
		$data = [ 
			'title' => 'Manage Course Sections',
			'course' => $this->courses_model->get_course($course_id)
		];

		$this->template
			->set_partial('more_css', 'scripts/sections_form_css')
			->set_partial('more_js', 'scripts/sections_form_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_partial('curriculum_edit_modal', 'modals/mes_sm_modal')
			->set_layout('dashboard_template')
			->build('sections/sections_form', $data );
	}

	public function sections_listing($course_id = 0)
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		$sy_id = $this->schoolyear_model->get_active_sy()['id'];

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'sections_model',
	 		'model' 			=> 'sections_model',
	 		'func_get'			=> 'get_sections_list',
	 		'func_get_max'		=> 'get_max_sections_list',
	 		'where'				=> [ 'course_id' => $course_id, 'sy_id' => $sy_id ],
	 		'search' 			=> $search,
	 		'iDisplayLength' 	=> $_GET['iDisplayLength'],
	 		'iDisplayStart' 	=> $_GET['iDisplayStart'],
	 		'sEcho'				=> $_GET['sEcho']
	 	], [ 
	 		'section',
	 		'year',
	 		'code',
	 		'limit',
	 		'limit',
	 		'@view:sections/datatables/sections_list_action'
	 	] );
	}

	public function new_section()
	{
		if (!(isset($_POST['course']))) return false;

		$data = [
			'title' => 'New Section',
			'course' => $this->courses_model->get_course($_POST['course'])
		];

		echo $this->load->view('modals/sections_modal_data', compact('data'), TRUE);
	}

	public function save_section()
	{
		if (!(isset($_POST['year'])) || !(isset($_POST['code'])) || !(isset($_POST['course'])) || !(isset($_POST['limit']))) return false;

		$sy_info = $this->schoolyear_model->get_active_sy();

		$data = [
			'sy_id' => $sy_info['id'],
			'course_id' => $_POST['course'],
			'year' => $_POST['year'],
			'code' => $_POST['code'],
			'limit' => $_POST['limit']
		];

		echo json_encode($this->sections_model->create_section($data));
	}

	public function edit_section()
	{
		if (!(isset($_POST['section']))) return false;

		$data = [
			'title' => 'New Section',
			'section' => $this->sections_model->get_section($_POST['section'])
		];

		echo $this->load->view('modals/sections_modal_data', compact('data'), TRUE);
	}

	public function delete_section($id = 0)
	{
		if( $id > 0 )
		{
			$this->sections_model->delete_section( $id );
			$this->nativesession->set_flashdata( '_users', '<div class="alert alert-success">User has been removed.</div>' );	
		}
		else
		{
			$this->nativesession->set_flashdata( '_users', '<div class="alert alert-danger">Cannot remove record.</div>' );	
		}
		
		redirect(base_url( $this->uri->segment()));
	}
}
