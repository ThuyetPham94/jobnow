<!DOCTYPE html>
<html>
    <head>
        @section('head')
            @include('admin.includes.head')
        @show
        <style type="text/css">
            .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td{
                 border: 1px solid #E2E2E2 !important;
            }
            .table-striped>tbody>tr:nth-of-type(odd) {
                background-color: rgba(236, 236, 236, 0.78) !important;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                @section('mainHeader')
                    @include('admin.includes.main_header')
                @show
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                @section('main-sidebar')
                    @include('admin.includes.main_sidebar')
                @show
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="container-fluid" style="">
                    <div class="bg" style="background: #fff;margin:15px 0;">
                        <section class="content-header">
                            @section('content-header')
                                @include('admin.includes.content_header')
                            @show
                        </section>

                        <!-- Main content -->
                        <section class="content">
                            @if(count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @yield('content')               
                        </section><!-- /.content -->
                    </div>
                </div>
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
                {{-- <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2016 <a href="{!! url() !!}">JobNow</a>.</strong> --}}
            </footer>
            <!-- jQuery 2.1.4 -->
            @section('javascript-lib')
                @include('admin.includes.javascript_lib')
            @show
    </body>
</html>
