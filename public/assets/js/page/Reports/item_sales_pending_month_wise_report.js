function list_div(from_date,to_date,sales_ref_id,item_id,manager_id,group_id)
{
  $('#list_div').html("");
  var sendInfo={"action":"retrieve","from_date":from_date,"to_date":to_date,"sales_ref_id":sales_ref_id,"item_id":item_id,"manager_id":manager_id,"group_id":group_id};
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
      $('#item_id').empty();         
      $('#item_id').append('<option  value="">Select</option>');
      for(let i1=0;i1 < data.length;i1++){
        $('#item_id').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['item_name'] + '</option>');
      }
    },
    error: function () {
        alert("Error fetching Group Name");
    },
  });
}