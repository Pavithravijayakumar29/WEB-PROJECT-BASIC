function list_div()
{
  var _token1=$("#_token1").val();
  $('#list_div').html("");
  var sendInfo={"_token":_token1,"action":"retrieve","user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
  $.ajax({
    type: "POST",
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
                        columns: [0, 1, 2,3 ]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    //text: '<i class="far fa-file-pdf"></i>',
                    exportOptions: {
                        columns: [0, 1, 2,3 ]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2,3 ]
                    }
                }
            ]
        });
    });
    },
    error: function() {
      alert('error handing here');
    }
  });
}
$(function () {
  list_div();
});

function open_beats(tittle,id)
{
  var _token1=$("#_token1").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
  sendInfo={"_token":_token1,"action":"beats_form","id":id};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      console.log(data)
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(tittle);
      $('#bd-example-modal-lg1 #model_main_content').html(data);
    },
    error: function() {
      alert('error handing here');
    }
  });
}

function open_view(tittle,id)
{
  var _token1=$("#_token1").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
  sendInfo={"_token":_token1,"action":"view_form","id":id};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      console.log(data)
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(tittle);
      $('#bd-example-modal-lg1 #model_main_content').html(data);
    },
    error: function() {
      alert('error handing here');
    }
  });
}

function open_shops(tittle,beats_id,dealer_id)
{
  var _token1=$("#_token1").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
  sendInfo={"_token":_token1,"action":"shops_form","beats_id":beats_id,"dealer_id":dealer_id};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      console.log(data)
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(tittle);
      $('#bd-example-modal-lg1 #model_main_content').html(data);
      load_model_sublist(beats_id,dealer_id);
    },
    error: function() {
      alert('error handing here');
    }
  });
}

function load_model_sublist(beats_id,dealer_id)
{
  var _token1=$("#_token1").val();
  $('#bd-example-modal-lg1 #sublist_div').html("...");
  var sendInfo={"_token":_token1,"action":"shop_sublist","beats_id":beats_id,"dealer_id":dealer_id};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1 #sublist_div').html(data);
    }
  });
}

function open_shop_update(title,id,beats_id,dealer_id)
{
  var _token1=$("#_token1").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
 sendInfo={"_token":_token1,"action":"shop_update_form","id":id,"beats_id":beats_id,"dealer_id":dealer_id};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(title);
      $('#bd-example-modal-lg1 #model_main_content').html(data);
      load_model_sublist(beats_id,dealer_id);
    },
    error: function() {
      alert('error handing here');
    }
  });
}
function open_model(title,id)
{
  var _token1=$("#_token1").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
  if(id==""){sendInfo={"_token":_token1,"action":"create_form"};}
  else{sendInfo={"_token":_token1,"action":"update_form","id":id};}
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(title);
      $('#bd-example-modal-lg1 #model_main_content').html(data);
    },
    error: function() {
      alert('error handing here');
    }
  });
}
function insert_update_row(id,sales_rep_id,dealer_name,mobile_no,whatsapp_no,address,place,pan_no,gst_no,aadhar_no,driving_licence,bank_name,check_no,state_id,district_id,area_id,manager_id)
{

  const state_idSelect = document.getElementById('state_id');
      const selectedstate_id = [];
      for (let i = 0; i < state_idSelect.options.length; i++) {
        if (state_idSelect.options[i].selected) {
          selectedstate_id.push(state_idSelect.options[i].value);
        }
      }
    var state_id_sub = selectedstate_id.join(',');

    const district_idSelect = document.getElementById('district_id');
    const selecteddistrict_id = [];
    for (let i = 0; i < district_idSelect.options.length; i++) {
      if (district_idSelect.options[i].selected) {
        selecteddistrict_id.push(district_idSelect.options[i].value);
      }
    }
    var district_id_sub = selecteddistrict_id.join(',');

    const area_idSelect = document.getElementById('area_id');
      const selectedarea_id = [];
      for (let i = 0; i < area_idSelect.options.length; i++) {
        if (area_idSelect.options[i].selected) {
          selectedarea_id.push(area_idSelect.options[i].value);
        }
      }
      var area_id_sub = selectedarea_id.join(',');

  var _token1=$("#_token1").val();
  if(id=="")
  {
    if((dealer_name)&&(whatsapp_no)&&(address)){
        var formData = new FormData();
        formData.append("action", "insert");
        formData.append("sales_rep_id", sales_rep_id);
        formData.append("dealer_name", dealer_name);
        formData.append("mobile_no", mobile_no);
        formData.append("whatsapp_no", whatsapp_no);
        formData.append("address", address);
        formData.append("place", place);
        formData.append("pan_no", pan_no);
        formData.append("gst_no", gst_no);
        formData.append("aadhar_no", aadhar_no);
        formData.append("driving_licence", driving_licence);
        formData.append("bank_name", bank_name);
        formData.append("check_no", check_no);
        formData.append("state_id", state_id_sub);
        formData.append("district_id", district_id_sub);
        formData.append("area_id", area_id_sub);
        formData.append("manager_id", manager_id);
        formData.append("image_name", $("#image_name")[0].files[0]);
        formData.append("_token", _token1);
    $.ajax({
      type: "POST",
      url: $("#CUR_ACTION").val(),
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        $('#bd-example-modal-lg1').modal('hide');
        swal('Inserted Successfully', {icon: 'success',});
        list_div();
      },
      error: function() {
        alert('error handing here');
      }
    });
  }
  else{validate_inputs(dealer_name,whatsapp_no,address);}
  }
  else
  {
    if((dealer_name)&&(whatsapp_no)&&(address)){
        var formData = new FormData();
        formData.append("action", "update");
        formData.append("id", id);
        formData.append("sales_rep_id", sales_rep_id);
        formData.append("dealer_name", dealer_name);
        formData.append("mobile_no", mobile_no);
        formData.append("whatsapp_no", whatsapp_no);
        formData.append("address", address);
        formData.append("place", place);
        formData.append("pan_no", pan_no);
        formData.append("gst_no", gst_no);
        formData.append("aadhar_no", aadhar_no);
        formData.append("driving_licence", driving_licence);
        formData.append("bank_name", bank_name);
        formData.append("check_no", check_no);
        formData.append("state_id", state_id_sub);
        formData.append("district_id", district_id_sub);
        formData.append("area_id", area_id_sub);
        formData.append("manager_id", manager_id);
        formData.append("image_name", $("#image_name")[0].files[0]);
        formData.append("_token", _token1);
    $.ajax({
      type: "POST",
      url: $("#CUR_ACTION").val(),
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        $('#bd-example-modal-lg1').modal('hide');
        swal('Updated Successfully', {icon: 'success',});
        list_div();
      },
      error: function() {
        alert('error handing here');
      }
    });
  }
  else{validate_inputs(dealer_name,whatsapp_no,address);}
  }
}

function validate_inputs(dealer_name,whatsapp_no,address)
{
  if(dealer_name==='') { $("#dealer_name").addClass('is-invalid');$("#dealer_name_validate_div").html("Select Dealer Name"); return false;} else {$("#dealer_name").removeClass('is-invalid');$("#dealer_name_validate_div").html("");}

  if(whatsapp_no==='') { $("#whatsapp_no").addClass('is-invalid');$("#whatsapp_no_validate_div").html("Enter WhatsApp No"); return false;} else {$("#whatsapp_no").removeClass('is-invalid');$("#whatsapp_no_validate_div").html("");}

  if(address==='') { $("#address").addClass('is-invalid');$("#address_validate_div").html("Enter Address"); return false;} else {$("#address").removeClass('is-invalid');$("#address_validate_div").html("");}
}

function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Dealer Creation',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      var _token1=$("#_token1").val();
      var sendInfo={"_token":_token1,"action":"delete","id":id};
      $.ajax({
        type: "POST",
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

function delete_shop_row(id,beats_id,dealer_id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Shop Creation',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      var _token1=$("#_token1").val();
      var sendInfo={"_token":_token1,"action":"shop_delete","id":id,"beats_id":beats_id,"dealer_id":dealer_id};
      $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data){
          open_shops('Shops Creation',beats_id,dealer_id);
          swal('Deleted Successfully', {icon: 'success',});
        },
        error: function() {
          alert('error handing here');
        }
      });
    }
  });
}

