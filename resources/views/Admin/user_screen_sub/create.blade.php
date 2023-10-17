<form action="javascript:insert_update_row('',user_screen_main_id.value,sub_screen_name.value,description.value,status1.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Screen Name <b class="mark_label_red">*</b></label>
            <select class="form-control" id="user_screen_main_id" style="width:100%;">
                <?php foreach($user_screen_main as $user_screen_main1){ ?>
                <option value="<?php echo $user_screen_main1['id']; ?>"><?php echo $user_screen_main1['screen_name']; ?></option>
                <?php } ?>
            </select>
            <div id="user_screen_main_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Sub Screen Name <b class="mark_label_red">*</b></label>
            <input type="text" id="sub_screen_name" class="form-control">
            <div id="sub_screen_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Description </label>
            <textarea id="description" class="form-control"></textarea>
            <div id="description_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Status <b class="mark_label_red">*</b></label>
            <select id="status1" class="form-control">
            <option value="1">Active</option>
            <option value="0">In Active</option>
            </select>
            <div id="status1_validate_div" class="mark_label_red"></div>
        </div>
    </div>
</div>
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
$(function () {
    $("#user_screen_main_id").select2();
});
</script>
