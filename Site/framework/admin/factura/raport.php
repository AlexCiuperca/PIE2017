<?php

include("../../session.php");
require "prince.php";
require('../../../classes/Database.php');
//include("../../../functions/getSql.php");

$exepath = "D:/Programe/Prince/engine\bin/prince";
$prince = new Prince($exepath);
$prince->setHTML(1);
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$htmlString = "<style>
				table {
				margin: 5%;
			    border-collapse: collapse;
			    width: 100%;
			    border: 1px solid #ddd;
			   	width: 100%;
			   	table-layout:fixed;
			}

			tr, td {
			    padding: 8px;
			    text-align: left;
			    border: 1px solid #ddd;
			}
			h1, h3 {
				text-align: center;
			}
			</style>

			<h1>Raport Facturi</h1>
			<h3>din perioada  ".$date1."----".$date2."</h3>
			<br>
			<br>
			<table>
					<tr><th>Nume</th><th>Data</th><th>Piesa</th><th>Angajat</th><th>Data intrarii</th><th>Data iesirii</th><th>Data facturarii</th><th>Suma</th></tr>";


$sql = new Database;
$sql->query("SELECT f.id_factura, f.id_piese, c.nume_client, a.nume, a.prenume, f.data_intrarii, f.suma, f.data_iesirii, f.observatii, f.data_facturarii FROM angajati a, factura f, clientii c where f.id_client=c.id_client AND f.id_angajat=a.id_angajati AND f.data_facturarii >= :date1 AND f.data_facturarii <= :date2");
$sql->bind(':date1',$date1);
$sql->bind(':date2', $date2);
$data = $sql->resultset();
var_dump($data);
foreach ($data as $key => $row) {
	
	$htmlString .= "<tr>
				<td>".$row['nume_client']."</td>
				<td>".$row['data_facturarii']."</td>";
	$str="";
	$ids=$row['id_piese'];
	$sql =getSql("SELECT nume_piesa, prod FROM piese WHERE id_piesa IN (:ids)",array(':ids' => $ids));
		foreach ($sql as $val) {
			$str .= $val['nume_piesa']." ".$val['prod'].",";
		}
	$htmlString .= "<td>". $str . "</td>
				<td>" . $row['nume'] . " ".$row['prenume']."</td>
				<td>" . $row['data_intrarii'] . "</td>
				<td>" . $row['data_iesirii'] . "</td>
				<td>" . $row['data_facturarii'] . "</td>
				<td>" . $row['suma'] . "</td>
				</tr>";
	}
$htmlString .= "</table>"; 

$convert = $prince->convert_string_to_file($htmlString, "PDF_Raport.pdf");

?>