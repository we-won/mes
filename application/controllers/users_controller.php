<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->model(['users_model']);
	}


	public function index()
	{	

		$data = [ 
			'title' => ucwords( $this->uri->segment(1) )
		];

		$this->template
			->set_partial('more_css', 'scripts/users_css')
			->set_partial('more_js', 'scripts/users_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('users/users_listing', $data );
	}

	public function listings()
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'users_model',
	 		'model' 			=> 'users_model',
	 		'func_get'			=> 'get_users',
	 		'func_get_max'		=> 'get_max_user_pages',
	 		'where'				=> '',
	 		'search' 			=> $search,
	 		'iDisplayLength' 	=> $_GET['iDisplayLength'],
	 		'iDisplayStart' 	=> $_GET['iDisplayStart'],
	 		'sEcho'				=> $_GET['sEcho']
	 	], [ 
	 		'username',
	 		'name',
	 		'account_type',
	 		'created',
	 		'@view:users/datatables/action'
	 	] );
	}

	public function test() {
		print_r($this->users_model->get_users());
	}

	public function new_user()
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'user' ])) {
			$this->form_validation->set_rules('user[username]', 'Username', 'required');
			$this->form_validation->set_rules('user[firstname]', 'First Name', 'required');
			$this->form_validation->set_rules('user[lastname]', 'Last Name', 'required');
			$this->form_validation->set_rules('user[account_type]', 'Role', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'user' ];

				if($this->users_model->create_user($data)) {
					
					$this->nativesession->set_flashdata( '_user', '<div class="alert alert-success">user has been added.</div>' );	
					redirect( base_url( $this->uri->segment(1) ) );
				} else {

					$this->nativesession->set_flashdata( '_user', '<div class="alert alert-danger">Unable to add user, please try again.</div>' );	
				}
			}

		}

		$data = [ 
			'title' => ' <small>New User</small>'
		];

		$this->template
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('users/user_form', $data );
	}

	public function edit($id = 0)
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'user' ])) {
			$this->form_validation->set_rules('user[username]', 'Username', 'required');
			$this->form_validation->set_rules('user[firstname]', 'First Name', 'required');
			$this->form_validation->set_rules('user[lastname]', 'Last Name', 'required');
			$this->form_validation->set_rules('user[account_type]', 'Role', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'user' ];

				if($this->users_model->create_user($data)) {
					
					$this->nativesession->set_flashdata( '_user', '<div class="alert alert-success">user has been added.</div>' );	
					redirect( base_url( $this->uri->segment(1) ) );
				} else {

					$this->nativesession->set_flashdata( '_user', '<div class="alert alert-danger">Unable to add user, please try again.</div>' );	
				}
			}

		}



		$data = [ 
			'title' => ' <small>Update User</small>',
			'user'	=> $this->users_model->get_user($id)
		];

		$this->template
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('users/user_form', $data );
	}

}
