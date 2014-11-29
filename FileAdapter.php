<?php

class FileAdapter implements Storage {

    private $_file;
    private $_data;

    public function __construct($file) {
        $this->_file = $file;
    }

    function add($data) {
        
    }

    function update($id) {
        
    }

    function delete($id) {
        
    }

    function find($id) {
        $data =array();
        $f = file($this->file);
        foreach($f as $line){
            $data = str_getcsv($line);
        }
    }

    function fetchAll() {
        $f = file($this->_file);
        foreach ($f as $line) {
            $data = str_getcsv($line);
            $tmp = array('nombre'=>$data[0],'apellido_paterno'=>$data[1],'apellido_materno'=>$data[2],'edad'=>$data[3]);
            $this->_data[] = $tmp;
        }
        return $this->_data;
    }

}
