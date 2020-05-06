<?php
    class Consultasmodel extends CI_Model{
        public function __construct(){
            parent::__construct();
        }
    

    public function productos($data){
        $this->db->select('*');
        $this->db->from('vendedoresreinventario');
        $this->db->where("idUser",$data['idUser']);
        $consulta = $this->db->get();
        $datos = $consulta->result_array();

        return $datos;
    }

    public function clientes($data){
        $this->db->select('*');
        $this->db->from('client');
        $this->db->where('nombreUsuario',$data['usuario']);
        $consulta = $this->db->get();
        $datos = $consulta->result_array();

        return $datos;
    }

    public function citas($idRepartidor){
        $this->db->select('*');
        $this->db->from('citas');
        $this->db->where('idRepartidor',$data['idUser']);
        $consulta = $this->db->get();
        $datos = $consulta->result_array();

        return $datos;
    }



    public function user($idRepartidor){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('usuario','Pedro');
        $this->db->where('password','Pedro123');
        $consulta = $this->db->get();
        $datos = $consulta->result_array();

        return $datos;
    }

    public function venta($data){
        $productos = $data['productos'];

        $detail = array(
            "idUser"=> $data['idUser'],
            "id_client"=> $data['id_client'],
            "total_pago"=> $data['total_pago'],
            "tipo_pago"=> $data['tipo_pago'],
            "monto_pagado" => $data['monto_pagado'],
            "saldo" => $data['saldo']
        );

        $this->db->insert('ventasrepartidor', $detail);
        $idVentaRepartidor = $this->db->insert_id();


        $max = sizeof($productos);
        for($i = 0; $i < $max;$i++){
            array_push($productos[$i],$productos['idventarepartidor']=$idVentaRepartidor);

            $productosData = $productos[$i];

            $prod = array(
                "idVentaRepartidor" => $productosData[0],
                "id_inv" => $productosData['id_inv'],
                "cantidad" => $productosData['cantidad'],
                "producto" => $productosData['cantV'],
                "total" => $productosData['total'],
                "descripcion" => $productosData['descripcion']
            );

            $this->db->insert('ventasrepartidor_detalle', $prod);
        }

        return $idVentaRepartidor = $this->db->insert_id();


    }

    public function getventas($data){
        $this->db->select('*');
        $this->db->from('ventasrepartidor');
        $this->db->where("idUser",$data['idUser']);
        $consulta = $this->db->get();
        $datos = $consulta->result_array();

        $data = array(
            "detalle" =>  $datos
        );

        return $data;
    }

    public function getproductos($data){
        $this->db->select('*');
        $this->db->from('ventasrepartidor_detalle');
        $this->db->where("idVentaRepartidor",$data['idVentaRepartidor']);
        $consultas = $this->db->get();
        $datost = $consultas->result_array();

        return $datost;
    }

}
    
?>