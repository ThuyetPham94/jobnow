@extends('admin.main')

@section('extra-lib')
	<script type="text/javascript">
		function detroy(id)  {
			var token = '{!! csrf_token() !!}';
			//this.preventDefault();
			var r = confirm('Bạn có muốn xóa không ?');
			if (r) {
				$.ajax({
					url: '{!! route('admin.industry.postDelete') !!}',
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
		{!! HTML::link(route('admin.industry.getCreate'), 'Thêm ngành nghề', ['class'=> 'btn btn-success pull-right']) !!}
		<div class="clearfix"></div>
	</div>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Tên ngành nghề</th>
				<th>Mô tả</th>
				<th>Trạng thái</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{!! Form::open(['url' => route('admin.industry.getIndex'), 'method' => 'GET']) !!}
				<tr >
					<td></td>
					<td><input name="Name" class="form-control"></td>
					<td><input name="Description" class="form-control"></td>
					<td></td>
					<td><input type="submit" class="btn btn-success" value="Search"></td>
				</tr>
			</form>
			{!! Form::close() !!}
			@foreach($data as $item)
			<tr id="tr_{!! $item->id !!}">
				<td>{!! $item->id !!}</td>
				<td>{!! $item->Name !!}</td>
				<td>{!! $item->Description !!}</td>
				<td>
					@if($item->IsActive == 1)
						<p class="btn btn-xs btn-success">Công bố</p>
					@else
						<p class="btn btn-xs btn-danger">Tạm hoãn</p>
					@endif
				</td>
				<td>
					{!! HTML::decode(HTML::link(route('admin.industry.getUpdate', ['id' => $item->id]), 'Cập nhật', ['class' => 'btn btn-xs btn-success'])) !!}
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