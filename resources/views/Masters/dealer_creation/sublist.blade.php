<br>
<div class="row">
    <div class="col-md-12">
        <table class="table table-sm table-hover" id="rights_tableExport" style="width:100%;">
        <thead>
    <tr align="center" class="stl">
    <th>Sno</th>
        <th>Shop Name</th>
        <th>WhatsApp No</th>
        <th>GST No</th>
        <th>Days</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($shop_creation as $shop_creation1)
    { ?>
    <tr align="center">
        <td class="stl"><?php echo $i1;$i1++; ?></td>
        <td class="stl"><?php echo $shop_creation1['shop_name']; ?></td>
        <td class="stl"><?php echo $shop_creation1['whatsapp_no']; ?></td>
        <td class="stl"><?php echo $shop_creation1['gst_no']; ?></td>
        <td class="stl"><?php echo $shop_creation1['language']; ?></td>
        <td align="center" class="stl">
        <a class="btn btn-icon icon-left btn-info" data-toggle="tooltip" style="cursor: pointer" title="Edit"  onclick=" open_shop_update('Update Shop Creation', '<?php echo $shop_creation1['id']; ?>', '<?php echo $shop_creation1['beats_id']; ?>', '<?php echo $shop_creation1['dealer_id']; ?>')"><i class="far fa-edit"></i>Edit</a>

        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_shop_row('<?php echo $shop_creation1['id']; ?>','<?php echo $shop_creation1['beats_id']; ?>','<?php echo $shop_creation1['dealer_id']; ?>')"><i class="fas fa-trash"></i>Delete</a>
    </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
</div>
    </div>
<script>
var rights_tableExport_rows=null;
$(function () {
    $(".user_type_options").select2();
    rights_tableExport_rows=$('#rights_tableExport').DataTable({"dom": 'frtip',"pageLength": 5});
});
</script>
