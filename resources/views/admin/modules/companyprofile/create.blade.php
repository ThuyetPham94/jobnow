@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.country.postCreate')]) !!}
			<div class="form-group">
				<label for="">Tên công ty</label>
				<input type="text" class="form-control" id="" name="Name">
			</div>
			<div class="form-group">
				<label for="">PostalCode</label>
				<input type="text" class="form-control" id="" hidden="" name="PostalCode">
			</div>
			<div class="form-group">
				<label for="">Mô tả</label>
				<textarea name="Description" class="form-control" rows="8"></textarea>
			</div>
			<div class="form-group">
				<label for="">Trạng thái</label>
				{!! Form::select('IsActive', [1 => 'Active', 0 => 'Dective'], null, ['class' => 'form-control']) !!}
			</div>
			<button type="submit" class="btn btn-primary pull-right">Add Country</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop