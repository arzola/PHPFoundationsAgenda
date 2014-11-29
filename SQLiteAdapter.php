<?php

class SQLiteAdapter implements Storage {

    private $_connection;
    private $_data;

    public function __construct($file) {
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
        
    }

    function update($id) {
        
    }

    function delete($id) {
        
    }

    function find($id) {
        
    }

    function fetchAll() {
        $resultado = $this->_connection->query("SELECT * FROM contactos");
        while ($row = $resultado->fetchArray(SQLITE3_ASSOC)) {
            $tmp = array('nombre' => $row['nombre'], 'apellido_paterno' => $row['apellido_p'], 'apellido_materno' => $row['apellido_m'], 'edad' => $row['edad']);
            $this->_data[] = $tmp;
        }
        return $this->_data;
    }

}
