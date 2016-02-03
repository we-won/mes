<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Datatables {

	function __construct()
	{
		$this->ci =& get_instance();
	}

	public function records( $data, $column )
	{
		
			$this->ci->load->model( $data[ 'model_loc' ] );
			/* Paging */
			

			// $iTotalRecords = $this->ci->$data[ 'model' ]->get_max_pages( $data[ 'search' ] );

			$get_max = ( isset($data['get_max']) ) ? $data['get_max'] : 'get_max_pages';
			$iTotalRecords = ( isset($data['where']) ) ? $this->ci->$data[ 'model' ]->$get_max( $data[ 'search' ], $data['where'] ) :  $this->ci->$data[ 'model' ]->$get_max( $data[ 'search' ] );
			

			// $iTotalRecords = $data[ 'iTotalRecords' ];
			$iDisplayLength = intval( $data[ 'iDisplayLength' ] );
			$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
			$iDisplayStart = intval( $data[ 'iDisplayStart' ] );
			$sEcho = intval( $data[ 'sEcho' ] );


			$func = ( isset($data['func']) ) ? $data['func'] : 'get';

			$results = ( isset($data['where']) ) ? $this->ci->$data[ 'model' ]->$func( $iDisplayStart, $iDisplayLength, $data[ 'search' ], $data['where'] ) : $this->ci->$data[ 'model' ]->$func( $iDisplayStart, $iDisplayLength, $data[ 'search' ] );
			
			// $records = array();
			$records["aaData"] = array(); 

				$ctr =  count( $column );

			foreach( $results as $row )
			{
				$item = array();
				$action = '';

				for( $i = 0; $i < $ctr; $i++ )
				{
					
					if( preg_match( '/^@/', $column[ $i ] ) )
					{
						$item[] = $this->ci->load->view( 'admin/datatables/' . str_replace('@', '', $column[ $i ] ), $row, TRUE );
					}
					else
					{
						$item[] = $row->$column[$i];
					}
				}
				
				$records["aaData"][] = $item;
			}


			$records["sEcho"] = $sEcho;
			$records["iTotalRecords"] = $iTotalRecords;
			$records["iTotalDisplayRecords"] = $iTotalRecords;

			return json_encode($records);
	}

	public function records_basic( $data, $column )
	{
		 /* Paging */
		  $iTotalRecords = $data[ 'iTotalRecords' ];
		  $sEcho = intval( $data[ 'sEcho' ] );
		  
		  $records = array();
		  $records["aaData"] = array(); 

		  	$ctr =  count( $column );

			foreach( $data[ 'aaData' ] as $row )
			{
				$item = array();
				$action = '';

				for( $i = 0; $i < $ctr; $i++ )
				{
					
					if( preg_match( '/^@/', $column[ $i ] ) )
					{
						$item[] = $this->ci->load->view( 'admin/datatables/' . str_replace('@', '', $column[ $i ] ), $row, TRUE );
					}
					else
					{
						$item[] = $row->$column[$i];
					}
				}
				
				$records["aaData"][] = $item;
			}

		 
		  $records["sEcho"] = $sEcho;
		  $records["iTotalRecords"] = $iTotalRecords;
		  $records["iTotalDisplayRecords"] = $iTotalRecords;
		  
		  return json_encode($records);
	}


	public function datatables_game( $data, $column )
	{
		
			$this->ci->load->model( $data[ 'model_loc' ] );
			/* Paging */
			
			$get_max = ( isset($data['get_max']) ) ? $data['get_max'] : 'get_max_pages';
			$iTotalRecords = 0;
			if( isset($data['where']) )
			{

				$iTotalRecords = $this->ci->$data[ 'model' ]->$get_max( $data[ 'search' ], $data['where'] );
			}
			else
			{
				$iTotalRecords = $this->ci->$data[ 'model' ]->$get_max( $data[ 'search' ] );
			}

			$iDisplayLength = intval( $data[ 'iDisplayLength' ] );
			$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
			$iDisplayStart = intval( $data[ 'iDisplayStart' ] );
			$sEcho = intval( $data[ 'sEcho' ] );

			$func = ( isset($data['func']) ) ? $data['func'] : 'get';

			$results = array();

			if( isset($data['where']) )
			{
				$results = $this->ci->$data[ 'model' ]->$func( $iDisplayStart, $iDisplayLength, $data[ 'search' ], $data['where'] );
			}
			else
			{
				$results = $this->ci->$data[ 'model' ]->$func( $iDisplayStart, $iDisplayLength, $data[ 'search' ] );
			}
			
			

			// $records = array();
			$records["aaData"] = array(); 

			$ctr =  count( $column );

			foreach( $results as $row )
			{
				$item = array();
				$action = '';

				for( $i = 0; $i < $ctr; $i++ )
				{
					
					if( preg_match( '/^@/', $column[ $i ] ) )
					{
						$item[] = $this->ci->load->view( 'datatables/' . str_replace('@', '', $column[ $i ] ), $row, TRUE );
					}
					else
					{
						$item[] = $row->$column[$i];
					}
				}
				
				$records["aaData"][] = $item;
			}


			$records["sEcho"] = $sEcho;
			$records["iTotalRecords"] = $iTotalRecords;
			$records["iTotalDisplayRecords"] = $iTotalRecords;

			return json_encode($records);
	}


	public function make( $data, $column )
	{
		
			$this->ci->load->model( $data[ 'model_loc' ] );
			/* Paging */
			

			// $iTotalRecords = $this->ci->$data[ 'model' ]->get_max_pages( $data[ 'search' ] );

			$get_max = ( isset($data['func_get_max']) && !empty( $data['func_get_max'] ) ) ? $data['func_get_max'] : 'get_max_pages';
			$iTotalRecords = ( isset($data['where']) ) ? $this->ci->$data[ 'model' ]->$get_max( $data[ 'search' ], $data['where'] ) :  $this->ci->$data[ 'model' ]->$get_max( $data[ 'search' ] );
			

			// $iTotalRecords = $data[ 'iTotalRecords' ];
			$iDisplayLength = intval( $data[ 'iDisplayLength' ] );
			$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength; 
			$iDisplayStart = intval( $data[ 'iDisplayStart' ] );
			$sEcho = intval( $data[ 'sEcho' ] );


			$func = ( isset($data['func_get']) && !empty( $data['func_get'] ) ) ? $data['func_get'] : 'get';

			$results = ( isset($data['where']) ) ? $this->ci->$data[ 'model' ]->$func( $iDisplayStart, $iDisplayLength, $data[ 'search' ], $data['where'] ) : $this->ci->$data[ 'model' ]->$func( $iDisplayStart, $iDisplayLength, $data[ 'search' ] );
			
			// $records = array();
			$records["aaData"] = array(); 

			$ctr =  count( $column );

			$viewParseRegex = '/@view\:/';

			foreach( $results as $row )
			{
				$item = array();
				$action = '';

				for( $i = 0; $i < $ctr; $i++ )
				{
					
					if( preg_match( $viewParseRegex, $column[ $i ] ) )
					{
						// $item[] = $this->ci->load->view( 'admin/datatables/' . str_replace('@', '', $column[ $i ] ), $row, TRUE );
						$item[] = $this->ci->load->view( trim( preg_replace( $viewParseRegex, '', $column[ $i ] ) ), $row, TRUE );
					}
					else
					{
						$item[] = $row->$column[$i];
					}
				}
				
				$records["aaData"][] = $item;
			}


			$records["sEcho"] = $sEcho;
			$records["iTotalRecords"] = $iTotalRecords;
			$records["iTotalDisplayRecords"] = $iTotalRecords;

			return json_encode($records);
	}

}