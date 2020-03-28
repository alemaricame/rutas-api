<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include_once(APPPATH.'/libraries/REST_Controller.php');
    use  Restserver\libraries\REST_Controller;

    class Login extends REST_Controller{
        public function __construct(){

            header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: contentType:x-www-form-urlencoded; charset=utf-8, Content-Length, Accept-Encoding");
            header("Access-Control-Allow-Origin: * ");
            
            parent::__construct();

            $this->load->model('Loginmodel');
        }


    	public function login_post(){
            if($datos = !empty($this->input->post('data')) ? $this->input->post('data') : false ){
                $result = $this->MasterModel->getUsers($datos);
                echo json_encode($result);
            }
            $data = $this->post();
            $result = $this->Loginmodel->login($data);

            $this->response($result);
        }
        public function recuperapass_get($usuarioRepartidor="0"){
            $this->response($usuarioRepartidor);

           // $result = $this->Loginmodel->recuperapass($usuarioRepartidor);
            //$this->response($result);
        }

        public function agregarventa_post(){

                $this->response(array('error' => TRUE,'status' => 'ERROR'));
            
          }
        
        
    }
?>