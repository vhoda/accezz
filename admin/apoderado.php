<?php

include('header.php');

?>

<div class="container" style="margin-top:30px">
  <div class="card shadow">
  	<div class="card-header">
      <div class="row">
        <div class="col-md-9">Lista de Apoderados</div>
        <div class="col-md-3" align="right">
          <button type="button" id="add_button" class="btn btn-success btn-sm">Agregar apoderado</button>
        </div>
      </div>
    </div>
  	<div class="card-body">
  		<div class="table-responsive">
        <span id="message_operation"></span>
  			<table class="table table-striped table-bordered" id="apoderado_table">
  				<thead>
  					<tr>
  						<th>Imagen</th>
  						<th>Nombre del Apoderado</th>
  						<th>Correo</th>
              <th>Curso</th>
  						<th>Ver</th>
  						<th>Editar</th>
  						<th>Eliminar</th>
  					</tr>
  				</thead>
  				<tbody>

  				</tbody>
  			</table>
  		</div>
  	</div>
  </div>
</div>

</body>
</html>

<script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="../css/datepicker.css" />

<style>
    .datepicker {
      z-index: 1600 !important; /* has to be larger than 1050 */
    }
</style>

<div class="modal" id="formModal">
  <div class="modal-dialog">
    <form method="post" id="apoderado_form" enctype="multipart/form-data">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modal_title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="mb-3 col-auto">
            <div class="row">
              <label class="col-md-4 text-right">Nombre del apoderado <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="apoderado_name" id="apoderado_name" class="form-control" />
                <span id="error_apoderado_name" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="mb-3 col-auto">
            <div class="row">
              <label class="col-md-4 text-right">Dirección<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <textarea name="apoderado_address" id="apoderado_address" class="form-control"></textarea>
                <span id="error_apoderado_address" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="mb-3 col-auto">
            <div class="row">
              <label class="col-md-4 text-right">Correo <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="apoderado_emailid" id="apoderado_emailid" class="form-control" />
                <span id="error_apoderado_emailid" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="mb-3 col-auto">
            <div class="row">
              <label class="col-md-4 text-right">Contraseña <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="password" name="apoderado_password" id="apoderado_password" class="form-control" />
                <span id="error_apoderado_password" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="mb-3 col-auto">
            <div class="row">
              <label class="col-md-4 text-right">Calificación<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="apoderado_qualification" id="apoderado_qualification" class="form-control" />
                <span id="error_apoderado_qualification" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="mb-3 col-auto">
            <div class="row">
              <label class="col-md-4 text-right">Curso <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <select name="apoderado_grade_id" id="apoderado_grade_id" class="form-control">
                  <option value="">Seleccionar Curso</option>
                  <?php
                  echo load_grade_list($connect);
                  ?>
                </select>
                <span id="error_apoderado_grade_id" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="mb-3 col-auto">
            <div class="row">
              <label class="col-md-4 text-right">Fecha de ingreso <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" name="apoderado_doj" id="apoderado_doj" class="form-control" />
                <span id="error_apoderado_doj" class="text-danger"></span>
              </div>
            </div>
          </div>
          <div class="mb-3 col-auto">
            <div class="row">
              <label class="col-md-4 text-right">Imagen <span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="file" name="apoderado_image" id="apoderado_image" />
                <span class="text-muted">Solo en formato .jpg and .png son Aceptados</span><br />
                <span id="error_apoderado_image" class="text-danger"></span>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <input type="hidden" name="hidden_apoderado_image" id="hidden_apoderado_image" value="" />
          <input type="hidden" name="apoderado_id" id="apoderado_id" />
          <input type="hidden" name="action" id="action" value="Agregar" />
          <input type="submit" name="button_action" id="button_action" class="btn btn-success btn-sm" value="Agregar" />
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
        </div>

      </div>
    </form>
  </div>
</div>

<div class="modal" id="viewModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Detalles del apoderado</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="apoderado_details">

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<div class="modal" id="deleteModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Confimar Eliminar</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <h3 align="center">Estas seguro?</h3>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="button" name="ok_button" id="ok_button" class="btn btn-primary btn-sm">OK</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>


