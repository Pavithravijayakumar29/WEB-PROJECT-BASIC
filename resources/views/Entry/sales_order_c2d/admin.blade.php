@extends('layouts/main_page')
@section('page_title','Order Recipt')
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
<input type="hidden" id="CUR_ACTION" value="{{ route('Sales_Order_C2D_Action') }}" />
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4><span class="label info small">Order Recipt</span></h4>
        <div class="card-header-action" id="user_rights_add_div">
          <button type="submit" class="button" onclick="open_model(' Order Recipt','')">Create</button>
        </div>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="from_date_1">From Date</label>
              <input type="date" class="form-control" id="from_date_1" value="<?php echo date("Y-m-01"); ?>" />
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="to_date_1">To Date</label>
              <input type="date" class="form-control" id="to_date_1" value="<?php echo date("Y-m-t"); ?>" />
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="order_no_1">Order Number</label>
              <select class="form-control select2" id="order_no_1" width="100%">
                <option value="">Select</option>
                <?php foreach($order_no_list as $order_no_list1){ ?>
                <option value="<?php echo $order_no_list1['order_no']; ?>"><?php echo $order_no_list1['order_no']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="market_creation_id_1">Market Name</label>
              <select class="form-control select2" id="market_creation_id_1" width="100%">
                <option value="">Select</option>
                <?php foreach($market_creation as $market_creation1){ ?>
                <option value="<?php echo $market_creation1['id']; ?>"><?php echo $market_creation1['area_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="dealer_creation_id_1">Dealer Name</label>
              <select class="form-control select2" id="dealer_creation_id_1" width="100%">
                <option value="">Select</option>
                <?php foreach($dealer_creation as $dealer_creation1){ ?>
                <option value="<?php echo $dealer_creation1['id']; ?>"><?php echo $dealer_creation1['dealer_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="status_1">Status</label>
              <select class="form-control" id="status_1" width="100%">
                <option value="">Select</option>
                <option value="1">Active</option>
                <option value="0">In Active</option>
              </select>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <label>&nbsp;</label><br>
              <button class="btn btn-info" onclick="list_div(from_date_1.value,to_date_1.value,order_no_1.value,market_creation_id_1.value,dealer_creation_id_1.value,status_1.value)">GO</button>
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
$(function () {
  if(user_rights_add_1!='1'){$("#user_rights_add_div").remove();}
  if((user_rights_add_1!='1') && (user_rights_edit_1!='1')){$("#bd-example-modal-lg1").remove();}
});
</script>
<script src="../assets/js/page/Entry/sales_order_c2d.js"></script>
@endsection
