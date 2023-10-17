function list_div(
    from_date_1, to_date_1, order_no_1, dealer_creation_id_1) {
    $("#list_div").html("");
    var sendInfo = {
        "action": "retrieve", "from_date_1": from_date_1, "to_date_1": to_date_1, "order_no_1": order_no_1, "dealer_creation_id_1": dealer_creation_id_1, "user_rights_edit_1": user_rights_edit_1, "user_rights_delete_1": user_rights_delete_1
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

function load_model_sublist(main_id, sub_id) {
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
            $("#bd-example-modal-lg1 #sublist_div").html(data);
        },
    });
}

function getaddress() {

    var dealer_creation_id = $("#dealer_creation_id").val();

    var sendInfo = {
        action: "getaddress",
        dealer_creation_id: dealer_creation_id,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $('#dealer_address').empty();
            for (let i1 = 0; i1 < data.length; i1++) {
                $('#dealer_address').val(data[i1]['address']);
            }
        },
        error: function () {
            alert('Error fetching here');
        }
    });
}

function short_code() {

    var item_creation_id = $("#item_creation_id").val();
    // alert(item_creation_id);
    $("#short_code_id").empty();
    $("#short_code_id").append('<option value="">Select short name </option>');
    var sendInfo = {
        action: "getshortcode",
        item_creation_id: item_creation_id,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
// console.log(data);
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


function getopeningstock() {

    var stock_entry_date = $("#stock_entry_date").val();
    var dealer_creation_id = $("#dealer_creation_id").val();
    var item_creation_id = $("#item_creation_id").val();
    var short_code_id = $("#short_code_id").val();
    var item_property = $("#item_property").val();
    var item_weights = $("#item_weights").val();

    var sendInfo = {
        action: "getopeningstock",
        stock_entry_date: stock_entry_date,
        dealer_creation_id: dealer_creation_id,
        item_creation_id: item_creation_id,
        short_code_id:short_code_id,
        item_property: item_property,
        item_weights: item_weights,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            stock_count = data;
            $('#current_stock').val(stock_count);
            getitempieces(item_creation_id, stock_count);
        },
        error: function () {
            alert('Error fetching Opening Stock');
        }
    });
}

function getitempieces(item_creation_id,stock_count) {

    var sendInfo = {
        action: "getitempieces",
        item_creation_id: item_creation_id,
        stock_count: stock_count,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $('#pieces_quantity').val(data);
        },
        error: function () {
            alert('Error fetching Pieces');
        }
    });
}

