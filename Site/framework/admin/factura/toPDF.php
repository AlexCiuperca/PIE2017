<?php

include("../../../functions/getSql.php");


//$temp = temporaryFile($factura, $html);

require "prince.php";

$exepath = "D:/Programe/Prince/engine\bin/prince";
$prince = new Prince($exepath);

$id = $_GET['id'];
$sql = getSql("SELECT f.id_factura, f.id_piese, c.nume_client, a.nume, a.prenume, f.data_intrarii, f.suma, f.data_iesirii, f.observatii, f.data_facturarii FROM angajati a, factura f, clientii c where f.id_client=c.id_client AND f.id_angajat=a.id_angajati AND f.id_factura=:id", array(':id'=>$id));

foreach ($sql as $key => $row) {
	$str="";
	$ids=$row['id_piese'];
	$sql2 =getSql("SELECT nume_piesa, prod FROM piese WHERE id_piesa IN (:ids)",array(':ids' => $ids));
		foreach ($sql2 as $val) {
			$str .= $val['nume_piesa']." ".$val['prod'].",";
		}
	$numeClient = $row['nume_client'];
	$numeAngajat = $row['nume'];
	$prenAngajat = $row['prenume'];
	$dataIntrarii = $row['data_intrarii'];
	$dataIesirii = $row['data_iesirii'];
	$dataFacturarii = $row['data_facturarii'];
	$observatii = $row['observatii'];
  	$suma = $row['suma'];
  	}
$prince->setHTML(1);

$htmlString = "<p>Nume:  ".$numeClient."</p>
				<p>Data Facturarii:  ".$dataFacturarii."</p>
				<p>Angajat:  ".$numeAngajat." ".$prenAngajat."</p>
				<p>Piesa:  ".$str."</p>
				<p>Data Intrarii:  ".$dataIntrarii."</p>
				<p>Data Iesirii:  ".$dataIesirii."</p>
				<p>Observatii:  ".$observatii."</p>
				<p>Suma:  ".$suma."</p>";

$convert = $prince->convert_string_to_file($htmlString, $numeClient.".pdf");

if($convert) {
	header("Location:" .$numeClient.".pdf");
}

?>
