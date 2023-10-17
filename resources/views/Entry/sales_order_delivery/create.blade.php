<form action="javascript:insert_update_row('',dispatch_date.value,delivery_no.value,order_recipt_no.value,sales_exec.value,dealer_creation_id.value,status1.value,driver_name.value,driver_number.value,vehile_name.value,tally_no.value,description.value)">
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>Dispatch Date <b class="mark_label_red">*</b></label>
            <input type="date" id="dispatch_date" class="form-control" value="<?php echo date("Y-m-d"); ?>">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Dispatch Number <b class="mark_label_red">*</b></label>
            <input type="text" id="delivery_no" class="form-control" placeholder="Delivery Number" readonly value="<?php echo $delivery_no; ?>">
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
            <label>Dealer Name <b class="mark_label_red">*</b></label>
            <select class="form-control select2_comp" id="dealer_creation_id" style="width:100%;" onchange="getreciptno();">
                <option value="">Select</option>
                <?php foreach($dealer_creation as $dealer_creation1){ ?>
                <option value="<?php echo $dealer_creation1['id']; ?>"><?php echo $dealer_creation1['dealer_name']; ?></option>
                <?php } ?>
            </select>
            <div id="dealer_creation_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Order Recipt Number<b class="mark_label_red">*</b></label>
            <select class="form-control select2_comp" id="order_recipt_no" style="width:100%;" onchange="getorderrecipt();">
            <option value="">Select Order No</option>
            <?php foreach($order_no as $order_no1){ ?>
                <option value="<?php echo $order_no1['id']; ?>"><?php echo $order_no1['order_no'] ." - ". $order_no1['order_date']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Status <b class="mark_label_red">*</b></label>
            <select id="status1" class="form-control">
            <option value="1">Active</option>
            <option value="0">In Active</option>
            </select>
        </div>
    </div>
  <div class="col-md-2">
  <div class="form-group">
    <label>Driver Name</label>
  <input type="text" id="driver_name" class="form-control"  placeholder="Enter Driver Name">
  </div>
</div>
<div class="col-md-2">
<div class="form-group">
    <label>Driver Number</label>
  <input type="text" id="driver_number" class="form-control"  placeholder="Enter Driver Number">
  </div>
</div>
<div class="col-md-2">
    <div class="form-group">
        <label>Vehicle Number</label>
      <input type="text" id="vehile_name" class="form-control"  placeholder="Enter Vechile Number">
  </div>
    </div>
    <div class="col-md-2">
    <div class="form-group">
        <label>Tally Number</label>
      <input type="text" id="tally_no" class="form-control"  placeholder="Enter Tally Number">
  </div>
    </div>
    <div class="col-md-2">
    <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4"></textarea>
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
});
</script>
