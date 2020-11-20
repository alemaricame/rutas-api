<?php
// set the default timezone to use. Available since PHP 5.1
date_default_timezone_set('UTC');
    class Consultasmodel extends CI_Model{
        public function __construct(){
            parent::__construct();
        }
    

    public function productos($data){
        $this->db->select('*');
        $this->db->from('vendedoresreinventario');
        $this->db->where("idUser",$data['idUser']);
        $this->db->order_by("descripcion", "ASC");
        $consulta = $this->db->get();
        $datos = $consulta->result_array();

        return $datos;
    }

    public function clientes($data){
        $day = date("l");
                 $this->db->select('*');
                $this->db->from('client');
                $this->db->where('nombreUsuario',$data['usuario']);
                $consulta = $this->db->get();
                $datos = $consulta->result_array();
        // switch ($day) {
        //     case 'Monday':
        //         $this->db->select('*');
        //         $this->db->from('client');
        //         $this->db->where('nombreUsuario',$data['usuario']);
        //         $this->db->where('comentario','Ruta Lunes');
        //         $consulta = $this->db->get();
        //         $datos = $consulta->result_array();
        //     break;
        //     case 'Tuesday':
        //         $this->db->select('*');
        //         $this->db->from('client');
        //         $this->db->where('nombreUsuario',$data['usuario']);
        //         $this->db->where('comentario','Ruta Martes');
        //         $consulta = $this->db->get();
        //         $datos = $consulta->result_array();
        //     break;
        //     case 'Wednesday':
        //         $this->db->select('*');
        //         $this->db->from('client');
        //         $this->db->where('nombreUsuario',$data['usuario']);
        //         $this->db->where('comentario','Ruta Miercoles');
        //         $consulta = $this->db->get();
        //         $datos = $consulta->result_array();
        //     break;
        //     case 'Thursday':
        //         $this->db->select('*');
        //         $this->db->from('client');
        //         $this->db->where('nombreUsuario',$data['usuario']);
        //         $this->db->where('comentario','Ruta Jueves');
        //         $consulta = $this->db->get();
        //         $datos = $consulta->result_array();
        //     break;
        //     case 'Friday':
        //         $this->db->select('*');
        //         $this->db->from('client');
        //         $this->db->where('nombreUsuario',$data['usuario']);
        //         $this->db->where('comentario','Ruta Viernes');
        //         $consulta = $this->db->get();
        //         $datos = $consulta->result_array();
        //     break;
        //     case 'Saturday':
        //         $this->db->select('*');
        //         $this->db->from('client');
        //         $this->db->where('nombreUsuario',$data['usuario']);
        //         $this->db->where('comentario','Ruta Sabado');
        //         $consulta = $this->db->get();
        //         $datos = $consulta->result_array();
        //     break;
            
        //     default:
        //         # code...
        //     break;
        // }
        
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
            "fecha_add"=> $data['fecha_add'],
            "id_client"=> $data['id_client'],
            "total_pago"=> $data['total_pago'],
            "tipo_pago"=> $data['tipo_pago'],
            "monto_pagado" => $data['monto_pagado'],
            "saldo" => $data['saldo']
        );

        $this->db->insert('ventasrepartidor', $detail);
        $idVentaRepartidor = $this->db->insert_id();


        $max = sizeof($productos);
        for($j = 0; $j < $max;$j++){
            $productosData = $productos[$j];
            //die(json_encode($productos[$j]['idProducto']));
            $this->db->select('vendedoresreinventario.cantidad');
            $this->db->from('vendedoresreinventario');
            $this->db->where('idProducto',$productosData['idProducto']);
            $this->db->where('idUser',$data['idUser']);
            $consulta = $this->db->get();
            $datos = $consulta->result_array();

            
            $updateInventario[$j] = $datos[0]['cantidad'] - $productosData['cantV'];
            $sql = "UPDATE vendedoresreinventario SET cantidad = ? WHERE id_inv = ?";
            $this->db->query($sql, array($updateInventario[$j], $productosData['id_inv']));
            
        }


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

        return $idVentaRepartidor;


    }

    public function getventas($data){
        $this->db->select('*');
        $this->db->from('ventasrepartidor');
        $this->db->where("idUser",$data['idUser']);
        $consulta = $this->db->get();
        $datos = $consulta->result_array();


        return $datos;
    }

    public function getproductos($data){
        $user = $data['idVentaRepartidor'];
        $this->db->select('*');
        $this->db->from('ventasrepartidor_detalle');
        $this->db->where("ventasrepartidor_detalle.idVentaRepartidor",$data['idVentaRepartidor']);
        $consulta = $this->db->get();
        $datos = $consulta->result_array();        
        return $datos;
    }


    public function editClient($data){
        $cliente = $data['nombre_cte'];
        $id_client = $data['id_client'];
        $direccion = $data['direccion'];
        $comunidad = $data['comunidad'];
        $telefono = $data['telefono'];
        $comunidad = $data['comunidad'];
        $nombreUsuario = $data['nombreUsuario'];
        $comentario = $data['comentario'];

        $sql = "UPDATE client SET nombre_cte = '$cliente', direccion = '$direccion', comunidad = '$comunidad', telefono = '$telefono',  comentario = '$comentario', nombreUsuario = '$nombreUsuario'
        WHERE id_client = $id_client";       
        $resultados = $this->db->query($sql);
        return $resultados;
    }


    public function abonos($data){
        return $data;
    }

    public function getVendedores(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("tipo",'Vendedor');
        $consultas = $this->db->get();
        $datost = $consultas->result_array();

        return $datost;
    }

    public function updateProduct($data){


        $productosDataCantidad = $data['cantidad'];
        $total = $data['total'];
        $productosDataId = $data['idProducto'];

        $sql = "UPDATE vendedoresreinventario SET cantidad = '$productosDataCantidad', total = '$total'
        WHERE idProducto = $productosDataId";   
        
        $resultados = $this->db->query($sql);
        return $resultados;


    }

    public function addProduct($data){

    }

    public function addCliente($data){
        $this->db->insert('client', $data);
        return $this->db->insert_id();
    }

    public function deleteCliente($data){
        $sql = ('DELETE from client where id_client = '.$data[0].'');
        $resultados = $this->db->query($sql);

        return $resultados;
    }
    

    public function inventario(){
        $this->db->select('*');
        $this->db->from('inventario');
        $consulta = $this->db->get();
        $datos = $consulta->result_array();
        return $datos;
    }

    //editarstockproducto
    public function editarstockproducto($data){
        $idproducto = $data['idProducto'];
        $stock = $data['almacen'];
      

        $sql = "UPDATE inventario SET almacen = '$stock' 
        WHERE idProducto = $idproducto";       
        $resultados = $this->db->query($sql);
        return $resultados;
    }

    public function vendedores(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("tipo",'Vendedor');
        $consulta = $this->db->get();
        $datos = $consulta->result_array();
        return $datos;
    }

    public function vendedor($idRepartidor){
        $this->db->select('*');
        $this->db->from('clientesmostrador');
        $this->db->where('idclientesmostrador',$idRepartidor['id']);
        $consulta = $this->db->get();
        $datos = $consulta->result_array();
        return $datos;
    }

    public function addProductoVendedor($data){
        $this->db->insert('vendedoresreinventario', $data);
        return $this->db->insert_id();
    }

}
    
?>