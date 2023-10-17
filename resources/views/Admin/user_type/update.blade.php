<form action="javascript:insert_update_row('<?php echo $user_type['id']; ?>',user_type.value,status1.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">User Type <b class="mark_label_red">*</b></label>
            <input type="text" id="user_type" class="form-control" value="<?php echo $user_type['user_type']; ?>">
            <div id="user_type_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Status <b class="mark_label_red">*</b></label>
            <select id="status1" class="form-control">
            <option value="1" <?php if($user_type['status']=="1"){echo " selected";} ?>>Active</option>
            <option value="0" <?php if($user_type['status']!="1"){echo " selected";} ?>>In Active</option>
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
        <span class="fas fa-check"></span>Update
      </button>
    </div>
  </div>
</form>
