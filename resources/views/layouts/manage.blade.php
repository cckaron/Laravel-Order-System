<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- BEGIN STYLESHEETS -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
    <link type="text/css" rel="stylesheet" href="{{ URL::to('css/font-awesome.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::to('css/bootstrap.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::to('css/materialadmin.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::to('css/material-design-iconic-font.min.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::to('css/libs/DataTables/jquery.dataTables.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::to('css/libs/DataTables/extensions/dataTables.colVis.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::to('css/libs/DataTables/extensions/dataTables.tableTools.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::to('css/libs/select2/select2.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ URL::to('css/print.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">




    @yield('styles')
</head>
<body class="menubar-pin menubar-hoverable header-fixed "> <!--max sidemenu: menubar-pin -->
@include('manage.header')
@include('manage.base')


<!-- BEGIN JAVASCRIPT -->
<script src="{{ URL::to('js/libs/jquery/jquery-1.11.2.min.js') }}"></script>
<script src="{{ URL::to('js/libs/jquery/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ URL::to('js/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::to('js/libs/nanoscroller/jquery.nanoscroller.min.js') }}"></script>

<!-- DATATABLE -->
<script src="{{ URL::to('js/libs/DataTables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('js/libs/DataTables/extensions/ColVis/js/dataTables.colVis.min.js') }}"></script>
<script src="{{ URL::to('js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>


<script src="{{ URL::to('js/core/App.js') }}"></script>
<script src="{{ URL::to('js/core/AppNavigation.js') }}"></script>
<script src="{{ URL::to('js/core/AppOffcanvas.js') }}"></script>
<script src="{{ URL::to('js/core/AppCard.js') }}"></script>
<script src="{{ URL::to('js/core/AppForm.js') }}"></script>
<script src="{{ URL::to('js/core/AppVendor.js') }}"></script>
<script src="{{ URL::to('js/core/Demo.js') }}"></script>
<script src="{{ URL::to('js/core/DemoTableDynamic.js') }}"></script>
<script src="{{ URL::to('js/libs/select2/select2.min.js') }}"></script>
{{--<script src="{{ URL::to('js/xlsx/xlsx.full.min.js') }}"></script>--}}
<script src="https://cdn.rawgit.com/eligrey/FileSaver.js/5733e40e5af936eb3f48554cf6a8a7075d71d18a/FileSaver.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.13.2/xlsx.full.min.js"></script>

{{--datepicker--}}
<script src="https://cdn.bootcss.com/moment.js/2.17.1/moment.min.js"></script>
<script type="text/javascript" src="{{ URL::to('js/bootstrap-datetimepicker.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!--ADD TinyMCE-->
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=iv5p4gkx86bpmor83tc5b1n9y5jm5els22kv9mduo2tgkn8j"></script>
<script type="text/javascript" src="{{ URL::to('js/libs/TinyMCE/langs/zh_TW.js') }}"></script>

<!-- END JAVASCRIPT -->

@yield('scripts')
</body>
</html>
