<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

class FileAdapter implements Storage {

    private $_file;
    private $_data;
    private $_fileName;
    private $_filtro;

    public function __construct($file, $filtro = false) {
        $this->_file = file($file);
        $this->_fileName = $file;
        $this->_filtro = $filtro;
    }

    public function add($data, $valorMax = true) {
        if($valorMax == true){
            $data['id'] = $this->getNextId();    
        }
        $data['parametros']['id'] = $data['id'];
        $cadena = $this->makeLine($data['parametros']);
        file_put_contents($this->_fileName, $cadena, FILE_APPEND);
        return $data['id'];
    }

    public function update($data) {
        
        $data['parametros']['id'] = $data['id'];
        $dataOriginal = $this->findById($data['id']);
        
        foreach($data['parametros'] as $campo =>$valor){
            if(key_exists($campo, $dataOriginal)){
                $dataOriginal[$campo] = $valor;
            }
        }
        
        $this->delete($data['id']);
        $this->add($dataOriginal,false);
       
    }
    
    public function findById($id){
        $datosArray = array();
        foreach($this->_file as $line){
            $sourceFiles = str_getcsv($line);
            $sourceDatos = $this->to_array($sourceFiles);
            if($sourceDatos['id'] == $id){
                $datosArray =  $sourceDatos;
                break;
            }
        }
        
        return $datosArray;
    }

    function delete($id) {
        $nuevoCadena="";
        foreach($this->_file as $line){
            $data = str_getcsv($line);
            if($data[0] != $id){
                $arreglo = $this->to_array($data);
                $nuevoCadena.= $this->makeLine($arreglo);
            }
        }
        
        file_put_contents($this->_fileName , $nuevoCadena);
    }

    public function find($data) {
        
        $busqueda = array();
        foreach($this->_file as $line){
            $sourceFiles = str_getcsv($line);
            $sourceDatos = $this->to_array($sourceFiles);
            
            if(strstr(strtoupper($data['busqueda']), strtoupper($sourceDatos[$data['campo']]))){
                array_push($busqueda, $sourceDatos);
            }   
        }
        $this->_data = $busqueda;
        
        return $this->_data;
    }

    function fetchAll() {
        
        if($this->_filtro== false) {
            foreach ($this->_file as $line) {
                $data = str_getcsv($line);
                $tmp = $this->to_array($data);
                $this->_data[] = $tmp;
            }
        }
        
        return $this->_data;
        
    }
    
    private function to_array(array $data){
        
        return array('id'=>$data[0],'nombre'=>$data[1],'apellido_paterno'=>$data[2],'apellido_materno'=>$data[3],'edad'=>$data[4]);

    }
    
    private function getNextId(){
        $maxId = 0;
        foreach($this->_file as $line){
            $data = str_getcsv($line);
            
            if($data[0] > $maxId){
                $maxId = $data[0];
            }
        }
        $maxId++;
        return $maxId;
    }

    public function makeLine(array $data) {
        
        return $data['id'].",".$data['nombre'].",".$data['apellido_paterno'].",".$data['apellido_materno'].",".$data['edad'].PHP_EOL;
    }

}
