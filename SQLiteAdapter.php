<?php

class SQLiteAdapter implements Storage {

    private $_connection;
    private $_data;
    private $_filtro;

    public function __construct($file) {
        $this->_filtro = FALSE;
        $this->_connection = new SQLite3("data/$file");
        if (!file_exists($file)) {
            $create = <<<'TABLE'
CREATE TABLE contactos(
id_contacto INTEGER PRIMARY KEY,
nombre TEXT    NOT NULL,
apellido_p TEXT    NOT NULL,
apellido_m TEXT    NOT NULL,
edad INT     NOT NULL
);
TABLE;
        //$this->_connection->exec($create);
        }
    }

    function add($data) {        
        $insert = sprintf(""
        . "INSERT INTO contactos"
        . "(nombre, apellido_p, apellido_m, edad) "
        . "VALUES ("
                #. "'%s', "
                . "'%s', '%s', '%s', '%d')", 
                #''.$data['id_contacto'].'', 
                ''.$data['nombre'].'', 
                ''.$data['apellido_p'].'', 
                ''.$data['apellido_m'].'',
                ''.$data['edad'].''
                );
        $this->_connection->exec($insert);        
    }

    function update($data) {
              
        $var = "nombre = '".$data['parametros']['nombre']."' ";
                
        $update = sprintf(""
        . "UPDATE contactos SET "
        .((array_key_exists('nombre', $data['parametros']) ? "nombre = '".$data['parametros']['nombre']."' " : ''))
        .((array_key_exists('apellido_p', $data['parametros']) ? ",apellido_p = '".$data['parametros']['apellido_p']."' " : '')) 
        .((array_key_exists('apellido_m', $data['parametros']) ? ",apellido_m = '".$data['parametros']['apellido_m']."' " : '')) 
        .((array_key_exists('edad', $data['parametros']) ? ",edad = '".$data['parametros']['edad']."' " : ''))         
        . "WHERE id_contacto = ".$data['id']                
        );
        #die($update);
        $this->_connection->exec($update);        
    }

    function delete($data) {
        $update = sprintf("DELETE FROM contactos WHERE id_contacto = ".$data['id']);
        $this->_connection->exec($insert);
    }

    function find($data) {                
        if($data['campo'] != ''){
            $sql = "SELECT * FROM contactos where ".$data['campo']." = '".$data['busqueda']."'" ;
            $this->_filtro = $sql;   
            
        }        
    }

    function fetchAll() {
        if(!$this->_filtro){
            $resultado = $this->_connection->query("SELECT * FROM contactos");
        }else{
            $resultado = $this->_connection->query($this->_filtro);
        }        
        while ($row = $resultado->fetchArray(SQLITE3_ASSOC)) {
            $tmp = array('nombre' => $row['nombre'], 'apellido_paterno' => $row['apellido_p'], 'apellido_materno' => $row['apellido_m'], 'edad' => $row['edad']);
            $this->_data[] = $tmp;
        }
        return $this->_data;
    }

}
