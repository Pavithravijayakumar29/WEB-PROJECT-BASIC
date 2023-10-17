function list_div(
    from_date_1,
    to_date_1,
    ledger_name_1
) {
    $("#list_div").html("");
    var sendInfo = {
        action: "retrieve",
        from_date_1: from_date_1,
        to_date_1: to_date_1,
        ledger_name_1:ledger_name_1,
        user_rights_edit_1: user_rights_edit_1,
        user_rights_delete_1: user_rights_delete_1,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $("#list_div").html(data);
        },
    });
}
$(function () {
    list_div("", "", "", "", "", "");
});
function open_model(title, id) {

    $("#bd-example-modal-lg1 #model_main_content").html("...");
    var sendInfo = {};
    if (id == "") {
        sendInfo = { action: "create_form" };
    } else {
        sendInfo = { action: "update_form", id: id };
    }
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $("#bd-example-modal-lg1").modal("show");
            $("#bd-example-modal-lg1 #myLargeModalLabel").html(title);
            $("#bd-example-modal-lg1 #model_main_content").html(data);
        },
        error: function () {
            alert("error handing here");
        },
    });
}
function open_model_1(title, id) {

    $("#bd-example-modal-lg1 #model_main_content").html("...");
    var sendInfo = {};

        sendInfo = { action: "update_form", "id":id };

    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $("#bd-example-modal-lg1").modal("show");
            $("#bd-example-modal-lg1 #myLargeModalLabel").html(title);
            $("#bd-example-modal-lg1 #model_main_content").html(data);
            getorderrecipt_3(id);
        },
        error: function () {
            alert("error handing here");
        },
    });
}
function load_model_sublist(main_id, sub_id) {
    var tally_no = $('#tally_no').val();
    $("#bd-example-modal-lg1 #sublist_div").html("...");
    var sendInfo = {
        action: "form_sublist",
        main_id: main_id,
        sub_id: sub_id,
        user_rights_edit_1: user_rights_edit_1,
        user_rights_delete_1: user_rights_delete_1,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            if (!tally_no || tally_no === null || tally_no === undefined || tally_no === "") {

            $("#bd-example-modal-lg1 #sublist_div").html(data);
            }
        },
    });
}

  function getorderrecipt() {
    var tally_no = $("#tally_no").val();
    if(tally_no != ''){
        var sendInfo = {"action": "gettally","tally_no": tally_no,};
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
    }else{
        load_model_sublist('','')
    }

}


function hide_tally_number() {
    var ledger = $('#ledger_dr').val();

    if (ledger) {
        $('#tally_no').prop('disabled', true);
    }else{
        $('#tally_no').prop('disabled', false);
    }
}

function hide_ledger_name(){
    var tally_no = $('#tally_no').val();

    if (tally_no) {
        $('#ledger_dr').prop('disabled', true);
    }else{
        $('#ledger_dr').prop('disabled', false);
    }
}


function collectData(className) {
    var data = [];
    var elements = document.getElementsByClassName(className);
    for (let i = 0; i < elements.length; i++) {
        data.push(elements[i].value);
    }
    return data;
}

  function getorderrecipt_1(id) {
    // var tally_no = $('#tally_no').val();
    var tally_no = $("#tally_no").val();
    var order_no = $("#order_no").val();

    var sendInfo = {  "action": "getorderrecipt1",'id':id,"tally_no": tally_no,'order_no':order_no };

    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data) {
          $('#bd-example-modal-lg1 #sublist_div_1').html(data);
        },
        error: function() {
            alert('Error Fetching Sublist');
        }
    });
  }

  function getorderrecipt_3(id) {
    var tally_no = $('#tally_no').val();
    var tally_no = $("#tally_no").val();
    var order_no = $("#order_no").val();

    var sendInfo = {  "action": "getorderrecipt3",'id':id,"tally_no": tally_no,'order_no':order_no };

    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data) {
          $('#bd-example-modal-lg1 #sublist_div_1').html(data);
        },
        error: function() {
            alert('Error Fetching Sublist');
        }
    });
  }


  function getorderrecipt_2(id) {
    var tally_no = $('#tally_no').val();
    var tally_no = $("#tally_no").val();
    var order_no = $("#order_no").val();

    var sendInfo = {  "action": "getorderrecipt2",'id':id,"tally_no": tally_no,'order_no':order_no };

    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data) {
          $('#bd-example-modal-lg1 #sublist_div_1').html(data);
        },
        error: function() {
            alert('Error Fetching Sublist');
        }
    });
  }



function load_model_sublist_1(main_id, sub_id) {

    $("#bd-example-modal-lg1 #sublist_div_1").html("...");
    var sendInfo = {
        action: "form_sublist_rep",
        main_id: main_id,
        sub_id: sub_id,
        user_rights_edit_1: user_rights_edit_1,
        user_rights_delete_1: user_rights_delete_1,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $("#bd-example-modal-lg1 #sublist_div_1").html(data);
        },
    });
}

function load_model_sublist_2(main_id, sub_id) {

    $("#bd-example-modal-lg1 #sublist_div_1").html("...");
    var sendInfo = {
        action: "form_sublist_rep",
        main_id: main_id,
        sub_id: sub_id,
        user_rights_edit_1: user_rights_edit_1,
        user_rights_delete_1: user_rights_delete_1,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $("#bd-example-modal-lg1 #sublist_div_1").html(data);
        },
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

  function find_sales_ref()
{

  var manager_id = $("#manager_id").val();

  var sendInfo={"action":"getSalesRef","manager_id":manager_id};
    if (manager_id) {
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
          $('#sales_exec').empty();
          $('#sales_exec').append('<option  value="">Select Sales Executive</option>');
          for(let i1=0;i1 < data.length;i1++){
            $('#sales_exec').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['sales_ref_name'] + '</option>');
       }
        }
      });
    } else {
      $('#sales_ref_id').empty();

    }

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

  function gettallynumber(){

        var dealer_creation_id = $("#dealer_creation_id").val();
        var sendInfo = {
            action: "gettallynumber",
            dealer_creation_id: dealer_creation_id,
        };
        $.ajax({
            type: "GET",
            url: $("#CUR_ACTION").val(),
            data: sendInfo,
            success: function (data) {
                $('#tally_no').empty();
                $('#tally_no').append('<option value="">Select Tally No</option>');
                for (let i1 = 0; i1 < data.length; i1++) {
                    $('#tally_no').append('<option value="' + data[i1]['id'] + '">' + data[i1]['tally_no'] + '</option>');
                }
            },
            error: function () {
                alert('Error fetching Tally No');
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
//   function test_check(){

//     var tally_no = $("#tally_no").val();

//     if(tally_no == ''){

//         var sendInfo = {
//             action: "getdearlername",
//             tally_no: tally_no,
//         };
//         $.ajax({
//             type: "GET",
//             url: $("#CUR_ACTION").val(),
//             data: sendInfo,
//             success: function (data) {

//                 $('#sales_exec').empty();
//                 $('#dealer_creation_id').empty();
//                /*  $('#sales_exec').append('<option value="">Select sales Name</option>');
//                 $('#dealer_creation_id').append('<option value="">Select sales Name</option>'); */
//                 for (let i1 = 0; i1 < data.length; i1++) {
//                     $('#sales_exec').append('<option  value="' + data[i1]['sales_exec'] + '">' + data[i1]['sales_ref_name'] + '</option>');
//                     $('#dealer_creation_id').append('<option  value="' + data[i1]['dealer_creation_id'] + '">' + data[i1]['dealer_name'] + '</option>');
//                 }

//             },
//             error: function () {
//                 alert('Error fetching Sales Name');
//             }
//         });

//     }

//   }

function getsalesdealer() {
    var tally_no = $("#tally_no").val();

    if (tally_no == '') {
        var sendInfo = {
            action: "get_selectsalesrepname",
        };
        $.ajax({
            type: "GET",
            url: $("#CUR_ACTION").val(),
            data: sendInfo,
            success: function (data) {
                $('#sales_exec').empty();
                $('#sales_exec').append('<option value="">Select</option>');
                for (let i1 = 0; i1 < data.length; i1++) {
                    $('#sales_exec').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['sales_ref_name'] + '</option>');
                }
                var sendInfo = {
                    action: "get_selectdealername",
                };
                $.ajax({
                    type: "GET",
                    url: $("#CUR_ACTION").val(),
                    data: sendInfo,
                    success: function (data) {
                        $('#dealer_creation_id').empty();
                        $('#dealer_creation_id').append('<option value="">Select</option>');
                        for (let i1 = 0; i1 < data.length; i1++) {
                            $('#dealer_creation_id').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['dealer_name'] + '</option>');
                        }
                    },
                    error: function () {
                        alert('Error fetching Dealer Name');
                    }
                });
            },
            error: function () {
                alert('Error fetching Sales Name');
            }
        });
    } else {
        var sendInfo = {
            action: "getdearlername",
            tally_no: tally_no,
        };
        $.ajax({
            type: "GET",
            url: $("#CUR_ACTION").val(),
            data: sendInfo,
            success: function (data) {
                $('#sales_exec').empty();
                $('#dealer_creation_id').empty();
                for (let i1 = 0; i1 < data.length; i1++) {
                    $('#sales_exec').append('<option  value="' + data[i1]['sales_exec'] + '">' + data[i1]['sales_ref_name'] + '</option>');
                    $('#dealer_creation_id').append('<option  value="' + data[i1]['dealer_creation_id'] + '">' + data[i1]['dealer_name'] + '</option>');
                }
            },
            error: function () {
                alert('Error fetching Sales Name');
            }
        });
    }
}

function getsalesrep_dealername() {
    var sales_exec = $("#sales_exec").val();

    var sendInfo = {
        action: "getsalesrep_dealername",
        sales_exec: sales_exec,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $("#dealer_creation_id").empty();
            $("#dealer_creation_id").append(
                '<option value="">Select Dealer Name</option>'
            );
            for (let i1 = 0; i1 < data.length; i1++) {
                $("#dealer_creation_id").append('<option value="' + data[i1]["id"] + '">' + data[i1]["dealer_name"] + "</option>");
            }
        },
        error: function () {
            alert("Error fetching Dealer Name");
        },
    });
}

