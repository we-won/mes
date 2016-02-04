<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class subjects_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->model(['subjects_model']);
	}


	public function index()
	{	

		$data = [ 
			'title' => ucwords( $this->uri->segment(1) )
		];

		$this->template
			->set_partial('more_css', 'scripts/subjects_css')
			->set_partial('more_js', 'scripts/subjects_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('subjects/subjects_listing', $data );
	}

	public function listings()
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'subjects_model',
	 		'model' 			=> 'subjects_model',
	 		'func_get'			=> 'get_subjects',
	 		'func_get_max'		=> 'get_max_subjects_pages',
	 		'where'				=> '',
	 		'search' 			=> $search,
	 		'iDisplayLength' 	=> $_GET['iDisplayLength'],
	 		'iDisplayStart' 	=> $_GET['iDisplayStart'],
	 		'sEcho'				=> $_GET['sEcho']
	 	], [ 
	 		'code',
	 		'title',
	 		'description',
	 		'units',
	 		'prerequisite',
	 		'created',
	 		'@view:subjects/datatables/action'
	 	] );
	}

	public function new_subject()
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'subject' ])) {
			$this->form_validation->set_rules('subject[code]', 'Code', 'required');
			$this->form_validation->set_rules('subject[title]', 'Title', 'required');
			$this->form_validation->set_rules('subject[description]', 'Description', 'required');
			$this->form_validation->set_rules('subject[units]', 'Units', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'subject' ];

				$result = $this->subjects_model->create_subject($data);
				if($result[0]) {
					
					$this->nativesession->set_flashdata( '_subjects', '<div class="alert alert-success">' . $result[1] . '</div>' );
					redirect(base_url($this->uri->segment(1)));	
				} else {

					$this->nativesession->set_flashdata( '_subjects', '<div class="alert alert-danger">' . $result[1] . '</div>' );	
				}
			}

		}

		$data = [ 
			'title' => 'New Subject'
		];

		$this->template
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('subjects/subject_form', $data );
	}

	public function edit_subject( $id = 0 )
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'subject' ])) {
			$this->form_validation->set_rules('subject[code]', 'Code', 'required');
			$this->form_validation->set_rules('subject[title]', 'Title', 'required');
			$this->form_validation->set_rules('subject[description]', 'Description', 'required');
			$this->form_validation->set_rules('subject[units]', 'Units', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'subject' ];

				if($this->subjects_model->update_subject($id, $data)) {
					
					$this->nativesession->set_flashdata( '_subjects', '<div class="alert alert-success">Subject has been updated.</div>' );
					redirect(base_url( $this->uri->segment(1)));
				} else {

					$this->nativesession->set_flashdata( '_subjects', '<div class="alert alert-danger">Unable to update subject, please try again.</div>' );	
				}
			}

		}

		$data = [ 
			'title' 	=> 'Update Subject',
			'subject'	=> $this->subjects_model->get_subject($id)
		];

		$this->template
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('subjects/subject_form', $data);
	}

	public function delete_subject( $id = 0 )
	{	
		if( $id > 0 )
		{
			$this->subjects_model->delete_subject( $id );
			$this->nativesession->set_flashdata( '_subjects', '<div class="alert alert-success">Subject has been removed.</div>' );	
		}
		else
		{
			$this->nativesession->set_flashdata( '_subjects', '<div class="alert alert-danger">Cannot remove record.</div>' );	
		}
		
		redirect(base_url( $this->uri->segment(1)));
	}

}
