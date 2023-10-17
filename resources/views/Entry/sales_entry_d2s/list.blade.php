<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
        <tr>
            <th style="width: 5%;">Sno</th>
            <th style="width: 8%;">Order Date</th>
            <th style="width: 8%;">Order Number</th>
            <th style="width: 10%;">Market Name</th>
            <th style="width: 10%;">Dealer Name</th>
            <th style="width: 8%;">Tot Qty</th>
            <th style="width: 8%;">Tot Weight</th>
            <th style="width: 8%;">Tot Amt</th>
            <th class="text-center" style="width: 8%;">Status</th>
            <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
                <th class="text-center">Action</th>
            <?php } ?>
        </tr>

    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($sales_order_d2s_main as $sales_order_d2s_main1)
    {
        $total_sublist=explode(";",$sales_order_d2s_main1['total_sublist']);
        ?>
    <tr>
        <td><?php echo $i1;$i1++; ?></td>
        <td><?php echo $sales_order_d2s_main1['order_date']; ?></td>
        <td><?php echo $sales_order_d2s_main1['order_no']; ?></td>
        <td><?php echo $sales_order_d2s_main1['area_name']; ?></td>
        <td><?php echo $sales_order_d2s_main1['dealer_name']; ?></td>
        <td><?php echo $total_sublist[0]; ?></td>
        <td><?php echo $total_sublist[1]; ?></td>
        <td><?php echo $total_sublist[2]; ?></td>
        <td align="center"><?php if($sales_order_d2s_main1['status']=="1"){ ?><div class="badge badge-success">Active</div><?php }else{ ?><div class="badge badge-warning">In Active</div><?php } ?></td>
        <?php if(($user_rights_edit_1==1) || ($user_rights_delete_1==1)){ ?>
        <td align="center">
        <?php if($user_rights_edit_1==1){ ?>
        <a class="btn btn-icon icon-left btn-info hover-gradient" data-toggle="tooltip" style="cursor: pointer"  title="Edit" onclick="open_model('Update Secondary Sales (D -> S)','<?php echo $sales_order_d2s_main1['id']; ?>')"><i class="far fa-edit"></i>Edit</a>
        <?php } ?>
        <?php if($user_rights_delete_1==1){ ?>
        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_row('<?php echo $sales_order_d2s_main1['id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
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
