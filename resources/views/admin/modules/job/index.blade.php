@extends('admin.main')

@section('extra-lib')
	<script type="text/javascript">
		function detroy(id)  {
			var token = '{!! csrf_token() !!}';
			//this.preventDefault();
			var r = confirm('Bạn có muốn xóa không');
			if (r) {
				$.ajax({
					url: '{!! route('admin.job.postDelete') !!}',
					type: 'POST',
					data: {id : id, _token : token},
				})
				.done(function(output) {
					if(output.code == 200) {
						$('.messages').html('Success');
	                    $('#getMessages').modal('toggle');
	                    $('#tr_'+id).remove();
	                } else {
	                	alert('Error');
	                }
				})
			}
		}
		function view(id) {
			$.ajax({
				url: '{!! route('admin.job.getView') !!}',
				type: 'GET',
				data: {id: id},
			}).done(function(output) {
				if(output.code == 200) {
					// console.log(output)
					$('.modal-title').text(output.result.Title);
					$('#Title').text(output.result.Title);
					$('#Comapny').text(output.result.CompanyName);
					$('#Description').text(output.result.Description);
					$('#Requirement').text(output.result.Requirement);
					$('#ToSalary').text(output.result.ToSalary);
					$('#currency').text();
					$('#Create').text(output.result.created_at);					
					$('#view').modal('show');
				} else {
					alert('No Job');
				}
			});
			
			
		}
	</script>
	<div class="modal fade" tabindex="-1" role="dialog" id="view">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Chi tiết</h4>
				</div>
				<div class="modal-body">
					<p><strong>Tên việc làm : </strong> <span id="Title"></span></p>
					<p><strong>Công ty : </strong> <span id="Comapny"></span></p>
					<p><strong>Mô tả : </strong> <span id="Description"></span></p>
					<p><strong>Yêu cầu : </strong> <span id="Requirement"></span></p>
					<p><strong>Lương : </strong> <span id="ToSalary"></span> <span id="currency"></span></p>
					<p><strong>Ngày tạo : </strong> <span id="Create"></span></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop

@section('content')
	<div style="margin-bottom: 15px;">
		<!-- {!! HTML::link(route('admin.job.getCreate'), 'Add Job', ['class'=> 'btn btn-success pull-right']) !!} -->
		<div class="clearfix"></div>
	</div>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Tiêu đề</th>
				<th>Công ty</th>
				<th>Trạng thái</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{!! Form::open(['url' => route('admin.job.getIndex'), 'method' => 'GET']) !!}
				<tr >
					<td></td>
					<td><input name="Title" class="form-control"></td>
					<td><input name="Company" class="form-control"></td>
					<td></td>
					<td><input type="submit" class="btn btn-success" value="Tìm kiếm"></td>
				</tr>
			</form>
			{!! Form::close() !!}
			@foreach($data as $item)
			<tr id="tr_{!! $item->id !!}">
				<td>{!! $item->id !!}</td>
				<td>{!! $item->Title !!}</td>
				<td>{!! $item->Name !!}</td>
				<td>
					@if($item->IsActive == 1)
						<p class="btn btn-xs btn-success">Công bó</p>
					@else
						<p class="btn btn-xs btn-danger">Tạm hoãn</p>
					@endif
				</td>
				<td>
					{!! HTML::decode(HTML::link('#', 'Chi tiết', ['class' => 'btn btn-xs btn-info', 'onclick' => 'view('.$item->id.')'])) !!}
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