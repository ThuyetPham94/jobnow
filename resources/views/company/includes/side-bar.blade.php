<ul class="sidebar-nav" id="accordion">
    <li class="sidebar-brand">
        <a href="{!! route('public.company.index') !!}">
            {{-- <img src="images/logo.png"> --}}
            {!! HTML::image('frontend/jobnow_backend/images/logo.png') !!}
        </a>
    </li>   
    <li class="menu @if(request()->is('ManageCompany')) active @endif">
        <a href="{!! route('public.company.index') !!}">{!! HTML::image('frontend/jobnow_backend/images/dashboad-icon.png') !!} Dashboard</a>
    </li>
        

    <li class="menu @if(request()->is('ManageCompany/job/create')) active @endif">
        <a href="{!! route('public.company.job.getCreate') !!}">{!! HTML::image('frontend/jobnow_backend/images/upload-icon.png') !!} Đăng tin</a>
    </li>
    <!-- update by hung -->
    <style>
        .menu ul{
            list-style: none;
            padding:0px;
        }
        li.panel{
            background:transparent;
            border-width:0px;
            margin:0px;
            padding:0px; 
        }
    </style>
    <li class="panel menu @if(request()->is('ManageCompany/job') || request()->is('ManageCompany/job/done-hiring')) active @endif">
        <a href="#collapse-job" data-toggle="collapse" data-parent="#accordion" aria-controls="collapse-job">
            {!! HTML::image('frontend/jobnow_backend/images/myjob-icon.png') !!}Việc làm của tôi
        </a>

        <ul class="panel-collapse collapse collapseable  @if(request()->is('ManageCompany/job') || request()->is('ManageCompany/job/done-hiring')) in @endif" id="collapse-job">
            <li  class="@if(request()->is('ManageCompany/job')) sub-active @endif" ><a href="{!! route('public.company.job.index') !!}">{!! HTML::image('frontend/jobnow_backend/images/hiring.png') !!}Việc đang tuyển</a></li>
            <li  class="@if(request()->is('ManageCompany/job/done-hiring')) sub-active @endif" ><a href="{!! route('public.company.job.done-hiring') !!}">{!! HTML::image('frontend/jobnow_backend/images/done.png') !!}Việc đã hoàn thành</a></li>
        </ul>
    </li>


    <li class="menu @if(request()->is('ManageCompany/interview')) active @endif">
        <a href="{!! route('public.company.interview') !!}">{!! HTML::image('frontend/jobnow_backend/images/search-icon.png') !!}Phỏng vấn</a>
    </li>
    <li class="menu @if(request()->is('ManageCompany/shortlist')) active @endif">
        <a href="{!! route('public.company.shortlist.shortlist') !!}">{!! HTML::image('frontend/jobnow_backend/images/shortlist.png') !!}danh sách ngắn</a>
    </li>
    <li class="menu @if(request()->is('ManageCompany/account')) active @endif">
        <a href="{!! route('public.company.account') !!}">{!! HTML::image('frontend/jobnow_backend/images/pencil-icon.png') !!} Hồ sơ</a>
    </li>


    
    <li class="panel menu @if(request()->is('ManageCompany/websetting')||request()->is('ManageCompany/term')||request()->is('ManageCompany/invitecredit')||request()->is('ManageCompany/feedback')||request()->is('ManageCompany/privacy')||request()->is('ManageCompany/credit')) active @endif">
        <a href="#collapse-setting" data-toggle="collapse" data-parent="#accordion" aria-controls="collapse-setting">
            {!! HTML::image('frontend/jobnow_backend/images/setting.png') !!} Cài đặt
        </a>

        <ul class="panel-collapse collapse collapseable  @if(request()->is('ManageCompany/websetting')||request()->is('ManageCompany/term')||request()->is('ManageCompany/invitecredit')||request()->is('ManageCompany/feedback')||request()->is('ManageCompany/privacy')||request()->is('ManageCompany/credit')) in @endif" id="collapse-setting">
            <li class="@if(request()->is('ManageCompany/websetting')) sub-active @endif">
                <a href="{!! route('public.company.setting.websetting') !!}">{!! HTML::image('frontend/jobnow_backend/images/websetting.png') !!}Cài đặt chung</a>
            </li>
            <li class="@if(request()->is('ManageCompany/invitecredit')) sub-active @endif">
                <a href="{!! route('public.company.setting.invitecredit') !!}">{!! HTML::image('frontend/jobnow_backend/images/getmore-credit.png') !!} Nhận thêm credit</a>
            </li>
            <li class="@if(request()->is('ManageCompany/feedback')) sub-active @endif">
                <a href="{!! route('public.company.setting.feedback') !!}">{!! HTML::image('frontend/jobnow_backend/images/feedback.png') !!} Phản hồi</a>
            </li>
            <li class="@if(request()->is('ManageCompany/privacy')) sub-active @endif">
                <a href="{!! route('public.company.setting.privacy') !!}">{!! HTML::image('frontend/jobnow_backend/images/privacy.png') !!} Chính sách bảo mật</a>
            </li>
            <li class="@if(request()->is('ManageCompany/term')) sub-active @endif">
                <a href="{!! route('public.company.setting.term') !!}">{!! HTML::image('frontend/jobnow_backend/images/privacy.png') !!} Điều khoản sử dụng</a>
            </li>
        </ul>
    </li>
    <li class="menu @if(request()->is('ManageCompany/checkout')) active @endif">
        <a href="{!! route('public.company.checkout') !!}">{!! HTML::image('frontend/jobnow_backend/images/getmore-credit.png') !!}Mua credits</a>
    </li>
</ul>
<div class="clearfix"></div>