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
function insert_update_row(id,user_screen_main_id,sub_screen_name,description,status)
{
  if(id=="")
  {
    if((user_screen_main_id)&&(sub_screen_name)&&(status))
    {
      var sendInfo={"action":"insert","user_screen_main_id":user_screen_main_id,"sub_screen_name":sub_screen_name,"description":description,"status":status};
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
          else{$("#sub_screen_name").addClass('is-invalid');$("#sub_screen_name_validate_div").html("Sub Screen Name Already Exist");}
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
    else{validate_inputs(user_screen_main_id,sub_screen_name,status);}
  }
  else
  {
    if((user_screen_main_id)&&(sub_screen_name)&&(status))
    {
      var sendInfo={"action":"update","id":id,"user_screen_main_id":user_screen_main_id,"sub_screen_name":sub_screen_name,"description":description,'status':status};
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
          else{$("#sub_screen_name").addClass('is-invalid');$("#sub_screen_name_validate_div").html("Sub Screen Name Already Exist");}
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
    else{validate_inputs(user_screen_main_id,sub_screen_name,status);}
  }
}
function validate_inputs(user_screen_main_id,sub_screen_name,status)
{
  if(user_screen_main_id==='') { $("#user_screen_main_id").addClass('is-invalid');$("#user_screen_main_id_validate_div").html("Select Screen Name"); return false;} else {$("#user_screen_main_id").removeClass('is-invalid');$("#user_screen_main_id_validate_div").html("");}
  if(sub_screen_name==='') { $("#sub_screen_name").addClass('is-invalid');$("#sub_screen_name_validate_div").html("Enter Sub Screen Name"); return false;} else {$("#sub_screen_name").removeClass('is-invalid');$("#sub_screen_name_validate_div").html("");}
  
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
function open_rights_model(screen_name,sub_screen_name,user_screen_main_id,user_screen_sub_id)
{
  $('#bd-example-modal-lg2 #model_main_content2').html("...");
  var sendInfo={"action":"rights_form","screen_name":screen_name,"sub_screen_name":sub_screen_name,"user_screen_main_id":user_screen_main_id,"user_screen_sub_id":user_screen_sub_id};
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg2').modal('show');
      $('#bd-example-modal-lg2 #model_main_content2').html(data);
    },
    error: function() {
      alert('error handing here');
    }
  });
}
function update_right_options(user_screen_main_id,user_screen_sub_id)
{
  $("#update_submit_btn").attr("class","btn disabled btn-primary btn-progress");
  var user_type_ids=[];
  var user_type_option_ids=[];
  var user_type_options=[];
  for(let i1=0;i1<rights_tableExport_rows.page.info().recordsTotal;i1++){
    var comp=$(rights_tableExport_rows.cell({row:i1, column: 2}).node()).find('.user_type_options').first();
    var comp_id=comp.attr('id').split('_');
    user_type_ids.push(comp_id[1]);
    user_type_option_ids.push(comp_id[2]);
    user_type_options.push(comp.val().toString());
  }
  var sendInfo={"action":"update_rights","user_screen_main_id":user_screen_main_id,"user_screen_sub_id":user_screen_sub_id,"user_type_ids":user_type_ids,"user_type_option_ids":user_type_option_ids,"user_type_options":user_type_options};
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg2 #model_main_content2').html("...");
      $('#bd-example-modal-lg2').modal('hide');
      swal('Updated Successfully', {icon: 'success',});
    },
    error: function() {
      alert('error handing here');
      $("#update_submit_btn").attr("class","btn btn-primary");
    }
  });
}