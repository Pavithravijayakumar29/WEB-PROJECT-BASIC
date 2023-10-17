<form action="javascript:insert_update_row('',user_type_id.value,staff_id.value,mar_man.value,designation.value,user_name.value,password.value,confirm_password.value,status1.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">User Type <b class="mark_label_red">*</b></label>
            <select class="form-control" id="user_type_id" style="width:100%;">
                <option value="0">SELECT ONE</option>
                <?php foreach($user_type as $user_type1){ ?>
                <option value="<?php echo $user_type1['id']; ?>"><?php echo $user_type1['user_type']; ?></option>
                <?php } ?>
            </select>
            <p id="error_message_1" style="color: red; display: none;">Please Select User Type.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Sales Rep Name<b class="mark_label_red"></b></label>
            <select class="form-control" id="staff_id" style="width:100%;" onchange="played(this.value)">
                <option value="0">SELECT ONE</option>
                <?php foreach($staff_creation as $staff_creation1){ ?>
                <option value="<?php echo $staff_creation1['id']; ?>"><?php echo $staff_creation1['sales_ref_name']; ?></option>
                <?php } ?>
            </select>
            <p id="error_message_2" style="color: red; display: none;">Please Select Staff Name.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Market Manager<b class="mark_label_red"></b></label>
            <select class="form-control" id="mar_man" style="width:100%;" onchange="keeper(this.value)">
                <option value="0">SELECT ONE</option>
                <?php foreach($MarketManager as $MarketManager1){ ?>
                <option value="<?php echo $MarketManager1['id']; ?>"><?php echo $MarketManager1['manager_name']; ?></option>
                <?php } ?>
            </select>
            <p id="error_message_2" style="color: red; display: none;">Please Select Staff Name.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Designation<b class="mark_label_red"></b></label>
            <select class="form-control" id="designation" style="width:100%;" >
                <option value="0">SELECT ONE</option>
                <?php foreach($designation as $designation1){ ?>
                <option value="<?php echo $designation1['id']; ?>"><?php echo $designation1['designation_name']; ?></option>
                <?php } ?>
            </select>
            <p id="error_message_3" style="color: red; display: none;">Please Select Designation.</p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">User Name <b class="mark_label_red">*</b></label>
            <input type="text" id="user_name" class="form-control">
            <div id="user_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Password <b class="mark_label_red">*</b></label>
            <input type="password" id="password" class="form-control">
            <div id="password_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Confirm Password <b class="mark_label_red">*</b></label>
            <input type="password" id="confirm_password" class="form-control">
            <div id="confirm_password_validate_div" class="mark_label_red"></div>
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
function played(staff_id) {
    var mar_man = $('#mar_man');
    if (staff_id != 0) {
        mar_man.prop('disabled', true);
    } else {
        mar_man.prop('disabled', false);
    }
}
function keeper(mar_man) {
    var staff_id = $('#staff_id');
    if (mar_man != 0) {
        staff_id.prop('disabled', true);
    } else {
        staff_id.prop('disabled', false);
    }
}

$(function () {
    $("#user_type_id").select2();
    $("#staff_id").select2();
    $("#mar_man").select2();
    $("#designation").select2();
});
</script>


