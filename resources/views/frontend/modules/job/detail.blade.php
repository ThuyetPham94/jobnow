@extends('frontend.main')

@section('extra-lib')
	<script type="text/javascript">
		$(document).ready(function() {
			$('p.save-job').on('click', function() {
				var is = $('.saved').attr('data-is');
				//console.log(is);
				savedJob(is);
			});
		});	
		function savedJob(is) {
			//console.log(is);
			@if(!empty(Auth::user()) && Auth::user()->IsCompany ==0 )
				var id = '{!! $data->id !!}';
				$.ajax({
					url: '{!! route('public.job.postSaved') !!}',
					type: 'POST',
					data: {idJob: id, _token : '{!! csrf_token() !!}'},
				})
				.done(function(output) {
					// console.log(output);
					if(output.code == 200){
						//alert("Saved Job");
						if(is == 0){
							$('.saved').attr('data-is', 1);
							$('.des_mes').text('Job saved successfully');
							$('#popup .popup').attr('id', 'success');
							$('#popup').show();
						}else{
							$('.saved').attr('data-is', 0);
							$('.des_mes').text('Removed');
							$('#popup .popup').attr('id', 'success');
							$('#popup').show();
						}
						$('p.save-job span').toggleClass('active');

					}else{
						$('.des_mes').text('Error');
						$('#popup .popup').attr('id', 'error');
						$('#popup').show();
					}
				});				
			@else
				$('.des_mes').text('You are not logged');
				$('#popup .popup').attr('id', 'warning');
				$('#popup').show();
				// alert('You are not logged');
			@endif
		}
		function appliedJob() {
			@if(!empty(Auth::user()) && Auth::user()->IsCompany ==0 )
				var id = '{!! $data->id !!}';
				$.ajax({
					url: '{!! route('public.job.postApplied') !!}',
					type: 'POST',
					data: {idJob: id, _token : '{!! csrf_token() !!}'},
				})
				.done(function(output) {
					//console.log(output);
					if(output.code == 200){
						$('.des_mes').text(output.message);
						$('#popup .popup').attr('id', 'success');
						$('#popup').show();
						$('.apply').text('Approved');
					}else{
						$('.des_mes').text(output.message);
						$('#popup .popup').attr('id', 'warning');
						$('#popup').show();
					}
				});				
			@else
				$('.des_mes').text('You are not logged');
				$('#popup .popup').attr('id', 'warning');
				$('#popup').show();
			@endif
		}

		var obj = {
                "data":""
            };
           function getLocation(latlng){
              var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=";
             
              // var latlng = "21.025065587036384,105.78829765319824";
            var key = "AIzaSyBv5DQpiye2WEKFfzKVW-56fI_BX5fqRYc";
            url+=latlng+"&key="+key;
            
            $.ajax({
                dataType: "json",
                type: "GET",
                url: url,
                cache: false,
                data: {'latlng':latlng,'key':key},
                success: function(data){
                    obj.data = data.results[0].formatted_address;
                    $("#Location").append(obj.data);
                }
            });
		}

		var latlng = "{!!$data->Latitude.','.$data->Longitude!!}";                
        getLocation(latlng);

	</script>
@stop

