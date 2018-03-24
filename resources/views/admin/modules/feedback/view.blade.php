@extends('admin.main')

@section('content')

	<div class="content">
		<p><strong>Name : </strong></p>
		<p style="padding-left: 20px;">{!! $data->Name !!}</p>
		<p><strong>Email : </strong></p>
		<p style="padding-left: 20px;">{!! $data->Email !!}</p>
		<p><strong>Phone Number : </strong></p>
		<p style="padding-left: 20px;">{!! $data->PhoneNumber !!}</p>
		<p><strong>Subject : </strong></p>
		<p style="padding-left: 20px;">{!! $data->Subject !!}</p>
		<p><strong>Content : </strong></p>
		<p style="padding-left: 20px;">{!! $data->Content !!}</p>
	</div>
@stop