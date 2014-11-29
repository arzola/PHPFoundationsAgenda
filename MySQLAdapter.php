<?php

class MySQLAdapter implements Storage {

    private $_connection;
    private $_data;
    private $_filtro;

    function __construct($params) {
        $this->_connection = new mysqli($params[0], $params[1], $params[2], $params[3]);
        $this->_data = array();
        $this->_filtro = false;
    }

    function add($data) {
        $sql = <<<INSERTDATA
                INSERT INTO contactos(nombre, apellido_paterno, apellido_materno, edad) 
                    values('{$data['nombre']}','{$data['apellido_paterno']}','{$data['apellido_materno']}','{$data['edad']}');
INSERTDATA;
        $this -> _connection -> query($sql);
    }

    function update($data) {
        $sql1 = '';
        foreach($data['parametros'] as $key => $val)
        {
            $sql1 .= $key . " = '$val', ";
        }
        $sql1 = substr($sql1,0,-2);
        $sql = <<<UPDATEDATA
                UPDATE contactos SET $sql1 WHERE id_contacto = {$data['id']};
UPDATEDATA;
        $this -> _connection -> query($sql);
    }

    function delete($id) {
        $sql = <<<DELETEDATA
                DELETE FROM contactos WHERE id_contacto = $id;
DELETEDATA;
        $this -> _connection -> query($sql);
    }

    function find($data) {
        $sql = <<<SELECTDATA
                SELECT * FROM contactos WHERE {$data['campo']} LIKE '%{$data['busqueda']}%';
SELECTDATA;
        $this -> _filtro = $sql;
    }

    function fetchAll() {
        if($this -> _filtro === false)
        {
            $resultado = $this->_connection->query("SELECT * FROM contactos");
        }else{
            $resultado = $this->_connection->query($this -> _filtro);
            $this -> _filtro = false;
        }
        while ($row = $resultado->fetch_assoc()) {
            $tmp = array('nombre'=>$row['nombre'],'apellido_paterno'=>$row['apellido_paterno'],'apellido_materno'=>$row['apellido_materno'],'edad'=>$row['edad']);
            $this->_data[] = $tmp;
        }
        return $this->_data;
    }

}
