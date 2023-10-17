<form action="javascript:insert_update_row('<?php echo $sales_order_delivery_main['id']; ?>',dispatch_date.value,delivery_no.value,order_recipt_no.value,sales_exec.value,dealer_creation_id.value,status1.value,driver_name.value,driver_number.value,vehile_name.value,tally_no.value,description.value)">
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label>Dispatch Date <b class="mark_label_red">*</b></label>
            <input type="date" id="dispatch_date" class="form-control" value="<?php echo ($sales_order_delivery_main['dispatch_date']!="")?date('Y-m-d',strtotime($sales_order_delivery_main['dispatch_date'])):date("Y-m-d"); ?>">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Dispatch Number <b class="mark_label_red">*</b></label>
            <input type="text" id="delivery_no" class="form-control" placeholder="Dispatch Number" readonly value="<?php echo $sales_order_delivery_main['delivery_no']; ?>">
            <div id="delivery_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Sales Executive<b class="mark_label_red">*</b></label>
            <select class="form-control select2_comp" id="sales_exec" style="width:100%;" onchange="getdearlername()" disabled>
                <option value="">Select</option>
                <?php foreach($sales_name as $sales_name1){ ?>
                <option value="<?php echo $sales_name1['id']; ?>" <?php if($sales_name1['id']==$sales_order_delivery_main['sales_exec']){echo " selected";} ?>><?php echo $sales_name1['sales_ref_name']; ?></option>
                <?php } ?>
            </select>
            <div id="sales_exec_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Dealer Name <b class="mark_label_red">*</b></label>
            <select class="form-control select2_comp" id="dealer_creation_id" style="width:100%;" onchange="getmarket();" disabled>
                <option value="">Select</option>
                <?php foreach($dealer_creation as $dealer_creation1){ ?>
                <option value="<?php echo $dealer_creation1['id']; ?>" <?php if($dealer_creation1['id']==$sales_order_delivery_main['dealer_creation_id']){echo " selected";} ?>><?php echo $dealer_creation1['dealer_name']; ?></option>
                <?php } ?>
            </select>
            <div id="dealer_creation_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Order Recipt Number<b class="mark_label_red">*</b></label>
            <select class="form-control select2_comp" id="order_recipt_no" style="width:100%;" onchange="getorderrecipt();getsalesrepdealer();" disabled>
            <option value="">Select Order No</option>
            <?php foreach($order_no as $order_no1){ ?>
                <option value="<?php echo $order_no1['id']; ?>"  <?php if($order_no1['id']==$sales_order_delivery_main['order_recipt_no']){echo " selected";} ?>><?php echo $order_no1['order_no'] ." - ". $order_no1['order_date']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Status <b class="mark_label_red">*</b></label>
            <select id="status1" class="form-control">
                <option value="1" <?php if($sales_order_delivery_main['status']=="1"){echo " selected";} ?>>Active</option>
                <option value="0" <?php if($sales_order_delivery_main['status']!="1"){echo " selected";} ?>>In Active</option>
            </select>
            <div id="status1_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label>Driver Name</label>
      <input type="text" id="driver_name" class="form-control"  placeholder="Enter Driver Name" value="<?php echo $sales_order_delivery_main['driver_name']; ?>">
      </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
          <label>Driver Number</label>
        <input type="text" id="driver_number" class="form-control"  placeholder="Enter Driver Number" value="<?php echo $sales_order_delivery_main['driver_number']; ?>">
        </div>
      </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Vehicle Number</label>
          <input type="text" id="vehile_name" class="form-control"  placeholder="Enter Vechile Number" value="<?php echo $sales_order_delivery_main['vehile_name']; ?>">
      </div>
    </div>
    <div class="col-md-2">
    <div class="form-group">
        <label>Tally Number</label>
      <input type="text" id="tally_no" class="form-control"  placeholder="Enter Tally Number" value="<?php echo $sales_order_delivery_main['tally_no']; ?>">
  </div>
    </div>
    <div class="col-md-2">
    <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4"><?php echo $sales_order_delivery_main['description']; ?></textarea>
      <div id="description_validate_div" class="mark_label_red"></div>
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
        <span class="fas fa-check"></span>Update
      </button>
    </div>
  </div>
</form>
<script>
$(function () {
    $(".select2_comp").select2();
    load_model_sublist('<?php echo $sales_order_delivery_main['id']; ?>','');
});
</script>
