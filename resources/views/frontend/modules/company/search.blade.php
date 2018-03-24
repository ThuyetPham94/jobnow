@extends('frontend.main')
@section('search')
@stop
@section('extra-style')
	<style type="text/css">
		.header-search{
			padding: 50px 0px;
			background: url('/frontend/images/company.jpg') no-repeat left center;
			background-size: 100%;
			background-position: 0px -450px;
		}
		.header-search .col-sm-2{
			font-weight: bold;
			color: #fff;
			line-height: 40px;
		}
		.header-search .col-sm-8{

		}
		.header-search .col-sm-8 .form-group{
			width: 100%;
		}
		.header-search .col-sm-8 .form-group .input-group{
			position: relative;
			width: 100%;
			height: 40px;
		}
		.header-search .col-sm-8 .form-group .input-group input{
			height: 40px;
			border-radius: 0;
		}
		.header-search .col-sm-8 .form-group .input-group button{
			position: absolute;
			right: 0;
			z-index: 999;
			height: 100%;
			width: 138px;
			border: 0;
			border-radius: 0;
			font-weight: bold;
			color: #fff;
			background: linear-gradient(#3eabf0, #2a8ece);
		}
		.header-search .col-sm-8 .form-group .input-group i{
			margin-right: 5px;
		}
		.search-company .container{
			background: #fff;
			padding: 15px;
		}
		.search-result {
			margin-bottom: 15px;
		}
		.search-result span{
			font-weight: bold;
			color: #0982ea;
		}
		.list-results {

		}
		.list-results .item{
			    background: #fafafa;
    padding: 20px;
    position: relative;
        border: 1px solid #e4e4e4;
    margin-bottom: 10px;
		}
		.list-results .item .logo{
			
		}
		.list-results .item .logo img{
			
		}
		.list-results .item .des-company{
			
		}
		.list-results .item .des-company .company-name{
			
		}
		.list-results .item .des-company .company-name a{
		    font-size: 18px;
		    font-weight: bold;
		    color: #333;
		}
		.list-results .item .des-company .company-name a:hover{
    		color: #2879c0;
		}
		.list-results .item .des-company .location{
			margin-bottom: 5px;
    margin-top: 10px;
    padding-left: 30px;
    background: url('/frontend/images/icon/location2.png') no-repeat 5px center;
		}
		.list-results .item .des-company .location i{
			
		}
		.list-results .item .des-company .scale{
			padding-left: 30px;
			 background: url('/frontend/images/icon/employer.png') no-repeat left center;
			
		}
		.list-results .item .des-company .scale i{
			
		}
		.list-results .item .des-company{
			
		}
		.list-results .item .find-more{
			text-transform: uppercase;
		    position: absolute;
		    right: 0;
		    bottom: 0;
		    padding: 10px 20px 10px 40px;
		    background: url('/frontend/images/icon/find-more.png') no-repeat;
		    background-size: 100% 100%;
		}
		.list-results .item .find-more a{
			color: #fff;
		}
		.list-results .item .find-more:hover{
			background-image: url('/frontend/images/icon/find-more-hover.png');
		}
	</style>
@stop
@section('content')
	<div class="header-search">
		<div class="container">
			<div class="col-sm-2">TÌM KIẾM CÔNG TY</div>
			<div class="col-sm-8">
				<div class="input">
					<form class="form-inline" method="GET" action="{!! route('public.company.search') !!}">
						<div class="form-group">
							<div class="input-group" style="position: relative">
								<input type="text" class="form-control" id="exampleInputAmount" placeholder="Search for a company" name="keywork" value="{!! request()->keywork !!}">
								<button type="submit" class="input-group-addon" style="position: absolute; right: 0; z-index: 999;height: 100%;width: 150px;"><i class="fa fa-search" aria-hidden="true"></i> TÌM KIẾM</button>
								<!-- <div class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></div> -->
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="main">
		<div class="search-company margin">
			<div class="container">
				<div class="search-result">
					<span>{!! $data->count() !!}</span>Kết quả tìm thấy
				</div>
				<ul class="list-results">
				@if(count($data))
					@foreach($data as $item)
						<li class="item">
							<div class="col-sm-2 logo">
								@if($item->Logo)
									<a href=""><img src="{!! Asset(Config::get('images.image_company_url_logo').$item->Logo) !!}"></a>
								@else
									<a href=""><img src="{!! Asset('/frontend/images/icon/company-default.png') !!}"></a>
								@endif
							</div>
							<div class="col-sm-7 des-company">
								<div class="company-name">
									<a href="{!! route('public.company.getDetail', ['id' => $item->id, 'name' => str_slug($item->Name).'.html']) !!}">{!! $item->Name !!}</a>
								</div>
								<p class="location">
									<i class=""></i> {!! $item->Address !!}
								</p>
								<p class="scale">
									<i class=""></i> {!! $item->companySize->Name !!} Nhà tuyển dụng
								</p>
							</div>
							<div class="find-more">
								<a href="">
									Tìm hiểu thêm
								</a>								
							</div>
							<div class="clearfix"></div>
						</li>
					@endforeach
				@endif
				</ul>
			</div>
		</div>
	</div>
@stop