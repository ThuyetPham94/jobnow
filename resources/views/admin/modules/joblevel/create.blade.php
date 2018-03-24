@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.joblevel.postCreate')]) !!}
			<div class="form-group">
				<label for="">Tên</label>
				<input type="text" class="form-control" required="" name="Name">
			</div>
			
			
			<div class="clearfix"></div>
			
			<button type="submit" class="btn btn-primary pull-right">Thêm</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop