function list_div(from_date_1, to_date_1, order_no_1, market_creation_id_1, dealer_creation_id_1, status_1) {
    $("#list_div").html("");
    var _token=$("#_token").val();
    var sendInfo = {
        _token:_token,"action": "retrieve", "from_date_1": from_date_1, "to_date_1": to_date_1, "order_no_1": order_no_1, "market_creation_id_1": market_creation_id_1, "dealer_creation_id_1": dealer_creation_id_1, "status_1": status_1, "user_rights_edit_1": user_rights_edit_1, "user_rights_delete_1": user_rights_delete_1
    };
    $.ajax({
        type: "POST",
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
    var _token=$("#_token").val();
    $("#bd-example-modal-lg1 #model_main_content").html("...");
    var sendInfo = {};
    if (id == "") {
        sendInfo = {_token:_token, action: "create_form" };
    } else {
        sendInfo = {_token:_token, action: "update_form", id: id };
    }
    $.ajax({
        type: "POST",
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

function load_model_sublist(main_id, sub_id) {
    var _token=$("#_token").val();
    $("#bd-example-modal-lg1 #sublist_div").html("...");

    var sendInfo = {
        _token:_token,
        action: "form_sublist",
        main_id: main_id,
        sub_id: sub_id,
        user_rights_edit_1: user_rights_edit_1,
        user_rights_delete_1: user_rights_delete_1,
    };
    $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $("#bd-example-modal-lg1 #sublist_div").html(data);
        },
    });
}

function getmarket() {
    var _token=$("#_token").val();
    var dealer_creation_id = $("#dealer_creation_id").val();

    $("#market_creation_id").empty();
    $("#market_creation_id").append('<option value="">Select Market Name</option>');
    var sendInfo = {
        _token:_token,
        action: "getmarket",
        dealer_creation_id: dealer_creation_id,
    };
    $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            console.log(data);

            $('#market_creation_id').empty();
            $('#market_creation_id').append('<option value="">Select Market Name</option>');

            if (data.hasOwnProperty('dealer_address') && data.dealer_address.length > 0) {
                const dealerAddress = data.dealer_address[0].address;
                $('#dealer_address').val(dealerAddress);
            }

            if (data.hasOwnProperty('area_names')) {
                for (let i1 = 0; i1 < data.area_names.length; i1++) {
                    $('#market_creation_id').append('<option value="' + data.area_names[i1]['id'] + '">' + data.area_names[i1]['area_name'] + '</option>');
                }
            }
        },
        error: function () {
            alert('Error fetching data');
        }
    });
}
function short_code() {

    var item_creation_id = $("#item_creation_id").val();
    var _token=$("#_token").val();
    $("#short_code_id").empty();
    $("#short_code_id").append('<option value="">Select short name </option>');
    var sendInfo = {
        _token:_token,
        action: "getshortcode",
        item_creation_id: item_creation_id,
    };
    $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $('#short_code_id').empty();
            $('#short_code_id').append('<option value="">Select short name</option>');
            for (let i1 = 0; i1 < data.length; i1++) {
                $('#short_code_id').append('<option value="' + data[i1]['id']+ '">' + data[i1]['short_code'] + '</option>');
            }

        },
        error: function () {
            alert('Error fetching here');
        }
    });
}
function getshop() {

    var market_creation_id = $("#market_creation_id").val();
    var _token=$("#_token").val();
    $("#shop_creation_id").empty();
    //   $("#shop_creation_id").append('<option value="">Select here</option>');
    var sendInfo = {
        _token:_token,
        action: "getshop",
        market_creation_id: market_creation_id,
    };
    $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $('#shop_creation_id').empty();
            //   $('#shop_creation_id').append('<option value="">Select here</option>');
            for (let i1 = 0; i1 < data.length; i1++) {
                $('#shop_creation_id').append('<option value="' + data[i1]['id'] + '">' + data[i1]['shop_name'] + '</option>');
            }

        },
        error: function () {
            alert('Error fetching here');
        }
    });
}

function getdearlername() {

    var sales_exec = $("#sales_exec").val();
    var _token=$("#_token").val();
    $("#dealer_creation_id").empty();
    $("#dealer_creation_id").append('<option value="">Select dealer Name</option>');
    var sendInfo = {
        _token:_token,
        action: "getdearlername",
        sales_exec: sales_exec,
    };
    $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {

            $('#dealer_creation_id').empty();
            $('#dealer_creation_id').append('<option value="">Select dealer Name</option>');
            for (let i1 = 0; i1 < data.length; i1++) {
                $('#dealer_creation_id').append('<option value="' + data[i1]['id'] + '">' + data[i1]['dealer_name'] + '</option>');
            }

        },
        error: function () {
            alert('Error fetching here');
        }
    });
}

function getopeningstock() {
    var _token=$("#_token").val();
    var dealer_creation_id = $("#dealer_creation_id").val();
    var item_creation_id = $("#item_creation_id").val();
    var order_date_sub = $("#order_date_sub").val();
    var item_property = $("#item_property").val();
    var item_weights = $("#item_weights").val();

    var sendInfo = {
        _token:_token,
        action: "getopeningstock",
        dealer_creation_id: dealer_creation_id,
        item_creation_id: item_creation_id,
        order_date_sub: order_date_sub,
        item_property: item_property,
        item_weights: item_weights,

    };
    $.ajax({
        type: "POST",
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

function insert_update_row(
    id,
    order_date,
    market_creation_id,
    dealer_creation_id,
    dealer_address,
    order_no,
    status,
    description,
    sales_exec,
    radio_visit
) {

    var checkboxValue=document.getElementById('check_1').checked
    if (checkboxValue) {
        status_check = "Yes";
    } else {
        status_check = "No";
    }
    var item_creation_id = $("#item_creation_id").val();
    var current_stock = $("#current_stock").val();
    var order_quantity = $("#order_quantity").val();
    var pieces_quantity = $("#pieces_quantity").val();
    var item_property = $("#item_property").val();
    var item_weights = $("#item_weights").val();
    var item_price = $("#item_price").val();
    var total_amount = $("#total_amount").val();
    var dealer_address = $("#dealer_address").val();
    if ((sales_exec)) {

        if (id == "") {
            var _token=$("#_token").val();
            var sendInfo = {
                _token:_token,
                action: "insert",
                order_date: order_date,
                market_creation_id: market_creation_id,
                dealer_creation_id: dealer_creation_id,
                dealer_address:dealer_address,
                order_no: order_no,
                status: status,
                description: description,
                sales_exec: sales_exec,
                radio_visit:radio_visit,
            };
            $.ajax({
                type: "POST",
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
            var _token=$("#_token").val();
            var sendInfo = {
                _token:_token,
                action: "update",
                id: id,
                order_date: order_date,
                market_creation_id: market_creation_id,
                dealer_creation_id: dealer_creation_id,
                dealer_address:dealer_address,
                order_no: order_no,
                status: status,
                description: description,
                sales_exec: sales_exec,
                radio_visit:radio_visit,
            };
            $.ajax({
                type: "POST",
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
    } else { validate_inputs(sales_exec); }
}

function insert_update_row_radio_visit(
    id,
    order_date,
    market_creation_id,
    dealer_creation_id,
    dealer_address,
    order_no,
    status,
    description,
    sales_exec,
    radio_visit
) {

    var checkboxValue=document.getElementById('check_1').checked
    if (checkboxValue) {
        status_check = "Yes";
    } else {
        status_check = "No";
    }
    var item_creation_id = $("#item_creation_id").val();
    var current_stock = $("#current_stock").val();
    var order_quantity = $("#order_quantity").val();
    var pieces_quantity = $("#pieces_quantity").val();
    var item_property = $("#item_property").val();
    var item_weights = $("#item_weights").val();
    var item_price = $("#item_price").val();
    var total_amount = $("#total_amount").val();
    var dealer_address = $("#dealer_address").val();
    if ((sales_exec)) {

        if (id == "") {
            var _token=$("#_token").val();
            var sendInfo = {
                _token:_token,
                action: "insert",
                order_date: order_date,
                market_creation_id: market_creation_id,
                dealer_creation_id: dealer_creation_id,
                dealer_address:dealer_address,
                order_no: order_no,
                status: status,
                description: description,
                sales_exec: sales_exec,
                radio_visit:radio_visit,
            };
            $.ajax({
                type: "POST",
                url: $("#CUR_ACTION").val(),
                data: sendInfo,
                success: function (data) {
                    list_div();
                    open_visitors('Dealer Search Creation',data,order_date,order_no,sales_exec)
                },
                error: function () {
                    alert("error handing here");
                },
            });
        }
    } else { validate_inputs(sales_exec); }
}

function validate_inputs(sales_exec) {

    if (sales_exec === '') { $("#sales_exec").addClass('is-invalid'); $("#sales_exec_validate_div").html("Select Sales Executive "); return false; } else { $("#sales_exec").removeClass('is-invalid'); $("#sales_exec_validate_div").html(""); }

}


function insert_update_sub_row(
    main_id,
    id,
    checkboxValue,
    order_date_sub,
    arriving_time_sub,
    closing_time_sub,
    shop_creation_id,
    item_creation_id,
    short_code_id,
    current_stock,
    order_quantity,
    pieces_quantity,
    item_property,
    item_weights,
    item_price,
    total_amount
) {

    if (checkboxValue) {
        status_check = "Yes";
    } else {
        status_check = "No";
    }
    var _token=$("#_token").val();
    if ((status_check) && (order_date_sub) && (arriving_time_sub) && (closing_time_sub)) {
        if (id == "" && main_id == "") {
            var order_date = $("#order_date").val(),
                sales_exec = $("#sales_exec").val(),
                radio_visit = $("#radio_visit").val(),
                market_creation_id = $("#market_creation_id").val(),
                dealer_creation_id = $("#dealer_creation_id").val(),
                order_no = $("#order_no").val(),
                status = $("#status1").val(),
                description = $("#description").val(),
                dealer_address = $("#dealer_address").val()
            if (
                (sales_exec)
            ) {
                var sendInfo = {
                    _token:_token,
                    action: "insert_sub",
                    main_id: main_id,
                    order_date: order_date,
                    market_creation_id: market_creation_id,
                    dealer_creation_id: dealer_creation_id,
                    dealer_address:dealer_address,
                    order_no: order_no,
                    status: status,
                    description: description,
                    sales_exec: sales_exec,
                    radio_visit:radio_visit,
                    status_check: status_check,
                    order_date_sub: order_date_sub,
                    arriving_time_sub: arriving_time_sub,
                    closing_time_sub: closing_time_sub,
                    shop_creation_id: shop_creation_id,
                    item_creation_id: item_creation_id,
                    short_code_id:short_code_id,
                    current_stock: current_stock,
                    order_quantity: order_quantity,
                    pieces_quantity: pieces_quantity,
                    item_property: item_property,
                    item_weights: item_weights,
                    item_price,
                    total_amount,
                };
                $.ajax({
                    type: "POST",
                    url: $("#CUR_ACTION").val(),
                    data: sendInfo,
                    success: function (data) {

                        list_div();
                        $("#bd-example-modal-lg1 #model_main_content").html("...");
                        var _token=$("#_token").val();
                        var sendInfo1 = {_token:_token, action: "update_form", id: data };
                        $.ajax({
                            type: "POST",
                            url: $("#CUR_ACTION").val(),
                            data: sendInfo1,
                            success: function (data) {
                                $("#bd-example-modal-lg1 #model_main_content").html(
                                    data
                                );
                            },
                        });
                    },
                    error: function () {
                        alert("error handing here");
                    },
                });
            }
            else { validate_inputs(sales_exec); }
        } else {
            var sendInfo = [];
            if (id == "") {
                sendInfo = {
                    _token:_token,
                    action: "insert_sub",
                    main_id: main_id,
                    status_check: status_check,
                    order_date_sub: order_date_sub,
                    dealer_creation_id: dealer_creation_id,
                    arriving_time_sub: arriving_time_sub,
                    closing_time_sub: closing_time_sub,
                    shop_creation_id: shop_creation_id,
                    item_creation_id: item_creation_id,
                    short_code_id:short_code_id,
                    current_stock: current_stock,
                    order_quantity: order_quantity,
                    pieces_quantity: pieces_quantity,
                    item_property: item_property,
                    item_weights: item_weights,
                    item_price: item_price,
                    total_amount: total_amount,
                };
            } else {
                sendInfo = {
                    _token:_token,
                    action: "update_sub",
                    id: id,
                    status_check: status_check,
                    order_date_sub: order_date_sub,
                    arriving_time_sub: arriving_time_sub,
                    closing_time_sub: closing_time_sub,
                    shop_creation_id: shop_creation_id,
                    item_creation_id: item_creation_id,
                    short_code_id:short_code_id,
                    current_stock: current_stock,
                    order_quantity: order_quantity,
                    pieces_quantity: pieces_quantity,
                    item_property: item_property,
                    item_weights: item_weights,
                    item_price: item_price,
                    total_amount: total_amount,
                };
            }
            $.ajax({
                type: "POST",
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
    }else{validate_sub_inputs(status_check,order_date_sub,arriving_time_sub,closing_time_sub)}
}
function validate_sub_inputs(
    status_check,order_date_sub,arriving_time_sub,closing_time_sub
) {
    if (status_check === "") {
        $("#status_check").addClass("is-invalid");
        $("#status_check_validate_div").html("Select Status");
        return false;
    } else {
        $("#status_check").removeClass("is-invalid");
        $("#status_check_validate_div").html("");
    }
    if (order_date_sub === "") {
        $("#order_date_sub").addClass("is-invalid");
        $("#order_date_sub_validate_div").html("Enter Date");
        return false;
    } else {
        $("#order_date_sub").removeClass("is-invalid");
        $("#order_date_sub_validate_div").html("");
    }
    if (arriving_time_sub === "") {
        $("#arriving_time_sub").addClass("is-invalid");
        $("#arriving_time_sub_validate_div").html("Select Report Time");
        return false;
    } else {
        $("#arriving_time_sub").removeClass("is-invalid");
        $("#arriving_time_sub_validate_div").html("");
    }
    if (closing_time_sub === "") {
        $("#closing_time_sub").addClass("is-invalid");
        $("#closing_time_sub_validate_div").html("Enter Report Time");
        return false;
    } else {
        $("#closing_time_sub").removeClass("is-invalid");
        $("#closing_time_sub_validate_div").html("");
    }
}
function delete_row(id) {
    swal({
        title: "Are you sure?",
        text: "To delete DEALER TO SHOP ",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            var _token=$("#_token").val();
            var sendInfo = {_token:_token, action: "delete", id: id };
            $.ajax({
                type: "POST",
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
            var _token=$("#_token").val();
            var sendInfo = {_token:_token, action: "delete_sub", id: id };
            $.ajax({
                type: "POST",
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

//visitor

function open_visitors(tittle,d2s_id,order_date,order_no,sales_exec)
{
  var _token=$("#_token").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
  sendInfo={"_token":_token,"action":"visitors_form","d2s_id":d2s_id,"order_date":order_date,"order_no":order_no,"sales_exec":sales_exec};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      console.log(data)
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(tittle);
      $('#bd-example-modal-lg1 #model_main_content').html(data);
      visitor_sublist(d2s_id,order_date,order_no,sales_exec);
    },
    error: function() {
      alert('error handing here');
    }
  });
}

function visitor_sublist(d2s_id,order_date,order_no,sales_exec)
{
  var _token=$("#_token").val();
  $('#bd-example-modal-lg1 #sublist_div').html("...");
  var sendInfo={"_token":_token,"action":"visitor_sublist","d2s_id":d2s_id,"order_date":order_date,"order_no":order_no,"sales_exec":sales_exec};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1 #sublist_div').html(data);
    }
  });
}

function open_visitors_update(title,id,d2s_id,order_date,order_no,sales_exec)
{

  var _token=$("#_token").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
 sendInfo={"_token":_token,"action":"visitors_update","id":id,"d2s_id":d2s_id,"order_date":order_date,"order_no":order_no,"sales_exec":sales_exec};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(title);
      $('#bd-example-modal-lg1 #model_main_content').html(data);
      visitor_sublist(d2s_id,order_date,order_no,sales_exec);
    },
    error: function() {
      alert('error handing here');
    }
  });
}

function delete_visitor_row(id,d2s_id,order_date,order_no,sales_exec)
{
    swal({
        title: 'Are you sure?',
        text: 'To delete Visitor Creation',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var _token=$("#_token").val();
          var sendInfo={"_token":_token,"action":"visitor_delete","id":id,"d2s_id":d2s_id,"order_date":order_date,"order_no":order_no,"sales_exec":sales_exec};
          $.ajax({
            type: "POST",
            url: $("#CUR_ACTION").val(),
            data: sendInfo,
            success: function(data){
                open_visitors('Dealer Search Creation',d2s_id,order_date,order_no,sales_exec)
              swal('Deleted Successfully', {icon: 'success',});
            },
            error: function() {
              alert('error handing here');
            }
          });
        }
      });
}

function visitors_insert_update_row(id,d2s_id,order_date,order_no,visitor_name,sales_exec,mobile_no,description,address)
{
  var _token=$("#_token").val();
  if(id=="")
  {
        var formData = new FormData();
        formData.append("action", "visitors_insert");
        formData.append("d2s_id", d2s_id);
        formData.append("order_date", order_date);
        formData.append("order_no", order_no);
        formData.append("visitor_name", visitor_name);
        formData.append("sales_exec", sales_exec);
        formData.append("mobile_no", mobile_no);
        formData.append("description", description);
        formData.append("address", address);
        formData.append("image_name", $("#image_name")[0].files[0]);
        formData.append("_token", _token);
    $.ajax({
      type: "POST",
      url: $("#CUR_ACTION").val(),
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        open_visitors('Dealer Search Creation',d2s_id,order_date,order_no,sales_exec)
        swal('Inserted Successfully', {icon: 'success',})
      },
      error: function() {
        alert('error handing here');
      }
    });
  }
  else
  {
    var formData = new FormData();
    formData.append("action", "visitors_update_1");
    formData.append("id", id);
    formData.append("d2s_id", d2s_id);
    formData.append("order_date", order_date);
    formData.append("order_no", order_no);
    formData.append("visitor_name", visitor_name);
    formData.append("sales_exec", sales_exec);
    formData.append("mobile_no", mobile_no);
    formData.append("description", description);
    formData.append("address", address);
    formData.append("image_name", $("#image_name")[0].files[0]);
    formData.append("_token", _token);
    $.ajax({
      type: "POST",
      url: $("#CUR_ACTION").val(),
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        open_visitors('Dealer Search Creation',d2s_id,order_date,order_no,sales_exec)
        list_div();
        swal('Updated Successfully', {icon: 'success',});
      },
      error: function() {
        alert('error handing here');
      }
    });
  }
}
