<!DOCTYPE html>
<html>
<head>
<title>Home page</title>
</head>
<body>
<?php
	include("../navbar/nav-bar.html");
	include('../session.php');

?>

<p>Content</p>
<?php echo $login_session; ?>
<br>
<br>
<b id="logout"><a href="../logout.php">Log Out</a></b>
</body>
</html>