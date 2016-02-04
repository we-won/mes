<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class users_model extends CI_Model
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

	public function get_user( $user_id = 0 )
	{
		if ($user_id == 0) return false;

		$q = $this->db->query("
			SELECT * FROM $this->mes_users
			WHERE id = $user_id
			LIMIT 1
		");
		
		return $q->row_array();

	}
	
	public function get_users( $start = 0, $limit = 10, $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT id, username, CONCAT_WS(', ', lastname, firstname) as name, account_type, created
			FROM $this->mes_users
			WHERE username LIKE '%$search%'
			AND id <> 1
			LIMIT $start, $limit
		");
		
		return $q->result();
	}


	public function get_max_user_pages( $search = null, $where = null )
	{
		$q = $this->db->query("
			SELECT count(*) as count FROM $this->mes_users
			WHERE id <> 1
		");
		
		$return = $q->row_array()['count'];
		return $return;

	}

	public function create_user( $data )
	{
		$data['password'] = 'sha512:1000:dl4/Ltr1V2K8O2urBQMPsA8KJACMv312:wcIsUnHOce7IKFDufO30zuj6rP85u64o';
		$data['created'] = date("Y-m-d H:i:s");

		$this->db->insert( $this->mes_users, $data ); 

		if ($this->db->_error_number())
		{
			return [0, $this->error_msg = $this->db->_error_message()]; 
		}

		return [1, 'User has been added.'];
	}

	public function update_user( $id, $data )
	{
		$this->db->where( 'id', $id );
		$this->db->update( $this->mes_users, $data ); 

		return ($this->db->affected_rows() > 0) ? true : false;
	}

	public function delete_user( $id )
	{
		$this->db->where('id', $id);
		$this->db->delete( $this->mes_users );
		
		return ($this->db->affected_rows() > 0) ? true : false;
	}

}