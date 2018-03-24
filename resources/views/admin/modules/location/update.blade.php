@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.location.postUpdate', ['id' => $data->id])]) !!}
			<div class="form-group">
				<label for="">Tên huyện</label>
				<input type="text" class="form-control" id="" value="{!! $data->Name !!}" name="Name">
			</div>
			<div class="form-group">
				<label for="">Mã vùng</label>
				<input type="text" class="form-control" id="" name="ZipCode" value="{!! $data->ZipCode !!}">
			</div>
			<div class="form-group">
				<label for="">Trạng thái</label>
				{!! Form::select('IsActive', [1 => 'Công bố', 0 => 'Tạm hoãn'], $data->IsActive, ['class' => 'form-control']) !!}
			</div>
			<button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop