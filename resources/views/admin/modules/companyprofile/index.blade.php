@extends('admin.main')

@section('extra-lib')
	<script type="text/javascript">
		function detroy(id)  {
			var token = '{!! csrf_token() !!}';
			//this.preventDefault();
			var r = confirm('Bạn có muốn xóa không ?');
			if (r) {
				$.ajax({
					url: '{!! route('admin.companyprofile.postDelete') !!}',
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
		function view(id) {
			$.ajax({
				url: '{!! route('admin.companyprofile.getView') !!}',
				type: 'GET',
				data: {id: id},
			}).done(function(output) {
				if(output.code == 200) {
					console.log(output)
					$('.Name-title').text(output.result.Name);
					$('#Spoken').text(output.result.Spoken);
					$('#Address').text(output.result.Address);
					$('#ContactName').text(output.result.ContactName);
					$('#ContactNumber').text(output.result.ContactNumber);
					$('#company_size').text(output.result.company_size.Name);
					$('#Overview').text(output.result.Overview);
					$('.modal-title').text(output.result.Name);
					// $('#Create').text(output.result.created_at);
					
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
					<h4 class="modal-title">Thông tin chi tiết</h4>
				</div>
				<div class="modal-body">					
					<p><strong>Ngôn ngữ : </strong> <span id="Spoken"></span></p>
					<p><strong>Địa chỉ : </strong> <span id="Address"></span></p>
					<p><strong>Tên liên lạc : </strong> <span id="ContactName"></span></p>
					<p><strong>Điện thoại liên hệ : </strong> <span id="ContactNumber"></span> <span id="currency"></span></p>
					<p><strong>Phạm vi công ty : </strong> <span id="company_size"></span></p>
					<p><strong>Thông tin chung : </strong> <span id="Overview"></span></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop

@section('content')
	{{-- <div style="margin-bottom: 15px;">
		{!! HTML::link(route('admin.user.getCreateCompany'), 'Add Company', ['class'=> 'btn btn-success pull-right']) !!}
		<div class="clearfix"></div>
	</div> --}}
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Tên công ty</th>
				<th>Email</th>
				<th>Tên liên lạc</th>
				<th>Điện thoại liên hệ</th>
				<th>Trạng thái</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{!! Form::open(['url' => route('admin.companyprofile.getIndex'), 'method' => 'GET']) !!}
				<tr >
					<td></td>
					<td><input name="Name" class="form-control" value="{!! request()->Name !!}"></td>
					<td><input name="Email" class="form-control" value="{!! request()->Email !!}"></td>
					<td><input name="ContactName" class="form-control" value="{!! request()->ContactName !!}"></td>
					<td><input name="ContactNumber" class="form-control" value="{!! request()->ContactNumber !!}"></td>
					<td></td>
					<td><input type="submit" class="btn btn-success" value="Search"></td>
				</tr>
			</form>
			{!! Form::close() !!}
			@foreach($data as $item)
			<tr id="tr_{!! $item->id !!}">
				<td>{!! $item->id !!}</td>
				<td>{!! $item->Name !!}</td>
				<td>{!! $item->users->Email !!}</td>
				<td>{!! $item->ContactName !!}</td>
				<td>{!! $item->ContactNumber !!}</td>
				<td>
					@if($item->IsActive == 1)
						<p class="btn btn-xs btn-success">Hoạt động</p>
					@else
						<p class="btn btn-xs btn-danger">Tạm hoãn</p>
					@endif
				</td>
				<td>
					{!! HTML::decode(HTML::link('#', 'View', ['class' => 'btn btn-xs btn-info', 'onclick' => 'view('.$item->id.')'])) !!}
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