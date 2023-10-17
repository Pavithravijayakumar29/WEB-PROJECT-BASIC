@extends('layouts/main_page')
@section('page_title','Effective Calls Reports')
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

<input type="hidden" id="CUR_ACTION" value="{{ route('Effective_calls_Report_action') }}" />
<input type="hidden" id="_token" value="{{ csrf_token() }}" />
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4><span class="label info small">Effective Calls Reports</span></h4>
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
              <label for="sales_exec">Sales Executive</label>
              <select class="form-control select2" id="sales_exec" name= 'tableExport 'width="100%" onchange='getdearlername()'>
                <option value="">Select</option>
                <?php foreach($sales_name as $sales_name1){ ?>
                <option value="<?php echo $sales_name1['id']; ?>"><?php echo $sales_name1['sales_ref_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-2">
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

          <div class="col-md-2">
            <div class="form-group">
                <label for="group_id">Group Name</label>
                <select class="form-control select2" id="group_id" onchange="find_item_id()"  width="100%">
                <option value="">Select</option>
                <?php foreach($group_creation as $group_creation1){ ?>
                <option value="<?php echo $group_creation1['id']; ?>"><?php echo $group_creation1['group_name']; ?></option>
                <?php } ?>
                </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="dealer_creation_id_1">Item Name</label>
              <select class="form-control select2" id="item_name_1" width="100%">
                <option value="">Select</option>
                <?php foreach($item_namess as $item_namess1){ ?>
                <option value="<?php echo $item_namess1['id']; ?>"><?php echo $item_namess1['item_name']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="order_shop">Order Shop</label>
              <select class="form-control select2" id="order_shop" width="100%">
                <option value="2">All</option>
                <option value="1">Order Taken</option>
                <option value="0">Order Not Taken</option>
              </select>
            </div>
          </div>

          <div class="col-md-1">
            <div class="form-group">
              <label>&nbsp;</label><br>
              <button class="btn btn-info" onclick="list_div(from_date_1.value,to_date_1.value,sales_exec.value,dealer_creation_id_1.value,manager_na.value,order_shop.value,item_name_1.value,group_id.value)">GO</button>
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
<script src="../assets/js/page/Reports/effective_calls_Report.js"></script>
@endsection
