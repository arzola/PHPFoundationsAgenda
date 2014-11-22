<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$db = new SQLite3('data/db.sqllite');

$create = <<<'TABLE'
CREATE TABLE contactos(
id_contacto INTEGER PRIMARY KEY,          
nombre TEXT NOT NULL,
apellido_p TEXT NOT NULL,
apellido_m TEXT NOT NULL,
edad INT NOT NULL
);
TABLE;

$db->exec($create);
$insert = sprintf("
        INSERT INTO contactos
        (nombre,apellido_p,apellido_m,edad)
        VALUES( '%s','%s','%s','%d')" 
        ,'Oscar','Arzola','Cruz','30');

$insert2 = sprintf("
        INSERT INTO contactos
        (nombre,apellido_p,apellido_m,edad)
        VALUES( '%s','%s','%s','%d')" 
        ,'Ana Beatriz','Jaramillo','Lima','27');

$insert3 = sprintf("
        INSERT INTO contactos
        (nombre,apellido_p,apellido_m,edad)
        VALUES( '%s','%s','%s','%d')" 
        ,'Mario','Mendoza','Cardenas','30');

$insert4 = sprintf("
        INSERT INTO contactos
        (nombre,apellido_p,apellido_m,edad)
        VALUES( '%s','%s','%s','%d')" 
        ,'Kitizita','Abarca','Alfonso','35');

$insert5 = sprintf("
        INSERT INTO contactos
        (nombre,apellido_p,apellido_m,edad)
        VALUES( '%s','%s','%s','%d')" 
        ,'Jose Luis','Mendez','Perez','26');

$db->exec($insert);
$db->exec($insert2);
$db->exec($insert3);
$db->exec($insert4);
$db->exec($insert5);

$data = $db->query('Select * From contactos');

while( $row = $data->fetchArray(SQLITE3_ASSOC))
{
    $rows[] = $row;
}

?>

<pre>
    <?php print_r($rows); ?>
</pre>