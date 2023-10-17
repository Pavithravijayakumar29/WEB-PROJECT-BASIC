
//
function list_div(from_date,to_date,manager_name,sales_name,dealer_name,tally_no,ledger_dr) {

    $("#list_div").html("");
    var _token=$("#_token").val();
    var sendInfo = {
        _token:_token,"action": "retrieve", "from_date": from_date, "to_date": to_date,"manager_name":manager_name,"sales_name":sales_name,"dealer_name": dealer_name,"tally_no": tally_no,"ledger_dr":ledger_dr,"user_rights_edit_1": user_rights_edit_1, "user_rights_delete_1": user_rights_delete_1
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
    list_div("", "", "", "");
});
function find_sales_ref()
{

  var manager_id = $("#manager_name").val();

  var sendInfo={"action":"getSalesRef","manager_id":manager_id};
    if (manager_id) {
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
          $('#sales_name').empty();
          $('#sales_name').append('<option  value="">Select Sales Executive</option>');
          for(let i1=0;i1 < data.length;i1++){
            $('#sales_name').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['sales_ref_name'] + '</option>');
       }
        }
      });
    } else {
      $('#sales_ref_id').empty();

    }

}
function getsalesrep_dealername() {
    var sales_exec = $("#sales_name").val();

    var sendInfo = {
        action: "getsalesrep_dealername",
        sales_exec: sales_exec,
    };
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function (data) {
            $("#dealer_name").empty();
            $("#dealer_name").append(
                '<option value="">Select Dealer Name</option>'
            );
            for (let i1 = 0; i1 < data.length; i1++) {
                $("#dealer_name").append('<option value="' + data[i1]["id"] + '">' + data[i1]["dealer_name"] + "</option>");
            }
        },
        error: function () {
            alert("Error fetching Dealer Name");
        },
    });
}
function gettallynumber(){

    var dealer_creation_id = $("#dealer_name").val();
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
