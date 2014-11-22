<?php
/*
 * 1.- Crear un array multidimensional de 5 pesonas [nombre,apellido,telefono,twitter]
 * 2.- Recorrerlo para imprimirlo en una tabla
 * 3.- Agregar un formulario para buscar en la misma pagina dentro del array en cualquiera de los campos del array
 * 4.- Convertir a un usuario en admin agregando el indice rol con valor "admin" y filtrarlo si en la URL viene &admin=true
 */

//extract($_REQUEST);

  $arrPersonas =  array();
  
  $arrPersonas["1"]= ["nombre" => "Alfredo", "apellido" => "Lezama", "telefono" => "826436363", "twitter" => "@alezama", "rol" => "admin"];
  $arrPersonas["2"]= ["nombre" => "Juan", "apellido" => "Lopez", "telefono" => "826436363", "twitter" => "@juan"];
  $arrPersonas["3"]= ["nombre" => "Pedro", "apellido" => "Eslava", "telefono" => "282828", "twitter" => "@pedro"];
  $arrPersonas["4"]= ["nombre" => "Luis", "apellido" => "Juarez", "telefono" => "8272723", "twitter" => "@luis"];
  $arrPersonas["5"]= ["nombre" => "Bety", "apellido" => "Jaramillo", "telefono" => "152423", "twitter" => "@bjara"];
  $cad = "";
  /*
  if( $btnBuscar == "Buscar")
  {
    if( $inpDato ){                  
      foreach ($arrPersonas as $arrData1 )
      {
          foreach( $arrData1 as $key => $val )
          {     
              if(strtoupper($val) == strtoupper($inpDato))
              {
                  $cad .= "<tr><td>".$val."</td></tr>";
              }
              
          }
      }
   }
  }
  else{  
  foreach ($arrPersonas as $arrData )
  {      
      $cad .= "<tr>";      
      foreach( $arrData as $key => $val )
      {
         $cad .= "<td>".$val."</td>";
      }
      $cad .= "</tr>";
  }
  }*/

  foreach ($arrPersonas as $arrData )
  {      
      $cad .= "<tr>";      
      foreach( $arrData as $key => $val )
      {
         $cad .= "<td>".$val."</td>";
      }
      $cad .= "</tr>";
  }
?>

<?php

function traerDatos( $tipo = 'mysql')
{        
    $db = new SQLite3('data/db.sqllite');
    $data = $db->query('Select * From contactos');
 
    $result = '';
    $arrData = array();
    
    
    if( $tipo == 'sqlite') {
        $datos = $data->fetchArray(SQLITE3_ASSOC);
    }
    if( $tipo == 'mysql') {
        $link = mysqli_connect("localhost","root","","agenda") or die("Error " . mysqli_error($link)); 
        $query = "SELECT id_contacto,nombre,apellido_paterno as apellido_p, apellido_materno as apellido_m, edad  FROM contactos" or die("Error" . mysqli_error($link));
        $result = $link->query($query);
        while($row = mysqli_fetch_array($result) ){
            $arrData[$row['id_contacto']]['id_contacto'] = $row['id_contacto'];
            $arrData[$row['id_contacto']]['nombre'] = $row['nombre'];
            $arrData[$row['id_contacto']]['apellido_p'] = $row['apellido_p'];
            $arrData[$row['id_contacto']]['apellido_m'] = $row['apellido_m'];
            $arrData[$row['id_contacto']]['edad'] = $row['edad'];             
        } 
    }
    if( $tipo == 'archivo' ){
        $csv = array_map('str_getcsv', file('data/db.csv'));
        foreach( $csv as $key => $val ){
              $arrData[$key]['id_contacto'] = $key;
              $arrData[$key]['nombre'] = $val[0];
              $arrData[$key]['apellido_p'] = $val[1];
              $arrData[$key]['apellido_m'] = $val[2];
              $arrData[$key]['edad'] = $val[3];
        }
    }else{            
        while( $row = $data->fetchArray(SQLITE3_ASSOC)) {
            $arrData[$row['id_contacto']]['id_contacto'] = $row['id_contacto'];
            $arrData[$row['id_contacto']]['nombre'] = $row['nombre'];
            $arrData[$row['id_contacto']]['apellido_p'] = $row['apellido_p'];
            $arrData[$row['id_contacto']]['apellido_m'] = $row['apellido_m'];
            $arrData[$row['id_contacto']]['edad'] = $row['edad'];
        }
    }
    
    return $arrData;
}


function pintaTabla($tipo = 'mysql' )
{    
    $cad = '';
    $arrDatos = traerDatos($tipo);
    
    if(is_array($arrDatos)){
        foreach( $arrDatos as $key => $val ){            
               $cad .= "<tr>"                                              
                       . "<td>".$val['nombre']."</td>"
                       . "<td>".$val['apellido_p']."</td>"
                       . "<td>".$val['apellido_m']."</td>"
                       . "<td>".$val['edad']."</td>"
                       . "</tr>";                                           
        }
        
        $cad .= "<tr>"
                . "<td colspan='4'>-------</td>"
                . "</tr>";
    }
    return $cad;
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
        <div class="container">
            <p class="well">
                Pagina principal <?php echo 'Cool'; ?>
            </p> 
            <table class="table">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido P</th>
                    <th>Apellido M</th>
                    <th>Edad</th>                                       
                </tr>
                <?php echo pintaTabla('mysql'); ?>
                <?php //echo pintaTabla('sqlite'); ?>
                <?php //echo pintaTabla('archivo'); ?>
            </table>
        </div>
        <div>
            <table align="center">
             <!--<form method="POST" name="param">
                 <tr>
                     <td><input type="text" name="inpDato" id="inpDato" /></td>
                 </tr>
                 <tr>
                     <td>Administrador <input type="checkbox" name="chkAdmin" id="chkAdmin"/></td>
                     <td><input type="submit" value="Buscar" name="btnBuscar" id="btnBuscar"/></td>
                 </tr>
             </form>-->
            </table>
        </div>
    </body>
</html>
<?php
$var1 = "Hola";
echo "desde el index<br/>";
echo $var1;
?>