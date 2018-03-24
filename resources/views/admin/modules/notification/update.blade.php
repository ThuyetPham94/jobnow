@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.notification.postUpdate', ['id' => $data->id])]) !!}
			<div class="form-group">
				<label for="">Name</label>
				<input type="text" class="form-control" id="" value="{!! $data->Title !!}" name="Title">
			</div>
			<div class="form-group">
				<label for="">ZipCode</label>
				<textarea type="text" class="form-control" id="" rows="8" name="Content">{!! $data->Content !!}</textarea>
			</div>

			<div class="form-group">
                <label for="">Select User</label>
                <div class="form-group">
                    <select class="form-control" style="width: 100%" name="JobSeekerID">
					  @foreach ($JobSeeker as $sk)
					  	@if($sk->user_id == $data->JobSeekerID)					 
					  	<option selected="" value="{!! $sk->user_id !!}">{!! $sk->FullName !!}</option>
					  	@else
					  	<option value="{!! $sk->user_id !!}">{!! $sk->FullName !!}</option>
					  	@endif
					  @endforeach
					</select>					
                </div>
            </div>

            <div class="form-group">
                <label for="">Select Company</label>
                <div class="form-group">
                    <select class="form-control" style="width: 100%" name="CompanyID">
					  @foreach ($company as $com)					 
					  	@if($com->CompanyID == $data->CompanyID)					 
					  	<option selected="" value="{!! $com->CompanyID !!}">{!! $com->Name !!}</option>
					  	@else
					  	<option value="{!! $com->CompanyID !!}">{!! $com->Name !!}</option>
					  	@endif
					  @endforeach
					</select>					
                </div>
            </div>
			<div class="clearfix"></div>


			<div class="form-group">
				<label for="">Status</label>
				{!! Form::select('Status', [1 => 'Active', 0 => 'Dective'], $data->Status, ['class' => 'form-control']) !!}
			</div>
			<button type="submit" class="btn btn-primary pull-right">Update Notification</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop