<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
$storage = (empty($_SESSION['storage'])) ? 'mysql' : $_SESSION['storage'];
$_SESSION['storage'] = (empty($_GET['st'])) ? $storage : $_GET['st'];
require_once 'Agenda.php';
require_once 'MySQLAdapter.php';
require_once 'SQLiteAdapter.php';
require_once 'FileAdapter.php';
$mysql = new MySQLAdapter(array("67.43.1.124", 'icodeos_dipak', '123123qwe!!', 'icodeos_dipak_agenda'));
$sqlite = new SQLiteAdapter('db.sqlite');
$files = new FileAdapter('data/db.csv');
$agenda = new Agenda(${$_SESSION['storage']});
?>
<html> 
    <head>
        <title>Agenda :: Fancy</title> 
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </head>
    <?php
    ?>
    <body> 
        <div class="container">
            <div class="well well-lg">
                <h3>PHP Agenda Dipak!</h3>
                <p>Proyecto v1.1.0</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <a class="btn btn-primary" href="index.php?st=mysql">MySQL</a>
                    <a class="btn btn-info" href="index.php?st=sqlite">SQLlite</a>
                    <a class="btn btn-success" href="index.php?st=files">File</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <h4>Registrar nuevo:</h4>
                    <form action="actions.php?do=add" method="post" class="form">
                        <div class="panel panel-default">
                            <div class="panel-body form-horizontal payment-form">
                                <div class="form-group">
                                    <label for="concept" class="col-sm-3 control-label">Nombre</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-sm-3 control-label">Apellido Paterno</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="paterno" name="apellido_paterno">
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <label for="amount" class="col-sm-3 control-label">Apellido Materno</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="materno" name="apellido_materno">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-sm-3 control-label">Edad</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="edad" name="edad">
                                            <?php foreach (range(18, 90) as $edad): ?>
                                                <option><?php echo $edad; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <div class="col-sm-12 text-right">
                                        <button id="add" type="submit" class="btn btn-default preview-add-button">
                                            <span class="glyphicon glyphicon-plus"></span> Agregar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>     
                    </form>
                </div> <!-- / panel preview -->
            </div>
            <div class="row">    
                <div class="col-xs-8 col-xs-offset-2">
                    <div class="input-group">
                        <div class="input-group-btn search-panel">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span id="search_concept">Filtrar por</span> <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="sel" rel="nombre" href="#nombre" onclick="">Nombre</a></li>
                                <li><a class="sel" rel="apellido_paterno" href="#paterno">Paterno</a></li>
                                <li><a class="sel" rel="apellido_materno" href="#materno">Materno</a></li>
                                <li><a class="sel" rel="edad" href="#edad">Edad</a></li>
                                <li><a class="divider"></li>
                                <li><a class="sel" rel="all" href="#all">Cualquiera</a></li>
                            </ul>
                        </div>
                        <input type="hidden" name="campo" value="" id="campo">  
                        <input type="text" class="form-control" name="query" id="query" placeholder="Ej. Jhon Doe...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="ok"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                    <table class="table">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Edad</th>
                        </tr>
                        <?php foreach ($agenda->fetchAll() as $contacto): ?>
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
        <script type="text/javascript">
            $(document).ready(function (e) {
                //completar request ajax
                var Agenda = (function () {
                    $('.sel').click(function (E) {
                        E.preventDefault();
                        $('#campo').val($(this).attr('rel'));
                    });
                    $('#ok').click(function(e){
                       var params = {};
                       params['campo'] = ($('#campo').val()!=='')?$('#campo').val() : 'nombre';
                       params['query'] = $('#query').val();
                       $.ajax({
                          url:'actions.php?do=find',
                          type:'post',
                          dataType:'json',
                          data:params,
                          success:function(respuesta){
                              console.log(respuesta);
                          },
                          error:function(e){
                              alert('error al conectar');
                          }
                       });
                    });
                });
                Agenda();
            });
        </script>
    </body>
</html>
