function list_div(from_date,to_date,dealer_id)
{
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
  $('#list_div').html("");
  var manager_id = $("#manager_id").val();
  var sales_ref_id = $("#sales_ref_id").val();
  var dealer_id1 = $("#dealer_id").val();
  var sendInfo={"action":"retrieve","from_date":from_date,"to_date":to_date,"dealer_id":dealer_id1,"manager_id":manager_id,"sales_ref_id":sales_ref_id,"user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
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
  list_div();
});

function find_sales_ref()
{

  var manager_id = $("#manager_id").val();
  //alert(countryId)

  var sendInfo={"action":"getSalesRef","manager_id":manager_id};
    if (manager_id) {
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
          $('#sales_ref_id').empty();
          $('#sales_ref_id').append('<option  value="" readonly>---Select---</option>');
          for(let i1=0;i1 < data.length;i1++){
            $('#sales_ref_id').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['sales_ref_name'] + '</option>');
       }
        }
      });
    } else {
      $('#sales_ref_id').empty();

    }

}

function find_dealer()
{


  var sales_ref_id = $("#sales_ref_id").val();
  var manager_id = $("#manager_id").val();
  //alert(countryId)

  var sendInfo={"action":"getDealer","sales_ref_id":sales_ref_id,"manager_id":manager_id};
    if (sales_ref_id && manager_id) {
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
          $('#dealer_id').empty();
          $('#dealer_id').append('<option  value="" readonly>---Select---</option>');
          for(let i1=0;i1 < data.length;i1++){
            $('#dealer_id').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['dealer_name'] + '</option>');
       }
        }
      });
    } else {
      $('#dealer_id').empty();

    }

}
