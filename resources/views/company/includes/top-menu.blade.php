<div class="col-sm-12">
    <div class="row"> 
        <div class="col-xs-1">
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"></a>
        </div>
        <div class="col-xs-6">
            <!--<form action="" method="POST" role="form">-->
                <div class="form-group">
                    <input type="text" class="form-control" id="" placeholder="Search..">
                    <input type="hidden" value="{!! csrf_token() !!}" name="_token">
                </div>                            
            <!--</form>-->
        </div>
        <div class="col-xs-5">
            <div class="user">
                <div class="pull-right logout">
                    <a href="{!! route('public.user.logout') !!}">Đăng xuất</a>
                </div>
                <div class="avata pull-right">
                    <a href=" ">
                    <?php ?>
                    @if(Auth::user()->companyProfile->Logo != null)
                        @if(@getimagesize(Config::get('images.image_company_url_logo').Auth::user()->companyProfile->Logo))                                               
                        {!! HTML::image(Config::get('images.image_company_url_logo').Auth::user()->companyProfile->Logo, '', ['width' => '100%']) !!}
                        @else
                        {!! HTML::image('upload/images/company/logo/df_avatar.jpg', '', ['width' => '100%']) !!}
                        @endif
                    @else
                        {!! HTML::image('upload/images/company/logo/df_avatar.jpg', '', ['width' => '100%']) !!}
                    @endif
                    </a>
                    <span class="full-name"><?php echo (Auth::user()->companyProfile && Auth::user()->companyProfile->Name)?Auth::user()->companyProfile->Name:"Name"; ?></span>
                </div>
                <div class="pull-right" style="color: #268ccc;margin-top: 17px;margin-right: 15px">
                    credits
                </div>
                <div class="pull-right">
                    <div style="display: flex;color: #268ccc">
                        <div style="font-size: 30px">{{ Auth::user()->CreditNumber }}</div>                        
                    </div>
                </div>
                
                <div class="clearfix"></div>
            </div>  
        </div>
    </div>  
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div>