<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class schoolyear_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->model(['schoolyear_model']);
	}


	public function index()
	{	

		$data = [ 
			'title' => ucwords( $this->uri->segment(1) )
		];

		$this->template
			->set_partial('more_css', 'scripts/schoolyear_css')
			->set_partial('more_js', 'scripts/schoolyear_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('schoolyear/schoolyear_listing', $data );
	}

	public function listings()
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'schoolyear_model',
	 		'model' 			=> 'schoolyear_model',
	 		'func_get'			=> 'get_schoolyear_list',
	 		'func_get_max'		=> 'get_max_schoolyear_pages',
	 		'where'				=> '',
	 		'search' 			=> $search,
	 		'iDisplayLength' 	=> $_GET['iDisplayLength'],
	 		'iDisplayStart' 	=> $_GET['iDisplayStart'],
	 		'sEcho'				=> $_GET['sEcho']
	 	], [ 
	 		'id',
	 		'year',
	 		'sem',
	 		'created',
	 		'@view:schoolyear/datatables/status',
	 		'@view:schoolyear/datatables/action'
	 	] );
	}

	public function new_schoolyear()
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'schoolyear' ])) {
			$this->form_validation->set_rules('schoolyear[year]', 'Year', 'required');
			$this->form_validation->set_rules('schoolyear[sem]', 'Sem', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'schoolyear' ];

				$result = $this->schoolyear_model->create_schoolyear($data);
				if($result[0]) {
					
					$this->nativesession->set_flashdata( '_schoolyear', '<div class="alert alert-success">' . $result[1] . '</div>' );
					redirect(base_url($this->uri->segment(1)));	
				} else {

					$this->nativesession->set_flashdata( '_schoolyear', '<div class="alert alert-danger">' . $result[1] . '</div>' );	
				}
			}

		}

		$data = [ 
			'title' => 'New Schoolyear'
		];

		$this->template
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('schoolyear/schoolyear_form', $data );
	}

	public function edit_schoolyear( $id = 0 )
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'schoolyear' ])) {
			$this->form_validation->set_rules('schoolyear[year]', 'Year', 'required');
			$this->form_validation->set_rules('schoolyear[sem]', 'Sem', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'schoolyear' ];

				if($this->schoolyear_model->update_schoolyear($id, $data)) {
					
					$this->nativesession->set_flashdata( '_schoolyear', '<div class="alert alert-success">Schoolyear has been updated.</div>' );
					redirect(base_url( $this->uri->segment(1)));
				} else {

					$this->nativesession->set_flashdata( '_schoolyear', '<div class="alert alert-danger">Unable to update schoolyear, please try again.</div>' );	
				}
			}

		}

		$data = [ 
			'title' => 'Update Schoolyear',
			'schoolyear'	=> $this->schoolyear_model->get_schoolyear($id)
		];

		$this->template
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('schoolyear/schoolyear_form', $data );
	}

	public function delete_schoolyear( $id = 0 )
	{	
		if( $id > 0 )
		{
			$this->schoolyear_model->delete_schoolyear( $id );
			$this->nativesession->set_flashdata( '_schoolyear', '<div class="alert alert-success">Schoolyear has been removed.</div>' );	
		}
		else
		{
			$this->nativesession->set_flashdata( '_schoolyear', '<div class="alert alert-danger">Cannot remove record.</div>' );	
		}
		
		redirect(base_url( $this->uri->segment(1)));
	}

	public function update_stat_schoolyear( $id = 0 )
	{
		if( $id > 0 )
		{
			$this->schoolyear_model->update_stat_schoolyear( $id );
			$this->nativesession->set_flashdata( '_schoolyear', '<div class="alert alert-success">Schoolyear has been updated.</div>' );	
		}
		else
		{
			$this->nativesession->set_flashdata( '_schoolyear', '<div class="alert alert-danger">Cannot update record.</div>' );	
		}
		
		redirect(base_url( $this->uri->segment(1)));
	}

}