function shop_insert_update_row(id,shop_type_id,shop_name,beats_id,dealer_id,mobile_no,whatsapp_no,address,gst_no,language)
{
  var _token1=$("#_token1").val();
  if(id=="")
  {
    if((shop_name)){
        var formData = new FormData();
        formData.append("action", "shop_insert");
        formData.append("shop_type_id", shop_type_id);
        formData.append("shop_name", shop_name);
        formData.append("beats_id", beats_id);
        formData.append("dealer_id", dealer_id);
        formData.append("mobile_no", mobile_no);
        formData.append("whatsapp_no", whatsapp_no);
        formData.append("address", address);
        formData.append("gst_no", gst_no);
        formData.append("language", language);
        formData.append("image_name", $("#image_name")[0].files[0]);
        formData.append("_token", _token1);
    $.ajax({
      type: "POST",
      url: $("#CUR_ACTION").val(),
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        open_shops('Shops Creation',beats_id,dealer_id);
        swal('Inserted Successfully', {icon: 'success',})
      },
      error: function() {
        alert('error handing here');
      }
    });
  }
  else{shop_validate_inputs(shop_name);}
  }
  else
  {
    if((shop_name)){
        var formData = new FormData();
        formData.append("action", "shop_update");
        formData.append("id", id);
        formData.append("shop_type_id", shop_type_id);
        formData.append("shop_name", shop_name);
        formData.append("mobile_no", mobile_no);
        formData.append("whatsapp_no", whatsapp_no);
        formData.append("address", address);
        formData.append("gst_no", gst_no);
        formData.append("language", language);
        formData.append("image_name", $("#image_name")[0].files[0]);
        formData.append("_token", _token1);
    $.ajax({
      type: "POST",
      url: $("#CUR_ACTION").val(),
      data: formData,
      processData: false,
      contentType: false,
      success: function(data){
        open_shops('Shops Creation',beats_id,dealer_id);
        swal('Updated Successfully', {icon: 'success',});
      },
      error: function() {
        alert('error handing here');
      }
    });
  }
  else{shop_validate_inputs(shop_name);}
  }
}

function shop_validate_inputs(shop_name)
{
  if(shop_name==='') { $("#shop_name").addClass('is-invalid');$("#shop_name_validate_div").html("Enter Shop Name"); return false;} else {$("#shop_name").removeClass('is-invalid');$("#shop_name_validate_div").html("");}


}

function getDistricts() {
    var stateIds = $("#state_id").val();

    // Clear previous district options
    $("#district_id").empty();
    $("#district_id").append('<option value="">Select District</option>');

    if (stateIds === null) {
        // No states selected, exit the function
        return;
    }

    var _token1 = $("#_token1").val();

    var sendInfo = {
        "_token": _token1,
        "action": "getDistricts",
        "state_id": stateIds
    };

    $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
            for (let i = 0; i < data.length; i++) {
                $('#district_id').append('<option value="' + data[i]['id'] + '">' + data[i]['district_name'] + '</option>');
            }
        },
        error: function() {
            alert('Error fetching districts');
        }
    });
}
function getArea() {
    var districtId = $("#district_id").val();
    // Clear previous district options
    $("#area_id").empty();
    $("#area_id").append('<option value="">Select Area</option>');

    if (districtId === '') {
        // No state selected, exit the function
        return;
    }

    var _token1 = $("#_token1").val();
    var sendInfo = { "_token": _token1,"action": "getArea", "district_id": districtId };

    $.ajax({
        type: "POST",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {

            for(let i1=0;i1 < data.length;i1++){

              $('#area_id').append('<option value="' + data[i1]['id'] + '">' + data[i1]['area_name'] + '</option>');
            }

        },
        error: function() {
            alert('Error fetching Area');
        }
    });
  }
