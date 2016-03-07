<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sections_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->model(['courses_model', 'sections_model']);
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

	public function manage_sections()
	{	
		$data = [ 
			'title' => 'Manage Course Sections'
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

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'sections_model',
	 		'model' 			=> 'sections_model',
	 		'func_get'			=> 'get_sections_list',
	 		'func_get_max'		=> 'get_max_sections_list',
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
	 		'@view:sections/datatables/sections_list_action'
	 	] );
	}

	public function new_section($id = 0)
	{
	}

	public function edit_section($id = 0)
	{
		if (!(isset($_POST['year'])) || !(isset($_POST['sem'])) || !(isset($_POST['course']))) return false;

		$course = $_POST['course'];
		$year = $_POST['year'];
		$sem = $_POST['sem'];

		$data['year'] = $year;
		$data['sem'] = $sem;

		$data['section'] = $this->sections_model->get_section($id);

		echo $this->load->view('modals/curriculum_edit_modal_data', compact('data'), TRUE);
	}

	public function delete_section($id = 0)
	{
	}
}
