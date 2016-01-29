<?php if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class Nativesession
{
    public function __construct()
    {
        ini_set('session.cookie_lifetime', 60 * 60 * 24 * 300);
		ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 300);
        session_start();
    }

    public function set( $key, $value = null )
    {
        if ( !is_array( $key ) )
		{
			$_SESSION[ $key ] = $value;
			
			return true;
		}
		
		foreach ( $key as $i => $v )
		{
			$_SESSION[ $i ] = $v;
		}
		
		return true;
    }

    public function get( $key )
    {
        return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
    }
    

    public function regenerateId( $delOld = false )
    {
        session_regenerate_id( $delOld );
    }

    public function delete( $key )
    {
		if ( isset( $_SESSION[ $key ] ) )
		{
			unset( $_SESSION[ $key ] );
		}
    }
	
	private $flash_prefix = 'native_flash_';
	public function set_flashdata( $key, $value )
	{
		$_SESSION[ $this->flash_prefix . $key ] = $value;
	}
	
	public function flashdata( $key, $default = null )
	{
		$return_value = isset( $_SESSION[ $this->flash_prefix . $key ] ) ? $_SESSION[ $this->flash_prefix . $key ] : $default;
		
		$this->delete( $this->flash_prefix . $key );
		
		return $return_value;
	}
	
	public function sess_destroy()
	{
		session_destroy();
	}
}
?>