function insert_update_row(
    id,
    order_date,
    order_no,
    tally_no,manager_id,sales_exec,dealer_creation_id,
) {

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

    var total_amount_1 = [];
    var total_amount = document.getElementsByClassName('total_amount');
    for (let i1 = 0; i1 < total_amount.length; i1++) {
      total_amount_1.push(total_amount[i1].value);
    }

    var paid_amount_1 = [];
    var paid_amount = document.getElementsByClassName('paid_amount');
    for (let i1 = 0; i1 < paid_amount.length; i1++) {
        paid_amount_1.push(paid_amount[i1].value);
    }

    var bal_amount = [];
    var dispatch_status = document.getElementsByClassName('bal_amount');
    for (let i1 = 0; i1 < dispatch_status.length; i1++) {
        bal_amount.push(dispatch_status[i1].value);
    }

    var pay_amount = [];
    var pay_amount_1 = document.getElementsByClassName('pay_amount');
    for (let i1 = 0; i1 < pay_amount_1.length; i1++) {
        pay_amount.push(pay_amount_1[i1].value);
    }

    var check_amount = [];
    var check_amount_1 = document.getElementsByClassName('check_amount');
    for (let i1 = 0; i1 < check_amount_1.length; i1++) {
        check_amount.push(check_amount_1[i1].value);
    }


  {
    var ledger_dr = $("#ledger_dr").val();
    var comment = $("#comment").val();
        if (id == "") {
            var sendInfo = {
                action: "insert",
                order_date: order_date,
                order_no: order_no,
                ledger_dr: ledger_dr,
                comment: comment,
                tally_no: tally_no,
                manager_id:manager_id,
                sales_exec:sales_exec,dealer_creation_id: dealer_creation_id,
                "order_recipt_sub_id": order_recipt_sub_id_1.toString(),
                "order_date_sub": order_date_sub_1.toString(),
                "item_creation_id": item_creation_id_1.toString(),
                "total_amount": total_amount_1.toString(),
                "paid_amount": paid_amount_1.toString(),
                "bal_amount": bal_amount.toString(),
                "pay_amount": pay_amount.toString(),
                "check_amount": check_amount.toString(),
            };
            $.ajax({
                type: "GET",
                url: $("#CUR_ACTION").val(),
                data: sendInfo,
                success: function (data) {

                    $("#bd-example-modal-lg1").modal("hide");
                    swal("Inserted Successfully", { icon: "success" });
                    list_div();
                },
                error: function () {
                    alert("error handing here");
                },
            });
        } else {
            var sendInfo = {
                action: "update",
                id: id,
                order_date: order_date,
                order_no: order_no,
                ledger_dr: ledger_dr,
                comment: comment,
                tally_no: tally_no,
                manager_id:manager_id,
                sales_exec:sales_exec,dealer_creation_id: dealer_creation_id,
                "order_recipt_sub_id": order_recipt_sub_id_1.toString(),
                "order_date_sub": order_date_sub_1.toString(),
                "item_creation_id": item_creation_id_1.toString(),
                "total_amount": total_amount_1.toString(),
                "paid_amount": paid_amount_1.toString(),
                "bal_amount": bal_amount.toString(),
                "pay_amount": pay_amount.toString(),
                "check_amount": check_amount.toString(),
            };
            $.ajax({
                type: "GET",
                url: $("#CUR_ACTION").val(),
                data: sendInfo,
                success: function (data) {

                    $("#bd-example-modal-lg1").modal("hide");
                    swal("Updated Successfully", { icon: "success" });
                    list_div();

                },
                error: function () {
                    alert("error handing here");
                },
            });
        }
    }
}

