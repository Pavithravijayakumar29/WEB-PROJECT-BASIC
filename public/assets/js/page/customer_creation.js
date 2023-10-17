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
                        columns: [0, 1, 2,3,4,5 ]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    //text: '<i class="far fa-file-pdf"></i>',
                    exportOptions: {
                        columns: [0, 1, 2,3,4,5 ]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2,3,4,5 ]
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
function insert_update_row(id,customer_no,customer_name,perm_address,pin_gst_no,contact_no,phone_no,email_address,state_id,district_id,area_id,status1)
{
    
  if(id=="")
  {
    if((customer_name)&&(perm_address)&&(contact_no)&&(state_id)&&(district_id)&&(area_id)){
    var sendInfo={"action":"insert","customer_no":customer_no,"customer_name":customer_name,"perm_address":perm_address,"pin_gst_no":pin_gst_no,"contact_no":contact_no,"phone_no":phone_no,"email_address":email_address,"state_id":state_id,"district_id":district_id,"area_id":area_id,"status1":status1};
    $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
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
  else{validate_inputs(customer_name,perm_address,contact_no,state_id,district_id,area_id);}
  }
  else
  {
    if((customer_name)&&(perm_address)&&(contact_no)&&(state_id)&&(district_id)&&(area_id)){
    var sendInfo={"action":"update","id":id,"customer_no":customer_no,"customer_name":customer_name,"perm_address":perm_address,"pin_gst_no":pin_gst_no,"contact_no":contact_no,"phone_no":phone_no,"email_address":email_address,"state_id":state_id,"district_id":district_id,"area_id":area_id,"status1":status1};
    $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
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
  }
  else{validate_inputs(customer_name,perm_address,contact_no,state_id,district_id,area_id);}
  }
}

function validate_inputs(customer_name,perm_address,contact_no,state_id,district_id,area_id)
{
  if(customer_name==='') { $("#customer_name").addClass('is-invalid');$("#customer_name_validate_div").html("Select Customer Name"); return false;} else {$("#customer_name").removeClass('is-invalid');$("#customer_name_validate_div").html("");}

  if(perm_address==='') { $("#perm_address").addClass('is-invalid');$("#perm_address_validate_div").html("Enter Address"); return false;} else {$("#perm_address").removeClass('is-invalid');$("#perm_address_validate_div").html("");}

  if(contact_no==='') { $("#contact_no").addClass('is-invalid');$("#contact_no_validate_div").html("Enter Contact No"); return false;} else {$("#contact_no").removeClass('is-invalid');$("#contact_no_validate_div").html("");}

  var errorMessage = document.getElementById('error_message');
  var errorMessage_1 = document.getElementById('error_message_1');
  var errorMessage_2 = document.getElementById('error_message_2');
      if(state_id==0){
          errorMessage.style.display = 'block';
          return false;
      }else{

          errorMessage.style.display = 'none';
      }
      if(district_id==0){
          errorMessage_1.style.display = 'block';
          return false;
      }else{

          errorMessage_1.style.display = 'none';
      }
      if(area_id==0){
          errorMessage_2.style.display = 'block';
          return false;
      }else{

          errorMessage_2.style.display = 'none';
      }
}

function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Customer Creation',
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

function getDistricts() {
  var stateId = $("#state_id").val();

  // Clear previous district options
  $("#district_id").empty();
  $("#district_id").append('<option value="">Select District</option>');

  if (stateId === '') {
      // No state selected, exit the function
      return;
  }

  var _token = $("#_token").val();
  var sendInfo = { "_token": _token, "action": "getDistricts", "state_id": stateId };

  $.ajax({
      type: "GET",
      url: window.location.origin + "/customer_creation-db_cmd/",
      data: sendInfo,
      dataType: "json",
      success: function(data) {
          $('#district_id').empty();
          $('#district_id').append('<option value="">Select District</option>');
          for(let i1=0;i1 < data.length;i1++){
            $('#district_id').append('<option value="' + data[i1]['id'] + '">' + data[i1]['district_name'] + '</option>');
          }
          /* $.each(data, function(key, value) {
            $('#district_id').append('<option value="' + key + '">' + value + '</option>');
          }); */
      },
      error: function() {
          alert('Error fetching districts');
      }
  });
}

function getArea() {
  var districtId = $("#district_id").val();
  // Clear previous district options
  $("#area_id").empty();
  $("#area_id").append('<option value="">Select Area</option>');

  if (districtId === '') {
      // No state selected, exit the function
      return;
  }

  var _token = $("#_token").val();
  var sendInfo = { "_token": _token, "action": "getArea", "district_id": districtId };

  $.ajax({
      type: "GET",
      url: window.location.origin + "/customer_creation-db_cmd/",
      data: sendInfo,
      dataType: "json",
      success: function(data) {
          $('#area_id').empty();
          $('#area_id').append('<option value="">Select Area</option>');
          for(let i1=0;i1 < data.length;i1++){

            $('#area_id').append('<option value="' + data[i1]['id'] + '">' + data[i1]['area_name'] + '</option>');
          }
          /* $.each(data, function(key, value) {
            $('#district_id').append('<option value="' + key + '">' + value + '</option>');
          }); */
      },
      error: function() {
          alert('Error fetching Area');
      }
  });
}
