function list_div(from_date_1, to_date_1, sales_exec, dealer_creation_id_1,manager_na,order_shop,item_name_1,group_id) {
    $("#list_div").html("");
    var _token=$("#_token").val();
    var sendInfo = {
        _token:_token,"action": "retrieve", "from_date_1": from_date_1, "to_date_1": to_date_1, "sales_exec": sales_exec, "dealer_creation_id_1": dealer_creation_id_1,'manager_na':manager_na,'order_shop':order_shop,'item_name_1':item_name_1,'group_id':group_id,"user_rights_edit_1": user_rights_edit_1, "user_rights_delete_1": user_rights_delete_1
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
    list_div("", "", "", "", "", "", "", "");
});

function sales_mang(){

    var manager_na = $("#manager_na").val();
    var _token=$("#_token").val();
    $("#sales_exec").empty();
    $("#sales_exec").append('<option value="">Select dealer Name</option>');
    var sendInfo = {
        _token:_token,
        action: "getsalesexec",
        manager_na: manager_na,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {

            $('#sales_exec').empty();
            $('#sales_exec').append('<option value="">Select dealer Name</option>');
            for (let i1 = 0; i1 < data.length; i1++) {
                $('#sales_exec').append('<option value="' + data[i1]['id'] + '">' + data[i1]['sales_ref_name'] + '</option>');
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

function find_item_id()
{
  var group_id = $("#group_id").val();
  var sendInfo={"action":"getitemname","group_id":group_id};
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    dataType: "json",
    success: function(data) {
      $('#item_name_1').empty();         
      $('#item_name_1').append('<option  value="">Select</option>');
      for(let i1=0;i1 < data.length;i1++){
        $('#item_name_1').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['item_name'] + '</option>');
      }
    },
    error: function () {
        alert("Error fetching Group Name");
    },
  });
}
