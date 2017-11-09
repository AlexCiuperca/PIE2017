<?php
include("../../session.php");
	

	$data_facturarii=$_POST['dateFac'];
	$data_intrarii=$_POST['dateInt'];
    $id_client=$_POST['id_client'];
    $id_angajat=$_POST['id_angajat'];
    $stringPiese="";
    $observatii="";
    $id_garantie=0;

    Sql('INSERT INTO garantie (data_emiterii, data_exp) VALUES (:data_facturarii ,DATE_ADD(:data_facturarii, INTERVAL 6 MONTH))',array(':data_facturarii'=>$data_facturarii));
    $sql1=getSql('SELECT id_garantie from garantie order by id_garantie desc limit 1',array());
	foreach ($sql1 as $val1) {
		$id_garantie= intval($val1);
	}
	$suma=0;
    foreach ($_SESSION['arrPiese'] as $val2){
    	$sql=getSql('SELECT pret FROM piese where id_piesa=:val2',array(':val2' => $val2));
    		foreach ($sql as $val3) {
    			$suma += array_sum($val3);
    		}
   		$stringPiese .=$val2.",";
    }

    Sql('INSERT into factura (data_facturarii, id_client, id_piese, id_angajat, id_garantie, data_intrarii, data_iesirii, observatii, suma) values (:dateFac, :id_client, :id_piese, :id_angajat, :id_garantie, :data_intrarii, :data_iesirii, :observatii, :suma)',array(':dateFac' => $data_facturarii, ':id_client' => $id_client, ':id_piese' =>$stringPiese, ':id_angajat' => $id_angajat, ':id_garantie' => $id_garantie, ':data_intrarii' => $data_intrarii, ':data_iesirii'=>$data_facturarii, ':observatii'=>$observatii, ':suma'=>$suma));

   	unset($_SESSION['arrPiese']);
   

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


    echo json_encode($last);
    exit();
?>  