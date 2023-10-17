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
                        columns: [0, 1, 2 ]
                    }
                },
                {
                    extend: 'pdf',
                    text: 'PDF',
                    //text: '<i class="far fa-file-pdf"></i>',
                    exportOptions: {
                        columns: [0, 1, 2 ]
                    }
                },
                {
                    extend: 'print',
                    text: 'Print',
                    exportOptions: {
                        columns: [0, 1, 2 ]
                    }
                }
            ]
        });
    });
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
function insert_update_row(id,ledger_name,description)
{
  if(id=="")
  {
    var sendInfo={"action":"insert","ledger_name":ledger_name,"description":description};
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(response) {
            $('#bd-example-modal-lg1').modal('hide');
            if (response.error) {
                swal(response.error, { icon: 'error' });
            } else {
                var message = response.message || 'insert successfully';
                swal(message, { icon: 'success' });
                list_div();
            }
        },
        error: function() {
            alert('Error handling here');
        }
    });
  }
  else
  {
    var sendInfo={"action":"update","id":id,"ledger_name":ledger_name,"description":description};
    $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(response) {
            $('#bd-example-modal-lg1').modal('hide');
            if (response.error) {
                swal(response.error, { icon: 'error' });
            } else {
                swal('Updated Successfully', { icon: 'success' });
                list_div();
            }
        },
        error: function() {
            alert('Error handling here');
        }
    });
  }
}
function delete_row(id)
{
  swal({
    title: 'Are you sure?',
    text: 'To delete Ledger Name',
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
