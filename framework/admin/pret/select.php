<?php
  	include("../../../functions/getSql.php");
   

  	if($_POST['id']){
    $id=$_POST['id'];
    $info4=getSql('SELECT * from model where id_marca=:id',array(':id' => $id));
    foreach ($info4 as $key => $row)
    {
    echo "<option value = '{$row['id_model']}'";
    echo ">{$row['nume_model']}</option>";
    }
	}
?>