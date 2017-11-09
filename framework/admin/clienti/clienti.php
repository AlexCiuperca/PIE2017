<?php
include("../../session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>

<?php
	include("nav-bar.html");
	require('../../../classes/Database.php');
?>

	<div align="center">		
		<?php
			echo "<table>";
				echo "<tr><th>Nume</th><th>Telefon</th><th>Adresa</th><th>Setari</th></tr>";

				$info = new Database;
			    $info->query('SELECT * from clientii');
			    $data = $info->resultset();
			     foreach ($data as $key => $row) {
			
			    
				    echo "<tr id-row=".$row['id_client'].">";
					echo "<td class='editable-col' contenteditable='true' col-index='0' oldVal=".$row['nume_client'].">" . $row['nume_client'] . "</td>";
					echo "<td class='editable-col' contenteditable='true' col-index='1' oldVal=".$row['telefon'].">" . $row['telefon'] . "</td>";
					echo "<td class='editable-col' contenteditable='true' col-index='2' oldVal=".$row['adresa'].">" . $row['adresa'] . "</td>";
					echo "<td>
							<a href='deleteAngajati.php?id=".$row['id_client']."'>
								<img src='../../../img/delete.ico' style='padding-left:10px; width:20px; height:20px; border:0;'>
							</a>
							<a target='_blank' href='detaliiClient.php?id=".$row['id_client']."'>
								<img src='../../../img/detalii.png' style='padding-left:10px; width:20px; height:20px; border:0;'>
							</a>
						</td>";
					echo "</tr>";
			     }
			echo "</table>"; 
		?>
	</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
	
	$('td.editable-col').on('focusout', function () {
		data = {};
		data['val'] = $(this).text();
		data['id'] = $(this).parent('tr').attr('id-row');
		data['index'] = $(this).attr('col-index');
		$.ajax({   
				  
					type: "POST",  
					url: "editAngajati.php",  
					cache:false,  
					data: data,
					dataType: "json",				
					success: function(response)  
					{   
						if(!response.error) {
							$("#msg").removeClass('alert-danger');
							$("#msg").addClass('alert-success').html(response.msg);
						} else {
							$("#msg").removeClass('alert-success');
							$("#msg").addClass('alert-danger').html(response.msg);
						}
					}   
				});
	});
});

</script>