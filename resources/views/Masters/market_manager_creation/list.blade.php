<link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr class="stl">
        <th>Sno</th>
        <th>Manager Id</th>
        <th>Manager Name</th>
        <th>Contact No</th>
        <th>WhatsApp No</th>
        <th>Image</th>
        <th>status1</th>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <th class="text-center">Action</th>
            <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($market_manager_creation as $market_manager_creation1)
    { ?>
    <tr>
        <td class="stl"><?php echo $i1;$i1++; ?></td>
        <td class="stl"><?php echo $market_manager_creation1['manager_no']; ?></td>
        <td class="stl"><?php echo  ucfirst($market_manager_creation1['manager_name']); ?></td>
        <td class="stl"><?php echo $market_manager_creation1['contact_no']; ?></td>
        <td class="stl"><?php echo $market_manager_creation1['whatsapp_no']; ?></td>
        <td>
            <img src="{{ $market_manager_creation1['image_name'] != '' ? asset('storage/employee_images/'.$market_manager_creation1['image_name']) : asset('storage/employee_images/default_image.png') }}"
            width="35" height="35" alt="Image Preview"
            data-toggle="popover"
            data-trigger="hover"
            data-html="true"
            data-content='<img src="{{ $market_manager_creation1["image_name"] != "" ? asset("storage/employee_images/".$market_manager_creation1["image_name"]) : asset("storage/employee_images/default_image.png") }}" width="150" height="150" alt="Image Preview">'
            >
        </td>
        <td align="center" class="stl">
            <div class="pretty p-default p-curve p-toggle">
                <input type="checkbox" <?php if ($market_manager_creation1['status1']=="0"){ echo 'checked'; }else{ } ?> onclick="change_fun('<?php echo $market_manager_creation1['id']; ?>','<?php echo $market_manager_creation1['status1']; ?>')">
                <div class="state p-success p-on">
                  <label style="color: green">Active</label>
                </div>
                <div class="state p-danger p-off">
                  <label style="color: red">In Active </label>
                </div>
              </div>
        </td>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <td align="center" class="stl">
                <?php if($user_rights_edit_1==1){ ?>
        <a class="btn btn-icon icon-left btn-info" data-toggle="tooltip" style="cursor: pointer" title="Edit" onclick="open_model('Update Manager Creation','<?php echo $market_manager_creation1['id']; ?>')"><i class="far fa-edit"></i>Edit</a>
        <?php } ?>
        <?php if($user_rights_delete_1==1){ ?>
        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_row('<?php echo $market_manager_creation1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
    </td>
    <?php } ?>
</td>
<?php } ?>
</tr>
<?php } ?>
    </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        // Initialize the popovers
        $('[data-toggle="popover"]').popover();
    });

    function change_fun(id,status1){
        var _token1=$("#_token1").val();
      var sendInfo={"_token":_token1,"action":"statusinfo","id":id,"status1":status1};
      $.ajax({
        type: "POST",
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
