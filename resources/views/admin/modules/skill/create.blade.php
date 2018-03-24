@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.skill.postCreate')]) !!}
			<div class="form-group">
				<label for="">Kỹ năng</label>
				<input type="text" class="form-control" id="" name="Name" value="{!! old('Name') !!}">
			</div>
			<div class="form-group">
				<label for="">Ngành nghề</label>
				<select name="IndustryID" id="inputIndustry" class="form-control">
					<option value="">Chọn ngành nghề</option>
					@foreach ($industry as $item)
						<option value="{!! $item->id !!}">{!! $item->Name !!}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="">Mô tả</label>
				<textarea name="Description" id="inputDescrip" class="form-control" rows="3"></textarea>
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