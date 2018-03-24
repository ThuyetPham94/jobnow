@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.notification.postCreate')]) !!}
			{{ csrf_field() }}
			<div class="form-group">
				<label for="">Tiêu đề</label>
				<input type="text" class="form-control" id="" name="Title">
			</div>
			<div class="form-group">
				<label for="">Nội dung</label>
				<textarea type="text" class="form-control" rows="8" id="" name="Content"></textarea>
			</div>

			<div class="form-group">
                <label for="">Chọn ứng viên</label>
                <div class="form-group">
                    <select class="form-control" style="width: 100%" name="JobSeekerID">
					  @foreach ($JobSeeker as $sk)					 
					  	<option value="{!! $sk->user_id !!}">{!! $sk->FullName !!}</option>
					  @endforeach
					</select>					
                </div>
            </div>

            <div class="form-group">
                <label for="">Select Company</label>
                <div class="form-group">
                    <select class="form-control" style="width: 100%" name="CompanyID">
					  @foreach ($company as $com)					 
					  	<option value="{!! $com->CompanyID !!}">{!! $com->Name !!}</option>
					  @endforeach
					</select>					
                </div>
            </div>

			<div class="clearfix"></div>


			<div class="form-group">
				<label for="">Status</label>
				{!! Form::select('Status', [1 => 'Active', 0 => 'Dective'], null, ['class' => 'form-control']) !!}
			</div>
			<button type="submit" class="btn btn-primary pull-right">Add Notification</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop