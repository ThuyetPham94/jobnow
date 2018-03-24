<ul class="nav-html">
	<li><a href="{!! route('public.contactus') !!}" @if(request()->is('contact-us')) class="active" @endif>Liên hệ chúng tôi</a></li>
	<li><a href="{!! route('public.term') !!}" @if(request()->is('term-of-use')) class="active" @endif >Điều khoản sử dụng
</a></li>
	<li><a href="{!! route('public.privacy') !!}" @if(request()->is('privacy-policy')) class="active" @endif>Chính sách bảo mật
</a></li>
	<li><a href="{!! route('public.safe') !!}" @if(request()->is('safe')) class="active" @endif>Hướng dẫn tìm việc làm an toàn</a></li>
</ul>
<style type="text/css">
.nav-html {
	    margin-top: 10px;
}
.nav-html li{

}
.nav-html a{
	padding: 3px 10px; display: block; color: #3e3d3d; font-size: 13px; border-left: 2px solid; border-color: #f0f0f0;
}
.nav-html a:hover {
    border-color: #015d92;
}
.nav-html a.active{
	border-color: #015d92;
}
</style>