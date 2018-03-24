@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.user.postCreateCompany')]) !!}
			<div class="form-group">
				<label for="">Name</label>
				<input type="text" class="form-control" id="" name="Name">
			</div>

			<div class="form-group">
				<label for="">Company size</label>
				<select class="form-control" name="CompanySizeID">
					@foreach($companySize as $size)
						<option value="{!! $size->id !!}">{!! $size->Name !!}</option>
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="">Email</label>
				<input type="text" class="form-control" id="" name="Email">
			</div>
			
			<div class="form-group">
				<label for="">Password</label>
				<input type="password" class="form-control" id="" name="Password">
			</div>
			<div class="form-group">
				<label for="">Confim Password</label>
				<input type="password" class="form-control" id="" name="Re_Password">
			</div>
			<div class="form-group">
				<label for="">Status</label>
				{!! Form::select('IsActive', [
					1 => 'Active',
					0 => 'Detive'
				], 1, ['class' => 'form-control']) !!}				
			</div>
			<button type="submit" class="btn btn-primary pull-right">Add User</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop