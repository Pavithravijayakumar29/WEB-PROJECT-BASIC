function list_div()
{
  $('#list_div').html("");
  var sendInfo={"action":"retrieve"};
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#list_div').html(data);
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
function open_print(title,id,category_type)
{
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
  sendInfo={"action":"view_sublist_form","id":id,"category_type":category_type};
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

function load_model_sublist(main_id,sub_id)
{
  $('#bd-example-modal-lg1 #sublist_div').html("...");
  var sendInfo={"action":"sublist_form","main_id":main_id,"sub_id":sub_id,"user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1 #sublist_div').html(data);
    }
  });
}
function category_type_id(category_type)
{
  $('#bd-example-modal-lg1 #sublist_div').html("...");
  var sendInfo={"action":"sublist_form","category_type":category_type};
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1 #sublist_div').html(data);
    }
  });
}

function category_type_id1(id,category_type)
{
  $('#bd-example-modal-lg1 #sublist_div').html("...");
  var sendInfo={"action":"update_sublist_form","id":id,"category_type":category_type};
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1 #sublist_div').html(data);
    }
  });
}
function insert_update_row(id, entry_date, shift_type,category_type,description,attendance_status) {
    var checkbox = document.getElementById('checkbox').checked ? 1 : 0;
    var shift_type1_1 = [];
    var shift_type1 = document.getElementsByClassName('shift_type1');
    for (let i1 = 0; i1 < shift_type1.length; i1++) {
        shift_type1_1.push(shift_type1[i1].value);
    }
    var employee_name_1 = [];
    var employee_name = document.getElementsByClassName('employee_name');
    for (let i1 = 0; i1 < employee_name.length; i1++) {
        employee_name_1.push(employee_name[i1].value);
    }
    var attendance_status_1 = [];
    var attendance_status = document.getElementsByClassName('attendance_status');
    for (let i1 = 0; i1 < attendance_status.length; i1++) {
        attendance_status_1.push(attendance_status[i1].value);
    }
    var _token = $("#_token").val();
    if (id == "") {
        if (entry_date && shift_type) {
            var sendInfo = {
                "_token": _token,
                "action": "insert",
                "entry_date": entry_date,
                "shift_type": shift_type,
                "category_type":category_type,
                "description":description,
                "shift_type1": shift_type1_1.toString(),
                "checkbox": checkbox,
                "manager_name": employee_name_1.toString(),
                "attendance_status": attendance_status_1.toString()
            };
            $.ajax({
                type: "GET",
                url: window.location.origin + "/attendance_entry-db_cmd/",
                data: sendInfo,
                success: function(data){
                    $('#bd-example-modal-lg1').modal('hide');
                    swal('Updated Successfully', {icon: 'success',});
                    list_div();
                  },
                  error: function() {
                    alert('error handing here');
                  }
                });

        } else {
            validate_inputs(entry_date, shift_type);
        }
    } else {
        if (entry_date && shift_type) {
          var sendInfo = {
                "_token": _token,
                "action": "update",
                "id":id,
                "entry_date": entry_date,
                "shift_type": shift_type,
                "category_type":category_type,
                "description":description,
                "shift_type1": shift_type1_1.toString(),
                "checkbox": checkbox,
                "manager_name": employee_name_1.toString(),
                "attendance_status": attendance_status_1.toString()
            };
            $.ajax({
                type: "GET",
                url: window.location.origin + "/attendance_entry-db_cmd/",
                data: sendInfo,
                success: function (data) {
                    console.log(sendInfo);
                    $('#bd-example-modal-lg1').modal('hide');
                    swal('Updated Successfully', { icon: 'success' });
                    list_div();
                },
                error: function () {
                    alert('error handling here');
                }
            });
        } else {
            validate_inputs(entry_date, shift_type);
        }
    }
}
function validate_inputs(entry_date,shift_type)
{
  if(entry_date==='') { $("#entry_date").addClass('is-invalid');$("#entry_date_validate_div").html("Enter User Type"); return false;} else {$("#entry_date").removeClass('is-invalid');$("#entry_date_validate_div").html("");}
  if(shift_type==='') { $("#shift_type1").addClass('is-invalid');$("#shift_type1_validate_div").html("Select shift_type"); return false;} else {$("#shift_type1").removeClass('is-invalid');$("#shift_type1_validate_div").html("");}
}

function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Attendance Entry',
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
