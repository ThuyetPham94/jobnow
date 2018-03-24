@extends('frontend.main')

@section('extra-lib')
<div class="modal fade bs-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Chỉnh sửa Đánh giá</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="id" value="">
				<div class="form-group">
					<label>Tiêu đề</label>
					<input class="form-control" id="title-edit" />
				</div>
				<div class="form-group">
					<label>Đánh giá</label>
					<textarea id="content-edit" class="form-control" style="resize: none;" rows="5"></textarea>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="button" class="btn btn-primary" onclick="postEdit()">Lưu thay đổi</button>
			</div>
		</div>
	</div>
</div>
<style>
	.item{
		position: 	relative;	
	}
	p.review-func{
		position: absolute;
		right: 15px;
		top: 50px;
	}
	p.review-func span{
		margin-left: 	10px;
	}
</style>
{!! HTML::script('frontend/js/jssor.slider.min.js') !!}
{!! HTML::script('frontend/js/slide.js') !!}
<script type="text/javascript">
	function editReview(id) {
			$.ajax({
				url: '{!! route('public.company.getReview') !!}',
				type: 'POST',
				data: {id: id, _token : '{!! csrf_token() !!}'},
			})
			.done(function(output) {
				if(output.code == 200) {
					$('#id').val(output.result.id);
					$('#title-edit').val(output.result.Title);
					$('#content-edit').val(output.result.Review);
					$('#modalEdit').modal('show');
				}else{
					alert ('Error');
				}
			});			
		}

		function postEdit() {
			var id = $('#id').val();
			var Title = $('#title-edit').val();
			var Review = $('#content-edit').val();
			$.ajax({
				url: '{!! route('public.company.postEditReview') !!}',
				type: 'POST',
				data: {id: id, Title : Title, Review : Review, _token : '{!! csrf_token() !!}'},
			})
			.done(function(output) {
				if(output.code == 200) {
					$('#item_'+id+' .detail-cmt').text(output.result.Review);
					$('#item_'+id+' .title-cmt').text(output.result.Title);
					$('#modalEdit').modal('hide');
					$('.des_mes').text('Edit review success');
					$('#popup .popup').attr('id', 'success');
					$('#popup').show();
				}else{
					alert ('Error');
				}				
			});			
		}

		function delReview(id) {
			var r = confirm("Do you delete review!");
			if (r == true) {
				$.ajax({
					url: '{!! route('public.company.delReview') !!}',
					type: 'POST',
					data: {id: id, _token : '{!! csrf_token() !!}'},
				})
				.done(function(output) {
					if(output.code == 200) {
						$('#item_'+id).remove();
						$('.des_mes').text('Delete review success');
						$('#popup .popup').attr('id', 'success');
						$('#popup').show();
					}else{
						$('.des_mes').text('Failse');
						$('#popup .popup').attr('id', 'error');
						$('#popup').show();
					}
				});
			}
		}
		function review() {
			var start = $('#start_rating').val();
			var title = $('#Title').val();
			var review = $('#Review').val();
			@if(!empty(Auth::user()) && Auth::user()->IsCompany == 0)
			$.ajax({
				url: '{!! route('public.company.review') !!}',
				type: 'POST',
				data: { OverallRating: start, Title: title, Review: review,CompanyID : {!! $data->id !!} , _token : '{!! csrf_token() !!}'},
			})
			.done(function(output) {
				if(output.code == 200) {
					$('#Title').val('');
					$('#Review').val('');
					$('.list-cmt').prepend(output.html);
                    $('.start').html(output.count);                    
					$('.des_mes').text('Post review success');
					$('#popup .popup').attr('id', 'success');
					$('#popup').show();
				}else{
					$('.des_mes').text(output.message);
					$('#popup .popup').attr('id', 'error');
					$('#popup').show();
				}
			});
			@else
			$('.des_mes').text('You not logged');
			$('#popup .popup').attr('id', 'error');
			$('#popup').show();
			@endif		
		}

		$(document).ready(function() {
			$('.list-cmt li').hide();
			$('.load-more').hide();
			var cmt = $('.list-cmt').children('li');
			if(cmt.length > 10) {
				$('.load-more').show();
			}
			var num = 10;
			for (var i = 0; i < cmt.length; i++) {
				if(i <= num) {
					var item = cmt[i];
					$(item).show();
				}
			}
			$('.load-more').on('click', function(e) {
				e.preventDefault();
				num += 10;
				for (var i = 0; i < cmt.length; i++) {
					if(i <= num) {
						var item = cmt[i];
						$(item).show();
					}
				}
				if(num >= cmt.length) {
					$('.load-more').hide();
				}
			})
		});

		// paginate job
		$(document).on('click', '.pagination a', function(e) {
				e.preventDefault();								

				var url = $(this).attr('href');
				var page = url.split('page=')[1];

				$.ajax({
					url: '?page='+page,
					type: 'GET',
					data : {}
				})
				.done(function(output) {
					$('#ajax').html(output);
				});
			});

	</script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			
			var jssor_1_options = {
				$AutoPlay: true,
				$AutoPlaySteps: 4,
				$SlideDuration: 160,
				$SlideWidth: 200,
				$SlideSpacing: 3,
				$Cols: 4,
				$ArrowNavigatorOptions: {
					$Class: $JssorArrowNavigator$,
					$Steps: 4
				},
				$BulletNavigatorOptions: {
					$Class: $JssorBulletNavigator$,
					$SpacingX: 1,
					$SpacingY: 1
				}
			};
			
			var jssor_1_slider = new $JssorSlider$("jssor", jssor_1_options);		
            function ScaleSlider() {
            	var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
            	if (refSize) {
            		refSize = Math.min(refSize, 1100);
            		jssor_1_slider.$ScaleWidth(refSize);
            	}
            	else {
            		window.setTimeout(ScaleSlider, 30);
            	}
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);            
        });
		
    </script>
    <style>    	
        .jssorb03 {
        	position: absolute;
        }
        .jssorb03 div, .jssorb03 div:hover, .jssorb03 .av {
        	position: absolute;
        	/* size of bullet elment */
        	width: 21px;
        	height: 21px;
        	text-align: center;
        	line-height: 21px;
        	color: white;
        	font-size: 12px;
        	background: url('img/b03.png') no-repeat;
        	overflow: hidden;
        	cursor: pointer;
        }
        .jssorb03 div { background-position: -5px -4px; }
        .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -35px -4px; }
        .jssorb03 .av { background-position: -65px -4px; }
        .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }        
        .jssora03l, .jssora03r {
        	display: block;
        	position: absolute;
        	/* size of arrow element */
        	width: 55px;
        	height: 55px;
        	cursor: pointer;
        	background: url('img/a03.png') no-repeat;
        	overflow: hidden;
        }
        .jssora03l { background-position: -3px -33px; }
        .jssora03r { background-position: -63px -33px; }
        .jssora03l:hover { background-position: -123px -33px; }
        .jssora03r:hover { background-position: -183px -33px; }
        .jssora03l.jssora03ldn { background-position: -243px -33px; }
        .jssora03r.jssora03rdn { background-position: -303px -33px; }
    </style>
    @stop

    @section('content')
    <div class="main"> 
    	<div class="company-profile-detail margin" style="margin-top: 5px;">
    		<div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden; visibility: hidden;">
    			<!-- Loading Screen -->
    			<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
    				<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
    				<div style="position:absolute;display:block;background:url('/public/frontend/images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
    			</div>
    			<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 500px; overflow: hidden;">
    				<div data-p="225.00" style="display: none;">
    					@if($data->CoverImage != null)
    						@if(@getimagesize(Config::get('images.company_image_url').$data->CoverImage))
    						{!! HTML::image(Config::get('images.company_image_url').$data->CoverImage, $data->Name, ['data-u' => 'image']) !!}
    						@else
    						<img src="{{ asset('frontend/images/banner.jpg') }}"  alt="{!! $data->Name !!}">
    						@endif
    					@else
    					<img src="{{ asset('frontend/images/banner.jpg') }}"  alt="{!! $data->Name !!}">
    					@endif    					
    				</div>		            
		        </div>
		        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:12px;width:40px;height:58px;" data-autocenter="2"></span>
		        <span data-u="arrowright" class="jssora22r" style="top:0px;right:12px;width:40px;height:58px;" data-autocenter="2"></span>
		    </div>
		    <div class="top-main">
		    	<div class="container">
		    		<div class="row">
		    			<div class="col-sm-12">
		    				<div style="width: 80%;">
		    					<div class="logo-svg pull-left col-xs-3" style="text-align: center;">
		    						@if($data->Logo != null)
		    							@if(@getimagesize(Config::get('images.image_company_url_logo').$data->Logo))
		    								<img src="{{ asset(Config::get('images.image_company_url_logo').$data->Logo) }}" alt="{{$data->Name}}" style="width: 100px;height: 100%" />
		    							@else
		    							<img src="{{ asset('uploads/images/logo.jpg') }}"  alt="{!! $data->Name !!}" style="width: 100px;height: 100%" >
		    							@endif
		    						@else
		    						<img src="{{ asset('uploads/images/logo.jpg') }}"  alt="{!! $data->Name !!}" style="width: 100px;height: 100%" >
		    						@endif		    						
		    					</div>
		    					<div class="pull-left detail">
		    						<h2>{!! $data->Name !!}</h2>
		    						<p>{!! $data->Address !!}</p>
		    					</div>
		    					<div class="pull-right start">
		    						<p class="number">{!! $start = ($data->review->count() != 0)?round($data->review()->sum('OverallRating') / $data->review->count()):0 !!}.0</p>
		    						<p class="list-start">
		    							@for($i = 1 ; $i <= 5 ; $i++)
		    							@if($i <= $start)
		    							<span class="glyphicon glyphicon-star active"></span> 
		    							@else
		    							<span class="glyphicon glyphicon-star"></span> 
		    							@endif
		    							@endfor
		    						</p>
		    						<p class="view">
		    							( {!! $data->review->count() !!} Đánh giá )
		    						</p>
		    					</div>
		    					<div class="clearfix"></div>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		    <div class="content-main">
		    	<div class="container">
		    		<div class="row">
		    			<div class="col-sm-12">
		    				<div class="bor-content">
		    					<div class="col-sm-12">
		    						<div class="border">
		    							<ul class="menu-main" role="tablist">
		    								<li class="active" role="presentation">
		    									<a href="#overview" aria-controls="overview" role="tab" data-toggle="tab">
		    										<i class="glyphicon glyphicon-list-alt"></i><span> Tổng quan</span>
		    									</a>
		    								</li>
		    								<li class="" role="presentation">
		    									<a href="#job" aria-controls="job" role="tab" data-toggle="tab">
		    										<i class="glyphicon glyphicon-briefcase"></i><span>Công việc</span>
		    									</a>
		    								</li>
		    							</ul>

		    							<div class="clearfix"></div>
		    						</div>
		    					</div>
		    					<div class="tab-content">
		    						<div id="overview" role="tabpanel" class=" tab-pane active fade in">
		    							<div class="content-text col-sm-12">
		    								<div class="row">		    									
		    									<div class="col-xs-7 col-sm-8">
		    										<div class="view">
		    											<h3 class="title-view">
		    												Tổng quan công ty
		    											</h3>
		    											<p>
		    												{!! nl2br( $data->Overview, true) !!}
		    											</p>
		    											
		    										</div>
		    										<div class="view">
		    											<h3 class="title-view">
		    												Tại sao tham gia cùng chúng tôi?
		    											</h3>
		    											<div>
		    												{!! nl2br( HTML::decode($data->WhyJoinUs) ,true) !!}
		    											</div>
		    											
		    										</div>
		    										
		    									</div>
		    									<div class="col-xs-5 col-sm-4">
		    										<ul class="list-group">
		    											<li class="list-group-item active">Hồ sơ công ty </li>
		    											<li class="list-group-item">
		    												<p>Số điện thoại</p>
		    												<span>{{ $data->ContactNumber }}</span>
		    											</li>
		    											<li class="list-group-item">
		    												<p>Quy mô công ty</p>
		    												<span>{{ $data->companySize->Name }}</span>
		    											</li>
{{-- 
		    											<li class="list-group-item">
		    												<p>EA Reg. ID</p>
		    												<span>{{ $data->EA_Reg}}</span>
		    											</li>

		    											<li class="list-group-item">
		    												<p>EA No</p>
		    												<span>{{ $data->EA_No}}</span>
		    											</li>
 --}}
		    											<li class="list-group-item">
		    												<p>Ngành</p>
		    												<span>{{ $data->industry }}</span>
		    											</li>

		    											<li class="list-group-item">
		    												<p>Website</p>
		    												@if(strpos( $data->Website,'http') == true)
		    												<span><a href="{!! $data->Website !!}" target="_blank">{!! $data->Website !!}</a></span>
		    												@else
															<span><a href="http://{!! $data->Website !!}" target="_blank">{!! $data->Website !!}</a></span>
		    												@endif
		    											</li>

		    											<li class="list-group-item">
		    												<p> Facebook Fan Page</p>
		    												@if(strpos( $data->FaceBookPage,'http') == true)
		    													<span><a href="{!! $data->FaceBookPage !!}" target="_blank">{{ $data->FaceBookPage }}</a></span>
		    												@else
																<span><a href="http://{!! $data->FaceBookPage !!}" target="_blank">{!! $data->FaceBookPage !!}</a></span>
		    												@endif
		    											</li>										
		    										</ul>
		    									</div>
		    									<div class="clearfix"></div>
		    									<div class="img">
		    										<div id="jssor" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden; visibility: hidden;">
		    											<!-- Loading Screen -->
		    											<div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
		    												<div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
		    												<div style="position:absolute;display:block;background:url('img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
		    											</div>
		    											<div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden;">
		    												@foreach($data->image as $img)
		    												@if($img->ImageUrl != $data->CoverImage)
		    												<div style="display: none;">
		    													
		    													@if($img->ImageUrl != null)
		    														@if(@getimagesize(Config::get('images.company_image_url').$img->ImageUrl))
		    														{!! HTML::image(Config::get('images.company_image_url').$img->ImageUrl, '', ['data-u' => 'image']) !!}
		    														@else
		    														<img src="{{ asset('uploads/images/logo.jpg') }}" style="    width: 100%;" />
		    														@endif
		    													@else
		    													<img src="{{ asset('uploads/images/logo.jpg') }}" style="    width: 100%;" />
		    													@endif
		    												</div>
		    												@endif
		    												@endforeach
		    											</div>
		    											<span data-u="arrowleft" class="jssora03l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
		    											<span data-u="arrowright" class="jssora03r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
		    										</div>
		    										<div class="clearfix"></div>
		    									</div>
		    								</div>	
		    							</div>
		    						</div>
		    						<div id="job" role="tabpanel" class="fade tab-pane company-profile-detail-job">
		    							<div class="content-job">
		    								<h3 class="til-job col-sm-12">{!! $count !!} Việc làm {!! $data->Name !!}</h3>
		    								<div class="border">
		    									<div class="content" id="ajax">
		    										<ul class="list-job">
		    											@foreach($data->job as $job)
		    											<li class="col-xs-12">
		    												<div class="col-sm-12 border-item">
		    													<h2 class="title-job"><a href="{!! route('public.job.getDetail', ['id' => $job->id, 'name' => str_slug($job->Title).'.html']) !!}">{!! $job->Title !!}</a></h2>
		    													<div class="des-location">
		    														<a class="location">{!! $job->location->Name !!}</a>
		    														@if($job->IsDisplaySalary == 0)
		    														<a class="salary" href="">Trên mức lương mong muốn</a>
		    														@else
		    														<a class="salary" href="">{!! $job->FromSalary !!} - {!! $job->ToSalary !!} {!! $job->currency->Symbol !!}</a>
		    														@endif
		    													</div>
		    													<div class="description">
		    														<span>Trách nhiệm:</span>
		    														<p>
		    															{!! substr($job->Description, 0 , 300) !!} ... 
		    															<a href="{!! route('public.job.getDetail', ['id' => $job->id, 'name' => str_slug($job->Title).'.html']) !!}">Xem thêm</a>
		    														</p>
		    													</div>
		    													
		    												</div>
		    											</li>
		    											@endforeach
		    										</ul>
		    										<div class="clearfix"></div>
		    										<div class="main-bottom">
														<div class="col-sm-6">
															
														</div>
														<div class="col-sm-6">
															<div class="pull-right">
																{!! $data->job->render() !!}
															</div>
														</div>
														<div class="clearfix"></div>
													</div>
		    									</div>
		    								</div>
		    							</div>
		    						</div>
		    					</div>
		    					<div class="clearfix"></div>
		    				</div>

		    			</div>
		    			<div class="clearfix"></div>
		    		</div>
		    	</div>
		    </div>
		    <div class="maps-main">
		    	<div class="container">
		    		<div class="row">
		    			<div class="col-sm-12">
		    				<div id="map"></div>
		    			</div>
		    			<div class="clearfix"></div>
		    		</div>
		    	</div>
		    </div>
		    <div class="review">
		    	<div class="container">
		    		<div class="row">
		    			<div class="col-sm-12">
		    				<div class="box-review">
		    					<div class="top-review col-sm-12">
		    						<div class="box-topview">
		    							<a class="pull-right btn" onclick="showForm()" href="javascript:void(0)">
		    								Viết đánh giá
		    							</a>
		    							<h3>Ứng viên đánh giá {!! $data->Name !!}</h3>
		    							@if(!isset(Auth::user()->id))
		    							<p>Đăng nhập để đánh giá</p>
		    							@endif
		    							<div class="form">
		    								<form class="form-horizontal">
		    									<h2>Đánh giá</h2>
		    									<div class="form-group">
		    										<label for="inputEmail3" class="col-sm-2 control-label">Đánh giá tổng thể:</label>
		    										<div class="col-sm-10">
		    											<div id="stars-default"><input type="hidden" name="rating"/></div>
		    										</div>
		    									</div>
		    									<input type="hidden" name="start" id="start_rating" />
		    									<div class="form-group">
		    										<label for="inputEmail3" class="col-sm-2 control-label">Tiêu đề:</label>
		    										<div class="col-sm-10">
		    											<input type="text" class="form-control" id="Title" placeholder="Your Title">
		    										</div>
		    									</div>
		    									<div class="form-group">
		    										<label for="inputPassword3" class="col-sm-2 control-label">Đánh giá của bạn:</label>
		    										<div class="col-sm-10">
		    											<textarea class="form-control" id="Review" rows="5" class="form-control"></textarea>
		    											<button type="button" onclick="review()" class="btn btn-default pull-right">Lưu</button>
		    										</div>
		    									</div>
		    								</form>
		    							</div>
		    						</div>
		    					</div>
		    					<ul class="list-cmt">
		    						@foreach($data->review()->orderBy('id', 'DESC')->get() as $item)
		    						<li class="item col-sm-12" id="item_{!! $item->id !!}">
		    							<div class="detail-item">
		    								<span class="time pull-right">{!! date('d/m/Y', strtotime($item->created_at)) !!}</span>
		    								@if(!empty(Auth::user()) && !empty(Auth::user()->jobSeeker) && $item->jobseeker->id == Auth::user()->jobSeeker->id)
		    								<p class="review-func">
		    									<span onclick="editReview({!! $item->id !!})" style="color: blue" class="glyphicon glyphicon-edit"></span> <span onclick="delReview({!! $item->id !!})" style="color: red" class="glyphicon glyphicon-remove"></span>
		    								</p>
		    								@endif
		    								<h3 class="title-cmt">
		    									{!! $item->Title !!}
		    								</h3>
		    								<div class="detail-u">
		    									<span class="name">{!! $item->jobseeker->FullName !!}</span>
		    									@for($i = 1 ; $i <= 5; $i++)
			    									@if($i <= $item->OverallRating)
			    										<span class="list-start glyphicon glyphicon-star">
			    										</span>
			    									@else
			    										<span class="list-start not-rank glyphicon glyphicon-star">
			    										</span>
			    									@endif
		    									@endfor						    						
		    									<i>({!! $item->OverallRating !!}.00)</i>
		    								</div>
		    								<p class="detail-cmt">
		    									{!! $item->Review !!}
		    								</p>
		    							</div>	
		    						</li>
		    						@endforeach
		    					</ul>
		    					<div class="bot-review col-sm-12">
		    						<div>	
		    							<a class="load-more btn pull-right" href="">
		    								Xem thêm
		    							</a>
		    						</div>
		    					</div>
		    					<div class="clearfix"></div>
		    				</div>
		    			</div>
		    		</div>
		    	</div>
		    </div>
		</div>
	</div>
	<script>
		var map;
		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: 20.999211, lng: 105.814851},
				zoom: 12
			});
			var image = '{!! Asset("frontend/images/macker.png") !!}';
			var beachMarker = new google.maps.Marker({
				position: {lat: {!! $data->Latitude !!}, lng: {!! $data->Longitude !!}},
				map: map,
				icon: image,
			});
		}		
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuZwCi-4pzqjrJ-ADryQ3QPAH0zPsbYz0&callback=initMap"
	async defer></script>
	@stop