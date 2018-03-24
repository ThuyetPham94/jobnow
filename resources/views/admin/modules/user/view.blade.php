@extends('admin.main')

@section('extra-lib')
	<script type="text/javascript">
		function detroy(id)  {
			var token = '{!! csrf_token() !!}';
			//this.preventDefault();
			var r = confirm('Bạn muốn xóa không ?');
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
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Thông tin</th>
			</tr>
		</thead>
		<tbody>
			{{-- <tr>
				<td><strong>ID</strong></td>
				<td>{!! $data->id !!}</td>
			</tr> --}}
			<tr>
				<td><strong>Email</strong></td>
				<td>{!! $data->Email !!}</td>
			</tr>
			<tr>
				<td><strong>Vị trí</strong></td>
				<td>
					@if($data->IsCompany == 0)
						Ứng viên
					@elseif( $data->IsCompany == 1)
						Công ty
					@else
						Admin
					@endif
				</td>
			</tr>
			<tr>
				<td><strong>Ngày tạo</strong></td>
				<td>{!! date('d-m-Y', strtotime($data->created_at)) !!}</td>
			</tr>
			<tr>
				<td><strong>Số điện thoại</strong></td>
				<td>
					@if($data->IsCompany == 0 && !empty($data->jobSeeker))
						{!! $data->jobSeeker->PhoneNumber !!}
					@elseif( $data->IsCompany == 1 && !empty($data->companyProfile))
						{!! $data->companyProfile->ContactNumber !!}
					@endif
					{{-- @if(!empty($data->jobSeeker))
						{!! $data->jobSeeker->PhoneNumber !!}
					@else
						{!! $data->companyProfile->ContactPhone !!}
					@endif --}}
				</td>
			</tr>
		</tbody>
	</table>
@stop