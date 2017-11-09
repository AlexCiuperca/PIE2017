<?php
	include("../../../functions/getSql.php");

    $tip=$_POST['idTip'];
    $model=$_POST['idModel'];
    $piesa=getSql('SELECT * from piese where id_reparatie=:tip and id_model=:model ',array(':tip'=>$tip, ':model'=>$model));
    foreach ($piesa as $key => $row)
    	{
    	echo "<input type='checkbox' class='check' name='piese[]' value=" . $row['id_piesa'] . " />" . $row['nume_piesa']."  ".$row['prod']."<br>";
    	}
    echo "<input type='submit' id='save' name='submit' value='Save'>";

?>