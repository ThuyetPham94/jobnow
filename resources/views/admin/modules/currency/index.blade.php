@extends('admin.main')

@section('extra-lib')
	<script type="text/javascript">
		function detroy(id)  {
			var token = '{!! csrf_token() !!}';
			//this.preventDefault();
			var r = confirm('Are you sure delete?');
			if (r) {
				$.ajax({
					url: '{!! route('admin.currency.postDelete') !!}',
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
		{!! HTML::link(route('admin.currency.getCreate'), 'Add currency', ['class'=> 'btn btn-success pull-right']) !!}
		<div class="clearfix"></div>
	</div>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Symbol</th>
				<th>Description</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{!! Form::open(['url' => route('admin.currency.getIndex'), 'method' => 'GET']) !!}
				<tr >
					<td></td>
					<td><input name="Name" class="form-control"></td>
					<td><input name="Symbol" class="form-control"></td>
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
				<td>{!! $item->Symbol !!}</td>
				<td>{!! $item->Description !!}</td>
				<td>
					@if($item->IsActive == 1)
						<p class="btn btn-xs btn-success">Active</p>
					@else
						<p class="btn btn-xs btn-danger">Dective</p>
					@endif
				</td>
				<td>
					{!! HTML::decode(HTML::link(route('admin.currency.getUpdate', ['id' => $item->id]), 'Update', ['class' => 'btn btn-xs btn-success'])) !!}
					{!! HTML::decode(HTML::link('#', 'Delete', ['class' => 'btn btn-xs btn-danger', 'onclick' => 'detroy('.$item->id.')'])) !!}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="pagination">
		{!! $data->render() !!}
	</div>

@stop