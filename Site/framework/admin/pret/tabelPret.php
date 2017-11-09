<?php
	echo "<table>";
		echo "<tr><th>Nume</th><th>Producator</th><th>Model</th><th>Tip</th><th>Pret</th><th>Setari</th></tr>";


	     $info=getSql("SELECT p.id_piesa, p.nume_piesa, p.prod, t.nume_rep, m.nume_model, p.pret FROM piese p, model m, tip_reparatie t where p.id_model=m.id_model AND p.id_reparatie=t.id_reparatie");
	     foreach ($info as $key => $row) {
	
	    
		    echo "<tr id-row=".$row['id_piesa'].">";
			echo "<td class='editable-col' contenteditable='true' col-index='0' oldVal=".$row['nume_piesa'].">" . $row['nume_piesa'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='1' oldVal=".$row['prod'].">" . $row['prod'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='2' oldVal=".$row['nume_model'].">" . $row['nume_model'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='3' oldVal=".$row['nume_rep'].">" . $row['nume_rep'] . "</td>";
			echo "<td class='editable-col' contenteditable='true' col-index='4' oldVal=".$row['pret'].">" . $row['pret'] . "</td>";
			echo "<td>
					<a href='deletePiese.php?id=".$row['id_piesa']."'>
						<img src='../../../img/delete.ico' style='padding-left:10px; width:20px; height:20px; border:0;'>
					</a>
				</td>";
			echo "</tr>";
	     }
	$conn = null;
	echo "</table>"; 
?>