<?php

class MySQLAdapter implements Storage {

    private $_connection;
    private $_data;

    function __construct($params) {
        $this->_connection = new mysqli("127.0.0.1", "root", "", "agenda");
        $this->_data = array();
    }

    function add($data) {
        
    }

    function update($id) {
        
    }

    function delete($id) {
        
    }

    function find($id) {
        
    }

    function fetchAll() {
        $resultado = $this->_connection->query("SELECT * FROM contactos");
        while ($row = $resultado->fetch_assoc()) {
            $tmp = array('nombre'=>$row['nombre'],'apellido_paterno'=>$row['paterno'],'apellido_materno'=>$row['materno'],'edad'=>$row['edad']);
            $this->_data[] = $tmp;
        }
        return $this->_data;
    }

}
