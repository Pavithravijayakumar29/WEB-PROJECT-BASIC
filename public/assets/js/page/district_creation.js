function list_div()
{

  $('#list_div').html("");
  var sendInfo = {  "action": "retrieve" ,"user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
  $.ajax({
    type: "GET",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function (data) {
      $('#list_div').html(data);
      $(function () {
        $('#tableExport').DataTable({
            "dom": 'lBfrtip',
            "buttons": [
                {
                    extend: 'excel',
                    text: 'Excel',
                    exportOptions: {
                        columns: [0, 1, 2,3,4 ]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    //text: '<i class="far fa-file-pdf"></i>',
                    exportOptions: {
                        columns: [0, 1, 2,3,4 ]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2,3,4 ]
                    }
                }
            ]
        });
    });
    }
  });
}
$(function () {
  find_state();
  list_div();

});
function open_model(title,id)
{

    var countryId=$("#country_id").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
  if(id==""){sendInfo={"action":"create_form"};}
  else{sendInfo={"country_id":countryId,"action":"update_form","id":id};}
  $.ajax({
    type: "GET",
    url:$("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html(title);
      $('#bd-example-modal-lg1 #model_main_content').html(data);
      setTimeout(function (){
        $("#country_id").select2();
        $("#state_id").select2();
      }, 500);

    },
    error: function() {
      alert('error handing here');
    }
  });
}




function insert_update_row(id,country_id,state_id,district_name,description)
{

  if (id == "") {
    if ((country_id) && (state_id) && (district_name)) {
      var sendInfo = {  "action": "insert", "country_id": country_id, "state_id": state_id, "district_name": district_name, 'description': description };
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(response){
            $('#bd-example-modal-lg1').modal('hide');
            if (response.error) {
                swal(response.error, { icon: 'error' });
            } else {
                var message = response.message || ' inserted successfully';
                swal(message, { icon: 'success' });
                list_div();
            }
          },

        error: function () {
          alert('error handing here');
        }
      });
    } else {
      validate_inputs(country_id, state_id, district_name);
    }
  }
  else {
    if ((country_id) && (state_id) && (district_name)) {
      var sendInfo = {  "action": "update", "id": id, "country_id": country_id, "state_id": state_id, "district_name": district_name, 'description': description };
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(response){
            $('#bd-example-modal-lg1').modal('hide');
            if (response.error) {
                swal(response.error, { icon: 'error' });
            } else {
                var message = response.message || ' Update successfully';
                swal(message, { icon: 'success' });
                list_div();
            }
          },
        error: function () {
          alert('error handing here');
        }
      });
    } else {
      validate_inputs(country_id, state_id, district_name);
    }
  }
}
function validate_inputs(country_id,state_id,district_name){

  if (country_id == '') {
    $("#country_id_validate_div").html("Select Country Name");
    // swal('Please Select Country Name', { icon: 'info', });
    $("#country_id").focus();

    return false;
  } else {

    $("#country_id_validate_div").html("");
  }
  if (state_id == '') {
    $("#state_id_validate_div").html("Select State Name");
    // swal('Please Select State Name', { icon: 'info', });
    $("#state_id").focus();

    return false;
  } else {

    $("#state_id_validate_div").html("");
  }
  if (district_name == '') { $("#district_name").addClass('is-invalid'); $("#district_name_validate_div").html("Enter District Name"); return false; } else { $("#district_name").removeClass('is-invalid'); $("#district_name_validate_div").html(""); }


}
function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete User Creation',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {

      var sendInfo={"action":"delete","id":id};
      $.ajax({
        type: "GET",
        url:$("#CUR_ACTION").val(),
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


function find_state()
{

  var countryId = $("#country_id").val();
  //alert(countryId)

  var sendInfo={"action":"getStates","country_id":countryId};
    if (countryId) {
      $.ajax({
        type: "GET",
        url:$("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
          $('#state_id').empty();
          $('#state_id').append('<option value="" readonly>-----select state-----</option>');
          $.each(data, function(key, value) {
            $('#state_id').append('<option value="' + key + '">' + value + '</option>');
          });
        }
      });
    } else {
      $('#state_id').empty();
    }

}
