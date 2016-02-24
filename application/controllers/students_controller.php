<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class students_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->model(['students_model']);
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
			->set_partial('more_css', 'scripts/students_css')
			->set_partial('more_js', 'scripts/students_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('students/students_listing', $data );
	}

	public function listings()
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'students_model',
	 		'model' 			=> 'students_model',
	 		'func_get'			=> 'get_students',
	 		'func_get_max'		=> 'get_max_student_pages',
	 		'where'				=> '',
	 		'search' 			=> $search,
	 		'iDisplayLength' 	=> $_GET['iDisplayLength'],
	 		'iDisplayStart' 	=> $_GET['iDisplayStart'],
	 		'sEcho'				=> $_GET['sEcho']
	 	], [ 
	 		'number',
	 		'firstname',
	 		'middlename',
	 		'lastname',
	 		'@view:students/datatables/action'
	 	] );
	}

	public function new_student()
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'student' ])) {
			$this->form_validation->set_rules('student[number]', 'Student Number', 'required');
			$this->form_validation->set_rules('student[firstname]', 'First Name', 'required');
			$this->form_validation->set_rules('student[middlename]', 'Middle Name', 'required');
			$this->form_validation->set_rules('student[lastname]', 'Last Name', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'student' ];

				$result = $this->students_model->create_student($data);
				if($result[0]) {
					
					$this->nativesession->set_flashdata( '_students', '<div class="alert alert-success">' . $result[1] . '</div>' );
					redirect(base_url($this->uri->segment(1)));	
				} else {

					$this->nativesession->set_flashdata( '_students', '<div class="alert alert-danger">' . $result[1] . '</div>' );	
				}
			}

		}

		$data = [ 
			'title' => 'New Student'
		];

		$this->template
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('students/student_form', $data );
	}

	public function edit_student( $id = 0 )
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'student' ])) {
			$this->form_validation->set_rules('student[number]', 'Student Number', 'required');
			$this->form_validation->set_rules('student[firstname]', 'First Name', 'required');
			$this->form_validation->set_rules('student[middlename]', 'Middle Name', 'required');
			$this->form_validation->set_rules('student[lastname]', 'Last Name', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'student' ];

				if($this->students_model->update_student($id, $data)) {
					
					$this->nativesession->set_flashdata( '_students', '<div class="alert alert-success">Student has been updated.</div>' );
					redirect(base_url( $this->uri->segment(1)));
				} else {

					$this->nativesession->set_flashdata( '_students', '<div class="alert alert-danger">Unable to update student, please try again.</div>' );	
				}
			}

		}

		$data = [ 
			'title' => 'Update Student',
			'student'	=> $this->students_model->get_student($id)
		];

		$this->template
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('students/student_form', $data );
	}

	public function delete_student( $id = 0 )
	{	
		if( $id > 0 )
		{
			$this->students_model->delete_student( $id );
			$this->nativesession->set_flashdata( '_students', '<div class="alert alert-success">Student has been removed.</div>' );	
		}
		else
		{
			$this->nativesession->set_flashdata( '_students', '<div class="alert alert-danger">Cannot remove record.</div>' );	
		}
		
		redirect(base_url( $this->uri->segment(1)));
	}

}
