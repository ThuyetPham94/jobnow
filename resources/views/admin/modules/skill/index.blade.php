@extends('admin.main')

@section('extra-lib')
	<script type="text/javascript">
		function detroy(id)  {
			var token = '{!! csrf_token() !!}';
			//this.preventDefault();
			var r = confirm('Bạn có muốn xóa không ?');
			if (r) {
				$.ajax({
					url: '{!! route('admin.skill.postDelete') !!}',
					type: 'POST',
					data: {id : id, _token : token},
				})
				.done(function() {
					$('.messages').html('Success');
                    $('#getMessages').modal('toggle');
                    $('#tr_'+id).remove();
				})
			}
		}
	</script>
@stop

@section('content')
	<div style="margin-bottom: 15px;">
		{!! HTML::link(route('admin.skill.getCreate'), 'Thêm kỹ năng', ['class'=> 'btn btn-success pull-right']) !!}
		<div class="clearfix"></div>
	</div>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Kỹ năng</th>
				<th>Ngành nghề</th>
				<th>Mô tả</th>
				<th>Trạng thái</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{!! Form::open(['url' => route('admin.skill.getIndex'), 'method' => 'GET']) !!}
				<tr >
					<td></td>
					<td><input name="Name" class="form-control" value="{!! old('Name') !!}"></td>
					<td><select name="Industry" id="inputIndustry" class="form-control">
						<option value="">Chọn ngành nghề</option>
						@foreach ($industry as $item)
							<option value="{!! $item->id !!}">{!! $item->Name !!}</option>
						@endforeach
					</select></td>
					<td><input name="Description" class="form-control" {!! old('Description') !!}></td>
					<td></td>
					<td><input type="submit" class="btn btn-success" value="Tìm kiếm"></td>
				</tr>
			</form>
			{!! Form::close() !!}
			@foreach($data as $item)
			<tr id="tr_{!! $item->id !!}">
				<td>{!! $item->id !!}</td>
				<td>{!! $item->Name !!}</td>
				<td>{!! $item->industry->Name !!}</td>
				<td>{!! $item->Description !!}</td>
				<td>
					@if($item->IsActive == 1)
						<p class="btn btn-xs btn-success">Công bố</p>
					@else
						<p class="btn btn-xs btn-danger">Tạm hoãn</p>
					@endif
				</td>
				<td>
					{!! HTML::decode(HTML::link(route('admin.skill.getUpdate', ['id' => $item->id]), 'Cập nhật', ['class' => 'btn btn-xs btn-success'])) !!}
					{!! HTML::decode(HTML::link('#', 'Xóa', ['class' => 'btn btn-xs btn-danger', 'onclick' => 'detroy('.$item->id.')'])) !!}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="pagination">
		{!! $data->render() !!}
	</div>

@stop