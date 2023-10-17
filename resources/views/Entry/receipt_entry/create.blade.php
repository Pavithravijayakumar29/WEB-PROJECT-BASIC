<form action="javascript:insert_update_row('',order_date.value,order_no.value,tally_no.value,manager_id.value,sales_exec.value,dealer_creation_id.value)">

    <div class="row">

        <div class="col-md-3">
            <div class="form-group">
                <label>Date </label>
                <input type="date" id="order_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Receipt No </label>
                <input type="text" id="order_no" class="form-control" placeholder="Order Number" readonly
                    value="<?php echo $order_no; ?>">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
              <label>Manager Name</label>
              <select class="form-control select2_comp" id="manager_id" onchange="find_sales_ref()" style="width:100%;">
                <option value="">Select</option>
                <?php foreach($manager_creation as $manager_creation){ ?>
                <option value="<?php echo $manager_creation['id']; ?>"><?php echo $manager_creation['manager_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Sales Executive</label>
                <select class="form-control select2_comp" id="sales_exec" onchange="getsalesrep_dealername()" style="width:100%;">
                    <option value="">Select</option>
                    <?php foreach($sales_name as $sales_name1){ ?>
                    <option value="<?php echo $sales_name1['id']; ?>"><?php echo $sales_name1['sales_ref_name']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Dealer Name </label>
                <select class="form-control select2_comp" id="dealer_creation_id" style="width:100%;" onchange="gettallynumber()">
                    <option value="">Select</option>
                    <?php foreach($dealer_creation as $dealer_creation1){ ?>
                    <option value="<?php echo $dealer_creation1['id']; ?>"><?php echo $dealer_creation1['dealer_name']; ?></option>
                    <?php } ?>
                </select>

            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label>Tally Number</label>
                <div id="pass_hidden_count"></div>
                <select class="form-control select2_comp" id="tally_no" style="width:100%;"  onchange="getorderrecipt();hide_ledger_name();">
                    <option value="">Select</option>
                    <?php foreach($taally_no as $taally_no1){
                      if ($taally_no1['tally_no'] !== null) {   ?>
                    <option value="<?php echo $taally_no1['id']; ?>"><?php echo $taally_no1['tally_no']; ?></option>
                    <?php } } ?>

                </select>
                <div id="sales_exec_validate_div" class="mark_label_red"></div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="form-group">
                <label>Ledger Name <b style="color: blue;">Dr </b></label>
                <select class="form-control select2_comp" id="ledger_dr" name="ledger_dr" style="width:100%;" onchange='hide_tally_number()'>
                    <option value="">Select</option>
                    <?php foreach($ledger_name as $ledger_name1){ ?>
                    <option value="<?php echo $ledger_name1['id']; ?>"><?php echo $ledger_name1['ledger_name']; ?></option>
                    <?php } ?>
                </select>
                <div id="ledger_dr_validate_div" class="mark_label_red"></div>
            </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="comment" name="description" placeholder="Enter Description" rows="4"></textarea>
        </div>
        </div>
    </div>
    <div></div>
    <div id="sublist_div" style="width:100%;"></div>
    <div id="sublist_div_1" style="width:100%;"></div>
    <div></div>

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
    $(function() {
        $(".select2_comp").select2();
        load_model_sublist('', '');

    });
</script>

