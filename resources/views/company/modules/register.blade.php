@extends('frontend.main')
@section('main-header')
	<div class="col-md-10 col-sm-10 users">
		<ul>
			<li class="signup"><a href="{!! route('public.company.getLogin') !!}">Đăng nhập</a></li>
			<li class="employers">
				<a href="{!! url() !!}">
					Ứng viên
				</a>
			</li>
		</ul>
		<style type="text/css">
			.employers a{
				background: #026dbb;
				color: #fff !important;
				border: none !important;
				padding: 10px 30px !important;
			}
			.signup{
				margin-right: 10px;
			}
			.signup a{
				border: 1px solid #026dbb;
				color: #026dbb !important;
				padding: 10px 15px !important;
			    border-radius: 5px;
			    font-weight: bold;
			}
			.header .main-header .users .signup a{
				border-left: 1px solid #026dbb;
			}
			/* .header .main-header .users ul li>a{
				color: ##026dbb !important;
			} */
			.company-signup h1 {
			    text-align: center;
			    padding-bottom: 40px;
			}
			.register_company_form{
				border-top: 1px solid #f0f0f0;
				padding-top: 20px;
				margin-bottom: 40px;
			}
			.sign_up_company {
			    width: 100%;
			    text-transform: uppercase;
			    padding: 10px;
			    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#288ccb+0,40adf2+100 */
				background: #288ccb; /* Old browsers */
				background: -moz-linear-gradient(top,  #288ccb 0%, #40adf2 100%); /* FF3.6-15 */
				background: -webkit-linear-gradient(top,  #288ccb 0%,#40adf2 100%); /* Chrome10-25,Safari5.1-6 */
				background: linear-gradient(to bottom,  #288ccb 0%,#40adf2 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#288ccb', endColorstr='#40adf2',GradientType=0 ); /* IE6-9 */
				border: 0px;

			}
			p.company_login{
				margin-top: 20px;
				text-align: center;
			}
			p.company_login a{
				color: #fa603c;
			}
		</style>
	</div>
@stop
@section('login')
@stop
@section('extra-lib')
	<script type="text/javascript">
		$(document).ready(function() {
            $.validator.addMethod("PHONE", function(value, element) {
                return this.optional(element) || /^[0-9\s\+]{9,15}$/i.test(value);
            }, "Phone Number failse.");

            $('#companyReg').validate({
                rules : {
                    Name:"required",
					CompanySizeID:"required ",
					Email:{
			            required: true,
			            email: true
			        },
					Password:"required",
					re_password:{
						equalTo : '#password'
					},
					ContactNumber:"required PHONE",
					IndustryID:"required ",
                },
                messages: {
                	ContactNumber: "Sai số điện thoại",
                }
            });
            
        });
	</script>
	<style type="text/css">
		#Check-error{
		    display: block;
		    text-align: left;
		}
	</style>

@stop
@section('content')
	<div class="company-signup" style=" background:#fff; margin-top: 10px; padding-top: 20px; margin-bottom: 20px">
		<h1>ĐĂNG KÝ MIỄN PHÍ</h1>
		<div class="row">
			<div class="col-xs-3">
			</div>

			<div class="col-xs-6 register_company_form">
				@if(count($errors))
	                @foreach($errors->all() as $error)
	                    <p style="color: red;"><strong>(*) {!! $error !!}</strong></p>
	                @endforeach
	            @endif
				<form id="companyReg" action="{!! route('public.company.postCompanyregister') !!}" method="POST" role="form">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">		
				<div class="form-group">
					<label for="email">Địa chỉ email <span>*</span></label>
					<input type="text" class="form-control" id="email" name="Email" placeholder="">
				</div>
				<div class="form-group">
					<label for="password">Mật khẩu <span>*</span></label>
					<input type="password" class="form-control" id="password" name="Password" placeholder="">
				</div>
				<div class="form-group">
					<label for="re_password">Xác nhận mật khẩu <span>*</span></label>
					<input type="password" class="form-control" id="re_password" name="re_password" placeholder="">
				</div>
				<div class="form-group">
					<label for="Name">Tên công ty <span>*</span></label>
					<input type="text" class="form-control" id="Name" name="Name" placeholder="">
				</div>
				<div class="form-group">
					<label for="Industry">Ngành <span>*</span></label>
					<select name="IndustryID" id="Industry" class="form-control">
						<option value="">Lựa chọn</option>
						@foreach ($industry as $value)
							<option value="{!! $value->id !!}">{!! $value->Name !!}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="CompanySize">Quy mô công ty <span>*</span></label>
					<select name="CompanySizeID" id="CompanySize" class="form-control" >
						<option value="">Lựa chọn</option>
						@foreach ($companySize as $value)
							<option value="{!! $value->id !!}">{!! $value->Name !!}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="phonenumber">Số điện thoại <span>*</span></label>
					<input type="text" class="form-control" id="phonenumber" name="ContactNumber" placeholder="">
				</div>
			
				<button type="submit" class="btn btn-primary sign_up_company">Đăng ký</button>
				<p class="company_login">Bạn đã có tài khoản rồi? <a href="{!! route('public.company.getLogin') !!}">Đăng nhập tại đây</a></p>
			</form>
			</div>
		</div>
	</div>
@stop