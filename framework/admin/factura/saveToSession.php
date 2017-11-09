<?php
include("../../session.php");
$ceva = $_POST["piese"];
foreach ($ceva as $value){
   $_SESSION['arrPiese'][]= $value;
    }
Print_r ($_SESSION);
?>