@section('content')
	<div class="app details-job margin" style="margin-top: 10px">
		<div class="container">
			 
		    <div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
                        @if($data->company->CoverImage != null)
                        	@if(@getimagesize(Config::get('images.company_image_url').$data->company->CoverImage))
							{!! HTML::image(Config::get('images.company_image_url').$data->company->CoverImage, $data->company->Name, ["style"=>"width: 1140px; height: 310px;"]) !!}
							@else
							<img src="{{ asset('frontend/images/banner.jpg') }}" style="width: 1140px; height: 310px;" alt="{!! $data->company->Name !!}">
							@endif
                        @else
                            <img src="{{ asset('frontend/images/banner.jpg') }}" style="width: 1140px; height: 310px;" alt="{!! $data->company->Name !!}">
                        @endif
					</div>
				</div>
			</div>
		    <div class="company-profile-detail-job company-profile-detail">
				<div class="top-main">
			    	<div class="">
			    		<div class="row">
			    			<div class="col-sm-12">
			    				<div>
				    				<div class="col-xs-2 images" style="text-align: center;">
				    					<a href="{!! route('public.company.getDetail', ['id' => $data->company->id, 'name' => str_slug($data->company->Name).'.html']) !!}">
                                                @if($data->company->Logo != null)
                                                	@if(@getimagesize(Config::get('images.image_company_url_logo').$data->company->Logo))
                                                    {!! HTML::image(Config::get('images.image_company_url_logo').$data->company->Logo, $data->company->Name, ['width' => '100px', 'height' => '100px']) !!}
                                                    @else
                                                    <img src="{{ asset('uploads/images/logo.jpg') }}" style="width: 100px; height: 100px;" alt="{!! $data->company->Name !!}">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('uploads/images/logo.jpg') }}" style="width: 100px; height: 100px;" alt="{!! $data->company->Name !!}">
                                                @endif				    						
				    					</a>
				    				</div>
				    				<div class="col-xs-7 de-job">
				    					<h2>{!! $data->Title !!}</h2>
				    					<p class="name-company"><a href="{!! route('public.company.getDetail', ['id' => $data->company->id, 'name' => str_slug($data->company->Name).'.html']) !!}">{!! $data->company->Name !!}</a></p>
				    					<ul>
				    						@if($data->Latitude != 0 && $data->Longitude != 0 )
				    						<li class="pull-left central">
				    							<i class="glyphicon glyphicon-map-marker"></i>
				    							<span id="Location"></span>
				    						</li>
				    						@endif
				    						<li class="pull-left active salary">
				    							<i class="fa fa-usd" aria-hidden="true"></i>
				    							@if($data->IsDisplaySalary == 1)
				    								<span>{!! number_format($data->FromSalary,2) !!} - {!! number_format($data->ToSalary,2) !!} {!! $data->currency->Symbol !!}</span>
				    							@else
				    								<span>Trên mức lương mong muốn</span>
				    							@endif
				    						</li>
				    						@if($data->YearOfExperience != null )
				    						<li class="pull-left excu">
				    							<i class="glyphicon glyphicon-briefcase"></i>
				    							<span>{!! $data->YearOfExperience !!}</span>
				    						</li>
				    						@endif
				    					</ul>
				    				</div>
				    				<div class="col-xs-3 func-job">
				    					@if($check == 1)
				    						<a class="my-btn">
					    						Đã ứng tuyển
					    					</a>
				    					@else
					    					<a class="my-btn apply" onclick="appliedJob()">
					    						Ứng tuyển công việc này
					    					</a>
				    					@endif
				    					<p class="save-job">				    						
				    						<?php
				    							$saved = '';
				    							$is = 0;
				    						?>
				    						@if(!empty(Auth::user()->id))
					    						@foreach(Auth::user()->savedJob as $val) 
					    							@if($val->id == $data->id)
					    								<?php 
					    									$saved = 'active';
					    									$is = 1;
					    									break;
					    								?>
					    							@endif
					    						@endforeach
				    						@endif
				    						<span class="glyphicon glyphicon-star saved {!! $saved !!} " data-is="{!! $is !!}"></span>Lưu công việc này
				    					</p>
				    				</div>
			    				</div>
			    			</div>
			    		</div>
			    	</div>
			    </div>
		    </div>
	    </div>
	    <div class="container content-detail-job">
	    	<div class="border-detail-job">
	    		<div class="col-xs-7 col-sm-8 detail-des">
	    			<div>
		    			<div class="job-des">
		    				Chi tiết công việc
		    			</div>
		    			<ul>
		    				<li>
		    					<div class="tit-des">
		    						Mô tả công việc
		    					</div>
		    					<ul class="list-des">
		    						<li>
		    							{!! nl2br( $data->Description, true ) !!}
		    						</li>
		    					</ul>
		    				</li>
		    				<li>
		    					<div class="tit-des">
		    						Yêu cầu công việc
		    					</div>
		    					<ul class="list-des">
		    						<li>{!! nl2br( $data->Requirement, true ) !!}</li>
		    					</ul>
		    				</li>
		    			</ul>
	    			</div>
	    			
	    		</div>
	    		<div class="col-xs-5 col-sm-4 more-des">
	    			<div class="snap">
	    				Cấp bậc công việc *
	    			</div>
	    			<ul>
	    				<li>
	    					{!! $data['joblevel']->Name !!}
	    				</li>
	    				<li>
	    					<span>Danh mục việc làm</span>
	    					@for($i = 0 ;$i<count($data['Category']) ; $i++)
	    						{!! $data['Category'][$i] !!} <br>
	    					@endfor
	    					
	    				</li>
	    				<li>
	    					<span>Số năm kinh nghiệm</span>
	    					{!! $data['Experience']->Name !!}
	    				</li>
	    			</ul>
	    		</div>
	    		<div class="clearfix"></div>
	    	</div>
	    </div>
	    <div class="container content-detail-job" >
	    	<div class="border-detail-job" style="padding-bottom: 15px; padding-top: 15px;">
			    <div class="map col-sm-12">
			    	<div class="location-work">
		    			<div class="job-des">
		    				Trụ sở làm việc    
		    			</div>
		    			<p class="address">Địa chỉ: {!! $data->location->Name !!}</p>
		    			{{--  --}}
		    			<div id="map"></div>

		    			<script>
						  var map;
						  var markers = [];
						  function initMap() {
						    map = new google.maps.Map(document.getElementById('map'), {
						      center: {lat: {!! ($data->Latitude)?$data->Latitude:0 !!}, lng: {!! ($data->Longitude)?$data->Longitude:0 !!}},
						      zoom: 14
						    });

						    var image = '{!! Asset("frontend/images/macker.png") !!}';
						    var marker = new google.maps.Marker({
						      position: {lat: {!! $data->Latitude !!}, lng: {!! $data->Longitude !!}},
						      map: map,
						      icon:image
						    });
						  }
						</script>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuZwCi-4pzqjrJ-ADryQ3QPAH0zPsbYz0&callback=initMap&libraries=places&sensor=false" async defer></script>
					</div>
			    </div>
			    <div class="clearfix"></div>
	    	</div>
	    </div>
	    <div class="container content-detail-job-2">
	    	<div class="border-detail-job">
	    		<div class="col-xs-7 col-sm-8">
	    			<div class="job-des">
	    				Tổng quan công ty
	    			</div>	    			
	    			<p>{!! nl2br( $data->company->Overview, true ) !!}</p>
	    			<div class="detail-contact">
	    				<p class="email">Email: {!! $data->company->users->Email !!}</p>
	    				<p class="tel">Số điện thoại:  {!! $data->company->ContactNumber !!} </p>
	    				<p class="Homepage">Website: <a href="http://	{!! $data->company->Website !!}" target="_blank">{!! $data->company->Website !!}</a></p>
	    			</div>
	    		</div>

	    		<div class="col-xs-5 col-sm-4 img-detail">

	    		
	    		</div>
	    		<div class="clearfix"></div>
	    	</div>
	    </div> 
	    <div class="container bot-main">
	    	<div class="border">
			    <div class="col-xs-6 m-see">
			    	<p class="see"><a href="">Xem người khác đã được ứng tuyển</a></p>
			    	<p class="count">{{ $data->applied->count() }}Các ứng viên khác cho vị trí này</p>
			    	@if(!isset(Auth::user()->id))
			    		<p>Đăng nhập để xem chi tiết</p>
			    	@endif
		    	</div>
		    	<div class="col-xs-6 text-right">
		    		@if($check == 1)
						<a class="my-btn">
    						Đã ứng tuyển
    					</a>
					@else
    					<a class="my-btn apply" onclick="appliedJob()">
    						Ứng tuyển cho việc làm này
    					</a>
					@endif
					<p class="save-job">
						<span class="glyphicon glyphicon-star saved {!! $saved !!}"></span>Lưu việc làm này
					</p>
		    	</div>		    	
		    	<div class="clearfix"></div>
		    </div>
	    </div>
	</div>
	</div>
@stop