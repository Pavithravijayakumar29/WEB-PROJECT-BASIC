@extends('layouts/main_page')
@section('page_title','Beats Wise Report')
@section('header_content')
<link rel="stylesheet" type="text/css" href="../assets/css/page/button.css">
@endsection
@section('main_content')
<input type="hidden" id="CUR_ACTION" value="{{ route('Beats_Wise_Report_Action') }}" />
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4><span class="label info small">Beats Wise Report</span></h4>
        
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
              <label for="dealer_id">Dealer Name</label>
              <select class="form-control select2" id="dealer_id" width="100%">
                <option value="">Select</option>
                <?php foreach($dealer_creation as $dealer_creation1){ ?>
                <option value="<?php echo $dealer_creation1['id']; ?>"><?php echo $dealer_creation1['dealer_name']; ?></option>
                <?php } ?>
                </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="beats_id">Beats Name</label>
              <select class="form-control select2" id="beats_id" width="100%">
                <option value="">Select</option>
                <?php foreach($market_creation as $market_creation1){ ?>
                <option value="<?php echo $market_creation1['id']; ?>"><?php echo $market_creation1['area_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="shop_id">Shop Name</label>
              <select class="form-control select2" id="shop_id" width="100%">
                <option value="">Select</option>
                <?php foreach($shop_creation as $shop_creation1){ ?>
                <option value="<?php echo $shop_creation1['id']; ?>"><?php echo $shop_creation1['shop_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label>&nbsp;</label><br>
              <button class="btn btn-info" onclick="list_div(from_date.value,to_date.value,dealer_id.value,beats_id.value,shop_id.value)">GO</button>
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
<script src="../assets/js/page/Reports/beats_wise_report.js"></script>
@endsection
