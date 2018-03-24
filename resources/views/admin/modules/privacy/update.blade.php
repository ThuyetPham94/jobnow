@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.privacy.postUpdate', ['id' => $data->id])]) !!}
			<div class="form-group">
				<label for="">Tiêu đề</label>
				<input type="text" class="form-control" required="" value="{!! $data->Title !!}" name="Title">
			</div>
			<div class="form-group">
				<label for="">Mô tả</label>
				<textarea type="text" class="form-control" required="" rows="8" name="Description">{!! $data->Description !!}</textarea>
			</div>						
			<div class="clearfix"></div>		
			<button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop