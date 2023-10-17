function list_div(from_date,to_date,dealer_id,beats_id,shop_id)
{
  $('#list_div').html("");
  var sendInfo={"action":"retrieve","from_date":from_date,"to_date":to_date,"dealer_id":dealer_id,"beats_id":beats_id,"shop_id":shop_id};
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
  list_div('','','','','');
});
