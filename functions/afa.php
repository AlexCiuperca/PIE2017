<?php
	require_once("getSql.php");
	$user = 'root';
	$data = getSql("SELECT * from angajati");
	var_dump($data);
?>