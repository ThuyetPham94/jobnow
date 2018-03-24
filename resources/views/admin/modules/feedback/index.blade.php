@extends('admin.main')

@section('extra-lib')
	<script type="text/javascript">
		function detroy(id)  {
			var token = '{!! csrf_token() !!}';
			//this.preventDefault();
			var r = confirm('Bạn có muốn xóa');
			if (r) {
				$.ajax({
					url: '{!! route('admin.feedback.postDelete') !!}',
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
				<th>Tiêu đề</th>
				<th>Nội dung</th>
				<th>Email</th>				
				<th>Ngày tạo</th>
				<th></th>
				
			</tr>
		</thead>
		<tbody>
			{!! Form::open(['url' => route('admin.feedback.getIndex'), 'method' => 'GET']) !!}
				<tr >
					<td></td>
					<td><input name="Title" class="form-control"></td>
					<td><input name="Message" class="form-control"></td>					
					<td></td>
					<td></td>
					<td><input type="submit" class="btn btn-success" value="Tìm kiếm"></td>
				</tr>
			</form>
			{!! Form::close() !!}
			@foreach($data as $item)
			<tr id="tr_{!! $item->id !!}">
				<td>{!! $item->id !!}</td>
				<td>{!! $item->Title !!}</td>
				<td>{!! $item->Message !!}</td>
				<td>{!! $item->Email !!}</td>
				<td>{!! date('d-m-Y', strtotime($item->created_at)) !!}</td>							
				<td>
					{{-- {!! HTML::decode(HTML::link(route('admin.feedback.getView', ['id' => $item->id]), 'View', ['class' => 'btn btn-xs btn-info'])) !!} --}}
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