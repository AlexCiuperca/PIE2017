<?php 
    include("../../../functions/getSql.php");

    
    $sql = getSql("SELECT nume, id_piesa FROM piese where id_model=:id_M and id_reparatie=:id_rep", array(':id_M' => $id_M, 'id_rep' => $id_rep));
	 foreach ($info4 as $key => $row)
    {
	    echo "<span>".$employee['name']."</span>";
		echo "<input type='checkbox' name='employees[]' value=".$employee['name']."/><br />";
    }




    

?>