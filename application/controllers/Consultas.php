<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    include_once(APPPATH.'/libraries/REST_Controller.php');
    use  Restserver\libraries\REST_Controller;

    class Consultas extends REST_Controller{
        public function __construct(){
            header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
            header("Access-Control-Allow-Headers: contentType:x-www-form-urlencoded; charset=utf-8, Content-Length, Accept-Encoding");
            header("Access-Control-Allow-Origin: * ");
            
            parent::__construct();

            $this->load->model('Consultasmodel');
        }

    	public function productos_post(){
            $data = $this->post();

            $result = $this->Consultasmodel->productos($data);
            $this->response($result);
        }
        public function clientes_post(){
            $data = $this->post();
            $result = $this->Consultasmodel->clientes($data);
            $this->response($result);
        }
        public function citas_get($idRepartidor="0"){
            $result = $this->Consultasmodel->citas($idRepartidor);
            $this->response($result);
        }
        public function agregarventa_post(){
            // $data = $this->post();
            // $result = $this->Loginmodel->login($data);

            // $this->response($result);

            $data = $this->post();
            $result = $this->Consultasmodel->venta($data);
            $this->response($result);
        }

        public function verventas_post(){
            $data = $this->post();
            $result = $this->Consultasmodel->getventas($data);
            $this->response($result);
        }

        public function productosventas_post(){
            $data = $this->post();
            $result = $this->Consultasmodel->getproductos($data);
            $this->response($result);
        }

        public function editClient_post(){
            $data = $this->post();
            $result = $this->Consultasmodel->editClient($data);
            $this->response($result);
        }

        public function getUsers_get(){
            $result = $this->Consultasmodel->getVendedores();
            $this->response($result);
        }


        public function updateProducto_post(){
            $data = $this->post();
            $result = $this->Consultasmodel->updateProduct($data);
            $this->response($result);
        }

        
        public function addCliente_post(){
            $data = $this->post();
            $result = $this->Consultasmodel->addCliente($data);
            $this->response($result);
        }

        public function deleteCliente_post(){
            $data = $this->post();
            $result = $this->Consultasmodel->deleteCliente($data);
            $this->response($result);
        }

        public function inventario_get(){
            $data = $this->get();
            $result = $this->Consultasmodel->inventario();
            $this->response($result);
        }
    }
?>