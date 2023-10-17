function list_div()
{  
  $('#list_div').html("");
  var _token1=$("#_token1").val();
  var sendInfo={"_token":_token1,"action":"retrieve","user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){

      $('#list_div').html(data);
      $(function () {
        $('#tableExport').DataTable({
            "dom": 'lBfrtip',
            "buttons": [
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0, 1, 2,3,4 ]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    //text: '<i class="far fa-file-pdf"></i>',
                    exportOptions: {
                        columns: [0, 1, 2,3,4 ]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2,3,4 ]
                    }
                }
            ]
        });
    });
    },
    error: function() {
      alert('error handing here');
    }
  });
}
$(function () {
  list_div();
});
function open_model(title,id)
{
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
  
  var _token1=$("#_token1").val();
  if(id==""){sendInfo={"_token":_token1,"action":"create_form"};}
  else{sendInfo={"_token":_token1,"action":"update_form","id":id};}
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){

      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(title);
      $('#bd-example-modal-lg1 #model_main_content').html(data);
    },
    error: function() {
      alert('error handing here');
    }
  });
}
function insert_update_row(id,manager_no,manager_name,address,contact_no,whatsapp_no,email_address,status1)
{
  var _token1=$("#_token1").val();
 var gender = $("input[name='gender']:checked").val();
    
  if(id=="")
  {
    if((manager_name)&&(address)&&(whatsapp_no)){
        var formData = new FormData();
        formData.append("action", "insert");
        formData.append("manager_no", manager_no);
        formData.append("manager_name", manager_name);
        formData.append("gender", gender);
        formData.append("address", address);
        formData.append("contact_no", contact_no);
        formData.append("whatsapp_no", whatsapp_no);
        formData.append("email_address", email_address);
        formData.append("status1", status1);
        formData.append("image_name", $("#image_name")[0].files[0]);
        formData.append("_token", _token1);

    $.ajax({
      type: "POST",
      url: $("#CUR_ACTION").val(),
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        $('#bd-example-modal-lg1').modal('hide');
        swal('Inserted Successfully', {icon: 'success',});
        list_div();
      },
      error: function() {
        alert('error handing here');
      }
    });
  }
  else{validate_inputs(manager_name,address,whatsapp_no);}
  }
  else
  {
    if((manager_name)&&(address)&&(whatsapp_no)){
        var formData = new FormData();
        formData.append("action", "update");
        formData.append("id", id);
        formData.append("manager_no", manager_no);
        formData.append("manager_name", manager_name);
        formData.append("gender", gender);
        formData.append("address", address);
        formData.append("contact_no", contact_no);
        formData.append("whatsapp_no", whatsapp_no);
        formData.append("email_address", email_address);
        formData.append("status1", status1);
        formData.append("image_name", $("#image_name")[0].files[0]);
        formData.append("_token", _token1);
    $.ajax({
      type: "POST",
      url: $("#CUR_ACTION").val(),
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        $('#bd-example-modal-lg1').modal('hide');
        swal('Updated Successfully', {icon: 'success',});
        list_div();
      },
      error: function() {
        alert('error handing here');
      }
    });
  }
  else{validate_inputs(manager_name,address,whatsapp_no);}
  }
}

function validate_inputs(manager_name,address,whatsapp_no)
{
  if(manager_name==='') { $("#manager_name").addClass('is-invalid');$("#manager_name_validate_div").html("Select Manager Name"); return false;} else {$("#manager_name").removeClass('is-invalid');$("#manager_name_validate_div").html("");}

  if(address==='') { $("#address").addClass('is-invalid');$("#address_validate_div").html("Enter Address"); return false;} else {$("#address").removeClass('is-invalid');$("#address_validate_div").html("");}

  if(whatsapp_no==='') { $("#whatsapp_no").addClass('is-invalid');$("#whatsapp_no_validate_div").html("Enter WhatsApp No"); return false;} else {$("#whatsapp_no").removeClass('is-invalid');$("#whatsapp_no_validate_div").html("");}
}

function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Market Manager Creation',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
        
  var _token1=$("#_token1").val();
      var sendInfo={"_token":_token1,"action":"delete","id":id};
      $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data){
          swal('Deleted Successfully', {icon: 'success',});
          list_div();
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
  });
}
