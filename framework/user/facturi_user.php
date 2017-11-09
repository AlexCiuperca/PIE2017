<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
	include("nav_bar_user.html");
	include('../session.php');
	//include("../../functions/getSql.php");
?>
<div>
<?php
echo "<table style='width: 80%;'>";
		echo "<tr><th width='4%'>Nr. Crt.</th><th>Data</th><th>Piesa</th><th>Angajat</th><th>Data intrarii</th><th>Data iesirii</th><th>Data facturarii</th><th>Suma</th></tr>";
		$id=$_SESSION['id_client'];
	     $info=getSql("SELECT f.id_factura, f.id_piese, c.nume_client, a.nume, a.prenume, f.data_intrarii, f.suma, f.data_iesirii, f.observatii, f.data_facturarii FROM angajati a, factura f, clientii c where f.id_client=c.id_client AND f.id_angajat=a.id_angajati AND c.id_client=:id",array(':id' => $id));
	     $crt=1;
	     foreach ($info as $key => $row) {
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
			echo "</tr>";
			$crt++;
	     }
	$conn = null;
	echo "</table>"; 
?>
</div>
</body>
</html>