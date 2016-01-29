<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->template
			->set_partial('more_css', 'scripts/login_css')
			->set_partial('more_js', 'scripts/login_js')
			->set_layout('login_template')
			->build('login');
	}
}