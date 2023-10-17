<form action="javascript:insert_update_row('',expense_date.value,sales_rep_creation_id.value,market_manager_id.value,expense_no.value,status1.value,description.value,mode_of_payment.value)">
<div class="row">
    
    <div class="col-md-3">
        <div class="form-group">
            <label>Expense Number <b class="mark_label_red">*</b></label>
            <input type="text" id="expense_no" class="form-control" placeholder="Order Number" readonly value="<?php echo $expense_no; ?>">
            <div id="expense_no_validate_div" class="mark_label_red"></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Expense Date <b class="mark_label_red">*</b></label>
            <input type="date" id="expense_date" class="form-control" value="<?php echo date("Y-m-d"); ?>" onchange="getstaff();">
            <div id="expense_date_validate_div" class="mark_label_red"></div>
        </div>
    </div>

    <div   class="col-md-3">
        <div class="form-group">
            <label>Market Manager Name <b class="mark_label_red">*</b></label>
            <select class="form-control select2_comp" id="market_manager_id" style="width:100%;" >
                <option value="">Select</option>
                <?php foreach($market_manager_creation as $market_manager_creation1){ ?>
                <option value="<?php echo $market_manager_creation1['id']; ?>"><?php echo $market_manager_creation1['manager_name']; ?>
            </option>
                <?php } ?>
            </select>
            <div id="market_manager_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <label>Sales Rep-Name <b class="mark_label_red">*</b></label>
            <select class="form-control select2_comp" id="sales_rep_creation_id" style="width:100%;" onchange="get_dealer(),get_visitor()">
                <option value="0" >select</option>
            </select>
            <div id="sales_rep_creation_id_validate_div" class="mark_label_red"></div>
        </div>
    </div>
   
    <div class="col-md-3">
        <div class="form-group">
            <label>Status <b class="mark_label_red">*</b></label>
            <select id="status1" class="form-control">
            <option value="1">Active</option>
            <option value="0">In Active</option>
            </select>
            <div id="status1_validate_div" class="mark_label_red"></div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group">
            <label>Mode of Payment <b class="mark_label_red">*</b></label>
            <select id="mode_of_payment" class="form-control">
         
            <option value="Cash">Cash</option>
            <option value="NEFT">NEFT</option>
            </select>
            <div id="mode_of_payment_validate_div" class="mark_label_red">

            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
      <textarea class="form-control" id="description" name="description" placeholder="Enter Description" rows="4"></textarea>
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
     getstaff();
     get_visitor();
     get_dealer();
     get_market();
     get_sub_expense();

});
</script>
