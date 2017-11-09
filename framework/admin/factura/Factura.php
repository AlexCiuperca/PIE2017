<?php
include("../../session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../../style.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  	<script>
  	$( function() {
    	$( ".datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  	} );

    $(document).ready(function(){
    $("#add").click(function(){
        $("#slideAdd").slideToggle("slow");
    });

    $("#selectMarca").change(function(){
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
    $("#selectTip").change(function(){
      data={};
      data['idTip'] = $(this).val();
      data['idModel'] = $('#selectModel').val();

      $.ajax
      ({
      type: "POST",
      url: "check.php",
      data: data,
    cache: false,
    success: function(html)
    {
    $("#ch").html(html);
    } 
    });
    });

    $("#addFac").click(function(){
      data={};
      data['dateFac'] = $('#dateFac').val();
      data['dateInt'] = $('#dateInt').val();
      data['id_client'] = $('#IDCli').val();
      data['id_angajat'] = $('#IDAng').val();

      $.ajax
      ({
      type: "POST",
      url: "addFactura.php",
      data: data,
      dataType: 'json',
      success: function(data){
        console.log(data);
        var table = document.getElementById('tableFacturi');
        var add = document.createElement('tr');
        var html = '<tr id-row='+data.id_factura+'><td class="editable-col" contenteditable="true" col-index="0">'+data.nume_client+'</td><td class="editable-col" contenteditable="true" col-index="1">'+data.data_facturarii+'</td><td class="editable-col" contenteditable="true" col-index="2">'+data.numePiese+'</td><td class="editable-col" contenteditable="true" col-index="3">'+data.nume+' '+data.prenume+'</td><td class="editable-col" contenteditable="true" col-index="4">'+data.data_intrarii+'</td><td class="editable-col" contenteditable="true" col-index="5">'+data.data_iesirii+'</td><td class="editable-col" contenteditable="true" col-index="6">'+data.data_facturarii+'</td><td class="editable-col" contenteditable="true" col-index="7">'+data.suma+'</td><td><a href="deleteFactura.php?id='+data.id_factura+'"><img src="../../../img/delete.ico" style="padding-left:10px; width:20px; height:20px; border:0;"></a><a target="_blank" href="toPDF.php?id='+data.id_factura+'"><img src="../../../img/PDF.ico" style="padding-left:10px; width:20px; height:20px; border:0;"></a></td>';
        add.innerHTML = html;
        table.appendChild(add);
      }
      });
    });

    $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: "POST",
            url: "saveToSession.php",
            data: $('form').serialize(),
          });
        });

      });

  });
  	</script>

  	<script type="text/javascript"> 
       var obj = [];
        var source = [];
        var mapping = {};
       
        $(function() {
            $( "#hintClient" ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "getClient.php",
                        dataType: "json",
                        data: {
                            h: request.term
                        },
                        success: function( data ) {
                            console.log(data);
                            var nume=[];
                            obj = [];
                            $.each(data,function(index, value){
                              obj.push({'nume':value['nume_client'], 'id':value['id_client']});
                            });
                            for(var i = 0; i < obj.length; ++i) {
                                nume.push(obj[i].nume);
                                mapping[obj[i].nume] = obj[i].id;
                            }
                            response(nume);
                        }
                    });
                },
                select: function(event, ui) {
                    document.getElementById("IDCli").value=mapping[ui.item.value];
                }
            });

            $( "#hintAngajat" ).autocomplete({
                source: function( request, response ) {
                    $.ajax({
                        url: "getAngajat.php",
                        dataType: "json",
                        data: {
                            h: request.term
                        },
                        success: function( data ) {
                            console.log(data);
                            var nume=[];
                            var prenume=[];
                            obj = [];
                            $.each(data,function(index, value){
                              obj.push({'nume':value['nume'], 'prenume':value['prenume'], 'id':value['id_angajati']});
                            });
                            for(var i = 0; i < obj.length; ++i) {
                                nume.push(obj[i].nume);
                                prenume.push(obj[i].prenume);
                                mapping[obj[i].nume] = obj[i].id;
                            }
                            response(nume, prenume);
                        }
                    });
                },
                select: function(event, ui) {
                     document.getElementById("IDAng").value=mapping[ui.item.value];
                }
            });
        });     
        </script>
</head>
<body>

<?php
  include("nav-bar.html");
?>
<div class="butonFactura">
  <button id="add">Adauga</button>
     <div class="slide" id='slideAdd'>
      	<div class="grid">
      		<div class="row">
      			<div class="col-6" style="padding-right: 2%;">
			        <p style="text-align: right;">
			        <label>Nume Client:</label>
			        <input type="text" id="hintClient" name="numeClient">
			        </p>
			        <input type="hidden" name="nume_client" id="IDCli" value="">
			        <p style="text-align: right;">
			        <label>Nume Angajat:</label>
			        <input type="text" id="hintAngajat" name="numeAngajat">
			        </p>
			        <input type="hidden" name="nume_ang" id="IDAng" value="">
			        <p style="text-align: right;">
			        <label>Data Intrarii:</label>
			        <input type="text" class="datepicker" name="dateInt" id="dateInt">
			        </p>
			        <p style="text-align: right;">
			        <label>Data Facturarii:</label>
			        <input type="text" class="datepicker" name="dateFac" id="dateFac">
			        </p>
              
               <p style="text-align: center;">
              <button id="addFac">Adauga</button>
            </p>
			    </div>
			    <div class="col-6" style="padding-left: 2%;">
			    	<h3 style="text-align: left;">Piese</h3>
			        <p style="text-align: left;">
			        <label>Marca:</label>
                      <?php
                      $info=getSql('SELECT * from marca');
                      echo "<select name = 'selectMarcaAddP' id='selectMarca'>";
                      echo "<option selected='selected'>--Marca--</option>";
                      foreach ($info as $key => $row)
                      {
                         echo "<option value = '{$row['id_marca']}'";
                            echo ">{$row['nume_marca']}</option>";
                      }
                      echo "</select>";
                      ?>
                   	 </p>
                   	 <p style="text-align: left;">
                      <label>Model:</label>
                      <select name = 'selectModelAdd' id="selectModel">
                        <option selected="selected">--Model--</option>
                      </select>
                    </p>
			        <p style="text-align: left;">
                      <label>Tip Reparatie:</label>
                      <?php
                      $info2=getSql('SELECT * from tip_reparatie');
                      echo "<select name = 'selectTipAdd' id='selectTip'>";
                      foreach ($info2 as $key => $row)
                      {
                         echo "<option value = '{$row['id_reparatie']}'";
                            echo ">{$row['nume_rep']}</option>";
                      }
                      echo "</select>";
                      ?>
                    </p>
                    
                    <h4 style="text-align: left;">Selecteaza</h4>
                    <div style="text-align: left;">
                    <?php
                    echo "<form action='' method='POST' id='ch'>";
                    
                    echo "</form>";
                    ?>
					         </div>
			    </div>        
			</div>
      
		</div>
    </div>
</div>

<div style="text-align: center;">
  <h3>Selectati invervalul raportului</h3>
  <p>
    <input type="text" id="date1" class="datepicker">
    <input type="text" id="date2" class="datepicker">
    <input type="submit" id="raport" name="raport" value="Raport">
  </p>
  <script>
    $(document).ready(function(){
    $("#raport").click(function(){
      data={};
      data['date1'] = $('#date1').val();
      data['date2'] = $('#date2').val();

      $.ajax
      ({
      type: "POST",
      url: "raport.php",
      data: data,
      success: function(){
        window.open("PDF_Raport",'_blank');
      }
      });
    });
    });

  </script>
</div>

<div style="align-content: center;">
<?php
  include('tabelFactura.php');
?>
</div>
</body>
</html>

