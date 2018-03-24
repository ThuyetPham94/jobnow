@extends('frontend.main')

@section('extra-style')
	<style type="text/css">
		#upload_link{
    		text-decoration:none;
		}
		#upload{
		    display:none
		}
		.bootstrap-tagsinput{
			border: 1px solid #ccc;
			padding: 7px 5px;
			background: #fff;
		}
		.bootstrap-tagsinput span.tag {
			float: left;
			padding: 5px 30px 5px 5px;
			margin-right: 10px;
			background: url('/frontend/jobnow_backend/images/icon/back-tag.png') no-repeat center center;
			background-size: 100% 100%;
			color: #1e1e1e;
		}
		.bootstrap-tagsinput input{
		    border: none;
		    box-shadow: none;
		    outline: none;
		    background-color: transparent;
		    padding: 0 6px;
		    margin: 0;
		    width: auto;
		    max-width: inherit;
		}
		.display{
			display: none;
		}
	</style>
	<script type="text/javascript">
		function download(link) {			
			if(link == '' || link == 'None CV'){
                //$('.cv').show();
            }else{
                location.href = "{!! route('public.company.interview.downloadCVSeeker',['file'=>$data->CurriculumVitae]) !!}";
            }			
		}
	</script>
@stop

@section('content')
<div class="app margin">
	<div class="container">
		<div class="row">
			@include('frontend.modules.profile.includes.detail-user')
			<div class="col-xs-8 col-sm-9 list-app-job content-job">
				<div class="border">
					<div class="til">
						<h3>Thông tin cá nhân</h3>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-11 content">
						<div class="profile-detail">
							{!! Form::open(['url' => route('public.myprofile.postUpdate'), 'enctype'=>'multipart/form-data']) !!}
								<div class="form-group">
									<div class="col-xs-12">
										<label for="fullname" class="label-title">Tên đầy đủ: <span class="required">*</span></label>
										<input type="text" class="form-control" id="fullname" value="{!! $data->jobseeker->FullName !!}" name="FullName" placeholder="Jakichan">
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<label for="gender" class="label-title">Giới tính: <span class="required">*</span></label>
										<div class="clearfix"></div>
										@if($data->jobseeker->Gender == 1)
											<label class="radio-inline">
											<input type="radio" name="Gender" value="1" checked="checked"> Nam
											</label>
											<label class="radio-inline">
											<input type="radio" name="Gender" value="0"> Nữ
											</label>
										@else
											<label class="radio-inline">
											<input type="radio" name="Gender" value="1"> Nam
											</label>
											<label class="radio-inline">
											<input type="radio" name="Gender" value="0" checked="checked"> Nữ
											</label>
										@endif
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<label for="birthday" class="label-title">Ngày sinh: <span class="required">*</span></label>
									</div>
									<div class="clearfix"></div>
									<?php
										$birthday = $data->jobseeker->BirthDay;
										if($birthday != null && $birthday != ''){
											$arr_birth = explode("-", $birthday);
										}
									?>
									<div class="col-xs-2">
										<select class="form-control" name="day">
											@for($i = 1 ; $i <= 31 ; $i++)
												<option value="{!! $i !!}" @if(!empty($arr_birth) && $i==$arr_birth[2]) selected @endif>{!! $i !!}</option>
											@endfor
										</select>
									</div>
									<div class="col-xs-4">
										<select class="form-control" name="mouth">
											@for($i = 1 ; $i <= 12 ; $i++)
												<option value="{!! $i !!}" @if(!empty($arr_birth) &&  $i==$arr_birth[1]) selected @endif>{!! $i !!}</option>
											@endfor
										</select>
									</div>
									<div class="col-xs-2">
										<select class="form-control" name="year">
											@for($i = date('Y') ; $i >= 1960  ; $i--)
												<option value="{!! $i !!}" @if(!empty($arr_birth) && $i==$arr_birth[0]) selected @endif>{!! $i !!}</option>
											@endfor
										</select>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="form-group">
									<div class="col-xs-12">
										<label for="email" class="label-title">Email :<span class="required">*</span></label>
										<input type="email" disabled="disabled" class="form-control" id="email" value="{!! $data->Email !!}" name="Email"  placeholder="abcde@gmail.com">
									</div>
								</div>								
								<div class="form-group">
									<div class="col-xs-6">
										<label for="country" class="label-title">Quốc gia:<span class="required">*</span></label>
										<select class="form-control" name="Country" id="country">
											@foreach($country as $val)
												@if($data->jobseeker->CountryID == $val->id)
													<option selected="selected" value="{!! $val->id !!}">{!! $val->Name !!}</option>
												@else
													<option value="{!! $val->id !!}">{!! $val->Name !!}</option>
												@endif
											@endforeach	
										</select>
									</div>	
									<div class="col-xs-6">
										<label for="phone" class="label-title">Điện thoại:<span class="required">*</span></label>
										<input type="text" class="form-control" id="phone" value="{!! $data->jobseeker->PhoneNumber !!}" name="PhoneNumber" placeholder="Phone Number">
									</div>								
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<label for="description" class="label-title">Mô tả:<span class="required">*</span></label>
										<textarea class="form-control" rows="8" id="description" name="Description" style="height: 100px; resize: none;">{!! $data->jobseeker->Description !!}</textarea>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<label for="description" class="label-title">Tải CV:<span class="required">*</span></label>
										<div class="clearfix"></div>
										<div class="input-group input-icon-left" id="row_1">
											<input placeholder="CV" disabled="disabled" class="form-control" id="cv" name="cv" type="text" value="{!! $data->jobseeker->CurriculumVitae !!}">
											<input id="upload" type="file" name="CurriculumVitae">
											<span class="input-group-btn"> <a id="upload_link" href="#" class="btn btn-default iframe-btn" style="padding: 8px;">{!! HTML::image('frontend/images/icon/file-select-icon.png') !!} Chọn tệp..</a> </span>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="form-group save-change-cv">
									<button type="submit" class="btn btn-default">Lưu</button>
									@if($data->CurriculumVitae != null)
									<button type="button" onclick="download('{{ $data->CurriculumVitae }}')" class="btn btn-default"><i class="fa fa-download" aria-hidden="true"></i> <span>Download CV
									@endif
									</span></button>									
								</div>							
							{!! Form::close() !!}
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="border expience">
					<div class="til">
						<h3>Kinh nghiệm</h3>
						<div class="pull-right add-expience"><a href="javascript:void(0)">+ Thêm kinh nghiệm</a></div>
					</div>
					<div class="content content-expire">
						<div class="col-sm-1"></div>
						<?php $display = 'display' ?>
						<div class="col-sm-11 {!! $display !!}" id="addEx">
							<div class="profile-detail">
								{{-- {!! Form::open(['url' => route('public.myprofile.postCreateEx'), 'method' => 'POST']) !!} --}}
									<div class="form-group">
										<div class="col-xs-6">
											<label for="comname" class="label-title">Tên công ty<span class="required">*</span></label>
											<input type="text" class="form-control" name="CompanyName" id="comName" placeholder="">
										</div>
										<div class="col-xs-6">
											<label for="jobposition" class="label-title">Vị trí <span class="required">*</span></label>
											<input type="text" class="form-control" name="PositionName" id="jobPos" placeholder="">
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-4">
											<label for="comname" class="label-title">Ngày bắt đầu <span class="required">*</span></label>
											<div class='input-group date' id='FromDate'>
                                                <input type='text' name="FromDate" class="form-control" id="FromDate" />
                                                <span class="input-group-addon">
                                                    <b class="glyphicon glyphicon-calendar"></b>
                                                </span>
                                            </div>											
										</div>
										<div class="col-xs-4">
											<label for="jobposition" class="label-title">Ngày kết thúc <span class="required">*</span></label>
											<div class='input-group date' id='ToDate'>
                                                <input type='text' name="ToDate" class="form-control" id="ToDate" />
                                                <span class="input-group-addon">
                                                    <b class="glyphicon glyphicon-calendar"></b>
                                                </span>
                                            </div>											
										</div>
										<div class="col-xs-4">
											<label for="jobposition" class="label-title">Lương <span class="required">*</span></label>											
											<input type="text" class="form-control" name="Salary" id="Salary" placeholder="">
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-12">
											<label for="description" class="label-title">Mô tả:<span class="required">*</span></label>
											<textarea class="form-control" rows="8" name="Description" style="height: 100px; resize: none;" id="jobDes"></textarea>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="form-group pull-right save-expience">
										<button type="reset" class="btn btn-default">Hủy</button>
										<button type="button" id="addExpre" class="btn btn-primary">Lưu</button>
									</div>
								{{-- {!! Form::close() !!} --}}
							</div>
							<div class="clearfix"></div>
						</div>
						.<!-- end .content-expice -->
						<div class="expire-box">
							<div class="col-sm-1"></div>
							<div class="your-expience col-sm-10">
								@foreach(Auth::user()->experience()->orderBy('id', 'DESC')->get() as $val)
									<div class="box-pience" id="ex_{!! $val->id !!}">
										<div class="col-xs-12 det">
											<div class="company">{!! $val->CompanyName !!} <a href="javascript:void(0)" onclick="destroy({!! $val->id !!})" class="pull-right">{!! HTML::image('frontend/images/icon/delete-your-expience.png') !!}</a></div>
											<div class="position">{!! $val->PositionName !!}</div>
											<div class="description">{!! $val->Description !!}</div>
										</div>
										<div class="clearfix"></div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="border skill">
					<div class="til">
						<h3>Kỹ năng</h3>
						<div class="pull-right add-skill"><a href="javascript:void(0)">+ Thêm kỹ năng</a></div>
					</div>
					<div class="content content-skill">
						<div class="col-sm-1"></div>
						<?php $display = 'display' ?>
						<div class="col-sm-11 {!! $display !!}" id="addSkill">
							<div class="profile-detail">
								{{-- {!! Form::open(['url' => route('public.myprofile.postCreateSkill'), 'method' => 'POST']) !!} --}}
									<div class="form-group">
                                        <label for="">Tất cả kỹ năng</label>
                                        <div class="form-group">
                                            <!-- <input type="text" class="form-control" value="" name="Skill" id="Skill" data-role="tagsinput"> -->
                                            <select class="js-example-basic-multiple" id="Skill" style="width: 100%" name="Skill" multiple="multiple">
											  @foreach ($skill as $sk)
											  	<option value="{!! $sk->id !!}">{!! $sk->Name !!}</option>
											  @endforeach
											</select>
											<style type="text/css">
												.js-example-basic-multiple span{
													width: 100%;
												}
											</style>
											<link rel="stylesheet" href="{!! Asset('frontend/select2/css/select2.css') !!}">
											<!-- jQuery -->
											<script src="https://code.jquery.com/jquery.js"></script>
											<script type="text/javascript" src="{!! Asset('frontend/select2/js/select2.full.js') !!}"></script>
											<script type="text/javascript">
											$(".js-example-basic-multiple").select2();
											</script>
                                        </div>
                                    </div>
									<div class="clearfix"></div>
									<div class="form-group pull-right save-expience">
										<button type="reset" class="btn btn-default">Hủy</button>
										<button type="button" id="addS" class="btn btn-primary">Lưu</button>
									</div>
								{{-- {!! Form::close() !!} --}}
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="clearfix"></div>
					<div class="your-skill">
						<div class="col-sm-1"></div>
						<div class="col-xs-11" id="listSkill">
							@foreach($data->jobseekerskill()->orderBy('id', 'DESC')->get() as $val)
								<p class="JobSeekerSkill{!! $val->id !!}">{!! $val->Name !!} <i class="glyphicon glyphicon-remove RemoveSkill" js_id="{!! $val->id !!}"></i><span></span></p>
							@endforeach
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop