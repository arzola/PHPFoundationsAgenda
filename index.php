<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');


require_once 'Agenda.php';
//require_once 'MySQLAdapter.php';
//require_once 'SQLiteAdapter.php';
require_once 'FileAdapter.php';


//$mysql = new MySQLAdapter('127.0.0.1','root','','speculum');
//$sqlite = new SQLiteAdapter('db.sqlite');
$files = new FileAdapter('data/db.csv');
$agenda = new Agenda($files);
?>
<html> 
    <head>
        <title>Agenda :: Fancy</title> 
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </head>
    <?php
        
    ?>
    <body> 
        <div class="container">
            <div class="well well-lg">Proyecto v1.0.0</div>
            <div class="row">
                <div class="col-md-12">
                    <h3>PHP Agenda Dipak!</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Edad</th>
                        </tr>
                        <?php foreach($agenda->fetchAll() as $contacto): ?>
                        <tr>
                            <td><?php echo $contacto['nombre']; ?></td>
                            <td><?php echo $contacto['apellido_paterno']; ?></td>
                            <td><?php echo $contacto['apellido_materno']; ?></td>
                            <td><?php echo $contacto['edad']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
