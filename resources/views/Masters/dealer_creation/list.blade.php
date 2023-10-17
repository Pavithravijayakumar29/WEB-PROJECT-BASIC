<style>
    table {
        font-size: 14px; /* Adjust the font size to your preference */
    }
    table th, table td {
        font-size: 14px; /* Adjust the font size to your preference */
    }
</style>
<link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr  class="stl">
        <th>Sno</th>
        <th>Dealer Name</th>
        <th>Place</th>
        <th>WhatsApp No</th>
        <th>Image</th>
        <th>Status</th>
        <th>Beats</th>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <th class="text-center">Action</th>
            <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($dealer_creation as $dealer_creation1)
    { ?>
    <tr >
        <td class="stl"><?php echo $i1;$i1++; ?></td>
        <td class="stl"><?php echo  ucfirst($dealer_creation1['dealer_name']); ?></td>
        <td class="stl"><?php echo  ucfirst($dealer_creation1['place']); ?></td>
        <td class="stl"><?php echo $dealer_creation1['whatsapp_no']; ?></td>
        <td>
            <img src="{{ $dealer_creation1['image_name'] != '' ? asset('storage/dealer_img/' . $dealer_creation1['image_name']) : asset('storage/default/default_image.png') }}"
            width="35" height="35" alt="Image Preview"
            data-toggle="popover"
            data-trigger="hover"
            data-html="true"
            data-content='<img src="{{ $dealer_creation1["image_name"] != "" ? asset("storage/dealer_img/" . $dealer_creation1["image_name"]) : asset("storage/default/default_image.png") }}" width="100" height="100" alt="Image Preview">'
            >
        </td>
        <td align="center" class="stl">
            <div class="pretty p-default p-curve p-toggle">
                <input type="checkbox" <?php if ($dealer_creation1['status']=="1"){ echo 'checked'; }else{ } ?> onclick="change_fun('<?php echo $dealer_creation1['id']; ?>','<?php echo $dealer_creation1['status']; ?>')">
                <div class="state p-success p-on">
                  <label style="color: green">Active</label>
                </div>
                <div class="state p-danger p-off">
                  <label style="color: red">In Active </label>
                </div>
              </div>
        </td>
        <td align="center" class="stl">
            <a class="btn btn-icon icon-left btn-warning" data-toggle="tooltip" style="cursor: pointer" title="Market" onclick="open_beats('Beats Creation','<?php echo $dealer_creation1['id']; ?>')"><i class="fas fa-child"></i>Market</a>&nbsp;
            <img align="center" onclick="open_view('View Beats','<?php echo $dealer_creation1['id']; ?>')" src="{{ asset('storage/attandance_view/img23.png') }}" width="40" height="40" border="0" title="VIEW">
        </td>

        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <td align="center" class="stl">
                <?php if($user_rights_edit_1==1){ ?>
        <a class="btn btn-icon icon-left btn-info" data-toggle="tooltip" style="cursor: pointer" title="Edit" onclick="open_model('Update Dealer Creation','<?php echo $dealer_creation1['id']; ?>')"><i class="far fa-edit"></i>Edit</a>
        <?php } ?>
        <?php if($user_rights_delete_1==1){ ?>
        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_row('<?php echo $dealer_creation1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
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
        var _token1=$("#_token1").val();
      var sendInfo={"_token":_token1,"action":"statusinfo","id":id,"status":status};
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
