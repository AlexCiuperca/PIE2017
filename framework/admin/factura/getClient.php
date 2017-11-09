<?php
    require_once ('../../../functions/getSql.php');

    $h=$_REQUEST["h"]; 
    $results=getSql("SELECT * FROM clientii WHERE nume_client LIKE concat('%',:h,'%')",array(':h' =>$h));

    // $json= ;
    // foreach ($results as $key => $row) {
    //     array_push($json, $row['nume_client'], $row['id_client']);
    // }

    echo json_encode($results);
?>