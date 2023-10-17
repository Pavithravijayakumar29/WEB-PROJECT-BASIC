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
                        columns: [0, 1, 2,3,4,5]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    //text: '<i class="far fa-file-pdf"></i>',
                    exportOptions: {
                        columns: [0, 1, 2,3,4,5]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2,3,4,5]
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
function insert_update_row(id,company_name,address,mobile_no,phone_no,gst_no,tin_no,email_id,status1)
{
  
  if(id=="")
  {
    if((company_name)&&(address)&&(mobile_no)){
      var sendInfo={"action":"insert","company_name":company_name,"address":address,"mobile_no":mobile_no,"phone_no":phone_no,"gst_no":gst_no,"tin_no":tin_no,"email_id":email_id,"status1":status1};
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
    else{validate_inputs(company_name,address,mobile_no);}
  }
  else
  {
    if((company_name)&&(address)&&(mobile_no)){
      var sendInfo={"action":"update","id":id,"company_name":company_name,"address":address,"mobile_no":mobile_no,"phone_no":phone_no,"gst_no":gst_no,"tin_no":tin_no,"email_id":email_id,"status1":status1};
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
    else{validate_inputs(company_name,address,mobile_no);}
  }
}

function validate_inputs(company_name,address,mobile_no)
{
  if(company_name==='') { $("#company_name").addClass('is-invalid');$("#company_name_validate_div").html("Select Company Name"); return false;} else {$("#company_name").removeClass('is-invalid');$("#company_name_validate_div").html("");}

  if(address==='') { $("#address").addClass('is-invalid');$("#address_validate_div").html("Enter Address"); return false;} else {$("#address").removeClass('is-invalid');$("#address_validate_div").html("");}

  if(mobile_no==='') { $("#mobile_no").addClass('is-invalid');$("#mobile_no_validate_div").html("Enter Mobile No"); return false;} else {$("#mobile_no").removeClass('is-invalid');$("#mobile_no_validate_div").html("");}

//   if(gst_no==='') { $("#gst_no").addClass('is-invalid');$("#gst_no_validate_div").html("Enter GST No"); return false;} else {$("#gst_no").removeClass('is-invalid');$("#gst_no_validate_div").html("");}
}

function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Company Creation',
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
