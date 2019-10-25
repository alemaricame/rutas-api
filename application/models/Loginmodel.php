<?php
    class Loginmodel extends CI_Model{
        public function __construct(){
            parent::__construct();
        }
    

    public function login($data){

        $this->db->select('*');
        $this->db->from('repartidor');
        $this->db->where('usuarioRepartidor',$data['usuarioRepartidor']);
        $this->db->where('passRepartidor',$data['passRepartidor']);
        $consulta = $this->db->get();
        $datos = $consulta->row();

        if($datos){
            return $datos;
        }else{
            return $datos="error";
    
        }
    }

    public function recuperapass($usuarioRepartidor){
        $this->db->select('passRepartidor');
        $this->db->from('repartidor');
        $this->db->where('usuarioRepartidor',$usuarioRepartidor);
        $consulta = $this->db->get();
        $datos = $consulta->row();

        if($datos){
            return $datos;
        }else{
            return $datos="error";
    
        }
    }

}
    
?>