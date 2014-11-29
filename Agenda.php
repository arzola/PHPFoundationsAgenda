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
        return $this->_datasource->add($data);
    }
    
    public function update($data){
        return $this->_datasource->update($data);
    }
    
    public function find($where){
        return $this->_datasource->find($where);
    }
    
    public function delete($id){
        return $this->_datasource->delete($id);
    }
    
    public function fetchAll(){
        return $this->_datasource->fetchAll();
    }
    
    public function __toString() {
        //return $this->datasource->fetchAll();
    }
    
}
