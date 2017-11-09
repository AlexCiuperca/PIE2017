<?php
	echo "<table style='width: 80%;' id='tableFacturi'>";
		echo "<tr><th>Nume</th><th>Data</th><th>Piesa</th><th>Angajat</th><th>Data intrarii</th><th>Data iesirii</th><th>Data facturarii</th><th>Suma</th><th>Setari</th></tr>";


	     $info=getSql("SELECT f.id_factura, f.id_piese, c.nume_client, a.nume, a.prenume, f.data_intrarii, f.suma, f.data_iesirii, f.observatii, f.data_facturarii FROM angajati a, factura f, clientii c where f.id_client=c.id_client AND f.id_angajat=a.id_angajati");
	     foreach ($info as $key => $row) {
	
	    
		    echo "<tr id-row=".$row['id_factura'].">";
			echo "<td class='editable-col' contenteditable='true' col-index='0' oldVal=".$row['nume_client'].">" . $row['nume_client'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='1' oldVal=".$row['data_facturarii'].">" . $row['data_facturarii'] . "</td>";

			$str="";
			$ids=$row['id_piese'];
			$sql =getSql("SELECT nume_piesa, prod FROM piese WHERE id_piesa IN (:ids)",array(':ids' => $ids));
				foreach ($sql as $val) {
					$str .= $val['nume_piesa']." ".$val['prod'].",";
				}
			echo "<td class='editable-col' contenteditable='true' col-index='2' oldVal=".$row['id_piese'].">".    $str . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='3' oldVal=".$row['nume']." ".$row['prenume'].">" . $row['nume'] . " ".$row['prenume']."</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='4' oldVal=".$row['data_intrarii'].">" . $row['data_intrarii'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='5' oldVal=".$row['data_iesirii'].">" . $row['data_iesirii'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='6' oldVal=".$row['data_facturarii'].">" . $row['data_facturarii'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='7' oldVal=".$row['suma'].">" . $row['suma'] . "</td>";
			echo "<td>
					<a href='deleteFactura.php?id=".$row['id_factura']."'>
						<img src='../../../img/delete.ico' style='padding-left:10px; width:20px; height:20px; border:0;'>
					</a>
					<a target='_blank' href='toPDF.php?id=".$row['id_factura']."'>
						<img src='../../../img/PDF.ico' style='padding-left:10px; width:20px; height:20px; border:0;'>
					</a>
				</td>";
			echo "</tr>";
	     }
	$conn = null;
	echo "</table>"; 
?>