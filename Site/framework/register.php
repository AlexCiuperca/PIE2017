<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
$userErr = $pass1Err = $pass2Err = $numeErr = $prenErr = $telErr = "";
$userMatch = $passMatch = "";
$log=0;

if (isset($_POST['submitReg'])) {
  	if (empty($_POST["user"])) {
    $userErr = "Username este necesar";
  	} else {
    $user = $_POST["user"];
    	if(!preg_match("/^.{3,25}$/", $user)){
		$userMatch="Userul trebuie sa fie intre 3 si 25 de caractere";
		}else{
			$log++;
		}
  	}

  	if (empty($_POST["nume"])) {
    $numeErr = "Numele este necesar";
  	} else {
    $nume = $_POST["nume"];
  	}

  	if (empty($_POST["prenume"])) {
    $prenErr = "Prenumele este necesar";
  	} else {
    $pren = $_POST["prenume"];
    $numeCom=$nume.' '.$pren;
	}

	if (empty($_POST["telefon"])) {
    $telErr = "Numarul de telefon este necesar";
  	} else {
    $tel = $_POST["telefon"];
	}

  	if (empty($_POST["pass1"])) {
    $pass1Err = "Password is required";
  	} else {
    $pass1 = $_POST["pass1"];
    	if (!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $pass1)) {
    	$passMatch="Parola trebuie sa contina cel putin 8 caractere: o cifra, un uppercase, lowercase";
		}elseif(empty($_POST["pass2"])){
			$pass2Err = "Reintroduce-ti parola";
		}else {
    		$pass2 = $_POST["pass2"];
    		if ($pass1==$pass2) {
    			$log++;
			}else{
				$passMatch="Parola nu este identica";
			}
  	}
  	}
  	
  	if($log==2){

  		$passHash = password_hash($pass1, PASSWORD_DEFAULT);
  		
  		$db = new PDO('mysql:host=127.0.0.1;dbname=service', 'root', 'oracle');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  	$stmt1 = $db->prepare('INSERT INTO clientii (nume_client, telefon) VALUES (:nume, :telefon)');
		$stmt1->bindValue(':nume', $numeCom);
		$stmt1->bindValue(':telefon', $tel);
		$stmt1->execute();

		$stmt2 = $db->prepare('SELECT id_client from clientii where nume_client=:nume and telefon=:telefon');
		$stmt2->bindValue(':nume', $numeCom);
		$stmt2->bindValue(':telefon', $tel);
		$stmt2->execute();
		$data = $stmt2->fetch(PDO::FETCH_ASSOC);
		$id=$data['id_client'];

		$stmt3 = $db->prepare('INSERT INTO user (username, password, id_client) VALUES (:user, :pass, :id)');
		$stmt3->bindValue(':user', $user);
		$stmt3->bindValue(':pass', $passHash);
		$stmt3->bindValue(':id', $id);
		$stmt3->execute();
	}
}
?>
<form action="" id="regForm" method="POST">
	<p style="text-align: right; margin-top: 25%">
		<label>Username : </label>
		<input type="text" name="user" />
		<p style="text-align: right; margin:0px;">
		<span style="color: red;"> <?php echo $userErr;?></span>
		</p>
	</p>	
	<p style="text-align: right; margin-bottom:0px;">
		<label>Nume : </label>
		<input type="text" name="nume" />
		<p style="text-align: right; margin:0px;">
		<span style="color: red;"> <?php echo $numeErr;?></span>
		</p>
	</p>
	<p style="text-align: right;">
		<label>Prenume : </label>
		<input type="text" name="prenume" />
		<p style="text-align: right; margin:0px;">
		<span style="color: red;"> <?php echo $prenErr;?></span>
		</p>
	</p>
	<p style="text-align: right; margin-bottom:0px;">
		<label>Telefon : </label>
		<input type="text" name="telefon" />
		<p style="text-align: right; margin:0px;">
		<span style="color: red;"> <?php echo $telErr;?></span>	
		</p>
	</p>			
	<p style="text-align: right; margin-bottom:0px;">
		<label>Parola : </label>
		<input type="password" name="pass1" />
		<p style="text-align: right; margin:0px;">
		<span style="color: red;"> <?php echo $pass1Err;?></span>
		</p>
	</p>
	<p style="text-align: right; margin-bottom:0px;">
		<label>Verificare Parola : </label>
		<input type="password" name="pass2" />
		<p style="text-align: right; margin:0px;">
		<span style="color: red;"> <?php echo $pass2Err;?></span>
		</p>
	</p>
	<button name="submitReg" type="submit" form="regForm" value="submit">Register</button>
	</form>
	<span style="color: red;"> <?php echo $userMatch;?></span>
	<span style="color: red;"> <?php echo $passMatch;?></span>
	
</body>
</html>