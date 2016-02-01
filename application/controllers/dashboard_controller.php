<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

	}


	public function index()
	{	

		$data = [ 
			'title' => 'Dashboard',
			'account_type' => $this->nativesession->get('account_type') 
		];

		$this->template
			->set_partial('more_css', 'scripts/dashboard_css')
			->set_partial('more_js', 'scripts/dashboard_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('dashboard', $data );
	}		
}
