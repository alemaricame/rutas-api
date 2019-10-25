<?php
    class Consultasmodel extends CI_Model{
        public function __construct(){
            parent::__construct();
        }
    

    public function productos($idRepartidor){
        $this->db->select('*');
        $this->db->from('productos');
        $this->db->where('idRepatidor',$idRepartidor);
        $consulta = $this->db->get();
        $datos = $consulta->result_array();

        return $datos;
    }

    public function citas($idRepartidor){
        $this->db->select('*');
        $this->db->from('citas');
        $this->db->where('idRepartidor',$idRepartidor);
        $consulta = $this->db->get();
        $datos = $consulta->result_array();

        return $datos;
    }

}
    
?>