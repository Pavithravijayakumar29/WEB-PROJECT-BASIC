<form action="javascript:insert_update_row('',company_name.value,address.value,mobile_no.value,phone_no.value,gst_no.value,tin_no.value,email_id.value,status1.value)">
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Company Name<b class="mark_label_red">*</b></label>
            <input type="text" id="company_name" class="form-control">
            <div id="company_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Addresss<b class="mark_label_red">*</b></label>
            <textarea id="address" class="form-control"></textarea>
            <div id="address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Mobile No<b class="mark_label_red">*</b></label>
            <input type="text" id="mobile_no" maxlength="10" class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
            <div id="mobile_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Phone No</label>
            <input type="text" id="phone_no" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">GST No</label>
            <input type="text" id="gst_no" class="form-control">
            <div id="gst_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Pan No</label>
            <input type="text" id="tin_no" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Email-ID</label>
            <input type="text" id="email_id" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="stl">Status</label>
            <select id="status1" class="form-control" >
            <option value="1">Active</option>
            <option value="0">In Active</option>
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
            <span class="fas fa-check"></span>Submit
        </button>
    </div>
</div>
</form>
