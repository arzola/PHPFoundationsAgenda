<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RespositorioFile
 *
 * @author mariomendoza
 */
class RepositorioFile implements RepositorioInterface{
    public function listaContactos() {
        $file = file('/Library/WebServer/Documents/sitios/PHPFoundationsAgenda/data/db.csv');
        $rows = array();
        foreach($file as $string){
            $row = str_getcsv ($string, ",");
            $rows[] = ["id" => $row[0] , "nombre" => $row[1] , "apellido_p" => $row[2], "apellido_m" => $row[3], "edad" => $row[4]];
        }
        return $rows;
    }

//put your code here
}
