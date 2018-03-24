@extends('frontend.main')

@section('extra-lib')
	
	<script type="text/javascript">

		$(document).ready(function() {
			$('#IndustryID').on('change' , function () {
				var id = $(this).val();
				$.ajax({
					url: '{!! route('public.job.getSkill') !!}',
					type: 'POST',
					data: {id: id, _token : '{!! csrf_token() !!}'},
				})
				.done(function(output) {

					if(output.result != null) {
						var op_html = '';
						$.each(output.result, function(index, val) {
							op_html += '<li><div class="checkbox"><input type="checkbox" id="s_'+val.id+'" class="css-checkbox search-ajax" name="Skill" value="'+val.id+'"><label for="s_'+val.id+'" name="checkbox2_lbl" class="css-label lite-cyan-check">'+val.Name+'</label></div></li>';
						});
						console.log(op_html);
						$('#Skill').html(op_html);
					}else{
						$('#Skill').html('');
					}
				});
				
			});


			$('.search-ajax').on('change', function(){

				var skill = [];
				$.each($('input[name="Skill"]:checked'),function() {
					skill.push($(this).val());
				});

				var location = [];
				$.each($('input[name="Location"]:checked'),function() {
					location.push($(this).val());
				});

				var level = [];
				$.each($('input[name="Level"]:checked'),function() {
					level.push($(this).val());
				});

				var experience = [];
				$.each($('input[name="experience"]:checked'),function() {
					experience.push($(this).val());
				});

				var title = $('#TitleJob').val();
				var salary = $('#FromSalaryJob').val();

				// console.log(location);
				var url = window.location.href;
				var new_url = url.split('?page=')[0];
				history.pushState({}, "", new_url);

				$.ajax({
					url: '{!! route('public.job.index') !!}',
					type: 'GET',
					data : {skill: skill,experience:experience, location : location, Title : title, FromSalary: salary, level: level}
				})
				.done(function(output) {
					$('.ajax').html(output);
				});
				
			});
			var i = 1;
			$('#orderDate').on('click', function(){
				console.log(i);
				var date = 'DESC';
				if(i%2 == 0) {
					date = 'DESC';
				}else{
					date = 'ASC';
				}
				i++;
				console.log(i);
				var skill = [];
				$.each($('input[name="Skill"]:checked'),function() {
					skill.push($(this).val());
				});

				var location = [];
				$.each($('input[name="Location"]:checked'),function() {
					location.push($(this).val());
				});
				var level = [];
				$.each($('input[name="Level"]:checked'),function() {
					level.push($(this).val());
				});

				var title = $('#TitleJob').val();
				var salary = $('#FromSalaryJob').val();

				var url = window.location.href;
				var new_url = url.split('?page=')[0];
				history.pushState({}, "", new_url);
				$.ajax({
					url: '{!! route('public.job.index') !!}',
					type: 'GET',
					data : {skill: skill, location : location, Title : title, FromSalary: salary, Date : date, level: level}
				})
				.done(function(output) {
					// console.log(output);
					$('.ajax').html(output);
				});
				
			});
			$(document).on('click', '.pagination a', function(e) {
				e.preventDefault();
				var skill = [];
				$.each($('input[name="Skill"]:checked'),function() {
					skill.push($(this).val());
				});

				var location = [];
				$.each($('input[name="Location"]:checked'),function() {
					location.push($(this).val());
				});
				var level = [];
				$.each($('input[name="Level"]:checked'),function() {
					level.push($(this).val());
				});

				var title = $('#TitleJob').val();
				var salary = $('#FromSalaryJob').val();

				var url = $(this).attr('href');
				var page = url.split('page=')[1];

				$.ajax({
					url: '?page='+page,
					type: 'GET',
					data : {skill: skill, location : location, Title : title, FromSalary: salary, level: level}
				})
				.done(function(output) {
					$('.ajax').html(output);
				});
			});

			$("#showmore").click(function(){
				$('.hideskill').css('display', 'block');
				$('.hideskill').show();
				$(this).remove();
			});
		});
	</script>
@stop

