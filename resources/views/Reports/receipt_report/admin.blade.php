@extends('layouts/main_page')
@section('page_title','Receipt Reports')
@section('header_content')
<link rel="stylesheet" type="text/css" href="../assets/css/page/button.css">
@endsection
@section('main_content')
<style>
  .modal-xxl{
    max-width: 1600px;
    margin: 1 auto;
    padding-left: 17px;
  }
  </style>

<input type="hidden" id="CUR_ACTION" value="{{ route('Receipt_Report_action') }}" />
<input type="hidden" id="_token" value="{{ csrf_token() }}" />
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4><span class="label info small">Receipt Reports</span></h4>
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
              <label for="manager_name">Manager Name</label>
              <select class="form-control select2" id="manager_name" width="100%" onchange="find_sales_ref()">
                <option value="">Select</option>
                <?php foreach($manager_creation as $manager_creation){ ?>
                    <option value="<?php echo $manager_creation['id']; ?>"><?php echo $manager_creation['manager_name']; ?></option>
                    <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="sales_name">Sales Executive Name</label>
              <select class="form-control select2" id="sales_name" width="100%" onchange="getsalesrep_dealername()">
                <option value="">Select</option>
                <?php foreach($sales_name as $sales_name1){ ?>
                    <option value="<?php echo $sales_name1['id']; ?>"><?php echo $sales_name1['sales_ref_name']; ?></option>
                    <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="dealer_name">Dealer Name</label>
              <select class="form-control select2" id="dealer_name" width="100%" onchange="gettallynumber()">
                <option value="">Select</option>
                <?php foreach($dealer_list as $dealer_list1){ ?>
                <option value="<?php echo $dealer_list1['id']; ?>"><?php echo $dealer_list1['dealer_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="tally_no">Tally No</label>
              <select class="form-control select2" id="tally_no" width="100%" onchange="hide_ledger_name();">
                <option value="">Select</option>
                <?php foreach($tally_creation as $tally_creation1){ ?>
                <option value="<?php echo $tally_creation1['id']; ?>"><?php echo $tally_creation1['tally_no']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="ledger_dr">Ledger Name </label>
              <select class="form-control select2" id="ledger_dr" width="100%" onchange='hide_tally_number()'>
                <option value="">Select</option>
                <?php foreach($ledger_name as $ledger_name1){ ?>
                    <option value="<?php echo $ledger_name1['id']; ?>"><?php echo $ledger_name1['ledger_name']; ?></option>
                    <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label>&nbsp;</label><br>
              <button class="btn btn-info" onclick="list_div(from_date.value,to_date.value,manager_name.value,sales_name.value,dealer_name.value,tally_no.value,ledger_dr.value)">GO</button>
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
  <div class="modal-dialog modal-xxl">
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
    function hide_ledger_name(){
    var tally_no = $('#tally_no').val();

    if (tally_no) {
        $('#ledger_dr').prop('disabled', true);
    }else{
        $('#ledger_dr').prop('disabled', false);
    }
}
function hide_tally_number() {
    var ledger = $('#ledger_dr').val();

    if (ledger) {
        $('#tally_no').prop('disabled', true);
    }else{
        $('#tally_no').prop('disabled', false);
    }
}
$(function () {
  if(user_rights_add_1!='1'){$("#user_rights_add_div").remove();}
  if((user_rights_add_1!='1') && (user_rights_edit_1!='1')){$("#bd-example-modal-lg1").remove();}
});
</script>
<script src="../assets/js/page/Reports/receipt_report.js"></script>
@endsection
