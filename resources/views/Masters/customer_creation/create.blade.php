<form action="javascript:insert_update_row('',customer_no.value,customer_name.value,perm_address.value,pin_gst_no.value,contact_no.value,phone_no.value,email_address.value,state_id.value,district_id.value,area_id.value,status1.value)">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Customer Id<b class="mark_label_red">*</b></label>
            <input type="text" id="customer_no" value="<?php echo $newInvoiceNumber; ?>" class="form-control" readonly>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Customer Name<b class="mark_label_red">*</b></label>
            <input type="text" id="customer_name" class="form-control">
            <div id="customer_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Address<b class="mark_label_red">*</b></label>
            <textarea id="perm_address" class="form-control"></textarea>
            <div id="perm_address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Pan/GST No</label>
            <input type="text" id="pin_gst_no" class="form-control">
            <div id="pin_gst_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Contact No<b class="mark_label_red">*</b></label>
            <input type="text" id="contact_no" class="form-control" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
            <div id="contact_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Phone No</label>
            <input type="text" id="phone_no" class="form-control" maxlength="10" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Email-Id</label>
            <input type="text" id="email_address" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
            <label>State Name<b class="mark_label_red">*</b></label>
            <select class="select2-search__field" id="state_id" name="state_id" onchange="getDistricts()">
                <option value="">--Select State--</option>
                @foreach ($state_name as $state)
                    <option value="{{ $state->id }}">{{ $state->state_name }}</option>
                @endforeach
            </select>
            <p id="error_message" style="color: red; display: none;">Please Select State Name.</p>
        </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
              <label>District Name<b class="mark_label_red">*</b></label>
            <select class="select2-search__field" id="district_id" name="district_id" onchange="getArea()">
                <option value="">--Select District--</option>
            </select>
            <p id="error_message_1" style="color: red; display: none;">Please Select District Name.</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
          <label>Area Name<b class="mark_label_red">*</b></label>
            <select class="select2-search__field" id="area_id" name="area_id">
                <option value="">--Select Area--</option>
            </select>
            <p id="error_message_2" style="color: red; display: none;">Please Select Area Name.</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Status</label>
            <select id="status1" class="form-control">
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

<script>
$(document).ready(function() {
    $('#state_id').select2();
    $('#district_id').select2();
    $('#area_id').select2();
});
</script>
<style>
.select2-container--default .select2-selection--single .select2-selection__rendered{
    width: 350px;
    min-height: 42px;
    line-height: 42px;
    padding-left: 20px;
    padding-right: 20px;
}
</style>
