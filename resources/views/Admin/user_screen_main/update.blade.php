<form action="javascript:insert_update_row('<?php echo $user_screen_main['id']; ?>',screen_name.value,description.value,status1.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Screen Name <b class="mark_label_red">*</b></label>
            <input type="text" id="screen_name" class="form-control" value="<?php echo $user_screen_main['screen_name']; ?>">
            <div id="screen_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Description </label>
            <textarea id="description" class="form-control"><?php echo $user_screen_main['description']; ?></textarea>
            <div id="description_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Status <b class="mark_label_red">*</b></label>
            <select id="status1" class="form-control">
            <option value="1" <?php if($user_screen_main['status']=="1"){echo " selected";} ?>>Active</option>
            <option value="0" <?php if($user_screen_main['status']!="1"){echo " selected";} ?>>In Active</option>
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
