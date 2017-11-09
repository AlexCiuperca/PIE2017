<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
session_start();
$userErr = $passErr = "";
$userMatch = $passMatch = "";
$log=0;

if (isset($_POST['submitLog'])) {
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
  
  if (empty($_POST["pass"])) {
    $passErr = "Password is required";
  } else {
    $pass = $_POST["pass"];
    	if (!preg_match("/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $pass)) {
    	$passMatch="Parola trebuie sa contina cel putin 8 caractere: o cifra, un uppercase, lowercase";
		}else{
			$log++;
		}
  } 
  if($log==2){

  	$db = new PDO('mysql:host=127.0.0.1;dbname=service', 'root', 'oracle');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	$stmt = $db->prepare('SELECT username, password, tip_user, id_client FROM user WHERE username = :username');
	$stmt->execute(array(':username' => $user));
  	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	if($data == false){
		$userErr= "Userul nu exista.";
	}
	else {
		if(password_verify($pass, $data['password'])) {
  		$_SESSION['login_user'] = $user;
  		$_SESSION['tip_user'] = $data['tip_user'];
  		$_SESSION['id_client'] = $data['id_client'];
  			if($data['tip_user'] == 2){
  				header('Location: user/index.php');
  			}else {
  				header('Location: admin/index.php');
  			}
		exit;
		}
		else{
		 $passErr = 'Parola incorecta.';
		}
		}
  }   
}
?>
<form action="" id="loginForm" method="POST">
	<p style="text-align: right; margin-top: 15%">
		<label>Username : </label>
		<input type="text" id="user" name="user" /><br>
		<span style="color: red;"> <?php echo $userErr;?></span>
	</p>	
	<p style="text-align: right;">
		<label>Parola : </label>
		<input type="password" id="pass" name="pass" /><br>
		<span style="color: red;"> <?php echo $passErr;?></span>
	</p>
	<p><button name="submitLog" type="submit" form="loginForm" value="submit">Login</button></p>
	</form>
	<p>
	<span style="color: red;"> <?php echo $userMatch;?></span>
	<span style="color: red;"> <?php echo $passMatch;?></span>
	</p>
	
</body>
</html>