<?php
	
	function getSql($sql, $myarray=array()){

		$conn = new PDO('mysql:host=127.0.0.1;dbname=service', 'root', 'oracle');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare($sql); 
		$stmt->execute($myarray);
		$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$conn=null;
		return $data;

	}

	function Sql($sql, $myarray=array()){
		$conn = new PDO('mysql:host=127.0.0.1;dbname=service', 'root', 'oracle');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare($sql); 
		$stmt->execute($myarray);
		$conn=null;
	}

	function temporaryFile($name, $content){
	    $file = DIRECTORY_SEPARATOR .
	            trim(sys_get_temp_dir(), DIRECTORY_SEPARATOR) .
	            DIRECTORY_SEPARATOR .
	            ltrim($name, DIRECTORY_SEPARATOR);

	    file_put_contents($file, $content);

	    register_shutdown_function(function() use($file) {
	        unlink($file);
	    });

	    return $file;
	}

	function addAngajati($table_name,$form_data){
		$fields = array_keys($form_data);

		
		$conn = new PDO('mysql:host=127.0.0.1;dbname=service', 'root', 'oracle');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("INSERT INTO ".$table_name."(`".implode('`,`', $fields)."`) VALUES ('".implode("','", $form_data)."')");


		$result=$stmt->execute();
		$result=null;

		//header("Refresh:0");
	}

?>