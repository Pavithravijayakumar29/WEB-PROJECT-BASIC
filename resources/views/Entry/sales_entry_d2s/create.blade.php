<link rel="stylesheet" href="assets/bundles/pretty-checkbox/pretty-checkbox.min.css">
<form action="javascript:insert_update_row('',order_date.value,market_creation_id.value,dealer_creation_id.value,dealer_address.value,order_no.value,status1.value,description.value,sales_exec.value,'0')">

<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>Order Date </label>
            <input type="date" id="order_date" class="form-control" value="<?php echo date("Y-m-d"); ?>">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Order Number </label>
            <input type="text" id="order_no" class="form-control" placeholder="Order Number" readonly value="<?php echo $order_no; ?>">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
    <label>Sales Executive<b class="mark_label_red">*</b></label>
    <select class="form-control select2_comp" id="sales_exec" style="width:100%;" onchange="getdearlername()">
        <option value="">Select</option>
        <?php foreach($sales_name as $sales_name1){ ?>
        <option value="<?php echo $sales_name1['id']; ?>"><?php echo $sales_name1['sales_ref_name']; ?></option>
        <?php } ?>
    </select>
    <div id="sales_exec_validate_div" class="mark_label_red"></div>
        </div>
</div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Dealer Name </label>
            <select class="form-control select2_comp" id="dealer_creation_id" style="width:100%;" onchange="getmarket()">
                <option value="">Select</option>
                 <?php foreach($dealer_creation as $dealer_creation1) { ?>
                <option value="<?php echo $dealer_creation1['id']; ?>"><?php echo $dealer_creation1['dealer_name']; ?></option>
                <?php } ?>
            </select>
            <div id="dealer_creation_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="dealer_address">Dealer Address</label>
            <textarea class="form-control" id="dealer_address" name="dealer_address"  rows="4"></textarea>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Market Name </label>
            <select class="form-control select2_comp" id="market_creation_id" style="width:100%;" onchange="getshop()">
                <option value="">Select</option>
                <?php foreach($market_creation as $market_creation1){ ?>
                <option value="<?php echo $market_creation1['id']; ?>"><?php echo $market_creation1['area_name']; ?></option>
                <?php } ?>
            </select>
            <div id="market_creation_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Status </label>
            <select id="status1" class="form-control">
            <option value="1">Active</option>
            <option value="0">In Active</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
            <div class="form-group">
                <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4"></textarea>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group"><br><br>
            <span class="label info small" onclick="insert_update_row_radio_visit('',order_date.value,market_creation_id.value,dealer_creation_id.value,dealer_address.value,order_no.value,status1.value,description.value,sales_exec.value,'1');" style="cursor: pointer">Go To Visitors  <i class="fas fa-chevron-right"></i></span>
        </div>
    </div>
</div>
<div id="sublist_div" style="width:100%;"></div>
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
    $(".select2_comp").select2();
    load_model_sublist('','');
});
</script>
