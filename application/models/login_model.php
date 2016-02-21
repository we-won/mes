<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model
{

	var $mes_users = 'mes_users';
	var $error_no;
	var $error_msg;
	
	function __construct()
	{
		parent::__construct();		
		$this->error_no = 0;
		$this->error_msg = '';
	}
	
	public function get_user_existing_data( $username )
	{		
		
		$this->db->where('username', $username);
		$this->db->where('is_active', 1);
		$this->db->where_in('account_type', [ADMIN, REGISTRAR, CASHIER]);
		// $this->db->or_where('account_type', 'game manager'); 
		
		$res = $this->db->get($this->mes_users);
		return ($res->num_rows() > 0) ? $res->row_array() : false;
	}	

}