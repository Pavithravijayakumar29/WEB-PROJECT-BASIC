<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr>
        <th>Sno</th>
        <th>Employee Name</th>
        <th>Employee Address</th>
        <th>Contact No</th>
        <th>Dealer Assign</th>
        <th>Image</th>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <th class="text-center">Action</th>
            <?php } ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($employee_creation as $employee_creation1)
    { ?>
    <tr>
        <td><?php echo $i1;$i1++; ?></td>
        <td><?php echo $employee_creation1['employee_no']; ?></td>
        <td><?php echo $employee_creation1['employee_name']; ?></td>
        <td><?php echo $employee_creation1['contact_no']; ?></td>
        <td><?php echo $employee_creation1['dealer_name']; ?></td>
        <td>
            <img src="{{ $employee_creation1['image_name'] != '' ? asset('storage/employee_images/' . $employee_creation1['image_name']) : asset('storage/employee_images/default_image.png') }}"
            width="35" height="35" alt="Image Preview"
            data-toggle="popover"
            data-trigger="hover"
            data-html="true"
            data-content='<img src="{{ $employee_creation1["image_name"] != "" ? asset("storage/employee_images/" . $employee_creation1["image_name"]) : asset("storage/employee_images/default_image.png") }}" width="150" height="150" alt="Image Preview">'
            >
        </td>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
            <td align="center">
                <?php if($user_rights_edit_1==1){ ?>
        <a class="btn btn-icon icon-left btn-info" data-toggle="tooltip" style="cursor: pointer" title="Edit" onclick="open_model('Update Employee Creation','<?php echo $employee_creation1['id']; ?>')"><i class="far fa-edit"></i>Edit</a>
        <?php } ?>
        <?php if($user_rights_delete_1==1){ ?>
        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_row('<?php echo $employee_creation1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
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
</script>