<script>
$(document).ready(function(){
	var dataTable = $('#apoderado_table').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"apoderado_action.php",
			type:"POST",
			data:{action:'fetch'}
		},
		"columnDefs":[
			{
				"targets":[0, 4, 5, 6],
				"orderable":false,
			},
		],
	});

  $('#apoderado_doj').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        container: '#formModal modal-body'
    });

  function clear_field()
  {
    $('#apoderado_form')[0].reset();
    $('#error_apoderado_name').text('');
    $('#error_apoderado_address').text('');
    $('#error_apoderado_emailid').text('');
    $('#error_apoderado_password').text('');
    $('#error_apoderado_qualification').text('');
    $('#error_apoderado_doj').text('');
    $('#error_apoderado_image').text('');
    $('#error_apoderado_grade_id').text('');
  }

  $('#add_button').click(function(){
    $('#modal_title').text("Agregar apoderado");
    $('#button_action').val('Agregar');
    $('#action').val('Add');
    $('#formModal').modal('show');
    clear_field();
  });

  $('#apoderado_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"apoderado_action.php",
      method:"POST",
      data:new FormData(this),
      dataType:"json",
      contentType:false,
      processData:false,
      beforeSend:function()
      {        
        $('#button_action').val('Validando...');
        $('#button_action').attr('disabled', 'disabled');
      },
      success:function(data){
        $('#button_action').attr('disabled', false);
        $('#button_action').val($('#action').val());
        if(data.success)
        {
          $('#message_operation').html('<div class="alert alert-success">'+data.success+'</div>');
          clear_field();
          $('#formModal').modal('hide');
          dataTable.ajax.reload();
        }
        if(data.error)
        { 
          if(data.error_apoderado_name != '')
          {
            $('#error_apoderado_name').text(data.error_apoderado_name);
          }
          else
          {
            $('#error_apoderado_name').text('');
          }
          if(data.error_apoderado_address != '')
          {
            $('#error_apoderado_address').text(data.error_apoderado_address);
          }
          else
          {
            $('#error_apoderado_address').text('');
          }
          if(data.error_apoderado_emailid != '')
          {
            $('#error_apoderado_emailid').text(data.error_apoderado_emailid);
          }
          else
          {
            $('#error_apoderado_emailid').text('');
          }
          if(data.error_apoderado_password != '')
          {
            $('#error_apoderado_password').text(data.error_apoderado_password);
          }
          else
          {
            $('#error_apoderado_password').text('');
          }
          if(data.error_apoderado_grade_id != '')
          {
            $('#error_apoderado_grade_id').text(data.error_apoderado_grade_id);
          }
          else
          {
            $('#error_apoderado_grade_id').text('');
          }
          if(data.error_apoderado_qualification != '')
          {
            $('#error_apoderado_qualification').text(data.error_apoderado_qualification);
          }
          else
          {
            $('#error_apoderado_qualification').text('');
          }
          if(data.error_apoderado_doj != '')
          {
            $('#error_apoderado_doj').text(data.error_apoderado_doj);
          }
          else
          {
            $('#error_apoderado_doj').text('');
          }
          if(data.error_apoderado_image != '')
          {
            $('#error_apoderado_image').text(data.error_apoderado_image);
          }
          else
          {
            $('#error_apoderado_image').text('');
          }
        }
      }
    });
  });

  var apoderado_id = '';

  $(document).on('click', '.view_apoderado', function(){
    apoderado_id = $(this).attr('id');
    $.ajax({
      url:"apoderado_action.php",
      method:"POST",
      data:{action:'single_fetch', apoderado_id:apoderado_id},
      success:function(data)
      {
        $('#viewModal').modal('show');
        $('#apoderado_details').html(data);
      }
    });
  });

  $(document).on('click', '.edit_apoderado', function(){
  	apoderado_id = $(this).attr('id');
  	clear_field();
  	$.ajax({
  		url:"apoderado_action.php",
  		method:"POST",
  		data:{action:'edit_fetch', apoderado_id:apoderado_id},
  		dataType:"json",
  		success:function(data)
  		{
  			$('#apoderado_name').val(data.apoderado_name);
  			$('#apoderado_address').val(data.apoderado_address);
  			$('#apoderado_grade_id').val(data.apoderado_grade_id);
  			$('#apoderado_qualification').val(data.apoderado_qualification);
  			$('#apoderado_doj').val(data.apoderado_doj);
  			$('#error_apoderado_image').html('<img src="apoderado_image/'+data.apoderado_image+'" class="img-thumbnail" width="50" />');
  			$('#hidden_apoderado_image').val(data.apoderado_image);
  			$('#apoderado_id').val(data.apoderado_id);
  			$('#modal_title').text('Editar Apoderado');
  			$('#button_action').val('Editar');
  			$('#action').val('Edit');
  			$('#formModal').modal('show');
  		}
  	});
  });

  $(document).on('click', '.delete_apoderado', function(){
  	apoderado_id = $(this).attr('id');
  	$('#deleteModal').modal('show');
  });

  $('#ok_button').click(function(){
  	$.ajax({
  		url:"apoderado_action.php",
  		method:"POST",
  		data:{apoderado_id:apoderado_id, action:'delete'},
  		success:function(data)
  		{
  			$('#message_operation').html('<div class="alert alert-success">'+data+'</div>');
  			$('#deleteModal').modal('hide');
  			dataTable.ajax.reload();
  		}
  	})
  });

});
</script>