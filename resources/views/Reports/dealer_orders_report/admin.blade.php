@extends('layouts/main_page')
@section('page_title','Primary Orders Report')
@section('header_content')
<link rel="stylesheet" type="text/css" href="../assets/css/page/button.css">
@endsection
@section('main_content')
<style>
.card .card-body {

    padding-bottom: 5px;
}
</style>
<input type="hidden" id="CUR_ACTION" value="{{ route('dealer_order_report_action') }}" />
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4><span class="label info small">Primary Orders Report</span></h4>
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

          <div class="col-md-3">
            <div class="form-group">
              <label for="dealer_id">Manager Name</label>
              <select class="form-control select2" onchange="find_sales_ref()" id="manager_id" width="100%">
                <option value="">Select</option>
                <?php foreach($manager_creation as $manager_creation){ ?>
                <option value="<?php echo $manager_creation['id']; ?>"><?php echo $manager_creation['manager_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label for="dealer_id">Sales Ref Name</label>
              <select class="form-control select2" id="sales_ref_id" width="100%" onchange="find_dealer()" >
                <option value="">Select</option>
             
              </select>
            </div>
          </div>




          <div class="col-md-3">
            <div class="form-group">
              <label for="dealer_id">Dealer Name</label>
              <select class="form-control select2" id="dealer_id" width="100%">
                <option value="">Select</option>
               
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label>&nbsp;</label><br>
              <button class="btn btn-info" onclick="list_div(from_date.value,to_date.value,dealer_id.value)">GO</button>
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
<script src="../assets/js/page/Reports/dealer_orders_report.js"></script>
@endsection
