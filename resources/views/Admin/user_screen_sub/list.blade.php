<link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr class="stl">
        <th style="width: 5%">Sno</th>
        <th style="width: 15%">Screen Name</th>
        <th style="width: 15%">Sub Screen Name</th>
        <th style="width: 15%">Description</th>
        <th style="width: 15%" class="text-center">Status</th>
        <th class="text-center">Right Options</th>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
        <th class="text-center">Action</th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($user_screen_sub as $user_screen_sub1)
    { ?>
    <tr>
        <td class="stl"><?php echo $i1;$i1++; ?></td>
        <td class="stl"><?php echo ucfirst($user_screen_sub1['screen_name']); ?></td>
        <td class="stl"><?php echo ucfirst($user_screen_sub1['sub_screen_name']); ?></td>
        <td class="stl"><?php echo ucfirst($user_screen_sub1['description']); ?></td>
        <td align="center" class="stl">
            <div class="pretty p-default p-curve p-toggle">
                <input type="checkbox" <?php if ($user_screen_sub1['status']=="1"){ echo 'checked'; }else{ } ?> onclick="change_fun('<?php echo $user_screen_sub1['id']; ?>','<?php echo $user_screen_sub1['status']; ?>')">
                <div class="state p-success p-on">
                  <label style="color: green">Active</label>
                </div>
                <div class="state p-danger p-off">
                  <label style="color: red">In Active </label>
                </div>
              </div>
        </td>
        <td align="center" class="stl"><a class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Usertype Right Options" onclick="open_rights_model('<?php echo $user_screen_sub1['screen_name']; ?>','<?php echo $user_screen_sub1['sub_screen_name']; ?>','<?php echo $user_screen_sub1['user_screen_main_id']; ?>','<?php echo $user_screen_sub1['id']; ?>')"><i class="fas fa-cog"></i></a></td>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
        <td align="center">
        <?php if($user_rights_edit_1==1){ ?>
        <a class="btn btn-icon icon-left btn-info hover-gradient" data-toggle="tooltip" style="cursor: pointer" title="Edit" onclick="open_model('Update User Screen','<?php echo $user_screen_sub1['id']; ?>')"><i class="far fa-edit"></i>Edit</a>
        <?php } ?>
        <?php if($user_rights_delete_1==1){ ?>
        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_row('<?php echo $user_screen_sub1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
        <?php } ?>
        </td>
        <?php } ?>
    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>
<script>
$(function () {
    $('#tableExport').DataTable({
        "dom": 'lBfrtip',
        "buttons": [
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                //text: '<i class="far fa-file-pdf"></i>',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
            }
        ]
    });
});
function change_fun(id,status){
        // alert();
      var sendInfo={"action":"statusinfo","id":id,"status":status};
      $.ajax({
        type: "GET",
        url: $("#CUR_ACTION").val(),
        data: sendInfo,
        success: function(data){

        },
        error: function() {
          alert('error handing here');
        }
      });
    }
</script>
