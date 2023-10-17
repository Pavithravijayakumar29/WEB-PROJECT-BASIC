function list_div()
{

  $('#list_div').html("");
  var sendInfo={"action":"retrieve","user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
  $.ajax({
    type: "GET",
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
  if(id==""){sendInfo={"action":"create_form"};}
  else{sendInfo={"action":"update_form","id":id};

}
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(title);
      $('#bd-example-modal-lg1 #model_main_content').html(data);

      setTimeout(function (){
        $("#category_id").select2();
      }, 500);
    },
    error: function() {
      alert('error handing here');
    }
  });
}
function insert_update_row(id,category_id,group_name,hsn_code,description)
{

  if(id=="")
  {
    if((category_id) && (group_name) && (hsn_code) )
    {

    var sendInfo={"action":"insert","category_id":category_id,"group_name":group_name,"hsn_code":hsn_code,'description':description};
    $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function(data){
        if(data=='')
        {
        $('#bd-example-modal-lg1').modal('hide');
        swal('Inserted Successfully', {icon: 'success',});
        list_div();
      }else{
        swal('Already Exit', { icon: 'error', });
      }
      },
      error: function() {
        alert('error handing here');
      }
    });
  }
  else{validate_inputs(category_id,group_name,hsn_code);}


  }
  else
  {
    if((group_name) && (hsn_code) )
    {
    var sendInfo={"action":"update","id":id,"category_id":category_id,"group_name":group_name,'hsn_code':hsn_code,'description':description};
    $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function(data){
        if(data=='')
        {
        $('#bd-example-modal-lg1').modal('hide');
        swal('Updated Successfully', {icon: 'success',});
        list_div();
        }else{
          swal('Already Exit', { icon: 'error', });
        }
      },
      error: function() {
        alert('error handing here');
      }
    });
  }
  else{validate_inputs(category_id,group_name,hsn_code);}

  }
}

function validate_inputs(category_id,group_name,hsn_code)
{

  if (category_id == '') {
    $("#category_id_validate_div").html("Select Category Name");
    // swal('Please Select Category Name', { icon: 'info', });
    $("#category_id").focus();

    return false;
  } else {

    $("#category_id_validate_div").html("");
  }

  if(group_name=='') { $("#group_name").addClass('is-invalid'); $("#group_name_validate_div").html("Enter Group Name"); return false;} else {$("#group_name_validate_div").html(""); $("#group_name").removeClass('is-invalid');

  if(hsn_code=='') { $("#hsn_code").addClass('is-invalid'); $("#hsn_code_validate_div").html("Enter HSN Code"); return false;} else {$("#hsn_code_validate_div").html(""); $("#hsn_code").removeClass('is-invalid'); }
}
}


function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Group Creation',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      var sendInfo={"action":"delete","id":id};
      $.ajax({
        type: "GET",
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
