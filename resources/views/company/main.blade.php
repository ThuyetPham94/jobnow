<!DOCTYPE html>
<html lang="en">

<head>

    @section('head')
        @include('company.includes.head')
    @show
    <meta name="google-site-verification" content="ddeLe0t6sXWUStHk_0-iPNknoDQFwtEAvtV-I3oHdc8" />
</head>

<body>
    <div id="wrapper" style="min-height: 1500px">
    <!-- Sidebar -->
        <div id="sidebar-wrapper" >
            @section('side-bar')
                @include('company.includes.side-bar')
            @show
        </div>
        <div class="clearfix"></div>
        <!-- /#sidebar-wrapper -->

        <div id = "top-menu">
            @section('top-menu')
                @include('company.includes.top-menu')
            @show
        </div>

        <!-- content -->
        <div id="page-content-wrapper">
            @yield('content')
        </div>
        <div class="clearfix"></div>
    </div>

    <!-- Bootstrap Core JavaScript -->
    @section('footer')
        @include('company.includes.footer')
    @show
    
    <div class="clearfix"></div>
</body>

</html>
