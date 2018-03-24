@extends('admin.main')

@section('extra-lib')
	<script type="text/javascript">
		function detroy(id)  {
			var token = '{!! csrf_token() !!}';
			//this.preventDefault();
			var r = confirm('Bạn muốn xóa không ?');
			if (r) {
				$.ajax({
					url: '{!! route('admin.contact.postDelete') !!}',
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
		<div class="clearfix"></div>
	</div>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Tên</th>
				<th>Email</th>
				<th>Số điện thoại</th>
				<th>Tiêu đề</th>
				<th>Nội dung</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{!! Form::open(['url' => route('admin.contact.getIndex'), 'method' => 'GET']) !!}
				<tr >
					<td></td>
					<td><input name="Name" class="form-control"></td>
					<td><input name="Email" class="form-control"></td>
					<td><input name="PhoneNumber" class="form-control"></td>
					<td></td>
					<td></td>
					<td><input type="submit" class="btn btn-success" value="Tìm kiếm"></td>
				</tr>
			</form>
			{!! Form::close() !!}
			@foreach($data as $item)
			<tr id="tr_{!! $item->id !!}">
				<td>{!! $item->id !!}</td>
				<td>{!! $item->Name !!}</td>
				<td>{!! $item->Email !!}</td>
				<td>{!! $item->PhoneNumber !!}</td>
				<td>{!! $item->Subject !!}</td>
				<td>{!! $item->Content !!}</td>
				
				<td>
					{!! HTML::decode(HTML::link(route('admin.contact.getView', ['id' => $item->id]), 'CHi tiết', ['class' => 'btn btn-xs btn-info'])) !!}
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