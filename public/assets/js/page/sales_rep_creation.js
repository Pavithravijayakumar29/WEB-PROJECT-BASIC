function list_div()
{
    var _token=$("#_token2").val();
    $('#list_div').html("");
    var sendInfo={"_token":_token,"action":"retrieve","user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
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
    }
  });
}
$(function () {
  list_div();
});
function open_model(title,id)
{
//alert("hi");
var _token=$("#_token2").val();
$('#bd-example-modal-lg1 #model_main_content').html("...");
var sendInfo={};
if(id==""){sendInfo={"_token":_token,"action":"create_form"};}
else{sendInfo={"_token":_token,"action":"update_form","id":id};}
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

function insert_update_row(id,manager_id, sales_ref_name, mobile_no, phone_no, pin_gst_no, aadhar_no, driving_licence, address, state_id, district_id1) {

    if(id==''){
        if((sales_ref_name)&&(manager_id)&&(mobile_no)){
    var _token=$("#_token2").val();
    var formData = new FormData();
    formData.append("_token", _token);
    formData.append("action", "insert");
    formData.append("sales_ref_name", sales_ref_name);
    formData.append("manager_id", manager_id);
    formData.append("mobile_no", mobile_no);
    formData.append("phone_no", phone_no);
    formData.append("pin_gst_no", pin_gst_no);
    formData.append("aadhar_no", aadhar_no);
    formData.append("driving_licence", driving_licence);
    formData.append("address", address);
    formData.append("state_id", state_id);
    formData.append("district_id1", district_id1);
  
    formData.append("image_name", $("#image_name")[0].files[0]);
    $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {

            $('#bd-example-modal-lg1').modal('hide');
            swal('Inserted Successfully', { icon: 'success', });
            list_div();
        },
        error: function () {
            alert('error handling here');
        }
    });
}
 else{validate_inputs(manager_id,sales_ref_name,mobile_no);}
    }
else{
    if((sales_ref_name)&&(manager_id)&&(mobile_no)){
        var _token = $("#_token2").val();
    var formData = new FormData();
    formData.append("_token", _token);
    formData.append("action", "update");
    formData.append("id",id);
    formData.append("manager_id", manager_id);
    formData.append("sales_ref_name", sales_ref_name);
    formData.append("mobile_no", mobile_no);
    formData.append("phone_no", phone_no);
    formData.append("pin_gst_no", pin_gst_no);
    formData.append("aadhar_no", aadhar_no);
    formData.append("driving_licence", driving_licence);
    formData.append("address", address);
    formData.append("state_id", state_id);
    formData.append("district_id1", district_id1);
    
    formData.append("image_name", $("#image_name")[0].files[0]);

        $.ajax({
            type: "POST",
            url: $("#CUR_ACTION").val(),
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                // alert(sales_ref_name);
                $('#bd-example-modal-lg1').modal('hide');
                swal('Update Successfully', { icon: 'success', });
                list_div();
            },
            error: function () {
                alert('error handling here');
            }
        });
    }

 else{validate_inputs(manager_id,sales_ref_name,mobile_no);}
    }
}

function validate_inputs(manager_id,sales_ref_name,mobile_no)
{

  if(manager_id==='') { $("#manager_id").addClass('is-invalid');$("#manager_id_validate_div").html("Select Manager Name"); return false;} else {$("#manager_id").removeClass('is-invalid');$("#manager_id_validate_div").html("");}


  if(sales_ref_name==='') { $("#sales_ref_name").addClass('is-invalid');$("#sales_ref_name_validate_div").html("Select Sales Ref Name"); return false;} else {$("#sales_ref_name").removeClass('is-invalid');$("#sales_ref_name_validate_div").html("");}

  var mobilePattern = /^\d{10}$/;
  if (mobile_no.trim() === "" || !mobilePattern.test(mobile_no)) {
      $("#mobile_no").addClass('is-invalid');
      $("#mobile_no_validate_div").html("Please enter a valid 10-digit Mobile Number.");
      return false;
  } else {
      $("#mobile_no").removeClass('is-invalid');
      $("#mobile_no_validate_div").html("");
  }

//   if(address==='') { $("#address").addClass('is-invalid');$("#address_validate_div").html("Enter Address"); return false;} else {$("#address").removeClass('is-invalid');$("#address_validate_div").html("");}

//   if(state_id==='') { $("#state_id").addClass('is-invalid');$("#state_id_validate_div").html("Enter state name"); return false;} else {$("#state_id").removeClass('is-invalid');$("#state_id_validate_div").html("");}

//   if(district_id1==='') { $("#district_id1").addClass('is-invalid');$("#district_id1_validate_div").html("Enter district"); return false;} else {$("#district_id1").removeClass('is-invalid');$("#district_id1_validate_div").html("");}



}

function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete sales rep creation',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      var _token=$("#_token2").val();
      var sendInfo={"_token":_token,"action":"delete","id":id};
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


function getDistricts() {
    var stateId = $("#state_id").val();

    // Clear previous district options
    $("#district_id").empty();
    $("#district_id").append('<option value="">Select District</option>');

    if (stateId === '') {
        // No state selected, exit the function
        return;
    }
    var _token = $("#_token2").val();

    var sendInfo = {"_token": _token,"action": "getDistricts", "state_id": stateId };

    $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
            $('#district_id').empty();
            $('#district_id').append('<option value="">Select District</option>');
            for(let i1=0;i1 < data.length;i1++){
              $('#district_id').append('<option value="' + data[i1]['id'] + '">' + data[i1]['district_name'] + '</option>');
            }

        },
        error: function() {
            alert('Error fetching districts');
        }
    });
  }




