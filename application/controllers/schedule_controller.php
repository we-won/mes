<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class schedule_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->model(['schedule_model']);
	}


	public function index()
	{	

		$data = [ 
			'title' => ucwords( $this->uri->segment(1) )
		];

		$this->template
			->set_partial('more_css', 'scripts/schedule_css')
			->set_partial('more_js', 'scripts/schedule_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('schedule/schedule_listing', $data );
	}

	public function listings()
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'schedule_model',
	 		'model' 			=> 'schedule_model',
	 		'func_get'			=> 'get_schedule_list',
	 		'func_get_max'		=> 'get_max_schedule_pages',
	 		'where'				=> '',
	 		'search' 			=> $search,
	 		'iDisplayLength' 	=> $_GET['iDisplayLength'],
	 		'iDisplayStart' 	=> $_GET['iDisplayStart'],
	 		'sEcho'				=> $_GET['sEcho']
	 	], [ 
	 		'subject_name',
	 		'days',
	 		'time',
	 		'created',
	 		'@view:schedule/datatables/action'
	 	] );
	}

	public function new_schedule()
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'schedule' ])) {
			$this->form_validation->set_rules('schedule[subject_id]', 'Subject', 'required');
			$this->form_validation->set_rules('schedule[days]', 'Days', 'required');
			$this->form_validation->set_rules('schedule[time]', 'Time', 'required');
			
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'schedule' ];

				$result = $this->schedule_model->create_schedule($data);
				if($result[0]) {
					
					$this->nativesession->set_flashdata( '_schedule', '<div class="alert alert-success">' . $result[1] . '</div>' );
					redirect(base_url($this->uri->segment(1)));	
				} else {

					$this->nativesession->set_flashdata( '_schedule', '<div class="alert alert-danger">' . $result[1] . '</div>' );	
				}
			}

		}

		$data = [ 
			'title' => 'New Schedule'
		];

		$this->template
			->set_partial('more_css', 'scripts/schedule_css')
			->set_partial('more_js', 'scripts/schedule_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('schedule/schedule_form', $data );
	}

	public function edit_schedule( $id = 0 )
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'schedule' ])) {
			$this->form_validation->set_rules('schedule[subject_id]', 'Subject', 'required');
			$this->form_validation->set_rules('schedule[days]', 'Days', 'required');
			$this->form_validation->set_rules('schedule[time]', 'Time', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'schedule' ];

				if($this->schedule_model->update_schedule($id, $data)) {
					
					$this->nativesession->set_flashdata( '_schedule', '<div class="alert alert-success">Schedule has been updated.</div>' );
					redirect(base_url( $this->uri->segment(1)));
				} else {

					$this->nativesession->set_flashdata( '_schedule', '<div class="alert alert-danger">Unable to update schedule, please try again.</div>' );	
				}
			}

		}

		$data = [ 
			'title' => 'Update Schedule',
			'schedule'	=> $this->schedule_model->get_schedule($id)
		];

		$this->template
			->set_partial('more_css', 'scripts/schedule_css')
			->set_partial('more_js', 'scripts/schedule_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('schedule/schedule_form', $data );
	}

	public function delete_schedule( $id = 0 )
	{	
		if( $id > 0 )
		{
			$this->schedule_model->delete_schedule( $id );
			$this->nativesession->set_flashdata( '_schedule', '<div class="alert alert-success">Schedule has been removed.</div>' );	
		}
		else
		{
			$this->nativesession->set_flashdata( '_schedule', '<div class="alert alert-danger">Cannot remove record.</div>' );	
		}
		
		redirect(base_url( $this->uri->segment(1)));
	}

}
