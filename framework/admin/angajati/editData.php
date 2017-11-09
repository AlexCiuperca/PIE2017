<?php
	$data=$_POST['val'];
	$id=$_POST['id'];
	
	$conn = new PDO('mysql:host=127.0.0.1;dbname=service', 'root', 'oracle');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("UPDATE angajati 
							SET data_angajarii = :data
							WHERE id_angajati=:id");
	$stmt->bindValue(':data', $data);
	$stmt->bindValue(':id', $id);
	$stmt->execute();
	$conn=null;


?>