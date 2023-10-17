<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
        <tr>
            <th>Sno</th>
            <th>Order Date</th>
            <th>Order Number</th>
            <th>Ledger Name</th>
            <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
                <th class="text-center">Action</th>
            <?php } ?>
        </tr>

    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($receipt_entry_main as $receipt_entry_main1)
    {

        ?>
    <tr>
        <td><?php echo $i1;$i1++; ?></td>
        <td><?php echo $receipt_entry_main1['order_date']; ?></td>
        <td><?php echo $receipt_entry_main1['order_no']; ?></td>
        <td><?php echo $receipt_entry_main1['ledger_dr']; ?></td>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
        <td align="center">
        <?php if($user_rights_edit_1==1){
            if($receipt_entry_main1['tally_no']!=''){ ?>
                <a class="btn btn-icon icon-left btn-info hover-gradient" data-toggle="tooltip" style="cursor: pointer"  title="Edit" onclick="open_model_1('Update Receipt Entry','<?php echo $receipt_entry_main1['id']; ?>','<?php echo $receipt_entry_main1['tally_no']; ?>')"><i class="far fa-edit"></i>Edit</a>
           <?php }else{ ?> <a class="btn btn-icon icon-left btn-info hover-gradient" data-toggle="tooltip" style="cursor: pointer"  title="Edit" onclick="open_model('Update Receipt Entry','<?php echo $receipt_entry_main1['id']; ?>')"><i class="far fa-edit"></i>Edit</a> <?php } ?>

        <?php } ?>
        <?php if($user_rights_delete_1==1){ ?>
        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_row('<?php echo $receipt_entry_main1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
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
                    columns: [0, 1, 2,3,4,5,6,7,8]
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                //text: '<i class="far fa-file-pdf"></i>',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7,8]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7,8]
                }
            }
        ]
    });
});
</script>
