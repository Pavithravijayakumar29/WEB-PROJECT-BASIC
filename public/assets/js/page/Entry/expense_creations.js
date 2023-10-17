function list_div(from_date_1,to_date_1,expense_no_1,sales_rep_creation_id_1,market_manager_id_1,status_1,mode_of_payment_1)
{
  $('#list_div').html("");
  var sendInfo={"action":"retrieve","from_date_1":from_date_1,"to_date_1":to_date_1,"expense_no_1":expense_no_1,"sales_rep_creation_id_1":sales_rep_creation_id_1,"market_manager_id_1":market_manager_id_1,"status_1":status_1,"mode_of_payment_1":mode_of_payment_1,"user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
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
  list_div('','','','','','');
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
function load_model_sublist(main_id,sub_id)
{

  $('#bd-example-modal-lg1 #sublist_div').html("...");
  var sendInfo={"action":"form_sublist","main_id":main_id,"sub_id":sub_id,"user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1 #sublist_div').html(data);
    }
  });
}
function insert_update_row(id,expense_date,sales_rep_creation_id,market_manager_id,expense_no,status,description,mode_of_payment)
{
  if((expense_date) && (expense_no) && (mode_of_payment) && (status))
  {
    if(id=="")
    {
      var sendInfo={"action":"insert","expense_date":expense_date,"sales_rep_creation_id":sales_rep_creation_id,"market_manager_id":market_manager_id,"expense_no":expense_no,"status":status,"description":description,"mode_of_payment":mode_of_payment};
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
      var sendInfo={"action":"update","id":id,"expense_date":expense_date,"sales_rep_creation_id":sales_rep_creation_id,"market_manager_id":market_manager_id,"expense_no":expense_no,"status":status,"description":description,"mode_of_payment":mode_of_payment};
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
  else{validate_inputs(expense_date,expense_no,status);}
}
function validate_inputs(expense_date,expense_no,status)
{

  if(expense_date==='') { $("#expense_date").addClass('is-invalid');$("#expense_date_validate_div").html("Select Expense Date"); return false;} else {$("#expense_date").removeClass('is-invalid');$("#expense_date_validate_div").html("");}

  if(expense_no==='') { $("#expense_no").addClass('is-invalid');$("#expense_no_validate_div").html("Select Expense No"); return false;} else {$("#expense_no").removeClass('is-invalid');$("#expense_no_validate_div").html("");}

  if(status==='') { $("#status1").addClass('is-invalid');$("#status1_validate_div").html("Select Status"); return false;} else {$("#status1").removeClass('is-invalid');$("#status1_validate_div").html("");}
}
function insert_update_sub_row(main_id,id,expense_id,sub_expense_id,total_amount)
{
  let dealer_sub_id = $("#dealer_sub_id").val();
  let visitor_sub_id = $("#visitor_sub_id").val();
  let market_sub_id = $("#market_sub_id").val();

  if((expense_id) && (total_amount))
  {
    if((id=="")&&(main_id==""))
    {
      var expense_date=$("#expense_date").val(),sales_rep_creation_id=$("#sales_rep_creation_id").val(),market_manager_id=$("#market_manager_id").val(),expense_no=$("#expense_no").val(),status=$("#status1").val(),description=$("#description").val();
      if((expense_date) &&  (expense_no) && (status))
      {
        var sendInfo={"action":"insert_sub","main_id":main_id,"expense_date":expense_date,"sales_rep_creation_id":sales_rep_creation_id,"market_manager_id":market_manager_id,"expense_no":expense_no,"status":status,"description":description,"expense_id":expense_id,"sub_expense_id":sub_expense_id,"dealer_sub_id":dealer_sub_id,"visitor_sub_id":visitor_sub_id,"market_sub_id":market_sub_id,total_amount};
        $.ajax({
          type: "GET",
          url: $("#CUR_ACTION").val(),
          data: sendInfo,
          success: function(data){
           list_div();

            $('#bd-example-modal-lg1 #model_main_content').html("...");
            var sendInfo1={"action":"update_form","id":data};
            $.ajax({
              type: "GET",
              url: $("#CUR_ACTION").val(),
              data: sendInfo1,
              success: function(data){
                $('#bd-example-modal-lg1 #model_main_content').html(data);
              }
            });
          },
          error: function() {
            alert('error handing here');
          }
        });
      }
      else{validate_inputs(expense_date,expense_no,status);}
    }
    else
    {
      var sendInfo=[];
      if(id=="")
      {
        sendInfo={"action":"insert_sub","main_id":main_id,"expense_id":expense_id,"sub_expense_id":sub_expense_id,"dealer_sub_id":dealer_sub_id,"visitor_sub_id":visitor_sub_id,"market_sub_id":market_sub_id,"total_amount":total_amount};
    }
      else
      {sendInfo={"action":"update_sub","id":id,"expense_date":expense_date,"sales_rep_creation_id":sales_rep_creation_id,"market_manager_id":market_manager_id,"expense_no":expense_no,"status":status,"description":description,"expense_id":expense_id,"sub_expense_id":sub_expense_id,"dealer_sub_id":dealer_sub_id,"visitor_sub_id":visitor_sub_id,"market_sub_id":market_sub_id,total_amount};}
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data){
          list_div();
          load_model_sublist(main_id,'');
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
  }
  validate_sub_inputs(total_amount,expense_id);
}
function validate_sub_inputs(total_amount,expense_id)
{
  if(expense_id==='') { $("#expense_id").addClass('is-invalid');$("#expense_id_validate_div").html("Select Expense"); return false;} else {$("#expense_id").removeClass('is-invalid');$("#expense_id_validate_div").html("");}
  if(total_amount==='') { $("#total_amount").addClass('is-invalid');$("#total_amount_validate_div").html("Total Amount Empty"); return false;} else {$("#total_amount").removeClass('is-invalid');$("#total_amount_validate_div").html("");}
}
function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Expense Entry',
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
function delete_sublist_row(main_id,id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Product',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      var sendInfo={"action":"delete_sub","id":id};
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data){
          list_div();
          load_model_sublist(main_id,'');
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
  });
}
function getstaff() {
  var entry_date = $("#expense_date").val();
  var sendInfo = {
      action: "getstaff",
      entry_date: entry_date,
  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {
        $("#sales_rep_creation_id").empty();
          $('#sales_rep_creation_id').append('<option value="">Select Sales Rep Name</option>');
          for(let i1=0;i1 < data.length;i1++){
            $('#sales_rep_creation_id').append('<option value="' + data[i1]['id'] + '">'+ data[i1]['sales_ref_name']  + '</option>');
          }
      },
      error: function() {
          alert('Error fetching Shop Name');
      }
  });
}
function get_dealer() {
  $("#visitor_sub_id").empty();
  var sales_rep_creation_id = $("#sales_rep_creation_id").val();
  var expense_date = $("#expense_date").val();

  var sendInfo = {
      action: "get_dealer",
      "sales_rep_creation_id": sales_rep_creation_id,
      "expense_date": expense_date,
  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {
        $("#dealer_sub_id").empty();
          $('#dealer_sub_id').append('<option value="">Select Dealer Name</option>');
          for(let i1=0;i1 < data.length;i1++){
            $('#dealer_sub_id').append('<option value="' + data[i1]['id'] + '">'+ data[i1]['dealer_name']  + '</option>');
          }
      },
      error: function() {
          alert('Error fetching Shop Name');
      }
  });
}

function get_visitor() {
  var sales_rep_creation_id = $("#sales_rep_creation_id").val();
  var expense_date = $("#expense_date").val();

  var sendInfo = {
      action: "get_visitor",
      "sales_rep_creation_id": sales_rep_creation_id,
      "expense_date": expense_date,
  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {

        $("#visitor_sub_id").empty();

          $('#visitor_sub_id').append('<option value="">Select Visitor Name</option>');

          for(let i1=0;i1 < data.length;i1++){
            $('#visitor_sub_id').append('<option value="' + data[i1]['id'] + '">'+ data[i1]['visitor_name']  + '</option>');

          }

      },
      error: function() {
          alert('Error fetching Visitor Name');
      }
  });
}

function get_market() {
  var entry_date = $("#expense_date").val();
  var sales_rep_creation_id = $("#sales_rep_creation_id").val();
  var dealer_sub_id = $("#dealer_sub_id").val();
  var sendInfo = {
      action: "get_market",
      dealer_sub_id: dealer_sub_id,
      sales_rep_creation_id: sales_rep_creation_id,
      entry_date: entry_date,
  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {
        $("#market_sub_id").empty();
        $("#sub_expense_id").empty();
        $('#market_sub_id').append('<option value="">Select Sales Market Name</option>');

          for(let i1=0;i1 < data.length;i1++){
            $('#market_sub_id').append('<option value="' + data[i1]['id'] + '">'+ data[i1]['area_name']  + '</option>');

          }
      },
      error: function() {
          alert('Error fetching Shop Name');
      }
  });
}

function get_sub_expense() {
  var expense_id = $("#expense_id").val();
  var sendInfo = {
      action: "get_sub_expense",
      expense_id: expense_id,
  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {
        $("#sub_expense_id").empty();
        $('#sub_expense_id').append('<option value="">Select Sub Expense</option>');

          for(let i1=0;i1 < data.length;i1++){
            $('#sub_expense_id').append('<option value="' + data[i1]['id'] + '">'+ data[i1]['sub_expense_type']  + '</option>');

          }
      },
      error: function() {
          alert('Error fetching Shop Name');
      }
  });
}

function disbled_columns() {
  var market_manager_id = $("#market_manager_id").val();
  var sales_rep_creation_id = $('#sales_rep_creation_id');
  var dealer_sub_id = $('#dealer_sub_id');
  var market_sub_id = $('#market_sub_id');
  if ((market_manager_id != "") || (sales_rep_creation_id == "")) {
    sales_rep_creation_id.prop('disabled', true);
    dealer_sub_id.prop('disabled', true);
    market_sub_id.prop('disabled', true);
  }
  else
  {
    sales_rep_creation_id.prop('disabled', false);
    dealer_sub_id.prop('disabled', false);
    market_sub_id.prop('disabled', false);
  }
}

function disbled_column() {
  var sales_rep_creation_id = $("#sales_rep_creation_id").val();
  var market_manager_id = $('#market_manager_id');

  if (sales_rep_creation_id != "") {
    market_manager_id.prop('disabled', true);

  } else {
    market_manager_id.prop('disabled', false);
  }
}
function disbled_columns_upd() {
  var market_manager_id = $("#market_manager_id").val();
  var sales_rep_creation_id = $('#sales_rep_creation_id');
  var dealer_sub_id = $('#dealer_sub_id');
  var market_sub_id = $('#market_sub_id');
  if ((market_manager_id != "") || (sales_rep_creation_id == "")) {
    sales_rep_creation_id.prop('disabled', true);
    dealer_sub_id.prop('disabled', true);
    market_sub_id.prop('disabled', true);
  } else {
    dealer_sub_id.prop('disabled', false);
    market_sub_id.prop('disabled', false);
  }
}
