<?php

require_once 'RepositorioInterface.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RepositorioMysql
 *
 * @author mariomendoza
 */
class RepositorioMysql implements RepositorioInterface{
    
    private $conexion;
    
    public function __construct() {
        //$this->conexion = mysqli_connect('127.0.0.1', 'root', 'secreto', 'agenda', '33060');
    }
    
    public function listaContactos() {
        $arrayDatos = array();
        $conexion = mysqli_connect('127.0.0.1', 'root', 'secret', 'agenda', '33060');
        
        if($conexion->connect_errno){
            echo "error en la conexion";
            die();
        }
        
        $qry = "SELECT id_contacto id, nombre, apellido_paterno apellido_p, apellido_materno apellido_m, direccion, notas, edad FROM contactos";
        
        $rs = $conexion->query($qry);
        
        while($row = $rs->fetch_assoc()){
            $arrayDatos[] = $row;
        }

        return $arrayDatos;
    }

//put your code here
}
