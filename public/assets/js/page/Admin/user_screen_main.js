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
  else{sendInfo={"action":"update_form","id":id};}
  $.ajax({
    type: "GET",
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
function insert_update_row(id,screen_name,description,status)
{
  if(id=="")
  {
    if((screen_name)&&(status))
    {
      var sendInfo={"action":"insert","screen_name":screen_name,"description":description,"status":status};
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
          }
          else{$("#screen_name").addClass('is-invalid');$("#screen_name_validate_div").html("Screen Name Already Exist");}
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
    else{validate_inputs(screen_name,status);}
  }
  else
  {
    if((screen_name)&&(status))
    {
      var sendInfo={"action":"update","id":id,"screen_name":screen_name,"description":description,'status':status};
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
          }
          else{$("#screen_name").addClass('is-invalid');$("#screen_name_validate_div").html("Screen Name Already Exist");}
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
    else{validate_inputs(screen_name,status);}
  }
}
function validate_inputs(screen_name,status)
{
  if(screen_name==='') { $("#screen_name").addClass('is-invalid');$("#screen_name_validate_div").html("Enter Screen Name"); return false;} else {$("#screen_name").removeClass('is-invalid');$("#screen_name_validate_div").html("");}
  
  if(status==='') { $("#status1").addClass('is-invalid');$("#status1_validate_div").html("Select Status"); return false;} else {$("#status1").removeClass('is-invalid');$("#status1_validate_div").html("");}
}
function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete User Screen Main',
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