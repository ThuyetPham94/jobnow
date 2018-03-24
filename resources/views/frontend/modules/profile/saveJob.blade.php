@extends('frontend.main')

@section('content')
	<div class="app save-job margin">
		<div class="container">
			<div class="row">
				@include('frontend.modules.profile.includes.detail-user')
				<div class="col-xs-8 col-sm-9 list-app-job content-job">
					<div class="border">
						<div class="til">
						    <h3>Việc đã lưu <span id="count">({!! $count !!} jobs) </span></h3>
					    </div>
						<div class="col-sm-12 content">
						    <ul class="list-job">
						    	@if(count($list_saveJob))
							    	@foreach($list_saveJob as $item)
										<li class="col-xs-12" id="saved_{!! $item->id !!}">
											<h2 class="title-job">
											<a href="{!! route('public.job.getDetail', ['id' => $item->id, 'name' => str_slug($item->Title).'.html']) !!}">{!! $item->Title !!}</a><span class="pull-right glyphicon glyphicon-remove" onclick="savedJob({!! $item->id !!})" style="font-size: 12px;color: #a00;cursor: pointer;"></span></h2>
											<div class="des-location">
												<a class="location">{!! $item->Location !!}</a>
												@if($item->IsDisplaySalary == 1)
				    								<a class="salary" href="">{!! $item->FromSalary !!} - {!! $item->ToSalary !!} </a>
				    							@else
				    								<a class="salary" href="">Trên mức lương mong muốn</a>
				    							@endif
											</div>
											<div class="description">
												<span>Trách nhiệm:</span>
												<p>
													{!! substr($item->Description, 0 , 300) !!} ...
													<a href="{!! route('public.job.getDetail', ['id' => $item->id, 'name' => str_slug($item->Title).'.html']) !!}">Chi tiết</a>
												</p>
											</div>
											<div class="des-company">
												<div class="pull-left de-com">
													<div class="img pull-left">
														<a href="{!! route('public.company.getDetail', ['id' => $item->CompanyID->id, 'name' => str_slug($item->CompanyID->Name).'.html']) !!}">														
														@if($item->CompanyID->Logo != null)
															@if(@getimagesize(Config::get('images.image_company_url_logo').$item->CompanyID->Logo))
																<img src="{!! Asset(Config::get('images.image_company_url_logo').$item->CompanyID->Logo) !!}" title="{!! $item->CompanyID->Name !!}" style="width: 100%; margin-top: 10px;">
															@else
																<img src="{!! Asset('uploads/images/logo.jpg') !!}" title="{!! $item->CompanyID->Name !!}" style="width: 100%; margin-top: 10px;">
															@endif
														@else
															<img src="{!! Asset('uploads/images/logo.jpg') !!}" title="{!! $item->CompanyID->Name !!}" style="width: 100%; margin-top: 10px;">
														@endif

														</a>
													</div>
													<div class="detail pull-left">
														<h2><a href="{!! route('public.company.getDetail', ['id' => $item->CompanyID, 'name' => str_slug($item->Name).'.html']) !!}">{!! $item->CompanyID->Name !!}</a></h2>
														<span class="time-post">
															Đã đăng: {!! \Carbon\Carbon::createFromTimeStamp(strtotime($item->created_at))->diffForHumans(); !!}
														</span>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="pull-right">
													<p class="des-enginer">
													</p>
												</div>
												<div class="clearfix"></div>
											</div>
										</li>
									@endforeach
								@else
									<li class="list-job">
										<h1 style="text-align: center;color: #5e5e5e;">Không công việc nào được lưu</h1>
									</li>
								@endif
						    </ul>
						    <div class="clearfix"></div>
						    <div class="main-bottom">
								<div class="col-sm-6">
									
								</div>
								<div class="col-sm-6">
									<div class="pull-right">
										{!! $list_saveJob->render() !!}
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop