<!-- Logo -->
<a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>J</b>Now</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Job</b>Now</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">    
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                {!! HTML::image('./backend/dist/img/user2-160x160.jpg', 'User Image', ['class' => 'user-image']) !!}
                <span class="hidden-xs">ADMIN</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        {!! HTML::image('./backend/dist/img/user2-160x160.jpg', 'User Image', ['class' => 'img-circle']) !!}
                        <p>
                            ADMIN
                            <small>JobNew</small>
                        </p>
                    </li>                    
                    <li class="user-body">                       
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">                        
                        <div class="pull-right">
                        <a href="{!! route('admin.logout') !!}" class="btn btn-default btn-flat">Đăng xuất</a>
                        </div>
                    </li>
                </ul>
            </li>                        
        </ul>
    </div>
</nav>