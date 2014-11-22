<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$db = new SQLite3('data/db.sqllite');
//$sql = 'CREATE TABLE contactos('
//        . 'id_contacto INTEGER PRIMARY KEY,'
//        . 'nombre  text not null,'
//        . 'apellido_p text not null,'
//        . 'apellido_m text not null,'
//        . 'edad INT not NULL'
//        . ')';
//
//
//$db -> exec($sql);

//$sql = "INSERT INTO contactos(nombre,apellido_p,apellido_m,edad) VALUES('%s','%s','%s',%d)";
$insert1 = sprintf("INSERT INTO contactos(nombre,apellido_p,apellido_m,edad) VALUES('%s','%s','%s',%d)", 'Kitzia','Abarca','Alfonso',35);
$insert2 = sprintf("INSERT INTO contactos(nombre,apellido_p,apellido_m,edad) VALUES('%s','%s','%s',%d)", 'Jose','Mendez','Perez',28);
$insert3 = sprintf("INSERT INTO contactos(nombre,apellido_p,apellido_m,edad) VALUES('%s','%s','%s',%d)", 'Ana','Jaramillo','Perez',30);
$insert4 = sprintf("INSERT INTO contactos(nombre,apellido_p,apellido_m,edad) VALUES('%s','%s','%s',%d)", 'Mario','Mendoza','Perez',32);

$db -> exec($insert1);
$db -> exec($insert2);
$db -> exec($insert3);
$db -> exec($insert4);

$sql = 'SELECT * FROM contactos';
$data = $db -> query($sql);

while($row = $data ->fetchArray(SQLITE3_ASSOC))
{
    $rows[] = $row;
}


?>

<pre>
    <?php print_r($rows); ?>
</pre>
