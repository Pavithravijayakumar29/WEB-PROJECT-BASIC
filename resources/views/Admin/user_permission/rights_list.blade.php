<form action="javascript:update_right_options('<?php echo $user_type_id; ?>','<?php echo $user_type; ?>')">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>User Type <b class="mark_label_red">*</b></label>
            <input type="text" class="form-control form-control-sm" readonly="" value="<?php echo $user_type; ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-sm table-hover" id="rights_tableExport" style="width:100%;">
        <thead>
        <tr>
            <th>Sno</th>
            <th>User Screen Main</th>
            <th>User Screen Sub</th>
            <th class="text-center">Options</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i1=1;
        foreach($user_screen_main as $user_screen_main1)
        {
            $id1=$user_screen_main1['id'];
            foreach($user_screen_sub[$id1] as $user_screen_sub1)
            {
                $id2=$user_screen_sub1['id'];
                ?>
                <tr>
                    <td><?php echo $i1;$i1++; ?></td>
                    <td><?php echo $user_screen_main1['screen_name']; ?></td>
                    <td><?php echo $user_screen_sub1['sub_screen_name']; ?></td>
                    <td class="text-dark" align="right">
                        <div class="form-group m-0 p-0" style="float:right;">
                        <?php
                        $user_permission1=$user_permission[$id1][$id2];
                        $id3="0";$optionSel=[];
                        if($user_permission1!=null){
                            $id3=$user_permission1['id'];
                            $optionSel=explode(',',$user_permission1['option_ids']);
                        }else{
                            $optionSel=$user_screen_options_defaults;
                        } ?>
                        <select class="form-control form-control-sm user_type_options" style="width:300px;" id="usertypeoptions_<?php echo $user_type_id; ?>_<?php echo $id3; ?>" multiple=""><?php foreach($user_screen_options as $user_screen_options1){ ?><option value="<?php echo $user_screen_options1['id']; ?>" <?php echo (in_array($user_screen_options1['id'],$optionSel)?" selected":""); ?>><?php echo $user_screen_options1['option_name']; ?></option><?php } ?></select>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
        </table>
    </div>
</div>
<div class="row mt-1">
    <div class="col-md-12">
        <button class="btn btn-primary mr-1" id="update_submit_btn" type="submit">Submit</button>
        <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
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