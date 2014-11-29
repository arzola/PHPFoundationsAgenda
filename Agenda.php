<?php

require_once 'Storage.php';

class Agenda{
    
    private $_datasource;
    
    public function __construct(Storage $data) {
        $this->_datasource = $data;
    }
    /*
     * Implementar métodos del adaptador de datos
     */
    
    public function add($data){
        //return $this->datasource->fetchAll($data);
    }
    
    public function update($id){
        //return $this->datasource->fetchAll($id);
    }
    
    public function find($where){
        //return $this->datasource->fetchAll($where);
    }
    
    public function delete($id){
       // return $this->datasource->fetchAll($id);
    }
    
    public function fetchAll(){
        return $this->_datasource->fetchAll();
    }
    
    public function __toString() {
        //return $this->datasource->fetchAll();
    }
    
}
