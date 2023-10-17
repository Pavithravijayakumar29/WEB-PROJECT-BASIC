function list_div()
{

  $('#list_div').html("");
  var sendInfo={"action":"retrieve","user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#list_div').html(data);
      $(function () {
        $('#tableExport').DataTable({
            "dom": 'lBfrtip',
            "buttons": [
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0, 1, 2,3,4,5 ]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    //text: '<i class="far fa-file-pdf"></i>',
                    exportOptions: {
                        columns: [0, 1, 2,3,4,5 ]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2,3,4,5 ]
                    }
                }
            ]
        });
    });
    }
  });
}
$(function () {
  find_group();
  list_div();

});

function open_model(title,id)
{

    var category_id=$("#category_id").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
  if(id==""){sendInfo={"action":"create_form"};}
  else{sendInfo={"category_id":category_id,"action":"update_form","id":id};}
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(title);
      $('#bd-example-modal-lg1 #model_main_content').html(data);
      setTimeout(function (){
        $("#category_id").select2();
        $("#group_id").select2();
      }, 500);

    },
    error: function() {
      alert('error handing here');
    }
  });
}

function insert_update_row(id,category_id,group_id,item_name,item_liters_type_id,item_properties_type_id,distributor_rate,description,hsn_code,piece,short_code)
{

  if(id=="")
  {
    if((category_id)&&(group_id)&&(item_name)&&(item_liters_type_id)&&(item_properties_type_id)&&(distributor_rate)&&(short_code)){

    var sendInfo={"action":"insert","category_id":category_id,"group_id":group_id,"item_name":item_name,'item_liters_type_id':item_liters_type_id,'item_properties_type_id':item_properties_type_id,"distributor_rate":distributor_rate,'description':description,'hsn_code':hsn_code,'piece':piece,'short_code':short_code};
    $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function(data){

        if(data ==''){
        $('#bd-example-modal-lg1').modal('hide');
        swal('Inserted Successfully', {icon: 'success',});
        list_div();
        }else{
          swal('Already Exit', {icon: 'error',});
        }

      },

      error: function() {
        alert('error handing here');
      }
    });
  }else{
    validate_inputs(category_id,group_id,item_name,item_liters_type_id,item_properties_type_id,distributor_rate,short_code);
  }
  }
  else
  {
    if((category_id)&&(group_id)&&(item_name)&&(item_liters_type_id)&&(item_properties_type_id)&&(distributor_rate)&&(short_code)){

    var sendInfo={"action":"update","id":id,"category_id":category_id,"group_id":group_id,"item_name":item_name,'item_liters_type_id':item_liters_type_id,'item_properties_type_id':item_properties_type_id,"distributor_rate":distributor_rate,'description':description,'hsn_code':hsn_code,'piece':piece,'short_code':short_code};
    $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function(data){

        if(data == ''){
        $('#bd-example-modal-lg1').modal('hide');
        swal('Updated Successfully', {icon: 'success',});
        list_div();
      }else{
        swal('Already Exit', {icon: 'error',});
      }
      },
      error: function() {
        alert('error handing here');
      }
    });
  }else{
    validate_inputs(category_id,group_id,item_name,item_liters_type_id,item_properties_type_id,distributor_rate,short_code);
  }
}
}
function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Item Creation',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      var sendInfo={"action":"delete","id":id};
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data){
          swal('Deleted Successfully', {icon: 'success',});
          list_div();
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
  });
}
function validate_inputs(category_id,group_id,item_name,item_liters_type_id,item_properties_type_id,distributor_rate,short_code)
{
  if(category_id==="")
   { $("#category_id").addClass('is-invalid');$("#category_id_validate_div").html("Select Category Name"); return false;
}
   else {$("#category_id").removeClass('is-invalid');$("#category_id_validate_div").html("");
}

  if(group_id==='') { $("#group_id").addClass('is-invalid');$("#group_id_validate_div").html("Select Group Name"); return false;} else {$("#group_id").removeClass('is-invalid');$("#group_id_validate_div").html("");}

  if(item_name==='') { $("#item_name").addClass('is-invalid');$("#item_name_validate_div").html("Enter Item Name"); return false;} else {$("#item_name").removeClass('is-invalid');$("#item_name_validate_div").html("");}

  if(short_code==="")
  { $("#short_code").addClass('is-invalid');$("#short_code_validate_div").html("Enter short code"); return false;
}
  else {$("#short_code").removeClass('is-invalid');$("#short_code_validate_div").html("");
}

//   if(item_code==='') { $("#item_code").addClass('is-invalid');$("#item_code_validate_div").html("Enter Item Code No"); return false;} else {$("#item_code").removeClass('is-invalid');$("#item_code_validate_div").html("");}

  if(item_liters_type_id==='') { $("#item_liters_type_id").addClass('is-invalid');$("#item_liters_type_id_validate_div").html("Select Item Liter"); return false;} else {$("#item_liters_type_id").removeClass('is-invalid');$("#item_liters_type_id_validate_div").html("");}

  if(item_properties_type_id==='') { $("#item_properties_type_id").addClass('is-invalid');$("#item_properties_type_id_validate_div").html("Select Item Property Name"); return false;} else {$("#item_properties_type_id").removeClass('is-invalid');$("#item_properties_type_id_validate_div").html("");}

//   if(tax_id==='') { $("#tax_id").addClass('is-invalid');$("#tax_id_validate_div").html("Select Tax Percentage"); return false;} else {$("#tax_id").removeClass('is-invalid');$("#tax_id_validate_div").html("");}

  if(distributor_rate==='') { $("#distributor_rate").addClass('is-invalid');$("#distributor_rate_validate_div").html("Enter Distributor Rate"); return false;} else {$("#distributor_rate").removeClass('is-invalid');$("#distributor_rate_validate_div").html("");}

//   if(sub_dealer_rate==='') { $("#sub_dealer_rate").addClass('is-invalid');$("#sub_dealer_rate_validate_div").html("Enter Sub Dealer Rate"); return false;} else {$("#sub_dealer_rate").removeClass('is-invalid');$("#sub_dealer_rate_validate_div").html("");}
}

function find_group()
{

  var category_id = $("#category_id").val();
  //alert(countryId)

  var sendInfo={"action":"getGroups","category_id":category_id};
    if (category_id) {
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
          $('#group_id').empty();
          $('#hsn_code').empty();
          $("#myDiv").text("");
          $('#group_id').append('<option  value="" readonly>---Select Group Name---</option>');
          for(let i1=0;i1 < data.length;i1++){
            $('#group_id').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['group_name'] + '</option>');
       }
        }
      });
    } else {
      $('#group_id').empty();
      $('#hsn_code').empty();
      $("#myDiv").text("");
    }

}

function find_hsn(){

  var category_id = $("#category_id").val();
  var group_id = $("#group_id");
  var group_id1 = $("#group_id").val();

  if(group_id1 != ""){
  const group_name =group_id.find("option:selected").text();

  //alert(countryId)

  var sendInfo={"action":"getHsnCode","category_id":category_id,"group_name":group_name};
    if (category_id) {
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
          $("#myDiv").text("HSN Code:"+data['hsn_code']);
          $("#hsn_code").val(data['hsn_code']);
//           $('#group_id').empty();

//        for(let i1=0;i1 < data.length;i1++){




// // for(i=0;i<=count(data);i++){}


//             $('#group_id').append('<option  value="' + data[i1]['id'] + '">' + data[i1]['group_name'] + '</option>');
//        }
        }
      });
    } else {
      $('#group_id').empty();
    }

  }else{
    $('#hsn_code').empty();
    $("#myDiv").text("");
  }
}
