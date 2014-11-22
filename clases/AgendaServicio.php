<?php
 
require 'RepositorioInterface.php';
require_once 'clases/RepositorioMysql.php';
require_once 'clases/RepositorioSQLite.php';
require_once 'clases/RepositorioFile.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AgendaServicio
 *
 * @author mariomendoza
 */
class AgendaServicio {
    //put your code here
    private $repositorio ;
    
    public function __construct(RepositorioInterface $repositorio) {
        $this->repositorio = $repositorio;
    }
    
    
    public function listasContactos(){
        return $this->repositorio->listaContactos();
    }
}
