<form action="javascript:insert_update_row('<?php echo $sales_order_c2d_main['id']; ?>',order_date.value,dealer_creation_id.value,dealer_address.value,order_no.value,status1.value,description.value,sales_exec.value)">
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Order Date </label>
            <input type="date" id="order_date" class="form-control" value="<?php echo ($sales_order_c2d_main['order_date']!="")?date('Y-m-d',strtotime($sales_order_c2d_main['order_date'])):date("Y-m-d"); ?>">
            <div id="order_date_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Order Number </label>
            <input type="text" id="order_no" class="form-control" placeholder="Order Number" readonly value="<?php echo $sales_order_c2d_main['order_no']; ?>">
            <div id="order_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Sales Executive<b class="mark_label_red">*</b></label>
            <select class="form-control select2_comp" id="sales_exec" style="width:100%;">
                <option value="">Select</option>
                <?php foreach($sales_name as $sales_name1){ ?>
                <option value="<?php echo $sales_name1['id']; ?>" <?php if ($sales_name1['id'] == $sales_order_c2d_main['sales_exec']) {
                    echo 'selected';
                } ?>><?php echo $sales_name1['sales_ref_name']; ?></option>
                <?php } ?>
            </select>
            <div id="sales_exec_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Dealer Name </label>
            <select class="form-control select2_comp" id="dealer_creation_id" style="width:100%;">
                <option value="">Select</option>
                <?php foreach($dealer_creation as $dealer_creation1){ ?>
                <option value="<?php echo $dealer_creation1['id']; ?>" <?php if($dealer_creation1['id']==$sales_order_c2d_main['dealer_creation_id']){echo " selected";} ?>><?php echo $dealer_creation1['dealer_name']; ?></option>
                <?php } ?>
            </select>
            <div id="dealer_creation_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
        <label for="dealer_address1">Dealer Address</label>
        <textarea class="form-control" id="dealer_address" name="dealer_address" rows="4"><?php echo $sales_order_c2d_main['address']; ?></textarea>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Status </label>
            <select id="status1" class="form-control">
                <option value="1" <?php if($sales_order_c2d_main['status']=="1"){echo " selected";} ?>>Active</option>
                <option value="0" <?php if($sales_order_c2d_main['status']!="1"){echo " selected";} ?>>In Active</option>
            </select>
            <div id="status1_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
    <div class="form-group">
        <label for="description">Description</label>
       <textarea class="form-control" id="description" name="description" rows="4"><?php echo $sales_order_c2d_main['description']; ?></textarea>
   </div>
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
    load_model_sublist('<?php echo $sales_order_c2d_main['id']; ?>','');
});
</script>
