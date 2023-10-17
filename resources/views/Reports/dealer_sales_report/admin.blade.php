@extends('layouts/main_page')
@section('page_title','Primary Sales Report')
@section('header_content')
<link rel="stylesheet" type="text/css" href="../assets/css/page/button.css">
@endsection
@section('main_content')
<style>
.card .card-body {

    padding-bottom: 5px;
}
</style>
<input type="hidden" id="CUR_ACTION" value="{{ route('dealer_sales_report_Action') }}" />
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4><span class="label info small">Primary Sales Report</span></h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="from_date">From Date</label>
              <input type="date" class="form-control" id="from_date" value="<?php echo date("Y-m-01"); ?>" />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="to_date">To Date</label>
              <input type="date" class="form-control" id="to_date" value="<?php echo date("Y-m-t"); ?>" />
            </div>
          </div>
          {{-- <div class="col-md-2">
            <div class="form-group">
              <label for="manager_na">Manager Name</label>
              <select class="form-control select2" id="manager_na" name= 'tableExport 'width="100%" onchange='sales_mang()'>
                <option value="">Select</option>
                <?php foreach($manager_names as $manager_names1){ ?>
                <option value="<?php echo $manager_names1['id']; ?>"><?php echo $manager_names1['manager_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="rep_id">Sales Rep Name</label>
              <select class="form-control select2" id="rep_id" width="100%"
              onchange='getdearlername()'>
                <option value="">Select</option>
                <?php foreach($salesRep as $salesRep1){ ?>
                <option value="<?php echo $salesRep1['id']; ?>"><?php echo $salesRep1['sales_ref_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div> --}}

          <div class="col-md-3">
            <div class="form-group">
              <label for="dealer_id">Dealer Name</label>
              <select class="form-control select2" id="dealer_id" width="100%">
                <option value="">Select</option>
                <?php foreach($dealer_creation as $dealer_creation1){ ?>
                <option value="<?php echo $dealer_creation1['id']; ?>"><?php echo $dealer_creation1['dealer_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="group_id">Group Name</label>
              <select class="form-control select2" id="group_id" name= 'tableExport 'width="100%" onchange='get_item()'>
                <option value="">Select</option>
                <?php foreach($group_creation as $group_creation1){ ?>
                <option value="<?php echo $group_creation1['id']; ?>"><?php echo $group_creation1['group_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="item_id">Item Name</label>
              <select class="form-control select2" id="item_id" width="100%"
              onchange=''>
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
              <button class="btn btn-info" onclick="list_div_1(from_date.value,to_date.value,dealer_id.value,group_id.value,item_id.value)">GO</button>
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
@section('modal_content')
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="bd-example-modal-lg1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="myLargeModalLabel">Modal title1</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body" id="model_main_content">
      ...
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
<script src="../assets/js/page/Reports/dealer_sales_report.js"></script>
@endsection
