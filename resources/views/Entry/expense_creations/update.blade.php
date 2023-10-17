<form action="javascript:insert_update_row('<?php echo $expense_creations_main['id']; ?>',expense_date.value,sales_rep_creation_id.value,market_manager_id.value,expense_no.value,status1.value,description.value,mode_of_payment.value)">
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>Expense Date <b class="mark_label_red">*</b></label>
            <input disabled type="date" id="expense_date" class="form-control" value="<?php echo ($expense_creations_main['expense_date']!="")?date('Y-m-d',strtotime($expense_creations_main['expense_date'])):date("Y-m-d"); ?>">
            <div id="expense_date_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Expense Number <b class="mark_label_red">*</b></label>
            <input disabled type="text" id="expense_no" class="form-control" placeholder="Order Number"  value="<?php echo $expense_creations_main['expense_no']; ?>">
            <div id="expense_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Sales Rep Creation <b class="mark_label_red">*</b></label>
            <select disabled class="form-control select2_comp" id="sales_rep_creation_id" style="width:100%;" <?php if($expense_creations_main['sales_rep_creation_id'] != ""){echo "disblaed";} else{ echo "";} ?>>
                <option value="">Select</option>
                <?php foreach($sales_ref_creation as $sales_ref_creation1){ ?>
                <option value="<?php echo $sales_ref_creation1['id']; ?>" <?php if($sales_ref_creation1['id']==$expense_creations_main['sales_rep_creation_id']){echo " selected";} ?>><?php echo $sales_ref_creation1['sales_ref_name']; ?></option>
                <?php } ?>
            </select>
            <div id="sales_rep_creation_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Market Manager Name <b class="mark_label_red">*</b></label>
            <select disabled class="form-control select2_comp" id="market_manager_id" style="width:100%;">
                <option value="">Select</option>
                <?php foreach($market_manager_creation as $market_manager_creation1){ ?>
                <option value="<?php echo $market_manager_creation1['id']; ?>" <?php if($market_manager_creation1['id'] == $expense_creations_main['market_manager_id']){echo " selected";} ?>><?php echo $market_manager_creation1['manager_name']; ?></option> 
                <?php } ?>
            </select>
            <div id="market_manager_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Status <b class="mark_label_red">*</b></label>
            <select id="status1" class="form-control">
                <option value="1" <?php if($expense_creations_main['status']=="1"){echo " selected";} ?>>Active</option>
                <option value="0" <?php if($expense_creations_main['status']!="1"){echo " selected";} ?>>In Active</option>
            </select>
            <div id="status1_validate_div" class="mark_label_red"></div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Mode of Payment <b class="mark_label_red">*</b></label>
            <select id="mode_of_payment" name="mode_of_payment" class="form-control">
                <option value="Cash" <?php if($expense_creations_main['mode_of_payment']=="Cash"){echo " selected";} ?>>Cash</option>
                <option value="NEFT" <?php if($expense_creations_main['mode_of_payment'] =="NEFT"){echo " selected";} ?>>NEFT</option>
            </select>
            <div id="mode_of_payment_validate_div" class="mark_label_red"></div>
        </div>
    </div>


    <div class="form-group">
        <label for="description">Description</label>
       <textarea class="form-control" id="description" name="description" rows="4"><?php echo $expense_creations_main['description']; ?></textarea>
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
    // disbled_columns();
    // disbled_column();
    //get_dealer();
    //getstaff();
    // get_market();
    load_model_sublist('<?php echo $expense_creations_main['id']; ?>','');
});
</script>
