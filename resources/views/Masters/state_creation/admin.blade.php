<link rel="stylesheet" type="text/css" href="{!! asset('assets/css/page/button.css') !!}">
@extends('layouts/main_page')
@section('page_title','State Creation')
@section('header_content')
@endsection
@section('main_content')
<input type="hidden" id="CUR_ACTION" value="{{ route('State_Creation_Action') }}" />
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4><span class="label info small">State Master</span></h4>
        <div class="card-header-action" id="user_rights_add_div">
            <button type="submit" class="button" onclick="open_model('State Creation','')">Create</button>

        </div>
      </div>
      <div class="card-body" id="list_div">
      </div>
    </div>
  </div>
</div>
@endsection
@section('modal_content')
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="bd-example-modal-lg1"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
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
<script src="{!! asset('assets/js/page/state_creation.js') !!}"></script>
@endsection
