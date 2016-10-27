<?php

$servicio = $_POST['servicio'];

switch ($servicio) {
    case "profesores":

        $table = $_POST['table'];
        $columns = $_POST['ssColumns'];
        $primaryKey = 'id';
        $sql_details = array(
            'user' => 'ache_guerrero',
            'pass' => 'ache.guerrero',
            'db' => 'itcmcomunidad',
            'host' => 'mysql.comunidaditcm.com'
        );

        require('ssp.class.php');

        echo json_encode(
            SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns)
        );
        break;
    case "comentarios":
        $table = $_POST['table'];
        $columns = $_POST['ssColumns'];
        $primaryKey = 'id';
        $sql_details = array(
            'user' => 'ache_guerrero',
            'pass' => 'ache.guerrero',
            'db' => 'itcmcomunidad',
            'host' => 'mysql.comunidaditcm.com'
        );

        require('ssp.class.php');

        echo json_encode(
            SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns)
        );
        break;
}


