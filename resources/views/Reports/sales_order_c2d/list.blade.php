<div class="table-responsive">
    <table class="table table-hover" id="tableExport" style="width:100%;">
    <thead>
    <tr>
        <th>Sno</th>
        <th>Order Date</th>
        <th>Order Number</th>
        <th>Market Name</th>
        <th>Dealer Name</th>
        <th>Total Quantity</th>
        <th>Total Weight</th>
        <th>Total Amount</th>
        <th class="text-center">Status</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($sales_order_c2d_main as $sales_order_c2d_main1)
    {
        $total_sublist=explode(";",$sales_order_c2d_main1['total_sublist']);
        ?>
    <tr>
        <td><?php echo $i1;$i1++; ?></td>
        <td><?php echo $sales_order_c2d_main1['order_date']; ?></td>
        <td><?php echo $sales_order_c2d_main1['order_no']; ?></td>
        <td><?php echo $sales_order_c2d_main1['area_name']; ?></td>
        <td><?php echo $sales_order_c2d_main1['dealer_name']; ?></td>
        <td><?php echo $total_sublist[0]; ?></td>
        <td><?php echo $total_sublist[1]; ?></td>
        <td><?php echo $total_sublist[2]; ?></td>
        <td align="center"><?php if($sales_order_c2d_main1['status']=="1"){ ?><div class="badge badge-success">Active</div><?php }else{ ?><div class="badge badge-warning">In Active</div><?php } ?></td>
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
                    columns: [0, 1, 2,3,4,5,6,7]
                }
            },
            {
                extend: 'pdf',
                text: 'PDF',
                //text: '<i class="far fa-file-pdf"></i>',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7]
                }
            },
            {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7]
                }
            }
        ]
    });
});
</script>
