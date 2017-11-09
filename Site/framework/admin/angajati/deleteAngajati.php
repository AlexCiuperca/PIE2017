<?php
	$id=(int)$_GET['id'];

	$conn = new PDO('mysql:host=127.0.0.1;dbname=service', 'root', 'oracle');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("DELETE FROM angajati WHERE id_angajati=:id");
	$stmt->bindValue(":id", $id);
	$result=$stmt->execute();
	$result=null;

	header("Location: angajati.php");
?>