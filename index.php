<?php

require_once 'clases/AgendaServicio.php';

//$repositorio = new RepositorioMysql();
$repositorio = new RepositorioSQLite();
//$repositorio = new RepositorioFile();

$servicio = new AgendaServicio($repositorio);

$arrayPersonas = $servicio->listasContactos();

extract($_REQUEST);

$busqueda = isset($_REQUEST["busqueda"]) ? $_REQUEST['busqueda'] : false ;
/*
$arrayPersonas = array();

$arrayPersonas[1]['nombre'] = 'John';
$arrayPersonas[1]['apellido_p'] = 'Doe';
$arrayPersonas[1]['apellido_m'] = 'Doe';
$arrayPersonas[1]['edad'] = 30;


$arrayPersonas[1]['telefono'] = '56581111';
$arrayPersonas[1]['twitter']  = '@queTeImporta'; 
$arrayPersonas[1]['facebook']  = '@queTeImporta'; 
$arrayPersonas[1]['linkedin']  = 'linkedin/queTeImporta'; 
$arrayPersonas[1]['admin']     = 'Admin';

$arrayPersonas[2]['nombre'] = 'Juan';
$arrayPersonas[2]['apellido'] = 'Doe';
$arrayPersonas[2]['telefono'] = '56581111';
$arrayPersonas[2]['twitter']  = '@queTeImporta';
$arrayPersonas[2]['facebook']  = '@queTeImporta'; 
$arrayPersonas[2]['linkedin']  = 'linkedin/queTeImporta'; 
$arrayPersonas[2]['admin']     = 'Admin';


$arrayPersonas[3]['nombre'] = 'Kitzia';
$arrayPersonas[3]['apellido'] = 'Doe';
$arrayPersonas[3]['telefono'] = '56581111';
$arrayPersonas[3]['twitter']  = '@queTeImporta';
$arrayPersonas[3]['facebook']  = '@queTeImporta'; 
$arrayPersonas[3]['linkedin']  = 'linkedin/queTeImporta'; 


$arrayPersonas[4]['nombre'] = 'Bety';
$arrayPersonas[4]['apellido'] = 'Doe';
$arrayPersonas[4]['telefono'] = '56581111';
$arrayPersonas[4]['twitter']  = '@queTeImporta';
$arrayPersonas[4]['facebook']  = '@queTeImporta'; 
$arrayPersonas[4]['linkedin']  = 'linkedin/queTeImporta'; 


$arrayPersonas[5]['nombre'] = 'John';
$arrayPersonas[5]['apellido'] = 'Doe';
$arrayPersonas[5]['telefono'] = '56581111';
$arrayPersonas[5]['twitter']  = '@queTeImporta';
$arrayPersonas[5]['facebook']  = '@queTeImporta'; 
$arrayPersonas[5]['linkedin']  = 'linkedin/queTeImporta'; 
*/

$arrayResultado = $arrayPersonas;

//Creación de adaptadores o callback de filtros
$filtroRol = function($item) {
    if ('admin' === $item['rol']) {
        return true;
    }
};

$filtroBusqueda = function($item) use ($busqueda) {
    foreach ($item as $val) {
        if (stristr($val,$busqueda)) {
            return true;
        }
    }
};
//Agregación de filtros
if ($busqueda) {
    $arrayResultado = array_filter($arrayResultado, $filtroBusqueda);
}
if (isset($administrador) && "on" == $administrador) {
    $arrayResultado = array_filter($arrayResultado, $filtroRol);
}

?>

<html> 
    <head>
        <title>Pagina principal</title> 
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </head>
    <body> 
        <form method="post">
        <div class="container">
            <p class="well">
                Pagina principal <?php echo 'Cool'; ?>
            </p> 
            
            <div class="row">
                <h2>Buscar</h2>
            </div>
            <div>
                <input type="text" name="busqueda" /> <input type="submit" value="buscar" class="btn">
            </div>
            <div>
                Administrador<input type="checkbox" name="administrador">
            </div>
            <div>
                
            </div>
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Telefono Materno</th>
                    <th>Edad</th>

                </tr>
                
                <?php foreach($arrayResultado as $index):?>
                <tr>
                    <td><?php echo $index['nombre'] ?></td>
                    <td><?php echo $index['apellido_p'] ?></td>
                    <td><?php echo $index['apellido_m'] ?></td>
                    <td><?php echo $index['edad'] ?></td>
                </tr>
                
                <?php endforeach; ?>
            </table>
        </div>
        </form>
    </body>
</html>
