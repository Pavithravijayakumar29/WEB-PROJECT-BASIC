@extends('layouts/main_page')
@section('page_title','Excutive Ltrs Report')
@section('header_content')
<link rel="stylesheet" type="text/css" href="../assets/css/page/button.css">
@endsection
@section('main_content')
<style>
    .card .card-body {

        padding-bottom: 5px;
    }
    </style>
<input type="hidden" id="CUR_ACTION" value="{{ route('Excutive_Sales') }}" />
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4><span class="label info small">Executive Daily Ltrs Sales Report</span></h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label for="from_date">From Date</label>
              <input type="month" class="form-control" id="from_date" value="<?php echo date("Y-m"); ?>" />
            </div>
          </div>
          <div class="col-md-2">
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
              <label for="dealer_id">Excutive Name</label>
              <select class="form-control select2" id="excutive_id" width="100%" onchange= 'getdearlername()'>
                <option value="">Select</option>
                <?php foreach ($sales_rep_name as $sales_rep_name1) { ?>
                    <option value="<?php echo $sales_rep_name1['id']; ?>"><?php echo $sales_rep_name1['sales_ref_name']; ?></option>
               <?php }  ?>

                </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="beats_id">Dealer Name</label>
              <select class="form-control select2" id="area_id" width="100%">
                <option value="">Select</option>
                <?php foreach ($market_creation as $market_creation1) { ?>
                    <option value="<?php echo $market_creation1['id']; ?>"><?php echo $market_creation1['dealer_name']; ?></option>
               <?php }  ?>
              </select>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label>&nbsp;</label><br>
              <button class="btn btn-info" onclick="Excutive_sales(from_date.value,excutive_id.value,area_id.value,manager_na.value)">GO</button>
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
<script src="../assets/js/page/Reports/excutive_daily_ltr_report.js"></script>
@endsection
