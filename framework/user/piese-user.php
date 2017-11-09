<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
<?php
	include("nav_bar_user.html");
	include("../../functions/getSql.php");
?>
<script >
$(document).ready(function(){
	var str="";
	$('#selectModel, #selectTip').change(function(){
	    
	    var rows = $('#piese tr:not(:first)');
	    rows.hide();
	    
	    var sub = $("#selectTip").val();
	    var select= $('#selectModel').val();
	    if (select == "Show all" && sub == "Show all"){
	        rows.show();
	    }
	    else if (sub == "Show all"){
	        if (select != "Show all") str=":contains('" + select + "')";
	        else str="";
	    }else if (select == "Show all"){
	        if (sub != "Show all") str=":contains('" + sub + "')";
	        else str="";
	    }else{
	        str=":contains('" + sub + "'):contains('" + select + "')";
	    }
	    rows.filter(str).show();
	    console.log(sub, select,str);
	});

		$("#selectMarca").change(function()
		      {
		      var id=$(this).val();
		      var dataString = 'id='+ id;

		      $.ajax
		      ({
		      type: "POST",
		      url: "select.php",
		      data: dataString,
		      cache: false,
		      success: function(html)
		      {
		      $("#selectModel").html(html);
		      } 
		      });

		    });
});
</script>
<div style="padding-left: 20%; margin-top: 5%;">
	<p>
        <label>Marca:</label>
        <?php
        $info3=getSql('SELECT * from marca');
        echo "<select name = 'marca' id='selectMarca'>";
        echo "<option selected='selected'>--Marca--</option>";
        foreach ($info3 as $key => $row)
        {
        	echo "<option value = '{$row['id_marca']}'";
            echo ">{$row['nume_marca']}</option>";
        }
        echo "</select>";
        ?>
 
        <label>Model:</label>
        <select name = 'model' id="selectModel">
        	<option selected="selected">Show all</option>
        </select>
    
        <label>Tip Reparatie:</label>
        <?php
        $info2=getSql('SELECT * from tip_reparatie');
        echo "<select name = 'selectTip' id='selectTip'>";
         echo "<option selected='selected'>Show all</option>";
        foreach ($info2 as $key => $row)
        {
            echo "<option value = '{$row['nume_rep']}'";
            echo ">{$row['nume_rep']}</option>";
        }
        echo "</select>";
        ?>
    </p>
</div>

<div align="center">
	<?php
		echo "<table id='piese'>";
			echo "<tr><th>Nume</th><th>Producator</th><th>Model</th><th>Tip</th><th>Pret</th></tr>";


		     $info=getSql("SELECT p.id_piesa, p.nume_piesa, p.prod, t.nume_rep, m.nume_model, p.pret FROM piese p, model m, tip_reparatie t where p.id_model=m.id_model AND p.id_reparatie=t.id_reparatie");
		     foreach ($info as $key => $row) {
		
		    
			    echo "<tr id-row=".$row['id_piesa'].">";
				echo "<td class='editable-col' contenteditable='true' col-index='0' oldVal=".$row['nume_piesa'].">" . $row['nume_piesa'] . "</td>";
				echo "<td class='editable-col' contenteditable='true' col-index='1' oldVal=".$row['prod'].">" . $row['prod'] . "</td>";
				echo "<td class='editable-col' contenteditable='true' col-index='2' oldVal=".$row['nume_model'].">" . $row['nume_model'] . "</td>";
				echo "<td class='editable-col' contenteditable='true' col-index='3' oldVal=".$row['nume_rep'].">" . $row['nume_rep'] . "</td>";
				echo "<td class='editable-col' contenteditable='true' col-index='4' oldVal=".$row['pret'].">" . $row['pret'] . "</td>";
				echo "</tr>";
		     }
		$conn = null;
		echo "</table>"; 
	?>
</div>
</body>
</html>