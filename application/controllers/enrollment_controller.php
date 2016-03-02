<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class enrollment_controller extends CI_Controller {

	function __construct()
	{
		# code...
		parent::__construct();

		$this->load->model(['enrollment_model', 'schoolyear_model', 'schedule_model']);
	}


	public function index()
	{	
		if ($this->nativesession->get('user_id') == NULL) {
			redirect('/');
		}
		
		$sy_info = $this->schoolyear_model->get_active_sy();

		$data = [ 
			'title' => ucwords( $this->uri->segment(1) ),
			'sy' => $sy_info['year'],
			'sem' => $sy_info['sem']
		];

		$this->template
			->set_partial('more_css', 'scripts/enrollment_css')
			->set_partial('more_js', 'scripts/enrollment_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('enrollment/enrollment_listing', $data );
	}

	public function listings()
	{	
		$this->load->library('Datatables');
		
		$search = isset( $_GET['sSearch'] ) ? $_GET['sSearch'] : '';

		echo $this->datatables->make( [
	 		'model_loc' 		=> 'enrollment_model',
	 		'model' 			=> 'enrollment_model',
	 		'func_get'			=> 'get_enrollment_list',
	 		'func_get_max'		=> 'get_max_enrollment_pages',
	 		'where'				=> '',
	 		'search' 			=> $search,
	 		'iDisplayLength' 	=> $_GET['iDisplayLength'],
	 		'iDisplayStart' 	=> $_GET['iDisplayStart'],
	 		'sEcho'				=> $_GET['sEcho']
	 	], [ 
	 		'student_number',
	 		'student_name',
	 		'course_title',
	 		'year',
	 		'@view:enrollment/datatables/status',
	 		'added',
	 		'@view:enrollment/datatables/action'
	 	] );
	}

	public function new_enrollment()
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'enrollment' ])) {
			$this->form_validation->set_rules('enrollment[student_id]', 'Student', 'required');
			$this->form_validation->set_rules('enrollment[course_id]', 'Course', 'required');
			$this->form_validation->set_rules('enrollment[year]', 'Year', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'enrollment' ];
				$data_scheds = $_POST['duallistbox_enrollSchedule'];

				$result = $this->enrollment_model->new_enrollment($data);
				
				if($result[0] || true) {

					$this->enrollment_model->enroll_schedule($result[2], $data_scheds);

					$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-success">' . $result[1] . '</div>' );
					redirect(base_url($this->uri->segment(1)));	
				} else {

					$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-danger">' . $result[1] . '</div>' );	
				}
			}
		}

		$data = [ 
			'title' => 'New Enrollment',
			'schedules' => $this->schedule_model->get_sy_schedules()
		];

		
		$this->template
			->set_partial('more_css', 'scripts/enrollment_form_css')
			->set_partial('more_js', 'scripts/enrollment_form_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('enrollment/enrollment_form', $data );
	}

	public function edit_enrollment( $id = 0 )
	{	
		$this->load->helper( array('form', 'url') );
		$this->load->library( 'form_validation' );

		if (isset($_POST[ 'enrollment' ])) {
			$this->form_validation->set_rules('enrollment[student_id]', 'Student', 'required');
			$this->form_validation->set_rules('enrollment[course_id]', 'Course', 'required');
			$this->form_validation->set_rules('enrollment[year]', 'Year', 'required');
			
			if ($this->form_validation->run() != FALSE) {
				
				$data = $_POST[ 'enrollment' ];

				if($this->enrollment_model->update_enrollment($id, $data)) {
					
					$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-success">Enrollment has been updated.</div>' );
					redirect(base_url( $this->uri->segment(1)));
				} else {

					$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-danger">Unable to update enrollment, please try again.</div>' );	
				}
			}

		}

		$data = [ 
			'title' => 'Update Enrollment',
			'enrollment' => $this->enrollment_model->get_enrollment($id),
			'schedules' => $this->enrollment_model->get_enrolled_schedule($id)
		];

		$this->template
			->set_partial('more_css', 'scripts/enrollment_form_css')
			->set_partial('more_js', 'scripts/enrollment_form_js')
			->set_partial('sidebar', 'sidebar/dashboard_sidebar')
			->set_layout('dashboard_template')
			->build('enrollment/enrollment_form', $data);
	}

	public function cancel_enrollment( $id = 0 )
	{	
		if( $id > 0 )
		{
			$this->enrollment_model->cancel_enrollment( $id );
			$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-success">Enrollment has been canceled.</div>' );	
		}
		else
		{
			$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-danger">Cannot remove record.</div>' );	
		}
		
		redirect(base_url( $this->uri->segment(1)));
	}

	public function reenroll( $id = 0 )
	{	
		if( $id > 0 )
		{
			$this->enrollment_model->reenroll( $id );
			$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-success">Enrollment has been reserved.</div>' );	
		}
		else
		{
			$this->nativesession->set_flashdata( '_enrollment', '<div class="alert alert-danger">Cannot remove record.</div>' );	
		}
		
		redirect(base_url( $this->uri->segment(1)));
	}

	public function get_students()
	{
		$data = $this->enrollment_model->get_students($_GET['q']);
		echo json_encode(['items' => $data]);
	}

}
