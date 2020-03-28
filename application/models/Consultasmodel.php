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

}
    
?>