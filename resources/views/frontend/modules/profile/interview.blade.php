@extends('frontend.main')

@section('extra-style')
	<style type="text/css">
		.func {
		text-align: center;
		}
		.func a{
		margin-right: 10px;
		padding: 6px 10px;
		}
		td {
		vertical-align: middle !important;
		}
		.modal-dialog {

		}
		.modal-dialog .modal-title{
		color: #00a5bf;
		font-weight: bold;
		font-size: 16px;
		}
		.modal-dialog .top-content{
		padding-bottom: 20px;
		margin-bottom: 20px;
		border-bottom: 1px solid #ccc;
		}
		.modal-dialog .main-contain{

		}
		.modal-dialog .main-contain h4{
		font-weight: bold;
		margin-bottom: 10px;
		}
		.modal-dialog .modal-footer {

		}

	</style>
@stop
@section('extra-lib')
<script type="text/javascript">
	function showDetail(id) {
		$.ajax({
			url: '{!! route('public.myprofile.getDetail') !!}',
			type: 'POST',
			data: {id: id, '_token' : '{!! csrf_token() !!}'},
		})
		.done(function(output) {
			//console.log(output);
			$('.company-name').html(output[0].Name);
			$('.contact-name').html(output[0].ContactName);
			$('.contact-phone').html(output[0].PhoneNumber);
			$('.time').html(format(output[0].InterviewDate));
			$('.Starttime').html(output[0].Start_time);
			$('.Endtime').html(output[0].End_time);
			$('.Content').html(output[0].Content);
			$('.location').html(output[0].Location);
			$('#Accept').attr('data-id', id);
			$('#Reject').attr('data-id', id);
			$('.bs-example-modal-lg').modal('show');
		})
	}
	function accept(id) {
		$.ajax({
			url: '{!! route('public.myprofile.setStatus') !!}',
			type: 'POST',
			data: {id: id, Status : 2,'_token' : '{!! csrf_token() !!}'},
		})
		.done(function(output) {
			//console.log(output);
			if(output.code ==200) {
				$('.des_mes').text('Interview accepted successfully');
				$('#popup .popup').attr('id', 'success');
				$('#popup').show();
				$('.func_'+id).remove();
			}else{
				alert('Waring');
			}
		});		
	}
	function reject(id) {
		$.ajax({
			url: '{!! route('public.myprofile.setStatus') !!}',
			type: 'POST',
			data: {id: id, Status : 3,'_token' : '{!! csrf_token() !!}'},
		})
		.done(function(output) {
			//console.log(output);
			if(output.code ==200) {
				$('.des_mes').text('Interview rejected successfully');
				$('#popup .popup').attr('id', 'success');
				$('#popup').show();
				$('.func_'+id).remove();
			}else{
				alert('Waring');
			}
		});		
	}
	$(document).ready(function() {
		$('#Accept').on('click', function () {
			var id = $(this).data('id');
			accept(id);	
		});
		$('#Reject').on('click', function () {
			var id = $(this).data('id');
			reject(id);
		});
	});

	function format(datet){
		var date = new Date(datet);
		return date.getDate()+'/'+ (date.getMonth() + 1) + '/' +  date.getFullYear();
	}
</script>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">

		<div class="modal-content">
			<div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button> 
			<h4 class="modal-title company-name" id="myLargeModalLabel">Tên công ty</h4>
			</div>
			<div class="modal-body">
				<div class="top-content">
					<p><strong>Người phỏng vấn:</strong> <span class="contact-name"></span></p>
					<p><strong>Người liên hệ:</strong> <span class="contact-phone"></span></p>
					<p><strong>Ngày giờ:</strong> <span class="time"></span> from <span class="Starttime"></span> - <span class="Endtime"></span>  </p>
					<p><strong>Địa chỉ:</strong> <span class="location"></span></p>
				</div>
				<div class="main-contain">
					<h4>Ti nhắn</h4>
					<p class="Content"></p>
				</div>
			</div>
			<div class="modal-footer text-left" style="text-align: left">
				<button type="button" id="Accept" data-id="" name="accept" class="btn btn-primary ">Chấp nhận</button> 
				<button type="button" id="Reject" data-id="" name="reject" class="btn btn-danger">Từ chối</button>
			</div>
		</div>
	</div>
</div>
@stop
@section('content')
	<div class="app save-job margin">
		<div class="container">
			<div class="row">
				@include('frontend.modules.profile.includes.detail-user')
				<div class="col-xs-8 col-sm-9 list-app-job content-job">
					<div class="border">
						<div class="til">
						    <h3>Phỏng vấn <span>({{ count($data) }} Interview) </span></h3>
					    </div>
					    <div class="col-sm-12" style="margin-top: 10px;">
							<table class="table table-bordered table-hover">
	                            <thead>
	                                <tr>
	                                    <th>Chi tiết cuộc phỏng vấn</th>
	                                    <th>Vị trí</th>
	                                    <th>Ngày giờ</th>
	                                    <th>Trạng thái</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	@if(count($data))
			                            @foreach($data as $item)
		                                    <tr>
		                                        <td>
		                                            <a href="" class="name">{!! $item->Name !!}</a>
		                                        </td>
		                                        <td>
		                                            {!! $item->Location !!}
		                                        </td>
		                                        <td>
		                                            {!! date('d-m-Y', strtotime($item->InterviewDate)) !!} <br />
		                                            {!! date('H:i', strtotime($item->InterviewDate))  !!}
		                                        </td>
		                                       
		                                        <td class="func" style="display: inline-flex;border: none">
			                                        <a href="javascript:void(0)" data-toggle="modal" onclick="showDetail({!! $item->id !!})" style="text-align: center;color: #fff;background: #54b2f6">
		                                                Xem chi tiết
		                                            </a>
		                                            @if($item->Status == 0)
			                                            <a href="javascript:void(0)" class="func_{!! $item->id !!}" onclick="accept({!! $item->id !!})" style="text-align: center;color: #fff;background: #026dbb">
			                                                Chấp nhận
			                                            </a>
			                                            <a href="javascript:void(0)" class="func_{!! $item->id !!}" onclick="reject({!! $item->id !!})" style="text-align: center;color: #fff;background: #f74749">
			                                                Từ chối
			                                            </a>
		                                            @endif
		                                        </td>
		                                    </tr>
		                                @endforeach
	                                @endif
	                            </tbody>
	                        </table>
                        </div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop