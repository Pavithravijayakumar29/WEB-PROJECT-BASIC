function list_div(from_date_1,to_date_1,delivery_no_1,dealer_creation_id_1,status_1)
{
  $('#list_div').html("");
  var sendInfo={"action":"retrieve","from_date_1":from_date_1,"to_date_1":to_date_1,"delivery_no_1":delivery_no_1,"dealer_creation_id_1":dealer_creation_id_1,"status_1":status_1,"user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
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

function insert_update_row(id,dispatch_date,delivery_no,order_recipt_no,sales_exec,dealer_creation_id,status1,driver_name,driver_number,vehile_name,tally_no,description) {

  var checkbox = document.getElementById('checkbox').checked ? 1 : 0;

  var order_recipt_sub_id_1 = [];
  var order_recipt_sub_id = document.getElementsByClassName('order_recipt_sub_id');
  for (let i1 = 0; i1 < order_recipt_sub_id.length; i1++) {
    order_recipt_sub_id_1.push(order_recipt_sub_id[i1].value);
  }

  var order_date_sub_1 = [];
  var order_date_sub = document.getElementsByClassName('order_date_sub');
  for (let i1 = 0; i1 < order_date_sub.length; i1++) {
    order_date_sub_1.push(order_date_sub[i1].value);
  }

  var item_creation_id_1 = [];
  var item_creation_id = document.getElementsByClassName('item_creation_id');
  for (let i1 = 0; i1 < item_creation_id.length; i1++) {
    item_creation_id_1.push(item_creation_id[i1].value);
  }

  var item_property_1 = [];
  var item_property = document.getElementsByClassName('item_property');
  for (let i1 = 0; i1 < item_property.length; i1++) {
    item_property_1.push(item_property[i1].value);
  }

  var item_weights_1 = [];
  var item_weights = document.getElementsByClassName('item_weights');
  for (let i1 = 0; i1 < item_weights.length; i1++) {
    item_weights_1.push(item_weights[i1].value);
  }

  var order_quantity_1 = [];
  var order_quantity = document.getElementsByClassName('order_quantity');
  for (let i1 = 0; i1 < order_quantity.length; i1++) {
    order_quantity_1.push(order_quantity[i1].value);
  }

  var balance_quantity_1 = [];
  var balance_quantity = document.getElementsByClassName('balance_quantity');
  for (let i1 = 0; i1 < balance_quantity.length; i1++) {
    balance_quantity_1.push(balance_quantity[i1].value);
  }

  var return_quantity_1 = [];
  var return_quantity = document.getElementsByClassName('return_quantity');
  for (let i1 = 0; i1 < return_quantity.length; i1++) {
    return_quantity_1.push(return_quantity[i1].value);
  }

  var item_price_1 = [];
  var item_price = document.getElementsByClassName('item_price');
  for (let i1 = 0; i1 < item_price.length; i1++) {
    item_price_1.push(item_price[i1].value);
  }

  var total_amount_1 = [];
  var total_amount = document.getElementsByClassName('total_amount');
  for (let i1 = 0; i1 < total_amount.length; i1++) {
    total_amount_1.push(total_amount[i1].value);
  }

  var dispatch_status_1 = [];
  var dispatch_status = document.getElementsByClassName('dispatch_status');
  for (let i1 = 0; i1 < dispatch_status.length; i1++) {
    dispatch_status_1.push(dispatch_status[i1].value);
  }

  if (id == "") {
      if (dealer_creation_id && sales_exec) {
          var sendInfo = {
              "action": "insert",
              "dispatch_date": dispatch_date,
              "delivery_no": delivery_no,
              "order_recipt_no":order_recipt_no,
              "sales_exec":sales_exec,
              "dealer_creation_id":dealer_creation_id,
              "status1":status1,
              "driver_name":driver_name,
              "driver_number":driver_number,
              "vehile_name":vehile_name,
              "tally_no":tally_no,
              "description":description,
              "checkbox": checkbox,
              "order_recipt_sub_id": order_recipt_sub_id_1.toString(),
              "order_date_sub": order_date_sub_1.toString(),
              "item_creation_id": item_creation_id_1.toString(),
              "item_property": item_property_1.toString(),
              "item_weights": item_weights_1.toString(),
              "order_quantity": order_quantity_1.toString(),
              "balance_quantity": balance_quantity_1.toString(),
              "return_quantity": return_quantity_1.toString(),
              "item_price": item_price_1.toString(),
              "total_amount": total_amount_1.toString(),
              "dispatch_status": dispatch_status_1.toString(),
          };
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

      } else {
        validate_inputs(dealer_creation_id,sales_exec);
      }
   } else {
      if (dealer_creation_id && sales_exec) {
        var sendInfo = {
              "action": "update",
              "id":id,
              "dispatch_date": dispatch_date,
              "delivery_no": delivery_no,
              "order_recipt_no":order_recipt_no,
              "sales_exec":sales_exec,
              "dealer_creation_id":dealer_creation_id,
              "status1":status1,
              "driver_name":driver_name,
              "driver_number":driver_number,
              "vehile_name":vehile_name,
              "tally_no":tally_no,
              "description":description,
              "checkbox": checkbox,
              "order_recipt_sub_id": order_recipt_sub_id_1.toString(),
              "order_date_sub": order_date_sub_1.toString(),
              "item_creation_id": item_creation_id_1.toString(),
              "item_property": item_property_1.toString(),
              "item_weights": item_weights_1.toString(),
              "order_quantity": order_quantity_1.toString(),
              "balance_quantity": balance_quantity_1.toString(),
              "return_quantity": return_quantity_1.toString(),
              "item_price": item_price_1.toString(),
              "total_amount": total_amount_1.toString(),
              "dispatch_status": dispatch_status_1.toString(),
          };
          $.ajax({
              type: "GET",
              url: $("#CUR_ACTION").val(),
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
        validate_inputs(dealer_creation_id,sales_exec);
      }
  }
}


// function insert_update_row(id,order_date,sales_exec,dealer_creation_id,delivery_no,status,description,vechile_name,driver_name)
// {

//   if((sales_exec) && (dealer_creation_id) && (shop_creation_id))
//   {
//     if(id=="")
//     {
//       var state_id=$("#state_id").val();
//       var district_id=$("#district_id").val();
//       var sendInfo={"action":"insert","order_date":order_date,"sales_exec":sales_exec,"dealer_creation_id":dealer_creation_id,"delivery_no":delivery_no,"status":status,"state_id":state_id,"district_id":district_id,"description":description,"vechile_name":vechile_name,"driver_name":driver_name};
//       $.ajax({
//         type: "GET",
//         url: $("#CUR_ACTION").val(),
//         data: sendInfo,
//         success: function(data){
//           $('#bd-example-modal-lg1').modal('hide');
//           swal('Inserted Successfully', {icon: 'success',});
//           list_div();
//         },
//         error: function() {
//           alert('error handing here');
//         }
//       });
//     }
//     else
//     {
//       var state_id=$("#state_id").val();
//       var district_id=$("#district_id").val();
//       var sendInfo={"action":"update","id":id,"order_date":order_date,"sales_exec":sales_exec,"dealer_creation_id":dealer_creation_id,"delivery_no":delivery_no,"status":status,"state_id":state_id,"district_id":district_id,"description":description,"vechile_name":vechile_name,"driver_name":driver_name};
//       $.ajax({
//         type: "GET",
//         url: $("#CUR_ACTION").val(),
//         data: sendInfo,
//         success: function(data){
//           $('#bd-example-modal-lg1').modal('hide');
//           swal('Updated Successfully', {icon: 'success',});
//           list_div();
//         },
//         error: function() {
//           alert('error handing here');
//         }
//       });
//     }
//   }
//   else{validate_inputs(dealer_creation_id,sales_exec);}
// }
function validate_inputs(dealer_creation_id,sales_exec)
{
  if(dealer_creation_id==='') { $("#dealer_creation_id").addClass('is-invalid');$("#dealer_creation_id_validate_div").html("Select Dealer name"); return false;} else {$("#dealer_creation_id").removeClass('is-invalid');$("#dealer_creation_id_validate_div").html("");}

  if(sales_exec==='') { $("#sales_exec").addClass('is-invalid');$("#sales_exec_validate_div").html("Select Area name"); return false;} else {$("#sales_exec").removeClass('is-invalid');$("#sales_exec_validate_div").html("");}
}
function insert_update_sub_row(main_id,id,order_date_sub,time_sub,market_creation_id,shop_creation_id,item_creation_id,return_quantity,item_property,item_weights,current_stock,item_price,total_amount)
{

  var description = $("#description").val();
  var state_id = $("#state_id").val();
  var district_id = $("#district_id").val();
  var current_stock = $("#current_stock").val();


  if((item_creation_id) && (return_quantity) && (item_property) && (item_weights) && (item_price) && (total_amount))
  {

    if((id=="")&&(main_id==""))
    {

      var order_date=$("#order_date").val(),sales_exec=$("#sales_exec").val(),dealer_creation_id=$("#dealer_creation_id").val(),delivery_no=$("#delivery_no").val(),status=$("#status1").val(),vechile_name=$("#vechile_name").val(),driver_name=$("#driver_name").val();

      if((order_date) && (dealer_creation_id) && (delivery_no) && (status))
      {
        var sendInfo={"action":"insert_sub","main_id":main_id,"order_date":order_date,"sales_exec":sales_exec,"dealer_creation_id":dealer_creation_id,"delivery_no":delivery_no,"status":status,"description":description,"vechile_name":vechile_name,"driver_name":driver_name,'driver_number':driver_number,"state_id":state_id,"district_id":district_id,"order_date_sub":order_date_sub,"time_sub":time_sub,"market_creation_id":market_creation_id,"shop_creation_id":shop_creation_id,"item_creation_id":item_creation_id,"return_quantity":return_quantity,"item_property":item_property,"item_weights":item_weights,"current_stock":current_stock,"item_price":item_price,"total_amount":total_amount};
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
      else{validate_inputs(dealer_creation_id,sales_exec);}
    }
    else
    {
      var sendInfo=[];
      var current_stock = $("#current_stock").val();
      if(id=="")
      {sendInfo={"action":"insert_sub","main_id":main_id,"order_date_sub":order_date_sub,"time_sub":time_sub,"dealer_creation_id": dealer_creation_id,"market_creation_id":market_creation_id,"shop_creation_id":shop_creation_id,"item_creation_id":item_creation_id,"return_quantity":return_quantity,"item_property":item_property,"item_weights":item_weights,"current_stock":current_stock,"item_price":item_price,"total_amount":total_amount};}
      else
      {sendInfo={"action":"update_sub","id":id,"order_date_sub":order_date_sub,"time_sub":time_sub,"market_creation_id":market_creation_id,"shop_creation_id":shop_creation_id,"item_creation_id":item_creation_id,"return_quantity":return_quantity,"item_property":item_property,"item_weights":item_weights,"current_stock":current_stock,"item_price":item_price,"total_amount":total_amount};
    }
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data){
          list_div();
          // load_model_sublist(main_id,'');
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
  } else {
  validate_sub_inputs(item_creation_id,return_quantity,item_property,item_weights,item_price,total_amount);
  }
}
function validate_sub_inputs(item_creation_id,return_quantity,item_property,item_weights,item_price,total_amount)
{
  if(item_creation_id==='') { $("#item_creation_id").addClass('is-invalid');$("#item_creation_id_validate_div").html("Select Product"); return false;} else {$("#item_creation_id").removeClass('is-invalid');$("#item_creation_id_validate_div").html("");}
  if(return_quantity==='') { $("#return_quantity").addClass('is-invalid');$("#return_quantity_validate_div").html("Enter Quantity"); return false;} else {$("#return_quantity").removeClass('is-invalid');$("#return_quantity_validate_div").html("");}
  if(item_property==='') { $("#item_property").addClass('is-invalid');$("#item_property_validate_div").html("Select Item Property"); return false;} else {$("#item_property").removeClass('is-invalid');$("#item_property_validate_div").html("");}
  if(item_weights==='') { $("#item_weights").addClass('is-invalid');$("#item_weights_validate_div").html("Enter Item Weight"); return false;} else {$("#item_weights").removeClass('is-invalid');$("#item_weights_validate_div").html("");}
  if(item_price==='') { $("#item_price").addClass('is-invalid');$("#item_price_validate_div").html("Price not exist"); return false;} else {$("#item_price").removeClass('is-invalid');$("#item_price_validate_div").html("");}
  if(total_amount==='') { $("#total_amount").addClass('is-invalid');$("#total_amount_validate_div").html("Total Amount Empty"); return false;} else {$("#total_amount").removeClass('is-invalid');$("#total_amount_validate_div").html("");}
}
function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Sales Order Delivery',
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
          // load_model_sublist(main_id,'');
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
  });
}

function getorderrecipt() {
  var order_recipt_no = $("#order_recipt_no").val();
  $('#bd-example-modal-lg1 #sublist_div').html("...");
  var sendInfo = {  "action": "getorderrecipt", "order_recipt_no": order_recipt_no };

  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function(data) {
        $('#bd-example-modal-lg1 #sublist_div').html(data);
      },
      error: function() {
          alert('Error Fetching Sublist');
      }
  });
}

function getsalesrepdealer() {

  var order_recipt_no = $("#order_recipt_no").val();

  var sendInfo = {
      action: "getsalesrepmain",
      order_recipt_no: order_recipt_no,
  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {
        $('#sales_exec').empty();

          for (let i1 = 0; i1 < data.length; i1++) {
            $('#sales_exec').append('<option value="' + data[i1]['id'] + '">' + data[i1]['sales_ref_name'] + '</option>');
          }
      },
      error: function () {
          alert('Error fetching Sales Executive');
      }
  });

  var order_recipt_no = $("#order_recipt_no").val();

  var sendInfo = {
    action: "getdealermain",
    order_recipt_no: order_recipt_no,
  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {
          $('#dealer_creation_id').empty();

          for (let i1 = 0; i1 < data.length; i1++) {
            $('#dealer_creation_id').append('<option value="' + data[i1]['id'] + '">' + data[i1]['dealer_name'] + '</option>');
          }
      },
      error: function () {
          alert('Error fetching Dealer');
      }
  });

}

function getdearlername() {

  var sales_exec = $("#sales_exec").val();
  var sendInfo = {
      action: "getdearlername",
      sales_exec: sales_exec,
  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {

          $('#dealer_creation_id').empty();
          $('#dealer_creation_id').append('<option value="">Select Dealer Name</option>');
          for (let i1 = 0; i1 < data.length; i1++) {
              $('#dealer_creation_id').append('<option value="' + data[i1]['id'] + '">' + data[i1]['dealer_name'] + '</option>');
          }

      },
      error: function () {
          alert('Error fetching Shop Name');
      }
  });
}

function getreciptno() {

  var sales_exec = $("#sales_exec").val();
  var dealer_creation_id = $("#dealer_creation_id").val();
  var sendInfo = {
      action: "getreciptno",
      sales_exec: sales_exec,
      dealer_creation_id: dealer_creation_id,
  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {

          $('#order_recipt_no').empty();
          $('#order_recipt_no').append('<option value="">Select Recipt No</option>');
          for (let i1 = 0; i1 < data.length; i1++) {
              $('#order_recipt_no').append('<option value="' + data[i1]['id'] + '">' + data[i1]['order_no'] + '-' + data[i1]['order_date'] + '</option>');
          }

      },
      error: function () {
          alert('Error fetching Shop Name');
      }
  });
}

function getopeningstock() {

  var dealer_creation_id = $("#dealer_creation_id").val();
  var item_creation_id = $("#item_creation_id").val();
  var order_date_sub = $("#order_date_sub").val();

  var sendInfo = {
      action: "getopeningstock",
      dealer_creation_id: dealer_creation_id,
      item_creation_id: item_creation_id,
      order_date_sub: order_date_sub,

  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {
          $('#current_stock').val(data);
          // $('#opening_stock').empty();
          // for (let i1 = 0; i1 < data.length; i1++) {
          //     $('#opening_stock').val(data[i1]['total_opening_stock']);
          // }
      },
      error: function () {
          alert('Error fetching Opening Stock');
      }
  });
}

function getstock(dealerId) {
    // Rest of your code...

    if (dealerId === '') {
        // No dealer selected, exit the function
        return;
    }

    var sendInfo = {
        "action": "getstock",
        "dealer_creation_id": dealerId
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function (data) {
            $('#item_creation_id').empty();
            $('#current_stock').empty();
            for (let i = 0; i < data.length; i++) {
                $('#item_creation_id').append('<option value="' + data[i]['id'] + '">' + data[i]['item_name'] + '</option>');
                $('#current_stock').append('<option value="' + data[i]['order_quantity'] + '">' + data[i]['order_quantity'] + '</option>');
            }
            // Call functions to update item price and total amount
            var selectedItemValue = $("#item_creation_id").val();
            set_item_price(selectedItemValue);
            calc_total_amount();
        },
        error: function () {
            alert('Error fetching product');
        }
    });
}


function set_item_price(id) {
    $("#item_price").val(item_creation_list[id]);
    calc_total_amount();
}

function calc_total_amount() {
    var return_quantity = $("#return_quantity").val();
    return_quantity = (return_quantity != "") ? parseFloat(return_quantity) : 0;
    var item_price = $("#item_price").val();
    item_price = (item_price != "") ? parseFloat(item_price) : 0;
    var total_amount = (return_quantity * item_price).toFixed(2);
    $("#total_amount").val(total_amount);
}


  function getqyt() {

    var qtyId = $("#item_creation_id").val();

    $("#current_stock").empty();
    // $("#current_stock").append('<option value="">Select</option>');

    if (qtyId === '') {
        return;
    }

    var sendInfo = {"action": "getqyt", "item_creation_id": qtyId };

    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
            $('#current_stock').empty();
            for (let i1 = 0; i1 < data.length; i1++) {
                $('#current_stock').append('<option value="' + data[i1]['order_quantity'] + '">' + data[i1]['order_quantity'] + '</option>');
            }
        },

        error: function() {
            alert('Error fetching product');
        }
    });
  }
  function getmarket() {

    var dealer_creation_id = $("#dealer_creation_id").val();

    $("#market_creation_id").empty();
    $("#market_creation_id").append('<option value="">Select Market Name</option>');
    var sendInfo = {
        action: "getmarket",
        dealer_creation_id: dealer_creation_id,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $('#market_creation_id').empty();
            $('#market_creation_id').append('<option value="">Select Market Name</option>');
            for(let i1=0;i1 < data.length;i1++){
              $('#market_creation_id').append('<option value="' + data[i1]['id'] + '">' + data[i1]['area_name'] + '</option>');
            }

        },
        error: function() {
            alert('Error fetching Shop Name');
        }
    });
}

function getshop() {

  var market_creation_id = $("#market_creation_id").val();

  $("#shop_creation_id").empty();
  $("#shop_creation_id").append('<option value="">Select Shop Name</option>');
  var sendInfo = {
      action: "getshop",
      market_creation_id: market_creation_id,
  };
  $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function (data) {
          $('#shop_creation_id').empty();
          $('#shop_creation_id').append('<option value="">Select Shop Name</option>');
          for(let i1=0;i1 < data.length;i1++){
            $('#shop_creation_id').append('<option value="' + data[i1]['id'] + '">' + data[i1]['shop_name'] + '</option>');
          }

      },
      error: function() {
          alert('Error fetching Shop Name');
      }
  });
}
