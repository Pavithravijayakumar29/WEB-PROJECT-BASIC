<link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr>
        <th>Sno</th>
        <th>Market Manager Name</th>
        <th>Sales Rep Name</th>
        <th>Mobile Number</th>
        <th>Status</th>

        <th>Image</th>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <th class="text-center">Action</th>
            <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($sales_rep_creation as $sales_rep_creation1)
    { ?>
    <tr>
        <td><?php echo $i1;$i1++; ?></td>
        <td><?php echo $sales_rep_creation1['manager_name']; ?></td>
        <td><?php echo $sales_rep_creation1['sales_ref_name']; ?></td>
        <td><?php echo $sales_rep_creation1['mobile_no']; ?></td>
        <td align="center" class="stl">
            <div class="pretty p-default p-curve p-toggle">
                <input type="checkbox" <?php if ($sales_rep_creation1['status']=="0"){ echo 'checked'; }else{ } ?> onclick="change_fun('<?php echo $sales_rep_creation1['id']; ?>','<?php echo $sales_rep_creation1['status']; ?>')">
                <div class="state p-success p-on">
                  <label style="color: green">Active</label>
                </div>
                <div class="state p-danger p-off">
                  <label style="color: red">In Active </label>
                </div>
              </div>
        </td>


        <td>
            <img src="{{ $sales_rep_creation1['image_name'] != '' ? asset('storage/barang/' . $sales_rep_creation1['image_name']) : asset('storage/barang/default_image.png') }}"
                width="35" height="35" alt="Image Preview"
                data-toggle="popover"
                data-trigger="hover"
                data-html="true"
                data-content='<img src="{{ $sales_rep_creation1["image_name"] != "" ? asset("storage/barang/" . $sales_rep_creation1["image_name"]) : asset("storage/barang/default_image.png") }}" width="150" height="150" alt="Image Preview">'
                >
        </td>

        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <td align="center">
                <?php if($user_rights_edit_1==1){ ?>
        <a class="btn btn-icon icon-left btn-info hover-gradient" data-toggle="tooltip" style="cursor: pointer" title="Edit" onclick="open_model('Update Sales Rep Creation','<?php echo $sales_rep_creation1['id']; ?>')"><i class="far fa-edit"></i>Edit</a>
        <?php } ?>
        <?php if($user_rights_delete_1==1){ ?>
        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_row('<?php echo $sales_rep_creation1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
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

    function change_fun(id,status){
        var _token=$("#_token2").val();
      var sendInfo={"_token":_token,"action":"statusinfo","id":id,"status":status};
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
