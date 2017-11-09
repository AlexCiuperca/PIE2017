<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="framework/style.css">
<title>Home page</title>
</head>
<body>
<?php
	include("navbar/nav-bar_home.html");
?>
	<div class="grid">
		<div class="row">
			<div class="col-9">
			</div>
			<div class="col-3" style="width:35%; text-align: center;">
				<div>
					<?php
						include("login.php");
					?>
				</div>
				<div>
					<?php
						include("register.php");
					?>
				</div>
			</div>

</body>
</html>
	
</body>
</html>