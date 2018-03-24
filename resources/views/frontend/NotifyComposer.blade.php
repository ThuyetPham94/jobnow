{{-- {!! dd($notification->company) !!}
 --}}<li class="dropdown message">
	<a href="javascript:void(0)" @if(count($notification)) class="dropdown-toggle" data-toggle="dropdown" @endif><i class="fa fa-bell-o" aria-hidden="true"></i> @if(count($notification))<span class="badge badge-default"> {!! $notification->count() !!} </span> @endif</a>
	<ul class="dropdown-menu arrow_box">
		<p class="noti"><span class="jobnow" style="font-weight: bold">{!! count($notification) !!} pending</span> notifications</p>
		<div class="noti-scroll">
			@if(count($notification))
				@foreach($notification as $item)
					<li id="noti{!! $item->id !!}">
						<a href="javascript:void(0)" class="remove_noti" noti_id="{!! $item->id !!}">
							<div class="noti-img">{!! HTML::image('frontend/images/icon/noti-icon.png') !!}</div><div class="noti-text">
								{!! $item->Title !!}
							</div>
						</a>
					</li>			
				@endforeach
			@endif
		</div>
	</ul>
</li>
@section('extra-lib')
	<script type="text/javascript">
	$(document).ready(function() {
		$('.remove_noti').click(function(){
			var id = $(this).attr('noti_id');
			var token = '{!! csrf_token() !!}';
			$.ajax({
				url: '{!! route("public.myprofile.removeNotification") !!}',
				type: 'POST',
				dataType: 'json',
				data: {id: id, _token: token},
				success: function(result){
					if(result.code == 200){
						$('.des_mes').text('Remove Success');
						$('#popup .popup').attr('id', 'success');
						$('#popup').show();
						$('ul.dropdown-menu.arrow_box p.noti span.jobnow').html(result.notification);
						$('ul.profile-user a span.badge.badge-default').html(result.notification);
						$('li#noti'+id).remove();
					}else{
						$('.des_mes').text(output.message);
						$('#popup .popup').attr('id', 'error');
						$('#popup').show();
					}
				}
			});
			
		})
	});
	</script>
@endsection