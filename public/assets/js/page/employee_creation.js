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
function insert_update_row(id,employee_no,employee_name,address,contact_no,phone_no,email_address,aadhar_no,designation_id,staff_head_id,dealer_id,salary,incentive,status1)
{

 var gender = $("input[name='gender']:checked").val();
    
  if(id=="")
  {
    if((employee_name)&&(address)&&(contact_no)&&(aadhar_no)&&(designation_id)&&(staff_head_id)&&(dealer_id)&&(salary)){
        var formData = new FormData();
        formData.append("_token", _token);
        formData.append("action", "insert");
        formData.append("employee_no", employee_no);
        formData.append("employee_name", employee_name);
        formData.append("gender", gender);
        formData.append("address", address);
        formData.append("contact_no", contact_no);
        formData.append("phone_no", phone_no);
        formData.append("email_address", email_address);
        formData.append("aadhar_no", aadhar_no);
        formData.append("designation_id", designation_id);
        formData.append("staff_head_id", staff_head_id);
        formData.append("dealer_id", dealer_id);
        formData.append("salary", salary);
        formData.append("incentive", incentive);
        formData.append("status1", status1);
        formData.append("image_name", $("#image_name")[0].files[0]);

    $.ajax({
      type: "GET",
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
  else{validate_inputs(employee_name,address,contact_no,aadhar_no,designation_id,staff_head_id,dealer_id,salary);}
  }
  else
  {
    if((employee_name)&&(address)&&(contact_no)&&(aadhar_no)&&(designation_id)&&(staff_head_id)&&(dealer_id)&&(salary)){
        var formData = new FormData();

        formData.append("_token", _token);
        formData.append("action", "update");
        formData.append("id", id);
        formData.append("employee_no", employee_no);
        formData.append("employee_name", employee_name);
        formData.append("gender", gender);
        formData.append("address", address);
        formData.append("contact_no", contact_no);
        formData.append("phone_no", phone_no);
        formData.append("email_address", email_address);
        formData.append("aadhar_no", aadhar_no);
        formData.append("designation_id", designation_id);
        formData.append("staff_head_id", staff_head_id);
        formData.append("dealer_id", dealer_id);
        formData.append("salary", salary);
        formData.append("incentive", incentive);
        formData.append("status1", status1);
        formData.append("image_name", $("#image_name")[0].files[0]);
    $.ajax({
      type: "GET",
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
  else{validate_inputs(employee_name,address,contact_no,aadhar_no,designation_id,staff_head_id,dealer_id,salary);}
  }
}

function validate_inputs(employee_name,address,contact_no,aadhar_no,designation_id,staff_head_id,dealer_id,salary)
{
  if(employee_name==='') { $("#employee_name").addClass('is-invalid');$("#employee_name_validate_div").html("Select Employee Name"); return false;} else {$("#employee_name").removeClass('is-invalid');$("#employee_name_validate_div").html("");}

  if(address==='') { $("#address").addClass('is-invalid');$("#address_validate_div").html("Enter Address"); return false;} else {$("#address").removeClass('is-invalid');$("#address_validate_div").html("");}

  if(contact_no==='') { $("#contact_no").addClass('is-invalid');$("#contact_no_validate_div").html("Enter Contact No"); return false;} else {$("#contact_no").removeClass('is-invalid');$("#contact_no_validate_div").html("");}

  if(aadhar_no==='') { $("#aadhar_no").addClass('is-invalid');$("#aadhar_no_validate_div").html("Enter Aadhar No"); return false;} else {$("#aadhar_no").removeClass('is-invalid');$("#aadhar_no_validate_div").html("");}

  if(designation_id==='') { $("#designation_id").addClass('is-invalid');$("#designation_id_validate_div").html("Enter Designation Name"); return false;} else {$("#designation_id").removeClass('is-invalid');$("#designation_id_validate_div").html("");}

  if(staff_head_id==='') { $("#staff_head_id").addClass('is-invalid');$("#staff_head_id_validate_div").html("Enter Staff Head Name"); return false;} else {$("#staff_head_id").removeClass('is-invalid');$("#staff_head_id_validate_div").html("");}

  if(dealer_id==='') { $("#dealer_id").addClass('is-invalid');$("#dealer_id_validate_div").html("Enter Dealer Name"); return false;} else {$("#dealer_id").removeClass('is-invalid');$("#dealer_id_validate_div").html("");}

  if(salary==='') { $("#salary").addClass('is-invalid');$("#salary_validate_div").html("Enter Salary Amount"); return false;} else {$("#salary").removeClass('is-invalid');$("#salary_validate_div").html("");}

}

function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Employee Creation',
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
