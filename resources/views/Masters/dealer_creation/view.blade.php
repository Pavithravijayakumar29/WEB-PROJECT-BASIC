
<div class="table-responsive">
    <table class="table table-hover" id="rights_tableExport" style="width:100%;">
        <thead>
    <tr align="center">
        <th>Sno</th>
        <th>Dealer Name</th>
        <th>Beats Name</th>
        <th>Shops Name</th>
        <th>WhatsApp No</th>
        <th>GST No</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($shop_creation as $shop_creation1)
    { ?>
    <tr align="center">
        <td><?php echo $i1;$i1++; ?></td>
        <td><?php echo $shop_creation1['dealer_name']; ?></td> 
        <td><?php echo $shop_creation1['area_name']; ?></td>
        <td><?php echo $shop_creation1['shop_name']; ?></td>
        <td><?php echo $shop_creation1['whatsapp_no']; ?></td>
        <td><?php echo $shop_creation1['gst_no']; ?></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>
<script>
    $(function() {
        $('#rights_tableExport').DataTable({
            "dom": 'lBfrtip',
            "buttons": [
                'excel', 'pdf', 'print'
            ]
        });
    });
</script>
