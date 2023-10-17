<br>
<div class="row">
    <div class="col-md-12">
        <table class="table table-sm table-hover" id="rights_tableExport" style="width:100%;">
        <thead>
    <tr align="center" class="stl">
    <th>Sno</th>
        <th>Visited Date</th>
        <th>New Dealer Name</th>
        <th>Description</th>
        <th>Address</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i1=1;
    foreach($visitor_sublist as $visitor_sublist1)
    { ?>
    <tr align="center">
        <td class="stl"><?php echo $i1;$i1++; ?></td>
        <td class="stl"><?php echo $visitor_sublist1['order_date']; ?></td>
        <td class="stl"><?php echo $visitor_sublist1['visitor_name']; ?></td>
        <td class="stl"><?php echo $visitor_sublist1['description']; ?></td>
        <td class="stl"><?php echo $visitor_sublist1['address']; ?></td>
        <td class="stl"><img src="{{ $visitor_sublist1['image_name'] != '' ? asset('storage/visitors_img/' . $visitor_sublist1['image_name']) : asset('storage/default/default_image.png') }}"
            width="35" height="35" alt="Image Preview"
            data-toggle="popover"
            data-trigger="hover"
            data-html="true"
            data-content='<img src="{{ $visitor_sublist1["image_name"] != "" ? asset("storage/visitors_img/" . $visitor_sublist1["image_name"]) : asset("storage/default/default_image.png") }}" width="150" height="150" alt="Image Preview">'
            ></td>
        <td align="center" class="stl">
        <a class="btn btn-icon icon-left btn-info" data-toggle="tooltip" style="cursor: pointer" title="Edit"  onclick="open_visitors_update('Update Dealer Search Creation', '<?php echo $visitor_sublist1['id']; ?>', '<?php echo $visitor_sublist1['d2s_id']; ?>', '<?php echo $visitor_sublist1['order_date']; ?>', '<?php echo $visitor_sublist1['order_no']; ?>', '<?php echo $visitor_sublist1['sales_exec']; ?>')"><i class="far fa-edit"></i>Edit</a>

        <a class="btn btn-icon icon-left btn-danger" data-toggle="tooltip" style="cursor: pointer" title="Delete" onclick="delete_visitor_row('<?php echo $visitor_sublist1['id']; ?>', '<?php echo $visitor_sublist1['d2s_id']; ?>', '<?php echo $visitor_sublist1['order_date']; ?>', '<?php echo $visitor_sublist1['order_no']; ?>', '<?php echo $visitor_sublist1['sales_exec']; ?>')"><i class="fas fa-trash"></i>Delete</a>
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
