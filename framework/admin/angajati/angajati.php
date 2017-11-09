<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<script>
  	$( function() {
    	$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  	} );
  	</script>
  	
</head>
<body>

<?php
	include("nav-bar.html");
	//include("../../../functions/getSql.php");
	include("../../session.php");
	require('../../../classes/Database.php');
?>

	<div class="grid">
		<div class="row">
			<div class="col-3" style="text-align: center;">
				<form action="addAngajati.php ?>" method="POST">
				<p style="text-align: right; margin-top: 15%">
					<label>Nume : </label>
					<input type="text" id="nume" name="nume" />	
				</p>	
				<p style="text-align: right;">
					<label>Prenume : </label>
					<input type="text" id="prenume" name="prenume" />
				</p>
				<p style="text-align: right;">
					<label>Varsta : </label>
					<input type='text' id='varsta' name='varsta' />
				</p>
				<p style="text-align: right;">	
					<label>Profesia : </label>
					<input type="text" id="profesia" name="profesia">
				</p>
				<p style="text-align: right;">	
					<label>Salariu : </label>
					<input type="text" id="salariu" name="salariu">
				</p>
				<p style="text-align: right;">	
					<label>Data angajarii : </label>
					<input type="text" class="datepicker" name="date">
				</p>
				<input type="submit" nume="submit" value=" Adauga ">
				</form>
			</div>
			<div class="col-9">
				<?php
					echo "<table>";
						echo "<tr><th>Nume</th><th>Prenume</th><th>Varsta</th><th>Salariu</th><th>Data Angajarii</th><th>Profesia</th><th>Setari</th></tr>";

						$info = new Database;
					    $info->query('SELECT * from angajati');
					    $data = $info->resultset();
					     foreach ($data as $key => $row) {
					
					    
						    echo "<tr id-row=".$row['id_angajati'].">";
							echo "<td class='editable-col' contenteditable='true' col-index='0' oldVal=".$row['nume'].">" . $row['nume'] . "</td>";
							echo "<td class='editable-col' contenteditable='true' col-index='1' oldVal=".$row['prenume'].">" . $row['prenume'] . "</td>";
							echo "<td class='editable-col' contenteditable='true' col-index='2' oldVal=".$row['varsta'].">" . $row['varsta'] . "</td>";
							echo "<td class='editable-col' contenteditable='true' col-index='3' oldVal=".$row['salariu'].">" . $row['salariu'] . "</td>";
							echo "<td class='editable-col datepicker' contenteditable='true' col-index='4'><input style='width:80px;' class='datepicker' type='text' value='". $row['data_angajarii'] ."'></td>";
							echo "<td class='editable-col' contenteditable='true' col-index='5' oldVal=".$row['profesia'].">" . $row['profesia'] . "</td>";
							echo "<td>
									<a href='deleteAngajati.php?id=".$row['id_angajati']."'>
										<img src='../../../img/delete.ico' style='padding-left:10px; width:20px; height:20px; border:0;'>
									</a>
								</td>";
							echo "</tr>";
					     }
					$conn = null;
					echo "</table>"; 
				?>
			</div>
		</div>
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

	$('.datepicker.hasDatepicker').on('change', function(){
			var myelement=$(this);
			date = {};
			date['val'] = $(myelement).datepicker().val();
			date['id'] = $(this).parents('tr').attr('id-row');
			$.ajax({   
				  
					type: "POST",  
					url: "editData.php",  
					cache:false,  
					data: date,
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