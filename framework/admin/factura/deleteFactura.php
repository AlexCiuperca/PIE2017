<?php

include("../../../functions/getSql.php");

	$id=(int)$_GET['id'];

	Sql("DELETE FROM factura WHERE id_factura=:id",array(':id' => $id));

	header("Location: http://localhost/AIBD/framework/admin/factura/Factura.php");

?>