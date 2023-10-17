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
function insert_update_row(id,user_type_id,staff_id,mar_man,designation,user_name,password,confirm_password,status)
{
  if(id=="")
  {
    if((user_type_id)&&(user_name)&&(password)&&(confirm_password)&&(password==confirm_password)&&(status))
    {
      var sendInfo={"action":"insert","user_type_id":user_type_id,"staff_id":staff_id,"mar_man":mar_man,"designation":designation,"user_name":user_name,"password":password,'confirm_password':confirm_password,'status':status};
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
          else{$("#user_name").addClass('is-invalid');$("#user_name_validate_div").html("User Name Already Exist");}
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
    else{validate_inputs(user_type_id,user_name,password,confirm_password,status);}
  }
  else
  {
    if((user_type_id)&&(user_name)&&(password)&&(confirm_password)&&(password==confirm_password)&&(status))
    {
      var sendInfo={"action":"update","id":id,"user_type_id":user_type_id,"staff_id":staff_id,"mar_man":mar_man,"designation":designation,"user_name":user_name,"password":password,'confirm_password':confirm_password,'status':status};
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
          else{$("#user_name").addClass('is-invalid');$("#user_name_validate_div").html("User Name Already Exist");}
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
    else{validate_inputs(user_type_id,user_name,password,confirm_password,status);}
  }
}
function validate_inputs(user_type_id,user_name,password,confirm_password,status)
{
    var errorMessage_1 = document.getElementById('error_message_1');
    var errorMessage_2 = document.getElementById('error_message_2');

  if(user_type_id==0){
    errorMessage_1.style.display = 'block';
    return false;
    }else{

        errorMessage_1.style.display = 'none';
    }
    if(staff_id==0){
        errorMessage_2.style.display = 'block';
        return false;
        }else{

            errorMessage_2.style.display = 'none';
        }


  if(user_name==='') { $("#user_name").addClass('is-invalid');$("#user_name_validate_div").html("Enter User Name"); return false;} else {$("#user_name").removeClass('is-invalid');$("#user_name_validate_div").html("");}

  if(password==='') { $("#password").addClass('is-invalid');$("#password_validate_div").html("Enter Password"); return false;} else {$("#password").removeClass('is-invalid');$("#password_validate_div").html("");}

  if(confirm_password==='') { $("#confirm_password").addClass('is-invalid');$("#confirm_password_validate_div").html("Enter Confirm Password"); return false;} else {$("#confirm_password").removeClass('is-invalid');$("#confirm_password_validate_div").html("");}
  if(password!=confirm_password) { $("#confirm_password").addClass('is-invalid');$("#confirm_password_validate_div").html("Password not matched"); return false;} else {$("#confirm_password").removeClass('is-invalid');$("#confirm_password_validate_div").html("");}
  if(status==='') { $("#status1").addClass('is-invalid');$("#status1_validate_div").html("Select Status"); return false;} else {$("#status1").removeClass('is-invalid');$("#status1_validate_div").html("");}
}
function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete User Creation',
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
