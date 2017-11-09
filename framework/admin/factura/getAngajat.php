<?php
    require_once ('../../../functions/getSql.php');

    $h=$_REQUEST["h"]; 
    $results=getSql("SELECT * FROM angajati WHERE nume LIKE concat('%',:h,'%')",array(':h' =>$h));

    echo json_encode($results);
?>