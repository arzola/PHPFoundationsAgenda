<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$create = <<<'TABLE'
CREATE TABLE IF NOT EXISTS contacts(
id_contacto INTEGER PRIMARY KEY,
nombre TEXT NOT NULL,
apellido_p TEXT NOT NULL,
apellido_m TEXT NOT NULL,
edad INT NOT NULL
);
TABLE;
try{
    $db = new SQLite3('data/db.sqlite');
    $insert =array();
    //$db->exec($create);

    //$insert[] = sprintf("INSERT INTO contacts (nombre, apellido_p, apellido_m,edad) VALUES ('%s','%s','%s','%d')", 'MARIO','MENDOZA','CARDENAS',30);
//    $insert[] = sprintf("INSERT INTO contacts (nombre, apellido_p, apellido_m,edad) VALUES ('%s','%s','%s','%d')", 'KITZIA','ABARCA','ALFONSO',35);
//    $insert[] = sprintf("INSERT INTO contacts (nombre, apellido_p, apellido_m,edad) VALUES ('%s','%s','%s','%d')", 'BETY','JARAMILLO','LIMA',27);
    //$insert[] = sprintf("INSERT INTO contacts (nombre, apellido_p, apellido_m,edad) VALUES ('%s','%s','%s','%d')", 'JOSE LUIS','MENDEZ','PEREZ',26);
    if(is_array($insert)){
        foreach($insert as $query){
            $db->exec($query);
        }
    }

    $qry = "SELECT * FROM contacts";

    $rs = $db->query($qry);
    $rows = array();
    while($row = $rs->fetchArray(SQLITE3_ASSOC)){
        $rows[] = $row;
    }
}  catch (Exception $err){
    echo $err->getMessage();
}
?>
<pre>
<?php    print_r($rows); ?>
</pre>