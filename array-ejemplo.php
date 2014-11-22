<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

  $arrPersonas =  array();  
  $arrPersonas["1"]= ["nombre" => "Alfredo", "apellido" => "Lezama", "telefono" => "826436363", "twitter" => "@alezama", "rol" => "admin"];
  $arrPersonas["2"]= ["nombre" => "Juan", "apellido" => "Lopez", "telefono" => "826436363", "twitter" => "@juan"];
  $arrPersonas["3"]= ["nombre" => "Pedro", "apellido" => "Eslava", "telefono" => "282828", "twitter" => "@pedro"];
  $arrPersonas["4"]= ["nombre" => "Luis", "apellido" => "Juarez", "telefono" => "8272723", "twitter" => "@luis"];
  $arrPersonas["5"]= ["nombre" => "Bety", "apellido" => "Jaramillo", "telefono" => "152423", "twitter" => "@bjara"];
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
                    <th>Apellido</th>
                    <th>Telefono</th>
                    <th>Twitter</th>
                    <th>Facebook</th>
                    <th>Link</th>
                </tr>
                <?php
                    if(is_array($dataPersona))                    
                        foreach ($dataPersona as $persona);
                        ?>
                            
                        
                    
                ?>
            </table>
        </div>
        <div>
            <table align="center">
             <form method="POST" name="param">
                 <tr>
                     <td><input type="text" name="inpDato" id="inpDato" /></td>
                 </tr>
                 <tr>
                     <td>Administrador <input type="checkbox" name="chkAdmin" id="chkAdmin"/></td>
                     <td><input type="submit" value="Buscar" name="btnBuscar" id="btnBuscar"/></td>
                 </tr>
             </form>
            </table>
        </div>
    </body>
</html>