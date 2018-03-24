@section('initMap')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDuZwCi-4pzqjrJ-ADryQ3QPAH0zPsbYz0&callback=initMap&libraries=places&sensor=false" async defer></script>
@show
{{-- <script src="js/jquery.js"></script> --}}
{!! HTML::script('frontend/jobnow_backend/js/jquery.js') !!}
{{-- <script type="text/javascript" src="js/bootstrap-tagsinput.js"></script> --}}
{!! HTML::script('frontend/jobnow_backend/js/bootstrap-tagsinput.js') !!}
<!-- update by hung -->
<!-- {!! HTML::script('frontend/jobnow_backend/js/sidebar.js') !!} -->
{!! HTML::script('frontend/jobnow_backend/js/side_menu.js') !!}
<!-- end update by hung -->
<!-- Custom CSS -->

<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

{{-- <script src="js/bootstrap.min.js"></script> --}}
{!! HTML::script('frontend/jobnow_backend/js/bootstrap.min.js') !!}
{!! HTML::script('frontend/jobnow_backend/js/jquery.dataTables.min.js') !!}
{!! HTML::script('frontend/jobnow_backend/js/dataTables.bootstrap.min.js') !!}
{!! HTML::script('jquery.validate.min.js') !!}
<div id="popup" style="display: none;"> 
	<div id="succes" class="popup">
		<div class="left">
		</div>
		<div class="right">
			<p class="mes success"><strong>Thành công !</strong> <span class="pull-right glyphicon glyphicon-remove"></span></p>
			<p class="mes warning"><strong>Cảnh báo !</strong> <span class="pull-right glyphicon glyphicon-remove"></span></p>
			<p class="mes error"><strong>Lỗi !</strong> <span class="pull-right glyphicon glyphicon-remove"></span></p>
			<p class="des_mes"></p>
		</div>
	</div>
</div>

<!-- Menu Toggle Script -->
<script>
	@if(session()->has('message'))
		$('.des_mes').text('{!! session()->get('message')  !!}');
		@if(session()->has('status'))
			$('#popup .popup').attr('id', '{!! session()->get('status') !!}');
		@endif
		$('#popup').show();
	@endif
	$('#popup').on('click', function() {
		$('#popup .popup').attr('id','success');
		$(this).hide();
	});
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

@section('extra-lib')
@show