@section('content')
	<div class=" container margin">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
				<ul>
					<li class="li main-search">
						<div class="title">
							Tiêu chí tìm kiếm
						</div>
						<div class="col-xs-12">
							<form method="GET">
								<div class="form-group">
									<input type="text" class="form-control" name="Title" id="TitleJob" value="{!! request()->Title !!}" placeholder="Job Title or keyworks.....">
								</div>
								<div class="form-group">
									<select name="Industry" id="IndustryID" class="form-control">
										<option value="">Tất cả chuyên ngành</option>
										@foreach ($industry as $val)
											<option value="{{ $val->id }}" @if(request()->Industry == $val->id) selected @endif>{{ $val->Name }}</option>
										@endforeach
									</select>	
								</div>
								<div class="form-group">
									<input type="text" value="{!! request()->FromSalary !!}" class="form-control" name="FromSalary" id="FromSalaryJob" placeholder="Mức lương tối thiểu (VND)">
								</div>
								<button type="submit" class="btn btn-default">Tìm kiếm</button>
							</form>
						</div>
						<div class="clearfix"></div>
					</li>
					<style type="text/css">
						.checkbox{
							padding: 5px 0 5px 0;							
						}						

						/*mozilla scrolbalken*/
						@-moz-document url-prefix(http://),url-prefix(https://) {
						scrollbar {
						   -moz-appearance: none !important;
						   background: rgb(0,255,0) !important;
						}
						thumb,scrollbarbutton {
						   -moz-appearance: none !important;
						   background-color: rgb(0,0,255) !important;
						}

						thumb:hover,scrollbarbutton:hover {
						   -moz-appearance: none !important;
						   background-color: rgb(255,0,0) !important;
						}

						scrollbarbutton {
						   display: none !important;
						}

						scrollbar[orient="vertical"] {
						  min-width: 15px !important;
						}
						}
						/**/
						.scroll {
						    left: 0; right: 0;						    
						    overflow: auto;
						    height: 350px;
						}
						/*.scroll .inner {
						    height: 2011px;
						    width: 1985px;
						    padding: 1em;
						    background-color: white;
						    font-family: sans-serif;
						}*/
						::-webkit-scrollbar {
						    background: transparent;
						}
						::-webkit-scrollbar-thumb {
						    background-color: rgba(0, 0, 0, 0.2);
						    border: solid whiteSmoke 4px;
						}
						::-webkit-scrollbar-thumb:hover {
						    background-color: rgba(0, 0, 0, 0.3);
						}

					</style>
					<li class="li main-checkbox ">
						<div class="title">
							Nơi làm việc
						</div>
						<ul class="col-xs-12 scroll">
							@foreach($locations as $location)
							<li>
								<div class="checkbox">
									<input type="checkbox" id="l_{!! $location->id !!}" class="css-checkbox search-ajax" name="Location" value="{!! $location->id !!}">
									<label for="l_{!! $location->id !!}" name="checkbox2_lbl" id="txt_{!! $location->id !!}" class="css-label lite-cyan-check">									
									{!! $location->Name !!}									
									</label>
								</div>
								@if(strlen($location->Name) >28)
									<style type="text/css">
										#txt_{!! $location->id !!}{
											line-height: 20px;
											height: 40px;
										}
									</style>
								@else
									<style type="text/css">
										
									</style>
								@endif
							</li>
							@endforeach
						</ul>
						<div class="clearfix"></div>
					</li>
					<li class="li main-checkbox skill">
						<div class="title">
							Kỹ năng
						</div>
						<ul class="col-xs-12  scroll" id="Skill">						
							@foreach($skills as $skill)
								<li>
									<div class="checkbox">
										<input type="checkbox" id="s_{!! $skill->id !!}" class="css-checkbox search-ajax" name="Skill" value="{!! $skill->id !!}">
										<label for="s_{!! $skill->id !!}" name="checkbox2_lbl" id="skill_{!! $skill->id !!}" class="css-label lite-cyan-check">{!! $skill->Name !!}</label>
									</div>
									@if(strlen($skill->Name) >30)
										<style type="text/css">
											#skill_{!! $skill->id !!}{
												line-height: 20px;
												height: 25px;
											}
										</style>								
									@endif
								</li>
							@endforeach							
						</ul>
						<div class="clearfix"></div>
					</li>

					<li class="li main-checkbox experience">
						<div class="title">
							Kinh nghiệm công việc
						</div>
						<ul class="col-xs-12" id="Skill">						
							@foreach($experience as $experience)
								<li>
									<div class="experience">
										<input type="checkbox" id="e_{!! $experience->id !!}" class="css-checkbox search-ajax" name="experience" value="{!! $experience->id !!}">
										<label for="e_{!! $experience->id !!}" name="checkbox2_lbl" class="css-label lite-cyan-check">{!! $experience->Name !!}</label>
									</div>
								</li>
							@endforeach							
						</ul>
						<div class="clearfix"></div>
					</li>
					<li class="li main-checkbox position">
						<div class="title">
							Cấp bậc
						</div>
						<ul class="col-xs-12">
							<li>
								<div class="checkbox">
									<input type="checkbox" id="le_1" class="css-checkbox search-ajax" name="Level" value="1">
									<label for="le_1" name="checkbox3_lbl" class="css-label lite-cyan-check">Học việc</label>
								</div>
							</li>
							<li>
								<div class="checkbox">
									<input type="checkbox" id="le_2" class="css-checkbox search-ajax" name="Level" value="2">
									<label for="le_2" name="checkbox3_lbl" class="css-label lite-cyan-check">Có kinh nghiệm</label>
								</div>
							</li>
							<li>
								<div class="checkbox">
									<input type="checkbox" id="le_3" class="css-checkbox search-ajax" name="Level" value="3">
									<label for="le_3" name="checkbox3_lbl" class="css-label lite-cyan-check">Quản lý</label>
								</div>
							</li>
							<li>
								<div class="checkbox">
									<input type="checkbox" id="le_4" class="css-checkbox search-ajax" name="Level" value="4">
									<label for="le_4" name="checkbox3_lbl" class="css-label lite-cyan-check">Giám đốc</label>
								</div>
							</li>							
						</ul>
						<div class="clearfix"></div>
					</li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 content-main">
				<div class="content-job">
					<div class="til">
						<h3>Việc làm từ tất cả các chuyên ngành <span>({!! $count !!} jobs) </span></h3>
					</div>
					<div class="content">
						<div class="nav-job col-xs-12">
							<div class="pull-left">
								<ul>
									<li class="active">Tất cả việc làm</li>
								</ul>
							</div>
							<div class="pull-right">
								<ul>
									<li>Sắp xếp theo</li>
									<li>
										<a href="#" id="orderDate">Ngày</a>
									</li>
								</ul>
							</div>
							<div class="clearfix"></div>
						</div>
						<p class="clearfix"></p>
						<div class="ajax">
							<ul class="list-job">
								@if($data->count() > 0)
									@foreach($data as $job)
										<li class="col-xs-12">
											<h2 class="title-job"><a href="{!! route('public.job.getDetail', ['id' => $job->id, 'name' => str_slug($job->Title).'.html']) !!}">{!! $job->Title !!}</a></h2>
											<div class="des-location">
												<a class="location">{!! $job->location->Name !!}</a>
												@if($job->IsDisplaySalary == 1)
				    								<a class="salary" href="">{!! number_format($job->FromSalary, 2) !!} - {!! number_format($job->ToSalary,2) !!} {!! $job->currency->Symbol !!}</a>
				    							@else
				    								<a class="salary" href="">Trên mức lương mong muốn</a>
				    							@endif
											</div>
											<div class="description">
												<span>Trách nhiệm:</span>
												<p>
													{!! nl2br(str_limit($job->Description, 300), true) !!} ... 
													<a href="{!! route('public.job.getDetail', ['id' => $job->id, 'name' => str_slug($job->Title).'.html']) !!}">Xem thêm</a>
												</p>
											</div>
											<div class="des-company">
												<div class="pull-left de-com">
													<div class="img pull-left">
													<?php
														$com_id = $job->company_info->id;
														$com_name = $job->company_info->Name;
														$com_logo = $job->company_info->Logo;
														//var_dump($com_id."_".$com_name."_".$com_logo); die;
													?>
														<a href="{!! route('public.company.getDetail', ['id' => $com_id, 'name' => str_slug($com_name).'.html']) !!}">
														@if(Config::get('images.image_company_url_logo').$com_logo != null)
															@if(@getimagesize(Config::get('images.image_company_url_logo').$com_logo))
																<img src="{!! Asset(Config::get('images.image_company_url_logo').$com_logo) !!}" title="{!! $com_name !!}" style="width: 100%;">
															@else
																<img src="{!! Asset('uploads/images/logo.jpg') !!}" title="{!! $com_name !!}" style="width: 100%;">
															@endif
														@else
															<img src="{!! Asset('uploads/images/logo.jpg') !!}" title="{!! $com_name !!}" style="width: 100%;">
														@endif
														
														</a>
													</div>
													<div class="detail pull-left">
														<h2><a href="{!! route('public.company.getDetail', ['id' => $com_id, 'name' => str_slug($com_name).'.html']) !!}">{!! $com_name !!}</a></h2>
														<span class="time-post">
															Đã đăng: {!! \Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans(); !!}
														</span>
													</div>
													<div class="clearfix"></div>
												</div>
												<div class="pull-right">
													<p class="text-right">
														<a href="javascript:void(0)">{{ $job->joblevel }}</a>
													</p>
													<p class="text-right">
														Ngành: {{ $job->industry->Name }}
													</p>
												</div>
												<div class="clearfix"></div>
											</div>
										</li>
									@endforeach
								@else
									<li>
										<h1 class="text-center" style="margin: 20px 0; font-size: 25px;">Không tìm thấy kết quả</h1>
									</li>
								@endif
							</ul>
							<div class="clearfix"></div>
							<div class="main-bottom">
								<div class="col-sm-4">
									@if($data->count() > 0)
									<p>Hiển thị <span id="currentPage">@if($data->lastPage() == 0) 0 @else {!! $data->currentPage() !!} @endif</span> of <span id="total">{!! $data->lastPage() !!}</span> Các kết quả</p>
									@endif
								</div>
								<div class="col-sm-8">
									<div class="pull-right">
										@if (isset($data) && $data->count()>0 && $data->lastPage() > 1)
									    <ul class="pagination">
									        
									        <?php
									        $interval = isset($interval) ? abs(intval($interval)) : 7 ;
									        $from = $data->currentPage() - $interval;
									        if($from < 1){
									            $from = 1;
									        }
									        
									        $to = $data->currentPage() + $interval;
									        if($to > $data->lastPage()){
									            $to = $data->lastPage();
									        }
									        ?>
									        
									        <!-- first/previous -->
									        @if($data->currentPage() > 1)
									            <li>
									                <a href="{{ $data->url(1) }}" aria-label="First">
									                    <span aria-hidden="true">First</span>
									                </a>
									            </li>
									            <li>
									                <a href="{{ $data->url($data->currentPage() - 1) }}" aria-label="Previous">
									                    <span aria-hidden="true">&lsaquo;</span>
									                </a>
									            </li>
									        @endif
									        
									        <!-- links -->
									        @for($i = $from; $i <= $to; $i++)
									            <?php 
									            $isCurrentPage = $data->currentPage() == $i;
									            ?>
									            <li class="{{ $isCurrentPage ? 'active' : '' }}">
									                <a href="{{ !$isCurrentPage ? $data->url($i) : '#' }}">
									                    {{ $i }}
									                </a>
									            </li>
									        @endfor
									        
									        <!-- next/last -->
									        @if($data->currentPage() < $data->lastPage())
									            <li>
									                <a href="{{ $data->url($data->currentPage() + 1) }}" aria-label="Next">
									                    <span aria-hidden="true">&rsaquo;</span>
									                </a>
									            </li>

									            <li>
									                <a href="{{ $data->url($data->lastpage()) }}" aria-label="Last">
									                    <span aria-hidden="true">Last</span>
									                </a>
									            </li>
									        @endif
									        
									    </ul>

									@endif
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

				</div>
				
			</div>
			
			<div class="clearfix"></div>
		</div>
	</div>
	<style type="text/css">
		ul.pagination{
			margin: 0;
		}
	</style>
@stop