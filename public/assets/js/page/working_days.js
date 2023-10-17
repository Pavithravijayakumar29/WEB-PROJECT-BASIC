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
function insert_update_row(id,month_year,actual_month_days,working_days,description)
{
    
  if(id=="")
  {
    if((month_year)&&(working_days)){
    var sendInfo={"action":"insert","month_year":month_year,"actual_month_days":actual_month_days,"working_days":working_days,"description":description};
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
  else{validate_inputs(month_year,working_days);}
  }
  else
  {
    if((month_year)&&(working_days)){
    var sendInfo={"action":"update","id":id,"month_year":month_year,"actual_month_days":actual_month_days,"working_days":working_days,"description":description};
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
  else{validate_inputs(month_year,working_days);}
  }
}

function validate_inputs(month_year,working_days)
{
  if(month_year==='') { $("#month_year").addClass('is-invalid');$("#month_year_validate_div").html("Select Month Year"); return false;} else {$("#month_year").removeClass('is-invalid');$("#month_year_validate_div").html("");}

  if(working_days==='') { $("#working_days").addClass('is-invalid');$("#working_days_validate_div").html("Enter Working Days"); return false;} else {$("#working_days").removeClass('is-invalid');$("#working_days_validate_div").html("");}
}

function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Working Days',
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

function countWorkingDays() {
  // Get the selected month from the input field
  var month_year = document.getElementById("month_year");
  var selectedMonth = new Date(month_year.value);

  var month_year = document.getElementById("month_year");
  var selectedMonth123 = new Date(month_year.value);
  var year123 = selectedMonth123.getFullYear();
  var month123 = selectedMonth123.getMonth() + 1; // Months are zero-based, so we add 1

  // Use the selected year and month to calculate the number of days
  var numberOfDays = new Date(year123, month123, 0).getDate();

  // Get the year and month values
  var year = selectedMonth.getFullYear();
  var month = selectedMonth.getMonth();

  // Create a date object for the first day of the selected month
  var startDate = new Date(year, month, 1);

  // Create a date object for the last day of the selected month
  var endDate = new Date(year, month + 1, 0);

  // Initialize the counter for working days
  var workingDays = 0;

  // Loop through each day in the selected month
  for (var date = startDate; date <= endDate; date.setDate(date.getDate() + 1)) {
    // Check if the current day is not a Sunday (0 is Sunday, 6 is Saturday)
    if (date.getDay() !== 0) {
      workingDays++;
    }
  }
  document.getElementById("actual_month_days").value = numberOfDays;
  document.getElementById("working_days").value = workingDays;

}
