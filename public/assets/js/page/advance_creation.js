function list_div()
{
  $('#list_div').html("");
  var sendInfo={"action":"retrieve","user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
  $.ajax({
    type: "GET",
    url:$("#CUR_ACTION").val(),
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
                        columns: [0, 1, 2,3,4]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    //text: '<i class="far fa-file-pdf"></i>',
                    exportOptions: {
                        columns: [0, 1, 2,3,4]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2,3,4]
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
function insert_update_row(id,date,adv_no,staff_id,amount,payment,description)
{
  if(id=="")
  {
    var sendInfo={"action":"insert","date":date,"adv_no":adv_no,"staff_id":staff_id,"amount":amount,"payment":payment,"description":description};
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
  else
  {

    var sendInfo={"action":"update","id":id,"date":date,"adv_no":adv_no,"staff_id":staff_id,"amount":amount,"payment":payment,"description":description};
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
}
function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete User Type',
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
function restrictInput(event) {
    var input = event.target.value;
    var numericInput = input.replace(/[^0-9]/g, ''); // Remove non-numeric characters
    event.target.value = numericInput;
  }
  function validateForm() {

  var staff_id = $('#staff_id').val();
  var amount = document.getElementById('amount');
  var payment = document.getElementById('payment');
  var errorMessage_1 = document.getElementById('error_message_1');
  var errorMessage_2 = document.getElementById('error_message_2');
  var errorMessage_3 = document.getElementById('error_message_3');

  if(staff_id==0){
      errorMessage_1.style.display = 'block';
      return false;
  }else{

      errorMessage_1.style.display = 'none';
  }

  if (amount.value.trim() === '') {
  //    subExpenseType.style.borderColor = 'red';
    errorMessage_2.style.display = 'block';
    return false;
  } else {
      amount.style.borderColor = '';

    errorMessage_2.style.display = 'none';
  }
  if (payment.value.trim() === '') {
  //    subExpenseType.style.borderColor = 'red';
    errorMessage_3.style.display = 'block';
    return false;
  } else {
      payment.style.borderColor = '';

    errorMessage_3.style.display = 'none';
  }

  return true;
}
function changeColor() {
  var subExpenseType = document.getElementById('sub_expense_type');
  var errorMessage = document.getElementById('error_message');

  if (subExpenseType.value.trim() !== '') {
    subExpenseType.style.borderColor = 'green';
    subExpenseType.classList.remove('blink');
    errorMessage.style.display = 'none';
  }
}
// function filter(from_date,to_date,emp_id){
//     var sendInfo={
//         "action":"filtering",
//         "from_date":from_date,
//         "to_date":to_date,
//         "emp_id":emp_id,

//     };
//     $.ajax({
//       type: "GET",
//       url: $("#CUR_ACTION").val(),
//       data: sendInfo,
//       success: function(data){
//         $('#list_div').html(data);
//       },
//       error: function() {
//         alert('error handing here');
//       }
//     });
// }
