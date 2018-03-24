@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.notification.postCreate')]) !!}
			<div class="form-group">
				<label for="">Title</label>
				<input type="text" class="form-control" id="" name="Title">
			</div>
			<div class="form-group">
				<label for="">Content</label>
				<textarea type="text" class="form-control" rows="8" id="" name="Content"></textarea>
			</div>

			<div class="form-group">
                <label for="">Select User</label>
                <div class="form-group">
                    <select class="js-example-basic-multiple" id="User" style="width: 100%" name="User[]" multiple="multiple">
					  @foreach ($user as $sk)
					  @if($sk->jobSeeker && $sk->jobSeeker->FullName && !empty($sk->jobSeeker->FullName))
					  <?php $fullname = $sk->jobSeeker->FullName; ?>
					  @else
					  <?php $fullname = ""; ?>
					  @endif
					  	<option value="{!! $sk->id !!}">{!! $sk->Username.'/'.$sk->Email.'/'.$fullname !!}</option>
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


			<div class="form-group">
				<label for="">Status</label>
				{!! Form::select('Status', [1 => 'Active', 0 => 'Dective'], null, ['class' => 'form-control']) !!}
			</div>
			<button type="submit" class="btn btn-primary pull-right">Add Notification</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop