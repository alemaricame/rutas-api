<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
    die();
}

class Rutas extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Loginmodel');

		$this->info = array(
			'error' => '',
			'ok'	=> '',
			'mensaje' => ''
		);			
    }
    
    public function login(){
		var_dump("mensa");
		die();
	}
}
?>