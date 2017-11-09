<?php

include("../../session.php");

	$nume=$_POST['nume'];
	$prenume=$_POST['prenume'];
	$varsta=$_POST['varsta'];
	$profesia=$_POST['profesia'];
	$salariu=$_POST['salariu'];
	$data=$_POST['date'];

	$conn = new PDO('mysql:host=127.0.0.1;dbname=service', 'root', 'oracle');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("INSERT INTO angajati (nume, prenume, varsta, salariu, data_angajarii, profesia)
							VALUES(:nume, :prenume, :varsta, :salariu, :data, :profesia)");
	$stmt->bindValue(":nume", $nume);
	$stmt->bindValue(":prenume", $prenume);
	$stmt->bindValue(":varsta", $varsta);
	$stmt->bindValue(":salariu", $salariu);
	$stmt->bindValue(":profesia", $profesia);
	$stmt->bindValue(":data", $data);
	$result=$stmt->execute();
	$result=null;

	header("Location: angajati.php");
?>