function list_div(from_date,sales_ref_id,dealer_id,item_id,manager_id,group_id)
{
    var fr_date = $("#from_date").val();
  $('#list_div').html("");
  var sendInfo={"action":"retrieve","from_date":fr_date,"sales_ref_id":sales_ref_id,"dealer_id":dealer_id,"item_id":item_id,"manager_id":manager_id,"group_id":group_id};
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




function find_dealer_name()
{

  var sales_ref_id = $("#sales_ref_id").val();

  //alert(countryId)

  var sendInfo={"action":"getDealerName","sales_ref_id":sales_ref_id};
    if ( sales_ref_id ) {

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


$(function () {
  list_div('','','','','');
  find_sales_ref();

  find_dealer_name();

});

function get_item()
{

  var group_id = $("#group_id").val();

  //alert(countryId)

  var sendInfo={"action":"getitemName","group_id":group_id};
    if ( sales_ref_id ) {

      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
          $('#item_id').empty();

          $('#item_id').append('<option  value="" readonly>---Select---</option>');
          for(let i1=0;i1 < data.length;i1++){
            $('#item_id').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['item_name'] + '</option>');
       }
        }
      });
    } else {
      $('#dealer_id').empty();

    }

}
