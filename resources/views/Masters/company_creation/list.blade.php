<link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr class="stl">
        <th>Sno</th>
        <th>Company Name</th>
        <th>Company Address</th>
        <th>Mobile No</th>
        <th>GST No</th>
        <th>Status</th>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
        <th class="text-center">Action</th>
        <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($company_creation as $company_creation1)
    { ?>
    <tr align="center">
        <td class="stl"><?php echo $i1;$i1++; ?></td>
        <td class="stl"><?php echo  ucfirst($company_creation1['company_name']); ?></td>
        <td class="stl"><?php echo  ucfirst($company_creation1['address']); ?></td>
        <td class="stl"><?php echo $company_creation1['mobile_no']; ?></td>
        <td class="stl"><?php echo  ucfirst($company_creation1['gst_no']); ?></td>
        <td align="center" class="stl">
            <div class="pretty p-default p-curve p-toggle">
                <input type="checkbox" <?php if ($company_creation1['status1']=="1"){ echo 'checked'; }else{ } ?> onclick="change_fun('<?php echo $company_creation1['id']; ?>','<?php echo $company_creation1['status1']; ?>')">
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
        <a class="btn btn-icon icon-left btn-info" data-toggle="tooltip" title="Edit" onclick="open_model('Update Company Creation','<?php echo $company_creation1['id']; ?>')"><i class="far fa-edit"></i>Edit</a>
        <?php } ?>
        <?php if($user_rights_delete_1==1){ ?>
        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" title="Delete" onclick="delete_row('<?php echo $company_creation1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
        <?php } ?>
    </td>
    <?php } ?>
    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>
<script>
    function change_fun(id,status1){
        // alert();
      var sendInfo={"action":"statusinfo","id":id,"status1":status1};
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


