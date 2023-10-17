<link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr align="center" class="stl">
        <th>Sno</th>
        <th>Country Name</th>

        <th class="text-center">Description</th>
        <th>Status</th>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <th class="text-center">Action</th>
            <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($country_creation as $country_creation1)
    { ?>
    <tr align="center">
        <td><?php echo $i1;$i1++; ?></td>
        <td class="stl"><?php echo  ucfirst($country_creation1['country_name']); ?></td>

        <td class="stl"><?php echo  ucfirst($country_creation1['description']); ?></td>
        <td align="center" class="stl">
            <div class="pretty p-default p-curve p-toggle">
                <input type="checkbox" <?php if ($country_creation1['status']=="1"){ echo 'checked'; }else{ } ?> onclick="change_fun('<?php echo $country_creation1['id']; ?>','<?php echo $country_creation1['status']; ?>')">
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
        <a class="btn btn-icon icon-left btn-info hover-gradient" data-toggle="tooltip" style="cursor: pointer" title="Edit" onclick="open_model('Update Country Creation','<?php echo $country_creation1['id']; ?>')"><i class="far fa-edit"></i>Edit</a>
        <?php } ?>
        <?php if($user_rights_delete_1==1){ ?>
        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_row('<?php echo $country_creation1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
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
