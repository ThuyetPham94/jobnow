@extends('admin.main')

@section('extra-lib')
	<script type="text/javascript">
		function detroy(id)  {
			var token = '{!! csrf_token() !!}';
			//this.preventDefault();
			var r = confirm('Are you sure delete?');
			if (r) {
				$.ajax({
					url: '{!! route('admin.job-seeker.postDelete') !!}',
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
				url: '{!! route('admin.job-seeker.getView') !!}',
				type: 'GET',
				data: {id: id},
			}).done(function(output) {
				if(output.code == 200) {
					// console.log(output)
					// $('.modal-title').text(output.result.Title);
					$('#Name').text(output.result.Name);
					$('#PhoneNumber').text(output.result.PhoneNumber);
					$('#Email').text(output.result.user.Email);
					if(output.result.Gender == 0){
						$('#Gender').text('Female');
					}else{
						$('#Gender').text('Male');
					}
					$('#BirthDay').text(output.result.BirthDay);
					// $('#currency').text(output.result.currency.Symbol);
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
					<h4 class="modal-title">Modal title</h4>
				</div>
				<div class="modal-body">
					<p><strong>Name : </strong> <span id="Name"></span></p>
					<p><strong>PhoneNumber : </strong> <span id="PhoneNumber"></span></p>
					<p><strong>Email : </strong> <span id="Email"></span></p>
					<p><strong>Gender : </strong> <span id="Gender"></span></p>
					<p><strong>BirthDay : </strong> <span id="BirthDay"></span> <span id="currency"></span></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@stop

@section('content')
	<div style="margin-bottom: 15px;">
		{{-- {!! HTML::link(route('admin.location.getCreate'), 'Add Location', ['class'=> 'btn btn-success pull-right']) !!} --}}
		<div class="clearfix"></div>
	</div>
	<table class="table table-hover table-bordered">
		<thead>
			<tr>
				<th>#</th>
				<th>FullName</th>
				<th>Email</th>
				<th>Status</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			{!! Form::open(['url' => route('admin.job-seeker.getIndex'), 'method' => 'GET']) !!}
				<tr >
					<td></td>
					<td><input name="FullName" class="form-control"></td>
					<td><input name="Email" class="form-control"></td>
					<td></td>
					<td><input type="submit" class="btn btn-success" value="Search"></td>
				</tr>
			</form>
			{!! Form::close() !!}
			@if(!empty($data ))
			@foreach($data as $item)
				<tr id="tr_{!! $item->id !!}">
					<td>{!! $item->id !!}</td>
					<td>{!! $item->FullName !!}</td>
					<td>{!! $item->user->Email !!}</td>
					<td>
						@if($item->IsActive == 1)
							<p class="btn btn-xs btn-success">Active</p>
						@else
							<p class="btn btn-xs btn-danger">Dective</p>
						@endif
					</td>
					<td>
						{!! HTML::decode(HTML::link('#', 'View', ['class' => 'btn btn-xs btn-info', 'onclick' => 'view('.$item->id.')'])) !!}
						{!! HTML::decode(HTML::link('#', 'Delete', ['class' => 'btn btn-xs btn-danger', 'onclick' => 'detroy('.$item->id.')'])) !!}
					</td>
				</tr>
			@endforeach
			@endif
		</tbody>
	</table>
	<div class="pagination">
		{!! $data->render() !!}
	</div>

@stop