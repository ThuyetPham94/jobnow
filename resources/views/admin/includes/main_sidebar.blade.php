<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
    </div>
    <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <li @if(request()->is('admin')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.home') !!}"  ><i class="fa fa-dashboard"></i>DashBoard</a>
        </li>
        <li @if(request()->is('admin/location')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.location.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Vị trí</a>
        </li>
        {{-- <li @if(request()->is('admin/country')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.country.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Quốc gia</a>
        </li> --}}
        {{-- <li @if(request()->is('admin/currency')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.currency.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Đơn vị tiền</a>
        </li> --}}
        <li @if(request()->is('admin/industry')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.industry.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Ngành</a>
        </li>
        <li @if(request()->is('admin/companysize')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.companysize.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Quy mô công ty</a>
        </li>
        <li @if(request()->is('admin/skill')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.skill.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Kỹ năng</a>
        </li>
        {{-- <li @if(request()->is('admin/notification')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.notification.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Thông báo</a>
        </li> --}}
        <li @if(request()->is('admin/feedback')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.feedback.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Phản hồi</a>
        </li>
        <li @if(request()->is('admin/job')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.job.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Việc làm</a>
        </li>
        <li @if(request()->is('admin/joblevel')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.joblevel.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Cấp bậc công việc</a>
        </li>
       {{--  <li @if(request()->is('admin/company')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.companyprofile.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Công ty</a>
        </li> --}}
        <li @if(request()->is('admin/contact')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.contact.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Liên hệ</a>
        </li>
        <li @if(request()->is('admin/user')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.user.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Người dùng</a>
        </li>
        <li @if(request()->is('admin/term')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.term.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Kì hạn và điều kiện</a>
        </li>
        <li @if(request()->is('admin/privacy')) {!! 'class="active"' !!} @endif>
            <a href="{!! route('admin.privacy.getIndex') !!} "  ><i class="fa fa-dashboard"></i>Chính sách bảo mật</a>
        </li>
    </ul> 
</section>
