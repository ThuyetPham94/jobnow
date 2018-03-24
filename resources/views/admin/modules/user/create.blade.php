@extends('admin.main')

@section('content')
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
		{!! Form::open(['url' => route('admin.user.postCreate')]) !!}
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
			{{-- <div class="form-group">
				<label for="">Permission</label>
				{!! Form::select('IsCompany', [
					2 => 'Admin',
					1 => 'Company',
					0 => 'Seeker'
				], 2, ['class' => 'form-control']) !!}				
			</div> --}}
			<button type="submit" class="btn btn-primary pull-right">Add User</button>
		{!! Form::close() !!}
	</div>
	<div class="clearfix"></div>
@stop