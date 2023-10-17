function list_div(from_date_1,to_date_1,order_no_1,market_creation_id_1,dealer_creation_id_1,status_1)
{
  $('#list_div').html("");
  var sendInfo={"action":"retrieve","from_date_1":from_date_1,"to_date_1":to_date_1,"order_no_1":order_no_1,"market_creation_id_1":market_creation_id_1,"dealer_creation_id_1":dealer_creation_id_1,"status_1":status_1,"user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
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
