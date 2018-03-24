@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.joblevel.postUpdate', ['id' => $data->id])]) !!}
			<div class="form-group">
				<label for="">Tên</label>
				<input type="text" class="form-control" required="" value="{!! $data->Name !!}" name="Title">
			</div>
							
			<div class="clearfix"></div>		
			<button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop