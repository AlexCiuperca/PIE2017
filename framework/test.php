 <?php 
 	include('getSql.php');		
            $str="";
		    $lastRow = getSQL('SELECT f.id_factura, f.id_piese, c.nume_client, a.nume, a.prenume, f.data_intrarii, f.suma, f.data_iesirii, f.observatii, f.data_facturarii FROM angajati a, factura f, clientii c where f.id_client=c.id_client AND f.id_angajat=a.id_angajati ORDER BY id_factura DESC LIMIT 1');
		    foreach ($lastRow as $ceva) {
		        $last=$ceva;
		        $ids=$ceva['id_piese'];
		        $numePiese =getSql("SELECT nume_piesa, prod FROM piese WHERE id_piesa IN (:ids)",array(':ids' => $ids));
		        foreach ($numePiese as $ceva2) {
		            $str .= $ceva2['nume_piesa']." ".$ceva2['prod'].",";
		        }
		        $last['numePiese']=$str;
		    }

   	//          html=	"<tr id-row=".$row['id_factura'].">";
			// echo "<td class='editable-col' contenteditable='true' col-index='0' oldVal=".$row['nume_client'].">" . $row['nume_client'] . "</td>";
			// echo "<td class='editable-col' contenteditable='true' col-index='1' oldVal=".$row['data_facturarii'].">" . $row['data_facturarii'] . "</td>";

			// $str="";
			// $ids=$row['id_piese'];
			// $sql =getSql("SELECT nume_piesa, prod FROM piese WHERE id_piesa IN (:ids)",array(':ids' => $ids));
			// //var_dump($sql);
			// 	foreach ($sql as $val) {
			// 		$str .= $val['nume_piesa']." ".$val['prod'].",";
			// 	}
			// 	//var_dump($str);
			// echo "<td class='editable-col' contenteditable='true' col-index='2' oldVal=".$row['id_piese'].">".    $str . "</td>";
			// echo "<td class='editable-col' contenteditable='true' col-index='3' oldVal=".$row['nume']." ".$row['prenume'].">" . $row['nume'] . " ".$row['prenume']."</td>";
			// echo "<td class='editable-col' contenteditable='true' col-index='5' oldVal=".$row['data_intrarii'].">" . $row['data_intrarii'] . "</td>";
			// echo "<td class='editable-col' contenteditable='true' col-index='5' oldVal=".$row['data_iesirii'].">" . $row['data_iesirii'] . "</td>";
			// echo "<td class='editable-col' contenteditable='true' col-index='5' oldVal=".$row['data_facturarii'].">" . $row['data_facturarii'] . "</td>";
			// echo "<td class='editable-col' contenteditable='true' col-index='5' oldVal=".$row['suma'].">" . $row['suma'] . "</td>";
			// echo "<td>
			// 		<a href='deleteFactura.php?id=".$row['id_factura']."'>
			// 			<img src='../../../img/delete.ico' style='padding-left:10px; width:20px; height:20px; border:0;'>
			// 		</a>
			// 		<a target='_blank' href='toPDF.php?id=".$row['id_factura']."'>
			// 			<img src='../../../img/PDF.ico' style='padding-left:10px; width:20px; height:20px; border:0;'>
			// 		</a>
			// 	</td>";
			// echo "</tr>";
             var_dump($lastRow);
            var_dump($last);
        ?>