<?php

class MySQLAdapter implements Storage {

    private $_connection;
    private $_data;
    private $_filtro;

    function __construct($params) {
        $this->_connection = new mysqli($params[0], $params[1], $params[2], $params[3]);
        $this->_data = array();
        $this->_filtro = FALSE;
    }

    function add($data) {
        $sql = <<<INSERTDATA
INSERT INTO contactos(nombre,apellido_paterno,apellido_materno,edad)
values('{$data['nombre']}','{$data['apellido_paterno']}','{$data['apellido_materno']}','{$data['edad']}')
INSERTDATA;
        $this->_connection->query($sql);
    }

    function update($id) {
        $strDatos = '';
        foreach($id['parametros'] as $key => $val){
            $strDatos .= $key." = '".$val."',";
        }
        $strDatos = substr($strDatos,-1);
        $sql = <<<UPDATEDATA
                UPDATE contactos SET $strDatos
                where id_contacto = '{$id['id']}'                        
UPDATEDATA;
           echo $sql;             
           $this->_connection->query($sql);
    }

    function delete($id) {
        $sql = <<<DELETEDATA
                DELETE FROM contactos  WHERE id_contacto = '$id'
DELETEDATA;
        echo $sql;
        $this->_connection->query($sql);
    }

    function find($id) {  
        
        $sql = <<<FINDDATA
                SELECT nombre, apellido_paterno, apellido_materno, edad from contactos 
                    where {$id['campo']} = '{$id['busqueda']}'
FINDDATA;
           
         $this->_filtro =$sql;
         //$resultado = $this->_connection->query($sql);
         
         /*while ($row = $resultado->fetch_assoc()) {
            $tmp = array('nombre'=>$row['nombre'],'apellido_paterno'=>$row['apellido_paterno'],'apellido_materno'=>$row['apellido_materno'],'edad'=>$row['edad']);
            $this->_data[] = $tmp;
        }
        $this->_filtro = true;*/        
    }

    function fetchAll() {
        if( $this->_filtro === false)
        {
            $resultado = $this->_connection->query("SELECT * FROM contactos");
        }else{
            $resultado = $this->_connection->query($this->_filtro);
            $this->_filtro = false;
        }
        while ($row = $resultado->fetch_assoc()) {
            $tmp = array('nombre'=>$row['nombre'],'apellido_paterno'=>$row['apellido_paterno'],'apellido_materno'=>$row['apellido_materno'],'edad'=>$row['edad']);
            $this->_data[] = $tmp;
        }
        return $this->_data;
    }

}
