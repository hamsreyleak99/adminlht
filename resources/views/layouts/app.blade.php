<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <base href="https://demos.telerik.com/kendo-ui/upload/async">
     <title>{{ isset($title) ? $title.' :: '.config('app.name') : config('app.name')}}</title>

    @yield('before_styles')

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link href="{{ asset('vendor/adminlte/') }}/bootstrap/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/morris/morris.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/pace/pace.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">
    <!-- Kendo UI style -->
     <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/kendo.common-bootstrap.min.css">
     <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/kendo.bootstrap.min.css">
     <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/kendo.bootstrap.mobile.min.css">
    <!-- BackPack Base CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/backpack/backpack.base.css') }}">
    <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap-iso16.css" /> 
    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

    {{-- datepicker  --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap-datepicker3.css">

     <!-- Global css use in this application -->
    <style type="text/css">

      .toolbar-search {
        float: right;
        margin-right: 12px;
      }
      .text-box-search{
        width: 220px;
      }    
      /*Column grid*/
      .row-12{
        float: left;
        width: 99%;
        padding-right: 1%;
      }
      .row-6{
        float: left;
        width: 50%;
      }
      .col-12{
        float: left;
        width: 96%;
        padding: 0% 2% 2% 2%;
      }
      .col-6{
        float: left;
        width: 47%;
        padding: 0% 2% 2% 1%;
      }
      .row-1-12{
        float: left;
        width: 99%;
        padding-right: 1%;
      }
      .col-1-12{
        float: left;
        width: 98%;
        padding: 0% 1% 2% 1%;
      }
      .col-1-6{
        float: left;
        width: 48%;
        padding: 0% 1% 2% 1%;
      }
      input.k-textbox{
        text-indent: .5em;
      }
      .k-edit-form-container{
        width: 100%; 
      }
      .k-input{
        padding: 0px;
      }
      .k-multiselect-wrap{
        padding-top: 1px;
        padding-bottom: 1px;
        min-height: 2.15em;
      }
    </style>
    @yield('after_styles')
    
</head>
<body class="hold-transition {{ config('app.skin') }} sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
         <a href="{{ url('') }}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">{!! config('app.logo_mini') !!}</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg">{!! config('app.logo_lg') !!}</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          @include('inc.menu')
        </nav>
      </header>

      <!-- =============================================== -->

      @include('inc.sidebar')

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
         @yield('header')

        <!-- Main content -->
        <section class="content">

          @yield('content')

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        @if (config('app.show_powered_by'))
            <div class="pull-right hidden-xs">Powered by <a target="_blank" href="http://cstcambodia.com">CST Cambodia</a>
            </div>
        @endif
        Handcrafted by <a target="_blank" href="{{ config('app.developer_link') }}">{{ config('app.developer_name') }}</a>.
      </footer>
    </div>
    <!-- ./wrapper -->


    @yield('before_scripts')

     <!-- jQuery -->
    <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/jquery.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/jquery-1.11.3.min.js"></script>
    {{-- javascript --}}
    <script type="{{ asset('vendor/adminlte') }}/bootstrap-filestyle.min.js"> </script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/jszip.min.js"></script>
    {{-- datepicker --}}
    <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/kendo.all.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/pace/pace.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/plugins/fastclick/fastclick.js"></script>
    <script src="{{ asset('vendor/adminlte') }}/dist/js/app.min.js"></script>

    {{--  CKeditor  TinyMCE4 --}}
    <script src="{{asset('//cdn.tinymce.com/4')}}/tinymce.min.js"></script>
    
    <!-- page script -->
    <script type="text/javascript">
    
      var crudBaseUrl = "{{url('')}}";
      /*It's status data*/
      var statusDataSource = [
        {value: "Enabled", text: "Enabled"},
        {value: "Disabled", text: "Disabled"}
      ];

      //It's gender data
      var genderDataSource = [
        {value: "Male", text: "Male"},
        {value: "Female", text: "Female"}
      ];
        // To make Pace works on Ajax calls

        $(document).ajaxStart(function() { Pace.restart(); });

        // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        /*Set active state on menu element*/
        var current_url = window.location.href;
        
        $("ul.sidebar-menu li a").each(function() {
          if ($(this).attr('href') === current_url || current_url === $(this).attr('href'))
          {
            $(this).parents('li').addClass('active');
          }
        });

        /*Initialize status dropdownlist*/ 
      function initStatusDropDownList()
      {
        $("#status").kendoDropDownList({
          dataValueField: "value",
          dataTextField: "text",
          dataSource: statusDataSource  
        });
      }

      /*Initialize gender dropdownlist*/ 
      function initGenderDropDownList()
      {
        $("#gender").kendoDropDownList({
          dataValueField: "value",
          dataTextField: "text",
          dataSource: genderDataSource  
        });
      }

      /*
        Initialize article dropdownlist
       */
      function initialArticleDropDownList() {
        $("#article").kendoDropDownList({
          valuePrimitive: true,
          filter: "startswith",
          optionLabel: "Select article...",
          dataTextField: "title",
          dataValueField: "id",
          dataSource: {
            transport: {
              read: {
                url: crudBaseUrl + "/article/get",
                type: "GET",
                dataType: "json"
              }
            }
          }
        }).data("kendoDropDownList");
      }
      
    </script>

    
    @include('inc.alerts')

    @yield('after_scripts')
      

    <!-- JavaScripts -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
