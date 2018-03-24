@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.currency.postUpdate', ['id' => $data->id])]) !!}
			<div class="form-group">
				<label for="">Name</label>
				<input type="text" class="form-control" id="" name="Name" value="{!! $data->Name !!}">
			</div>
			<div class="form-group">
				<label for="">Symbol</label>
				<input type="text" class="form-control" id="" name="Symbol" value="{!! $data->Symbol !!}">
			</div>
			<div class="form-group">
				<label for="">Description</label>
				<textarea name="Description" class="form-control" rows="8">{!! $data->Description !!}</textarea>
			</div>
			<div class="form-group">
				<label for="">Status</label>
				{!! Form::select('IsActive', [1 => 'Active', 0 => 'Dective'], $data->IsActive, ['class' => 'form-control']) !!}
			</div>
			<button type="submit" class="btn btn-primary pull-right">Update currency</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop