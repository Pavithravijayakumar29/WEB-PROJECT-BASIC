<form action="javascript:update_right_options('<?php echo $user_screen_main_id; ?>','<?php echo $user_screen_sub_id; ?>')">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Screen Name <b class="mark_label_red">*</b></label>
            <input type="text" class="form-control form-control-sm" readonly="" value="<?php echo $screen_name; ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Sub Screen Name <b class="mark_label_red">*</b></label>
            <input type="text" class="form-control form-control-sm" readonly="" value="<?php echo $sub_screen_name; ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-hover" id="rights_tableExport" style="width:100%;">
        <thead>
        <tr class="stl">
            <th>Sno</th>
            <th>User Type</th>
            <th class="text-center">Options</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i1=1;
        foreach($user_type as $user_type1)
        {
            $user_type_id=$user_type1['id'];
            ?>
        <tr>
            <td class="stl"><?php echo $i1;$i1++; ?></td>
            <td class="stl"><?php echo $user_type1['user_type']; ?></td>
            <td class="text-dark" align="right" class="stl">
                <div class="form-group m-0 p-0" style="float:right;">
                <?php if(array_key_exists($user_type_id,$user_permission)){
                    $user_permission1=$user_permission[$user_type_id];
                    $options=explode(',',$user_permission1['option_ids']);
                    ?>
                <select class="form-control form-control-sm user_type_options" style="width:300px;" id="usertypeoptions_<?php echo $user_type_id; ?>_<?php echo $user_permission1['id']; ?>" multiple=""><?php foreach($user_screen_options as $user_screen_options1){ ?><option value="<?php echo $user_screen_options1['id']; ?>" <?php echo (in_array($user_screen_options1['id'],$options)?" selected":""); ?>><?php echo $user_screen_options1['option_name']; ?></option><?php } ?></select>
                <?php }else{ ?>
                <select class="form-control form-control-sm user_type_options" style="width:300px;" id="usertypeoptions_<?php echo $user_type_id; ?>_0" multiple=""><?php foreach($user_screen_options as $user_screen_options1){ ?><option value="<?php echo $user_screen_options1['id']; ?>" <?php echo ($user_screen_options1['make_default']=='1'?" selected":""); ?>><?php echo $user_screen_options1['option_name']; ?></option><?php } ?></select>
                <?php } ?>
                </div>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
      <button class="btn btn-icon icon-left btn-danger" data-dismiss="modal" aria-label="Close">
        <span class="fas fa-times"></span>Cancel
      </button>
    </div>
    <div class="col-md-6 text-right">
      <button class="btn btn-icon icon-left btn-success" type="submit">
        <span class="fas fa-check"></span>Submit
      </button>
    </div>
  </div>
</form>
<script>
var rights_tableExport_rows=null;
$(function () {
    $(".user_type_options").select2();
    rights_tableExport_rows=$('#rights_tableExport').DataTable({"dom": 'frtip',"pageLength": 5});
});
</script>
