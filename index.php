<?php

    $busca = isset($_POST['busca']) ? $_POST['busca'] : '';
    function datosMysql($busca)
    {
        $mysqli = new mysqli("localhost", "root", "", "agenda");
        $sql = 'SELECT * FROM contactos '
                .($busca!='' ? 'WHERE concat(nombre,apellido_paterno,apellido_materno,edad) LIKE \'%'.strtoupper($busca).'%\'' : '')
                . 'ORDER BY id_contacto ASC';
        $mysqli->real_query($sql);
        $resultado = $mysqli->use_result();
        $datos = array();
        while ($fila = $resultado->fetch_assoc()) {
            $id = $fila['id_contacto'];
            $datos[$id]['nombre'] = $fila['nombre'];
            $datos[$id]['apellido_paterno'] = $fila['apellido_paterno'];
            $datos[$id]['apellido_materno'] = $fila['apellido_materno'];
            $datos[$id]['edad'] = $fila['edad'];
        }
        return $datos;
    }
    
    function datosSqlite($busca)
    {
        $db = new SQLite3('data/db.sqllite');
        $sql = 'SELECT * FROM contactos ';
        $sql .= ($busca!='' ? 'WHERE nombre||apellido_p||apellido_m||edad LIKE \'%'.($busca).'%\'' : '');
        $data = $db -> query($sql);

        while($row = $data ->fetchArray(SQLITE3_ASSOC))
        {
            $id = $row['id_contacto'];
            $datos[$id]['nombre'] = $row['nombre'];
            $datos[$id]['apellido_materno'] = $row['apellido_m'];
            $datos[$id]['apellido_paterno'] = $row['apellido_p'];
            $datos[$id]['edad'] = $row['edad'];
        }
        return $datos;
    }
  
    function datosArchivo($busca)
    {
        $lines = file('data/db.csv');
        foreach ($lines as $line_num => $line) {
            if($busca == '' or strstr($line,$busca))
            {
            $row = explode(',', $line);
            $id = $row[0];
            $datos[$id]['nombre'] = $row[1];
            $datos[$id]['apellido_materno'] = $row[2];
            $datos[$id]['apellido_paterno'] = $row[3];
            $datos[$id]['edad'] = $row[4];
            }
        }
        return $datos;
    }
    
    $datos = datosArchivo($busca);
?>

<html> 
    <head>
        <title>Pagina principal</title> 
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </head>
    <body> 
        <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
            <input type='text' name='busca' />
            <input type='checkbox' name='chkAdmin' /> Solo Admin
            <button name='buscar' >Buscar</button>
        </form>
        <div class="container">
            <p class="well">
                Pagina principal <?php echo 'Cool'; ?>
            </p> 
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Edad</th>
                </tr>
                <?php foreach($datos as $id_contacto => $arrContacto): ?>
                <tr>
                    <td><?php echo $id_contacto;?></td>
                    <td><?php echo $arrContacto['nombre'];?></td>
                    <td><?php echo $arrContacto['apellido_paterno'];?></td>
                    <td><?php echo $arrContacto['apellido_materno'];?></td>
                    <td><?php echo $arrContacto['edad'];?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>


