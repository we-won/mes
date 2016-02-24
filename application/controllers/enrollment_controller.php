<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class enrollment_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->model(['enrollment_model']);
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
			->set_partial('more_css', 'scripts/enrollment_css')
			->set_partial('more_js', 'scripts/enrollment_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('enrollment/enrollment_listing', $data );
	}

	public function listings()
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'enrollment_model',
	 		'model' 			=> 'enrollment_model',
	 		'func_get'			=> 'get_enrollment_list',
	 		'func_get_max'		=> 'get_max_enrollment_pages',
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
	 		'@view:enrollment/datatables/action'
	 	] );
	}

	public function new_enrollment()
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'enrollment' ])) {
			$this->form_validation->set_rules('enrollment[code]', 'Code', 'required');
			$this->form_validation->set_rules('enrollment[title]', 'Title', 'required');
			$this->form_validation->set_rules('enrollment[description]', 'Description', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'enrollment' ];

				$result = $this->enrollment_model->create_enrollment($data);
				if($result[0]) {
					
					$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-success">' . $result[1] . '</div>' );
					redirect(base_url($this->uri->segment(1)));	
				} else {

					$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-danger">' . $result[1] . '</div>' );	
				}
			}

		}

		$data = [ 
			'title' => 'New Enrollment'
		];

		$this->template
			->set_partial('more_css', 'scripts/enrollment_form_css')
			->set_partial('more_js', 'scripts/enrollment_form_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_partial('curriculum_edit_modal', 'modals/curriculum_edit_modal')
			->set_layout('dashboard_template')
			->build('enrollment/enrollment_form', $data );
	}

	public function edit_enrollment( $id = 0 )
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'enrollment' ])) {
			$this->form_validation->set_rules('enrollment[code]', 'Code', 'required');
			$this->form_validation->set_rules('enrollment[title]', 'Title', 'required');
			$this->form_validation->set_rules('enrollment[description]', 'Description', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'enrollment' ];

				if($this->enrollment_model->update_enrollment($id, $data)) {
					
					$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-success">Enrollment has been updated.</div>' );
					redirect(base_url( $this->uri->segment(1)));
				} else {

					$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-danger">Unable to update enrollment, please try again.</div>' );	
				}
			}

		}

		$data = [ 
			'title' 	=> 'Update Enrollment',
			'enrollment'	=> $this->enrollment_model->get_enrollment($id)
		];

		$this->template
			->set_partial('more_css', 'scripts/enrollment_form_css')
			->set_partial('more_js', 'scripts/enrollment_form_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_partial('curriculum_edit_modal', 'modals/curriculum_edit_modal')
			->set_layout('dashboard_template')
			->build('enrollment/enrollment_form', $data);
	}

	public function delete_enrollment( $id = 0 )
	{	
		if( $id > 0 )
		{
			$this->enrollment_model->delete_enrollment( $id );
			$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-success">Enrollment has been removed.</div>' );	
		}
		else
		{
			$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-danger">Cannot remove record.</div>' );	
		}
		
		redirect(base_url( $this->uri->segment(1)));
	}

	public function curriculum_listing($enrollment_id = 0)
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'enrollment_model',
	 		'model' 			=> 'enrollment_model',
	 		'func_get'			=> 'get_curriculum_list',
	 		'func_get_max'		=> 'get_max_curriculum_list',
	 		'where'				=> [ 'enrollment_id' => $enrollment_id ],
	 		'search' 			=> $search,
	 		'iDisplayLength' 	=> $_GET['iDisplayLength'],
	 		'iDisplayStart' 	=> $_GET['iDisplayStart'],
	 		'sEcho'				=> $_GET['sEcho']
	 	], [ 
	 		'year',
	 		'semester',
	 		'total_subjects',
	 		'total_units',
	 		'@view:enrollment/datatables/curriculum_list_action'
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
}
