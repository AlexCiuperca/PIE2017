<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../../style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
    $("#add").click(function(){
        $("#slideAdd").slideToggle("slow");
    });
    $("#marcaAdd").click(function(){
        $("#formMarca").slideToggle("slow");
    });
    $("#modelAdd").click(function(){
        $("#formModel").slideToggle("slow");
    });
    $("#piesaAdd").click(function(){
        $("#formPiesa").slideToggle("slow");
    });

    $('td.editable-col').on('focusout', function () {
    data = {};
    data['val'] = $(this).text();
    data['id'] = $(this).parent('tr').attr('id-row');
    data['index'] = $(this).attr('col-index');
    $.ajax({   
          
          type: "POST",  
          url: "editPiese.php",  
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
</head>
<body>

  <?php
  	include("../../../functions/getSql.php");
    include("nav-bar.html");
  ?>
  <div class="grid">
    <div class="row">
      <div class="col-3" style="padding-top: 5%; width: 31%;">
        <button id='add'>Adauga</button>
          <div class="slide" id='slideAdd'>


            <button id="marcaAdd">Marca</button>
              <div class="slide" id='formMarca'>
                <form action="" method="POST">
                  <p>
                  <label>Nume:</label>
                  <input type="text" name="numeMarcaAdd">
                  </p>
                  <p>
                  <input type="submit" name="addMarca" value="OK">
                  </p>
                  </form>
              </div>


              <button id='modelAdd'>Model</button>
                <div class="slide" id='formModel'>
                  <form action="" method="POST">
                    <p>
                      <label>Nume:</label>
                      <input type="text" name="numeModelAdd">
                    </p>
                    <p>
                      <label>Marca:</label>
                      <?php
                      $info=getSql('SELECT * from marca');
                      echo "<select name = 'selectMarcaAdd'>";
                      foreach ($info as $key => $row)
                      {
                         echo "<option value = '{$row['id_marca']}'";
                            echo ">{$row['nume_marca']}</option>";
                      }
                      echo "</select>";
                      ?>
                    </p>
                    <p>
                    <input type="submit" name="addModel" value="OK">
                    </p>
                  </form>
                </div>


              <button id='piesaAdd'>Piesa</button>
                <div class="slide" id='formPiesa'  style="text-align: right;">
                  <form action="" method="POST">
                    <p>
                      <label>Nume:</label>
                      <input type="text" name="numePiesaAdd">
                    </p>
                    <p>
                      <label>Producator:</label>
                      <input type="text" name="producatorPiesaAdd">
                    </p>
                    <p>
                      <label>Tip Reparatie:</label>
                      <?php
                      $info2=getSql('SELECT * from tip_reparatie');
                      echo "<select name = 'selectTipAdd'>";
                      foreach ($info2 as $key => $row)
                      {
                         echo "<option value = '{$row['id_reparatie']}'";
                            echo ">{$row['nume_rep']}</option>";
                      }
                      echo "</select>";
                      ?>
                    </p>
                    <p>
                      <label>Marca:</label>
                      <?php
                      $info3=getSql('SELECT * from marca');
                      echo "<select name = 'selectMarcaAddP' id='selectMarca'>";
                      echo "<option selected='selected'>--Marca--</option>";
                      foreach ($info3 as $key => $row)
                      {
                         echo "<option value = '{$row['id_marca']}'";
                            echo ">{$row['nume_marca']}</option>";
                      }
                      echo "</select>";
                      ?>
                    </p>
                    <p>
                      <label>Model:</label>
                      <select name = 'selectModelAdd' id="selectModel">
                        <option selected="selected">--Model--</option>
                      </select>
                    </p>
                    <p>
                      <label>Pret:</label>
                      <input type="text" name="pretPiesaAdd">
                    </p>
                    <p style="text-align: center;">
                      <input type="submit" name="addPret" value="OK">
                    </p>
                  </form>
                </div>
          </div>
        </div>
      <div class="col-9" style="padding-top: 5%; border: none; width: 69%">
          <?php
          include('tabelPret.php');
          ?>
      </div>
    </div>
  </div>
</body>
</html>
<?php
  if(isset($_POST['addMarca'])) {
    if(!empty($_POST["numeMarcaAdd"])) {
      $numeMarcaAdd=$_POST['numeMarcaAdd'];
      Sql('INSERT INTO marca (nume) VALUES (:nume)', array(':nume' => $numeMarcaAdd));
    }
  }

  if(isset($_POST['addModel'])) {
    if(!empty($_POST["numeModelAdd"]) && !empty($_POST["selectMarcaAdd"])) {
      $numeModelAdd=$_POST['numeModelAdd'];
      $selectMarcaAdd=$_POST['selectMarcaAdd'];
      Sql('INSERT INTO model (nume, id_marca) VALUES (:nume,:id_marca)', array(':nume' => $numeModelAdd, ':id_marca' => $selectMarcaAdd));
    }
  }

  if(isset($_POST['addPret'])) {
    $numePiesaAdd=$_POST['numePiesaAdd'];
    $producatorPiesaAdd=$_POST['producatorPiesaAdd'];
    $pretPiesaAdd=$_POST['pretPiesaAdd'];
    $selectTipAdd=$_POST['selectTipAdd'];
    $selectModelAdd=$_POST['selectModelAdd'];
    Sql('INSERT INTO piese (nume_piesa, prod, id_model, id_reparatie, pret) VALUES (:nume, :prod, :id_model, :id_rep, :pret)', array(':nume' => $numePiesaAdd, ':prod' => $producatorPiesaAdd, ':id_model' => $selectModelAdd, ':id_rep' => $selectTipAdd, ':pret' => $pretPiesaAdd));
    //header("Location: .");
  }
?>