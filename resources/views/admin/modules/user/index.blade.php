@extends('admin.main')

@section('extra-lib')
	<script type="text/javascript">
		function detroy(id)  {
			var token = '{!! csrf_token() !!}';
			//this.preventDefault();
			var r = confirm('Bạn muốn xóa không ?');
			if (r) {
				$.ajax({
					url: '{!! route('admin.user.postDelete') !!}',
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
		{!! HTML::link(route('admin.user.getCreate'), 'Thêm admin', ['class'=> 'btn btn-warning pull-right', 'style' => 'margin-left : 10px;']) !!} 
		{{-- {!! HTML::link(route('admin.user.getCreateSeeker'), 'Add User Seeker', ['class'=> 'btn btn-primary pull-right', 'style' => 'margin-left : 10px;']) !!} 
		{!! HTML::link(route('admin.user.getCreateCompany'), 'Add User Company', ['class'=> 'btn btn-info pull-right', 'style' => 'margin-left : 10px;']) !!}  --}}
                {!! HTML::link(route('admin.user.export'), 'Export file', ['class'=> 'btn btn-info pull-right', 'style' => 'margin-left : 10px;']) !!} 
		<div class="clearfix"></div>
	</div>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>Email</th>
				<th>Tên đầy đủ</th>
				<th>Tên công ty</th>
				<th>vị trí</th>
				<th>Trạng thái</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{!! Form::open(['url' => route('admin.user.getIndex'), 'method' => 'GET']) !!}
				<tr >
					<td></td>
					<td><input name="Email" class="form-control" value="{!! request()->Email !!}"></td>
					<td><input name="FullName" class="form-control" value="{!! request()->FullName !!}"></td>
					<td><input name="Name" class="form-control" value="{!! request()->Name !!}"></td>
					<td>
						{!! Form::select('Permission', [
							'' => 'tất cả',
							0 => 'Ứng viên',
							1 => 'Công ty',
							2 => 'Admin'
						], request()->Permission, ['class' => 'form-control']) !!}
					</td>
					<td>
						{{-- {!! Form::select('IsActive', [
							1 => 'Active',
							0 => 'Dective'
						], request()->Permission, ['class' => 'form-control']) !!} --}}
					</td>
					<td><input type="submit" class="btn btn-success" value="Search"></td>
				</tr>
			</form>
			{!! Form::close() !!}
			@foreach($data as $item)
			<tr id="tr_{!! $item->id !!}">
				<td>{!! $item->id !!}</td>
				<td>{!! $item->Email !!}</td>
				<td>
					@if(!empty($item->jobSeeker))
						{!! $item->jobSeeker->FullName !!}
					@endif
				</td>
				<td>
					@if(!empty($item->companyProfile))
						{!! $item->companyProfile->Name !!}
					@endif
				</td>
				<td>
					@if($item->IsCompany == 0)
						<span class="seeker btn btn-xs btn-primary">Ứng viên</span>
					@elseif($item->IsCompany == 1)
						<span class="company btn btn-xs btn-info">Công ty</span>
					@else
						<span class="admin btn btn-xs btn-warning">Admin</span>
					@endif
				</td>
				<td>
					@if(!empty($item->companyProfile) && $item->companyProfile->IsActive == 1 || !empty($item->jobSeeker) &&  $item->jobSeeker->IsActive == 1)
						<p class="btn btn-xs btn-success">Công bố</p>
					@else
						<p class="btn btn-xs btn-danger">Tạm hoãn</p>
					@endif
				</td>
				<td>
					@if($item->id == Auth::user()->id)
						{!! HTML::decode(HTML::link(route('admin.user.getUpdate', ['id' => $item->id]), 'Cập nhật', ['class' => 'btn btn-xs btn-success'])) !!}
					@else
						{!! HTML::decode(HTML::link(route('admin.user.getView', ['id' => $item->id]), 'Chi tiết', ['class' => 'btn btn-xs btn-success'])) !!}
					@endif
					{!! HTML::decode(HTML::link('#', 'Xóa', ['class' => 'btn btn-xs btn-danger', 'onclick' => 'detroy('.$item->id.')'])) !!}
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<div class="pagination">
		{!! $data->appends([
			'Email' => request()->Email,
			'FullName' => request()->FullName,
			'Name' => request()->Name,
			'Permission' => request()->Permission
		])->render() !!}
	</div>

@stop