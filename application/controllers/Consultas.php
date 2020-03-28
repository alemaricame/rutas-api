<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include_once(APPPATH.'/libraries/REST_Controller.php');
    use  Restserver\libraries\REST_Controller;

    class Consultas extends REST_Controller{
        public function __construct(){
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
            
            parent::__construct();

            $this->load->model('Consultasmodel');
        }

        public function user_get($idRepartidor="0"){
            $result = $this->Consultasmodel->user($idRepartidor);
            $this->response($result);
        }

    	public function productos_get($idRepartidor="0"){
            $result = $this->Consultasmodel->productos($idRepartidor);
            $this->response($result);
        }
        public function citas_get($idRepartidor="0"){
            $result = $this->Consultasmodel->citas($idRepartidor);
            $this->response($result);
        }
        public function clientes_get($usuario="0"){
            $result = $this->Consultasmodel->clientes($usuario);
            $this->response($result);
        }
    }
?>