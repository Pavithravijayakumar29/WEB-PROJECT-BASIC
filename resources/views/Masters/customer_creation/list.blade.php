<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr>
        <th>Sno</th>
        <th>Customer Id</th>
        <th>Customer Name</th>
        <th>Contact No</th>
        <th>Pan/GST No</th>
        <th>Status</th>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <th class="text-center">Action</th>
            <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($customer_creation as $customer_creation1)
    { ?>
    <tr>
        <td><?php echo $i1;$i1++; ?></td>
        <td><?php echo $customer_creation1['customer_no']; ?></td>
        <td><?php echo $customer_creation1['customer_name']; ?></td>
        <td><?php echo $customer_creation1['contact_no']; ?></td>
        <td><?php echo $customer_creation1['pin_gst_no']; ?></td>
        <td align="center"><?php if($customer_creation1['status1']=="1"){ ?><div class="badge badge-success">Active</div><?php }else{ ?><div class="badge badge-warning">In Active</div><?php } ?></td>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <td align="center">
                <?php if($user_rights_edit_1==1){ ?>
        <a class="btn btn-icon icon-left btn-info" data-toggle="tooltip" style="cursor: pointer" title="Edit" onclick="open_model('Update Customer Creation','<?php echo $customer_creation1['id']; ?>')"><i class="far fa-edit"></i>Edit</a>
        <?php } ?>
        <?php if($user_rights_delete_1==1){ ?>
        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_row('<?php echo $customer_creation1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
    </td>
    <?php } ?>
</td>
<?php } ?>
</tr>
<?php } ?>
    </tbody>
    </table>
</div>
