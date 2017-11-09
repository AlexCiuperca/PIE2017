<!DOCTYPE html>
<html>
<head>
<title>Home page</title>
</head>
<body>
<?php
	include("nav_bar_user.html");
	include('../session.php');

?>

<p>Content</p>
<?php echo $login_session;
	echo $_SESSION['id_client']; ?>
<br>
<br>
<b id="logout"><a href="../logout.php">Log Out</a></b>
</body>
</html>