function validate_inputs(
    ledger_dr
) {
    if (ledger_dr === "") {
        $("#ledger_dr").addClass("is-invalid");
        $("#ledger_dr_validate_div").html("Select ledger dr");
        return false;
    }
}
function insert_update_sub_row(
    main_id,
    id,
    ledger_cr,
    description1,
    amount
) {

    if (
        ledger_cr &&
        amount

    )
    // var ledger_name = $("#ledger_name").val();
    // var comment = $("#comment").val();
        if (id == "" && main_id == "") {
            var order_date = $("#order_date").val();
            var ledger_dr = $("#ledger_dr").val();
            var order_no = $("#order_no").val();
            var comment = $("#comment").val();
            var tally_no = $("#tally_no").val();
            var manager_id = $("#manager_id").val();
            var sales_exec = $("#sales_exec").val();
            var dealer_creation_id = $("#dealer_creation_id").val();
            var sendInfo = {
                action: "insert_sub",
                main_id: main_id,
                order_date: order_date,
                order_no: order_no,
                ledger_dr: ledger_dr,
                comment: comment,
                tally_no: tally_no,
                manager_id:manager_id,
                sales_exec:sales_exec,dealer_creation_id: dealer_creation_id,
                ledger_cr: ledger_cr,
               description1: description1,
               amount: amount,
            };
                $.ajax({
                    type: "GET",
                    url: $("#CUR_ACTION").val(),
                    data: sendInfo,
                    success: function (data) {

                        list_div();

                        $("#bd-example-modal-lg1 #model_main_content").html(
                            "..."
                        );
                        var sendInfo1 = { action: "update_form", id: data };
                        $.ajax({
                            type: "GET",
                            url: $("#CUR_ACTION").val(),
                            data: sendInfo1,
                            success: function (data) {
                                $(
                                    "#bd-example-modal-lg1 #model_main_content"
                                ).html(data);
                            },
                        });
                    },
                    error: function () {
                        alert("error handing here");
                    },
                });
            }
         else {
            var sendInfo = [];
            if (id == "") {
                sendInfo = {
                    action: "insert_sub",
                    main_id: main_id,
                    ledger_cr: ledger_cr,
                    description1: description1,
                    amount: amount,
                };
            } else {
                sendInfo = {
                    action: "update_sub",
                    id: id,
                    ledger_cr: ledger_cr,
                    description1: description1,
                    amount: amount,
                };
            }
            $.ajax({
                type: "GET",
                url: $("#CUR_ACTION").val(),
                data: sendInfo,
                success: function (data) {

                    list_div();
                    load_model_sublist(main_id, "");
                },
                error: function () {
                    alert("error handing here");
                },
            });
        }
    }


function delete_row(id) {
    swal({
        title: "Are you sure?",
        text: "To delete receipt entry",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var sendInfo = { action: "delete", id: id };
            $.ajax({
                type: "GET",
                url: $("#CUR_ACTION").val(),
                data: sendInfo,
                success: function (data) {
                    swal("Deleted Successfully", { icon: "success" });
                    list_div();
                },
                error: function () {
                    alert("error handing here");
                },
            });
        }
    });
}


function delete_sublist_row(main_id, id) {
    swal({
        title: "Are you sure?",
        text: "To delete Product",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var sendInfo = { action: "delete_sub", id: id };
            $.ajax({
                type: "GET",
                url: $("#CUR_ACTION").val(),
                data: sendInfo,
                success: function (data) {
                    list_div();
                    load_model_sublist(main_id, "");
                },
                error: function () {
                    alert("error handing here");
                },
            });
        }
    });
}

