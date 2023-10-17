<form action="javascript:update_perm('<?php echo $user_type_id; ?>','<?php echo $user_type; ?>')">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="stl">User Type <b class="mark_label_red">*</b></label>
            <input type="text" class="form-control form-control-sm" readonly="" value="<?php echo $user_type; ?>">
        </div>
    </div>
</div>
<div style="width:100%;height:500px;overflow-y: scroll;">
    <ul class="list-group">
    <?php
    foreach($user_screen_main as $user_screen_main1)
    {
        $id1=$user_screen_main1['id'];
        if(array_key_exists($id1,$user_screen_sub))
        { ?>
        <li class="list-group-item perm_main" id="perm_<?php echo $id1; ?>">
            <div style="width:100%;">
                <b><?php echo $user_screen_main1['screen_name']; ?></b>
                <div class="customcheckbox_div" style="float:right;">
                    Select All&nbsp;<input class="customcheckbox_div_checkbox" id="perm_<?php echo $id1; ?>_all" type="checkbox" onchange="perm_function(this.checked,'all','perm_<?php echo $id1; ?>')" <?php if($user_rights_edit_1!=1){echo " onclick='return false;' onkeydown='return false;'";} ?>>
                </div>
            </div>
            <div class="row icon-feather-container">
            <?php $i1=1;
            foreach($user_screen_sub[$id1] as $user_screen_sub1)
            {
                $id2=$user_screen_sub1['id'];
                $user_permission1=$user_permission[$id1][$id2];
                $id3="0";$optionSel=[];$option_id_selected1=[];
                if($user_permission1!=null){
                    $id3=$user_permission1['id'];
                    $optionSel=explode(',',$user_permission1['option_ids']);
                    $option_id_selected1=explode(',',$user_permission1['option_id_selected']);
                }else{
                    $optionSel=$user_screen_options_defaults;
                    $option_id_selected1=$user_screen_options_defaults;
                } ?>
                <div class="col-md-2 perm_<?php echo $id1; ?>_sub" id="perm_<?php echo $id1; ?>_<?php echo $id2; ?>_<?php echo $id3; ?>">
                    <span style="width:100%;">
                        <b><?php echo $user_screen_sub1['sub_screen_name']; ?></b>
                        <input class="customcheckbox_div_checkbox" id="perm_<?php echo $id1; ?>_<?php echo $id2; ?>_<?php echo $id3; ?>_all" type="checkbox" onchange="perm_function(this.checked,'all_sub','perm_<?php echo $id1; ?>_<?php echo $id2; ?>_<?php echo $id3; ?>')" style="float:right;" <?php if($user_rights_edit_1!=1){echo " onclick='return false;' onkeydown='return false;'";} ?> />
                        <input type="hidden" id="perm_<?php echo $id1; ?>_<?php echo $id2; ?>_<?php echo $id3; ?>_option_ids" value="<?php echo implode(',',$optionSel); ?>" />
                    </span>
                    <table style="width:100%;">
                        <?php
                        $j1=1;
                        foreach($optionSel as $optionSel1)
                        { ?>
                        <tr><td style="width:20px;"><?php echo $j1;$j1++; ?>)</td><td><?php echo $user_screen_options[$optionSel1]['option_name']; ?></td><td style="width:20px;"><input class="customcheckbox_div_checkbox perm_<?php echo $id1; ?>_<?php echo $id2; ?>_<?php echo $id3; ?>_opt" value="<?php echo $optionSel1; ?>" type="checkbox" onchange="init_fun();" <?php echo (in_array($optionSel1,$option_id_selected1)?" checked":""); ?> <?php if($user_rights_edit_1!=1){echo " onclick='return false;' onkeydown='return false;'";} ?> /></td></tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } ?>
            </div>
        </li>
        <?php
        }
    } ?>
    </ul>
</div>
<div class="row mt-1">
    <div class="col-md-12">
        <?php if($user_rights_edit_1==1){ ?>
        <button class="btn btn-primary mr-1" id="update_submit_btn" type="submit">Save Changes</button>
        <?php } ?>
        <!-- <button onclick="refresh_model('<?php //echo $user_type_id; ?>','<?php //echo $user_type; ?>')" class="btn btn-secondary ml-1"><i class="fas fa-sync"></i></button> -->
        <button class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cancel</button>
    </div>
</div>
</form>
<script>
$(function () {
    init_fun();
});
</script>
