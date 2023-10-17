@extends('layouts/main_page')
@section('page_title','Item Sales & Pending Month Wise Report')
@section('header_content')
<link rel="stylesheet" type="text/css" href="../assets/css/page/button.css">
@endsection
@section('main_content')
<input type="hidden" id="CUR_ACTION" value="{{ route('Item_Sales_Pending_Month_Wise_Report_Action') }}" />
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4><span class="label info small">Item Sales Pending Month Wise Report

        </span></h4>
        
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="from_date">From Date</label>
              <input type="date" class="form-control" id="from_date" value="<?php echo date("Y-m-01"); ?>" />
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="to_date">To Date</label>
              <input type="date" class="form-control" id="to_date" value="<?php echo date("Y-m-t"); ?>" />
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="manager_id">Manager Name</label>
              <select class="form-control select2" id="manager_id" width="100%"  onchange="find_sales_ref()" >
                <option value="">Select</option>
                <?php foreach($manager_creation as $manager_creation1){ ?>
                <option value="<?php echo $manager_creation1['id']; ?>"><?php echo $manager_creation1['manager_name']; ?></option>
                <?php } ?>
                </select>
            </div>
          </div>



          <div class="col-md-2">
            <div class="form-group">
              <label for="sales_ref_id">Sales Ref Name</label>
              <select class="form-control select2" id="sales_ref_id" width="100%">
                <option value="">Select</option>
                <?php foreach($sales_rep_creation as $sales_rep_creation1){ ?>
                <option value="<?php echo $sales_rep_creation1['id']; ?>"><?php echo $sales_rep_creation1['sales_ref_name']; ?></option>
                <?php } ?>
                </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
                <label for="group_id">Group Name</label>
                <select class="form-control select2" id="group_id" onchange="find_item_id()"  width="100%">
                <option value="">Select Item Group</option>
                <?php foreach($group_creation as $group_creation1){ ?>
                <option value="<?php echo $group_creation1['id']; ?>"><?php echo $group_creation1['group_name']; ?></option>
                <?php } ?>
                </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="item_id">Item Name</label>
              <select class="form-control select2" id="item_id" width="100%">
                <option value="">Select</option>
                <?php foreach($item_creation as $item_creation1){ ?>
                <option value="<?php echo $item_creation1['id']; ?>"><?php echo $item_creation1['item_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
         
          <div class="col-md-2">
            <div class="form-group">
              <label>&nbsp;</label><br>
              <button class="btn btn-info" onclick="list_div(from_date.value,to_date.value,sales_ref_id.value,item_id.value,manager_id.value,group_id.value)">GO</button>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body" id="list_div">
      </div>
    </div>
  </div>
</div>
@endsection
@section('footer_content')
<script>
$(function () {
  if(user_rights_add_1!='1'){$("#user_rights_add_div").remove();}
  if((user_rights_add_1!='1') && (user_rights_edit_1!='1')){$("#bd-example-modal-lg1").remove();}
});
</script>
<script src="../assets/js/page/Reports/item_sales_pending_month_wise_report.js"></script>
@endsection
