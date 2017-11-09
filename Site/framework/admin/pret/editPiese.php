<?php
	$coloana =array(
		0 =>'nume_piesa',
		1 =>'prod',
		2 =>'nume_model',
		3 =>'nume_rep',
		4 =>'pret');
	$error=true;
	$colVal = '';
	$colIndex = $_POST['index'];
	$rowId = $_POST['id'];
	//$date = $_POST['date'];

	$msg = array('status' => !$error, 'msg' => 'Failed!');

	if(isset($_POST)){
    if(isset($_POST['val']) && !empty($_POST['val']) && $error) {
      $colVal = $_POST['val'];
      $error = false;
      
    } else {
      $error = true;
    }
    if(isset($_POST['index']) && $_POST['index'] >= 0 &&  $error) {
      $colIndex = $_POST['index'];
      $error = false;
    } else {
      $error = true;
    }
    if(isset($_POST['id']) && $_POST['id'] > 0 && $error) {
      $rowId = $_POST['id'];
      $error = false;
    } else {
      $error = true;
    }
  
    if(!$error) {
	$conn = new PDO('mysql:host=127.0.0.1;dbname=service', 'root', 'oracle');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $conn->prepare("UPDATE piese 
							SET ".$coloana[$colIndex]." = :colVal
							WHERE id_piesa=:id");
	$stmt->bindValue(':colVal', $colVal);
	$stmt->bindValue(':id', $rowId);
	$stmt->execute();
	$conn=null;
	}
	}

	echo json_encode($msg);

?>