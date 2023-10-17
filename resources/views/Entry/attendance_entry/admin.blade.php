<link rel="stylesheet" type="text/css" href="../assets/css/page/button.css">
@extends('layouts/main_page')
@section('page_title','Attendance Entry')
@section('header_content')
@endsection
@section('main_content')
<input type="hidden" id="CUR_ACTION" value="{{ route('Attendance_Entry_Action') }}" />
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4><span class="label info small">Attendance Entry</span></h4>
        <div class="card-header-action">
            <button type="submit" class="button" onclick="open_model(' Attendance Entry','')">Create</button>
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
<script src="{!! asset('assets/js/page/Entry/attendance_entry.js') !!}"></script>
@endsection
