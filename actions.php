<?php
require_once 'Agenda.php';
require_once 'MySQLAdapter.php';
require_once 'SQLiteAdapter.php';
require_once 'FileAdapter.php';
session_start();

$mysql = new MySQLAdapter(array("67.43.1.124",'icodeos_dipak', '123123qwe!!', 'icodeos_dipak_agenda'));
$sqlite = new SQLiteAdapter('db.sqlite');
$files = new FileAdapter('data/db.csv');
$agenda = new Agenda(${$_SESSION['storage']});

$data = $_POST;
$action = $_GET['do'];

//todo: completar metodo update
//todo: implementar busqueda

switch ($action) {
    case 'add':
        $agenda->add(array('id'=>0,'parametros'=>$data));
        header("Location: index.php");
        break;
    case 'delete':
        $id = $_GET['id'];
        $agenda->delete($id);
        break;
    case 'update':

        break;
    case 'find':
        $agenda->find(array('campo'=>$_POST['campo'],'busqueda'=>$_POST['query']));
        echo json_encode(['results'=>$agenda->fetchAll()]);
        break;
    default:
        break;
}