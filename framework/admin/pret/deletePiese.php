<?php
	include("../../../functions/getSql.php");

	$id=(int)$_GET['id'];

	Sql("DELETE FROM piese WHERE id_piesa=:id",array(':id' => $id));

	header("Location: http://localhost/AIBD/framework/admin/pret/pret_admin.php");

?>