function getdearlername() {

    var sales_exec = $("#sales_exec").val();

    $("#dealer_creation_id").empty();
    $("#dealer_creation_id").append('<option value="">Select dealer Name</option>');
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

function insert_update_row(
    id,
    stock_entry_date,
    dealer_creation_id,
    dealer_address,
    order_no,
    status,
    description,
    sales_exec
) {

    var item_creation_id = $("#item_creation_id").val();
    var short_code_id = $("#short_code_id").val();
    var item_property = $("#item_property").val();
    var item_weights = $("#item_weights").val();
    var opening_stock = $("#opening_stock").val();
    var current_stock = $("#current_stock").val();
    var pieces_quantity = $("#pieces_quantity").val();
    if ((dealer_creation_id)) {

        if (id == "") {
            if ((item_creation_id) && (short_code_id)&& (item_property) && (item_weights) && (opening_stock)) {
                var sendInfo = {
                    action: "insert",
                    stock_entry_date: stock_entry_date,
                    dealer_creation_id: dealer_creation_id,
                    dealer_address: dealer_address,
                    order_no: order_no,
                    status: status,
                    description: description,
                    sales_exec: sales_exec,
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
            }
            else { validate_sub_inputs(item_creation_id,short_code_id, item_property, item_weights, opening_stock); }
        } else {
            var sendInfo = {
                action: "update",
                id: id,
                stock_entry_date: stock_entry_date,
                dealer_creation_id: dealer_creation_id,
                dealer_address: dealer_address,
                order_no: order_no,
                status: status,
                description: description,
                sales_exec: sales_exec,
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
    } else { validate_inputs(sales_exec,dealer_creation_id); }
}

function validate_inputs(sales_exec,dealer_creation_id) {

    if (sales_exec === '') { $("#sales_exec").addClass('is-invalid'); $("#sales_exec_validate_div").html("Select Sales Executive "); return false; } else { $("#sales_exec").removeClass('is-invalid'); $("#sales_exec_validate_div").html(""); }

    if (dealer_creation_id === '') { $("#dealer_creation_id").addClass('is-invalid'); $("#dealer_creation_id_validate_div").html("Select Dealer Name"); return false; } else { $("#dealer_creation_id").removeClass('is-invalid'); $("#dealer_creation_id_validate_div").html(""); }
}

function insert_update_sub_row(
    main_id,
    id,
    item_creation_id,
    item_property,
    item_weights,
    opening_stock,
    current_stock,
    pieces_quantity
) {

    if ((item_creation_id) && (item_property) && (item_weights) && (opening_stock)) {
        if (id == "" && main_id == "") {
            var sales_exec = $("#sales_exec").val(),
                dealer_address = $("#dealer_address").val(),
                stock_entry_date = $("#stock_entry_date").val(),
                dealer_creation_id = $("#dealer_creation_id").val(),
                order_no = $("#order_no").val(),
                status = $("#status1").val(),
                description = $("#description").val(),
                short_code_id = $("#short_code_id").val()

            if (
                sales_exec && dealer_creation_id
            ) {
                var sendInfo = {
                    action: "insert_sub",
                    main_id: main_id,
                    stock_entry_date: stock_entry_date,
                    dealer_creation_id: dealer_creation_id,
                    dealer_address: dealer_address,
                    order_no: order_no,
                    status: status,
                    description: description,
                    sales_exec: sales_exec,
                    item_creation_id: item_creation_id,
                    short_code_id:short_code_id,
                    item_property: item_property,
                    item_weights: item_weights,
                    opening_stock,
                    current_stock,
                    pieces_quantity,
                };
                $.ajax({
                    type: "GET",
                    url: $("#CUR_ACTION").val(),
                    data: sendInfo,
                    success: function (data) {
                        // alert(short_code_id);
                        console.log(short_code_id);
                        list_div();
                        $("#bd-example-modal-lg1 #model_main_content").html("...");
                        var sendInfo1 = { action: "update_form", id: data };
                        $.ajax({
                            type: "GET",
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
            else { validate_inputs(sales_exec,dealer_creation_id); }
        } else {
            var sendInfo = [];
            if (id == "") {
                sendInfo = {
                    action: "insert_sub",
                    main_id: main_id,
                    item_creation_id: item_creation_id,
                    short_code_id:short_code_id,
                    item_property: item_property,
                    item_weights: item_weights,
                    opening_stock: opening_stock,
                    current_stock: current_stock,
                    pieces_quantity: pieces_quantity,
                };
            } else {
                sendInfo = {
                    action: "update_sub",
                    id: id,
                    item_creation_id: item_creation_id,
                    short_code_id:short_code_id,
                    item_property: item_property,
                    item_weights: item_weights,
                    opening_stock: opening_stock,
                    current_stock: current_stock,
                    pieces_quantity: pieces_quantity,
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
    } else { validate_sub_inputs(item_creation_id, short_code_id,item_property, item_weights, opening_stock); }
}
function validate_sub_inputs(
    item_creation_id,
    item_property,
    item_weights,
    opening_stock
) {
    if (item_creation_id === "") {
        $("#item_creation_id").addClass("is-invalid");
        $("#item_creation_id_validate_div").html("Select Item Name");
        return false;
    } else {
        $("#item_creation_id").removeClass("is-invalid");
        $("#item_creation_id_validate_div").html("");
    }
    if (item_property === "") {
        $("#item_property").addClass("is-invalid");
        $("#item_property_validate_div").html("Select Packing Type");
        return false;
    } else {
        $("#item_property").removeClass("is-invalid");
        $("#item_property_validate_div").html("");
    }
    if (item_weights === "") {
        $("#item_weights").addClass("is-invalid");
        $("#item_weights_validate_div").html("Select UOM");
        return false;
    } else {
        $("#item_weights").removeClass("is-invalid");
        $("#item_weights_validate_div").html("");
    }
    if (opening_stock === "") {
        $("#opening_stock").addClass("is-invalid");
        $("#opening_stock_validate_div").html("Enter Opening Stock");
        return false;
    } else {
        $("#opening_stock").removeClass("is-invalid");
        $("#opening_stock_validate_div").html("");
    }

}
function delete_row(id) {
    swal({
        title: "Are you sure?",
        text: "To delete Order Stock ",
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
