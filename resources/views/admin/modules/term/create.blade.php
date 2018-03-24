@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.term.postCreate')]) !!}
			<div class="form-group">
				<label for="">Tiêu đề</label>
				<input type="text" class="form-control" required="" name="Title">
			</div>
			<div class="form-group">
				<label for="">Mô tả</label>
				<textarea type="text" class="form-control" required="" rows="8" id="" name="Description"></textarea>
			</div>
			
			<div class="clearfix"></div>
			
			<button type="submit" class="btn btn-primary pull-right">Thêm</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop