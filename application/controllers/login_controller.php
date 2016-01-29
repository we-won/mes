<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();
	}

	public function test()
	{
		$this->load->model( 'login_model' );
		$potential_user = $this->login_model->get_user_existing_data( 'erectus' );
		print_r($potential_user);
	}

	public function login() 
	{
		$this->load->helper( array( 'form', 'url' ) );
		$this->load->library( array( 'form_validation' ) );
		$this->load->model( 'login_model' );

		$res = array();

		if ( isset( $_POST[ 'data' ] ) )
		{
			$login = $_POST[ 'data' ];
			
			$this->form_validation->set_rules('data[username]', 'username', 'required');
			$this->form_validation->set_rules('data[password]', 'required');
			
			if ($this->form_validation->run() == FALSE){
				$login_success = false;
				$res = [ 'errors' => false, 'message' => validation_errors() ];
			}else{
				
				$potential_user = $this->login_model->get_user_existing_data( $login[ 'username' ] );

				if ( $potential_user )
				{

					$this->load->library( 'PBKDF2' );
					
					$admin = $potential_user;
					
					$pbkdf2 = new PBKDF2();
					
					if ( $pbkdf2->validatePassword( $login[ 'password' ], $admin['password'] ) )
					{
					
							$login_success = true;
							
							if ( isset( $login[ 'remember_me' ] ) )
							{
								// @TODO remember me mechanism
							}
							
							$this->nativesession->set( array(
								'is_gm_logged_in' 	=> true,
								'admin_id' 			=> $admin['id'],
								'username' 			=> $admin['username'],
								'firstname' 		=> $admin['firstname'],
								'lastname' 			=> $admin['lastname'],
								'account_type' 		=> $admin['account_type']
							) );
							
							// $country_code = function_exists( 'geoip_country_code_by_name' ) ? geoip_country_code_by_name( $_SERVER[ 'REMOTE_ADDR' ] ) : '';
							
							
							/*
							$member_data = array(
											'last_login_date' 	=> date( 'Y-m-d H:i:s' ),
											'last_login_ip' 	=> $_SERVER[ 'REMOTE_ADDR' ],
											'last_login_country' => function_exists( 'geoip_country_code_by_name' ) ? geoip_country_code_by_name( $_SERVER[ 'REMOTE_ADDR' ] ) : ''
											);
											
							$this->admin_login_model->update_member($member_id, $member_data);
							*/
							$res = [ 'errors' => true, 'message'=> 'success', 'url' => base_url( '/dashboard' )  ];
						

					}
					else
					{
						$res = [ 'errors' => false, 'message' => 'Invalid password!' ];
					}
				}else{
						$res = [ 'errors' => false, 'message' => 'login failed!' ];
				}

	
	
			
			}
		
		}

		echo json_encode( $res );
	}

	public function logout()
	{	
		$this->nativesession->sess_destroy();
		redirect( base_url() );
	}

		

}
