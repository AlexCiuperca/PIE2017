<?php
include("../../session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
	<h2> Informatii </h2>
	<?php
	require('../../../classes/Database.php');

	$id=$_GET['id'];
	$info = new Database;
	$info->query("SELECT * FROM clientii WHERE id_client=:id");
	$info->bind(':id',$id);
	$data = $info->resultset();

	foreach ($data as $key => $row) {
	?>
	<p><b>Numele: </b> <?php echo $row['nume_client']; ?></p>
	<p><b>Telefon: </b> <?php echo $row['telefon']; ?></p>
	<p><b>Adresa: </b> <?php echo $row['adresa']; ?></p><?php } ?>
	<br>
	<br>
	<br>
	<h2> Facturi </h2>
	<?php

	$facturi = new Database;
	$facturi->query("SELECT f.id_factura, f.id_piese, c.nume_client, a.nume, a.prenume, f.data_intrarii, f.suma, f.data_iesirii, f.observatii, f.data_facturarii FROM angajati a, factura f, clientii c where f.id_client=c.id_client AND f.id_angajat=a.id_angajati AND c.id_client=:id");
	$facturi->bind(':id',$id);
	$data2 = $facturi->resultset();
	
	echo "<table style='width: 80%;'>";
	echo "<tr><th width='4%'>Nr. Crt.</th><th>Data</th><th>Piesa</th><th>Angajat</th><th>Data intrarii</th><th>Data iesirii</th><th>Data facturarii</th><th>Suma</th><th>Setari</th></tr>";
	$crt=1;
	foreach ($data2 as $key => $row) {
		 echo "<tr id-row=".$row['id_factura'].">";
			echo "<td class='editable-col' contenteditable='true' col-index='0' oldVal=".$crt.">" . $crt . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='1' oldVal=".$row['data_facturarii'].">" . $row['data_facturarii'] . "</td>";

			$str="";
			$ids=$row['id_piese'];
			$sql =getSql("SELECT nume_piesa, prod FROM piese WHERE id_piesa IN (:ids)",array(':ids' => $ids));
			//var_dump($sql);
				foreach ($sql as $val) {
					$str .= $val['nume_piesa']." ".$val['prod'].",";
				}
				//var_dump($str);

			echo "<td class='editable-col' contenteditable='true' col-index='2' oldVal=".$str.">" . $str . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='3' oldVal=".$row['nume']." ".$row['prenume'].">" . $row['nume'] . " ".$row['prenume']."</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='5' oldVal=".$row['data_intrarii'].">" . $row['data_intrarii'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='5' oldVal=".$row['data_iesirii'].">" . $row['data_iesirii'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='5' oldVal=".$row['data_facturarii'].">" . $row['data_facturarii'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='5' oldVal=".$row['suma'].">" . $row['suma'] . "</td>";
			echo "<td>
					<a href='deletePiese.php?id=".$row['id_factura']."'>
						<img src='../../../img/delete.ico' style='padding-left:10px; width:20px; height:20px; border:0;'>
					</a>
					<a href='toPDF.php?id=".$row['id_factura']."'>
						<img src='../../../img/PDF.ico' style='padding-left:10px; width:20px; height:20px; border:0;'>
					</a>
				</td>";
			echo "</tr>";
			$crt++;
	     }
	$conn = null;
	echo "</table>"; 
	?>
	<br>
	<br>
	<br>
	<h2> Garantii active </h2>
	<?php
	$garantii=getSql("SELECT g.id_garantie, g.data_emiterii, g.data_exp FROM garantie g, factura f WHERE f.id_client=:id AND f.id_garantie=g.id_garantie",array(':id' => $id));

	echo "<table style='width: 30%;'>";
	echo "<tr><th width='8%'>Nr. Crt.</th><th>Data Emiterii</th><th>Data Expirarii</th>";
	$crt=1;
	foreach ($garantii as $key => $row) {
		echo "<tr id-row=".$row['id_garantie'].">";
			echo "<td class='editable-col' contenteditable='true' col-index='0' oldVal=".$crt.">" . $crt . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='1' oldVal=".$row['data_emiterii'].">" . $row['data_emiterii'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='2' oldVal=".$row['data_exp'].">" . $row['data_exp'] . "</td>";
			$crt++;
	} 
	?>
</body>
</html>