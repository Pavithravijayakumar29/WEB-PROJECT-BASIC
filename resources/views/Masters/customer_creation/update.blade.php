<form action="javascript:insert_update_row('<?php echo $customer_creation['id']; ?>',customer_no.value,customer_name.value,perm_address.value,pin_gst_no.value,contact_no.value,phone_no.value,email_address.value,state_id.value,district_id.value,area_id.value,status1.value)">
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Customer Id<b class="mark_label_red">*</b></label>
            <input type="text" id="customer_no" class="form-control" value="<?php echo $customer_creation['customer_no']; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Customer Name<b class="mark_label_red">*</b></label>
            <input type="text" id="customer_name" class="form-control" value="<?php echo $customer_creation['customer_name']; ?>">
            <div id="customer_name_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Address<b class="mark_label_red">*</b></label>
            <textarea id="perm_address" class="form-control"><?php echo $customer_creation['perm_address']; ?></textarea>
            <div id="perm_address_validate_div" class="mark_label_red"></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Pan/GST No<b class="mark_label_red">*</b></label>
            <input type="text" id="pin_gst_no" class="form-control" value="<?php echo $customer_creation['pin_gst_no']; ?>">
            <div id="pin_gst_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Contact No<b class="mark_label_red">*</b></label>
            <input type="text" id="contact_no" class="form-control" value="<?php echo $customer_creation['contact_no']; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
            <div id="contact_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Phone No</label>
            <input type="text" id="phone_no" class="form-control" value="<?php echo $customer_creation['phone_no']; ?>" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Email-Id</label>
            <input type="text" id="email_address" class="form-control" value="<?php echo $customer_creation['email_address']; ?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>State Name</label>
            <select class="select2-search__field" id="state_id" name="state_id" onchange="getDistricts()">
                <option value="">Select State</option>
                <?php
                $state_id=$customer_creation['state_id'];
                foreach($state_name as $state){ ?>
                <option value="<?php echo $state['id']; ?>" <?php if($state_id==$state['id']){echo " selected";} ?>><?php echo $state['state_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <strong><label>District Name</label></strong>
            <select class="select2-search__field" id="district_id" width="100%" onchange="getArea()">
                        <?php
                        $dist_id=$customer_creation['district_id'];
                        foreach($district_creation as $district_creation1){ ?>
                        <option value="<?php echo $district_creation1['id']; ?>" <?php if($dist_id==$district_creation1['id']){echo " selected";} ?>><?php echo $district_creation1['district_name']; ?></option>
                        <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <strong><label>Area Name</label></strong>
            <select class="select2-search__field" id="area_id" width="100%">
                <?php
                $area_id1=$customer_creation['area_id'];
                foreach($market_creation as $market_creation1){ ?>
                <option value="<?php echo $market_creation1['id']; ?>" <?php if($area_id1==$market_creation1['id']){echo " selected";} ?>><?php echo $market_creation1['area_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Status</label>
            <select id="status1" class="form-control">
            <option value="1" <?php if($customer_creation['status1']=="1"){echo " selected";} ?>>Active</option>
            <option value="0" <?php if($customer_creation['status1']!="1"){echo " selected";} ?>>In Active</option>
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
        <button class="btn btn-icon icon-left btn-success" type="update">
            <span class="fas fa-check"></span>Update
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