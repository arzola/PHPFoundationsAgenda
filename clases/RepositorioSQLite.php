<?php

require_once 'RepositorioInterface.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conectar
 *
 * @author mariomendoza
 */
class RepositorioSQLite implements RepositorioInterface {
    //put your code here
    
    private $tipoConexcion ;
    
    public function __construct() {
        
    }

    public function listaContactos() {
        $rows = array();
        $db = new SQLite3('data/db.sqlite');
        
        $qry = "SELECT * FROM contacts";

        $rs = $db->query($qry);
        
        while($row = $rs->fetchArray(SQLITE3_ASSOC)){
            $rows[] = $row;
        }
        
        return $rows;
    }

}
