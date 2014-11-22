<?php
    $busca = $_POST['busca']!='' ? $_POST['busca'] : 'vacio';
    $chkAdmin = isset($_POST['chkAdmin']) ? $_POST['chkAdmin'] : '';
    $datos['nombre'] = ['Kitzia','Mario','Ana','Wendy','Wendy'];
    $datos['apellido'] = ['Abarca','Mendoza','Jaramillo','Acosta','Acosta'];
    $datos['telefono'] = ['3456-777','3333-5666','1111-3334','6543-3333','6666-666'];
    $datos['twiter'] = ['@kitzia','@mario','@ana','@wendy','@wendy'];
    $datos['role'] = ['','','','admin',''];
    $salida = '';
    foreach($datos['nombre'] as $key => $val)
    {
        if( (strstr($datos['nombre'][$key],$busca) || strstr($datos['apellido'][$key], $busca) || 
                strstr($datos['telefono'][$key],$busca) || strstr($datos['twiter'][$key],$busca) || 'vacio' == $busca )
                && (($chkAdmin == 'on' && $datos['role'][$key] == 'admin') || $chkAdmin == '')
           )
        {   
            $salida .= '<tr>'
                . '<td>'.$val.'</td>'
                . '<td>'.$datos['apellido'][$key].'</td>'
                . '<td>'.$datos['telefono'][$key].'</td>'
                . '<td>'.$datos['twiter'][$key].'</td>'
                . '</tr>';
        }
    }
    $busca = $busca == 'vacio' ? '' : $busca;
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
            <input type='input' name='busca' value='<?php echo $busca ?>'/>
            <input type='checkbox' name='chkAdmin' /> Solo Admin
            <button name='buscar' >Buscar</button>
        </form>
        <div class="container">
            <p class="well">
                Pagina principal <?php echo 'Cool'; ?>
            </p> 
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Twitter</th>
                    <th>Facebook</th>
                    <th>Linkedin</th>
                </tr>
                <?php echo $salida; ?>
            </table>
        </div>
    </body>
</html>


