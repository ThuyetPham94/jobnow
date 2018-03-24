@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.companysize.postCreate')]) !!}
			<div class="form-group">
				<label for="">Quy mô</label>
				<input type="text" class="form-control" id="" name="Name">
			</div>
			<div class="form-group">
				<label for="">Mô tả</label>
				<textarea name="Description" class="form-control" rows="8"></textarea>
			</div>
			<div class="form-group">
				<label for="">Trạng thái</label>
				{!! Form::select('IsActive', [1 => 'Công bố', 0 => 'Tạm hoãn'], null, ['class' => 'form-control']) !!}
			</div>
			<button type="submit" class="btn btn-primary pull-right">Thêm mới</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop