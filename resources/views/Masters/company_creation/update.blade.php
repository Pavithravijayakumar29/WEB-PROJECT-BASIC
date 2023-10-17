<form action="javascript:insert_update_row('<?php echo $company_creation['id']; ?>',company_name.value,address.value,mobile_no.value,phone_no.value,gst_no.value,tin_no.value,email_id.value,status1.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Company Name<b class="mark_label_red">*</b></label>
            <input type="text" id="company_name" class="form-control" value="<?php echo $company_creation['company_name']; ?>">
            <div id="company_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Company Address<b class="mark_label_red">*</b></label>
            <textarea id="address" class="form-control"><?php echo $company_creation['address']; ?></textarea>
            <div id="address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Mobile No<b class="mark_label_red">*</b></label>
            <input type="text" id="mobile_no" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $company_creation['mobile_no']; ?>" maxlength="10">
            <div id="mobile_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Phone No</label>
            <input type="text" id="phone_no" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="<?php echo $company_creation['phone_no']; ?>" maxlength="10">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">GST No</label>
            <input type="text" id="gst_no" class="form-control" value="<?php echo $company_creation['gst_no']; ?>">
            <div id="gst_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Pan No</label>
            <input type="text" id="tin_no" class="form-control" value="<?php echo $company_creation['tin_no']; ?>">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Email-ID</label>
            <input type="text" id="email_id" class="form-control" value="<?php echo $company_creation['email_id']; ?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Status</label>
            <select id="status1" class="form-control" required>
            <option value="1" <?php if($company_creation['status1']=="1"){echo " selected";} ?>>Active</option>
            <option value="0" <?php if($company_creation['status1']!="1"){echo " selected";} ?>>In Active</option>
            </select>
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
