
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
    },
    error: function() {
      alert('error handing here');
    }
  });
}
$(function () {
  list_div();
});
function open_model(title,id)
{

  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={};
  if(id==""){sendInfo={"action":"create_form"};}
  else{sendInfo={"action":"update_form","id":id};}
  $.ajax({
    type: "GET",
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
function insert_update_row(id,state_id,district_id,area_name,description)
{

  if(id==""){
  if((state_id)&&(district_id)&&(area_name)){

    var sendInfo={"action":"insert","state_id":state_id,"district_id":district_id,"area_name":area_name,"description":description};
    $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
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
else{validate_inputs(state_id,district_id,area_name);}
  }
  else
  {
    if((state_id)&&(district_id)&&(area_name)){
    var sendInfo={"action":"update","id":id,"state_id":state_id,"district_id":district_id,"area_name":area_name,"description":description};
    $.ajax({
      type: "GET",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
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
else{validate_inputs(state_id,district_id,area_name);}
  }
}
function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Market Creation',
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


function getDistricts() {
    var stateId = $("#state_id").val();

    var sendInfo = {"action": "getDistricts", "state_id": stateId};

    if (stateId) {
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        dataType: "json",
        success: function(data) {
          $('#district_id1').empty();
          $('#district_id1').append('<option value="" readonly>-----select district-----</option>');
          $.each(data, function(index, district) {
            $('#district_id1').append('<option value="' + district.id + '">' + district.district_name + '</option>');
          });
        }
      });
    } else {
      $('#district_id1').empty();
    }
  }


// function getDistricts() {
//     var stateId = $("#state_id").val();

//     // Clear previous district options
//     $("#district_id1").empty();
//     $("#district_id1").append('<option value="">Select District</option>');

//     if (stateId === '') {
//         // No state selected, exit the function
//         return;
//     }

//     var _token = $("#_token").val();
//     var sendInfo = { "_token": _token, "action": "getDistricts", "state_id": stateId };

//     $.ajax({
//         type: "GET",
//         url: $("#CUR_ACTION").val(),
//         data: sendInfo,
//         dataType: "json",
//         success: function(data) {
//             $('#district_id1').empty();
//             for(let i1=0;i1 < data.length;i1++){
//               $('#district_id1').append('<option value="' + data[i1]['id'] + '">' + data[i1]['district_name'] + '</option>');
//             }
//             /* $.each(data, function(key, value) {
//               $('#district_id').append('<option value="' + key + '">' + value + '</option>');
//             }); */
//         },
//         error: function() {
//             alert('Error fetching districts');
//         }
//     });
// }


function validate_inputs(state_id,district_id,area_name)
{
  if(state_id==='') { $("#state_id").addClass('is-invalid');$("#state_id_validate_div").html("Select State Name"); return false;} else {$("#state_id").removeClass('is-invalid');$("#state_id_validate_div").html("");}


  if(district_id==='') { $("#district_id").addClass('is-invalid');$("#district_id_validate_div").html("Select District Name"); return false;} else {$("#district_id").removeClass('is-invalid');$("#district_id_validate_div").html("");}

  if(area_name==='') { $("#area_name").addClass('is-invalid');$("#area_name_validate_div").html("Enter Area Name"); return false;} else {$("#area_name").removeClass('is-invalid');$("#area_name_validate_div").html("");}

}





