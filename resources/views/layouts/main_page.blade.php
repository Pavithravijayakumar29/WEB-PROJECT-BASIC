<style>
    .stl{
        font-family: "Times New Roman", Times, serif;
    }
</style>

<?php
$perm_details1=new App\Http\Controllers\Admin\UserPermissionController();
$cur_pg_uri=str_replace("/","",parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$perm_details=$perm_details1->get_login_details($cur_pg_uri);
// print_r($cur_pg_uri).'Lokie';
if($perm_details['user_rights_view']!=1)
{
    ?><script>window.location.href="/logout";</script><?php
    exit;
}
$perm_view_details=$perm_details1->get_perm_view_details($perm_details['user_type_id']); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>PPS - @yield('page_title')</title>

  <link rel="stylesheet" href="{!! asset('assets/css/app.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/bundles/datatables/datatables.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/css/style.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/css/components.css') !!}">
  <link rel="stylesheet" href="{!! asset('assets/css/custom.css') !!}">
  <link rel='shortcut icon' type='image/x-icon' href="{!! asset('assets/img/favicon.ico') !!}" />
  <link rel="stylesheet" href="{!! asset('assets/bundles/select2/dist/css/select2.min.css') !!}">
  <style>
    .mark_label_red{
      color:red;
    }
  </style>
  @section('header_content')
  @show
</head>
<body>
<script>
  const user_rights_add_1='<?php echo $perm_details['user_rights_add']; ?>', user_rights_edit_1='<?php echo $perm_details['user_rights_edit']; ?>',user_rights_delete_1='<?php echo $perm_details['user_rights_delete']; ?>';
</script>
{{-- <input type="hidden" id="_token1" value="{{ csrf_token() }}" /> --}}
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">@include('layouts/navbar')</nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="/Dashboard/">
              <img alt="image" src="{!! asset('assets/img/logo.png" class="header-logo') !!}" />&nbsp;<span class="logo-name">PPS</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            @include('layouts/sidebar')
          </ul>
        </aside>
      </div>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            @section('main_content')
            @show
          </div>
        </section>
        @section('modal_content')
        @show
        {{-- <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div> --}}
      </div>
      {{-- <footer class="main-footer">
        <div class="footer-left">
          <a href="templateshub.net">Templateshub</a></a>
        </div>
        <div class="footer-right">
          <a href="templateshub.net">Templateshub</a></a>
        </div>
      </footer> --}}
    </div>
  </div>
  <!-- General JS Scripts --> {{-- {!! asset('assets/js/page/advance_creation.js') !!} --}}
  <script src="{!! asset('assets/js/app.min.js') !!}"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="{!! asset('assets/js/scripts.js') !!}"></script>
  <script src="{!! asset('assets/bundles/datatables/datatables.min.js') !!}"></script>
  <script src="{!! asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') !!}"></script>
  <script src="{!! asset('assets/bundles/datatables/export-tables/dataTables.buttons.min.js') !!}"></script>
  <script src="{!! asset('assets/bundles/datatables/export-tables/buttons.flash.min.js') !!}"></script>
  <script src="{!! asset('assets/bundles/datatables/export-tables/jszip.min.js') !!}"></script>
  <script src="{!! asset('assets/bundles/datatables/export-tables/pdfmake.min.js') !!}"></script>
  <script src="{!! asset('assets/bundles/datatables/export-tables/vfs_fonts.js') !!}"></script>
  <script src="{!! asset('assets/bundles/datatables/export-tables/buttons.print.min.js') !!}"></script>
  <script src="{!! asset('assets/bundles/sweetalert/sweetalert.min.js') !!}"></script>
  <script src="{!! asset('assets/bundles/select2/dist/js/select2.full.min.js') !!}"></script>
  <script>
    $(function () {
      $(".select2").select2();
    });
  </script>
  @section('footer_content')
  @show
</body>
</html>
