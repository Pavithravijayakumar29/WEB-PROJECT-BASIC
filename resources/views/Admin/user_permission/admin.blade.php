@extends('layouts/main_page')
@section('page_title','User Permission')
<input type="hidden" id="_token1" value="{{ csrf_token() }}" />
<link rel="stylesheet" type="text/css" href="{!! asset('assets/css/page/button.css') !!}">
@section('header_content')
<style>
.customcheckbox_div
{
    cursor: pointer;
    display:flex;
    justify-content:center;
    align-items:center;
}
.customcheckbox_div_checkbox
{
    width:18px;
    height:18px;
}
</style>
@endsection
@section('main_content')
<input type="hidden" id="CUR_ACTION" value="{{ route('User_Permission_Action') }}" />
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h4><span class="label info small">User Permission</span></h4></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tableExport" style="width:100%;">
                            <thead>
                            <tr class="stl">
                                <th>Sno</th>
                                <th>User Type</th>
                                {{-- <th class="text-center">Rights Option</th> --}}
                                <th class="text-center">Update Permission</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i1=1;
                            foreach($user_type as $user_type1)
                            { ?>
                            <tr>
                                <td class="stl"><?php echo $i1;$i1++; ?></td>
                                <td class="stl"><?php echo ucfirst($user_type1['user_type']); ?></td>
                                {{-- <td align="center">
                                    <a class="btn btn-success btn-action mr-1" data-toggle="tooltip" title="Right Options" onclick="open_rights_model('<?php echo $user_type1['id']; ?>','<?php echo $user_type1['user_type']; ?>')"><i class="fas fa-cog"></i></a>
                                </td> --}}
                                <td align="center" class="stl">
                                    <a class="btn btn-icon icon-left btn-info hover-gradient" data-toggle="tooltip" style="cursor: pointer" title="Update Permission" onclick="open_model('<?php echo $user_type1['id']; ?>','<?php echo $user_type1['user_type']; ?>')"><i class="far fa-edit"></i>Update</a>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal_content')
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="bd-example-modal-lg1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
    $('#tableExport').DataTable();
});
</script>
<script src="../assets/js/page/Admin/user_permission.js"></script>
<?php if(isset($_GET["user_type_id"])){ ?>
<script>
$(function () {
    open_model('<?php echo $_GET["user_type_id"]; ?>','<?php echo $_GET["user_type"]; ?>');
});
</script>
<?php } ?>
@endsection
