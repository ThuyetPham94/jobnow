@section('extra-lib')
	{!! HTML::script('frontend/jobnow_backend/js/bootstrap-tagsinput.js') !!}
	{!! HTML::script('frontend/js/bootstrap-suggest.js') !!}


	<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
	<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
	<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    
<script type="text/javascript">
    $(function () {
        $('#FromDate').datetimepicker({
            format: 'YYYY-MM-DD',            
        });        
        $('#ToDate').datetimepicker({
            format: 'YYYY-MM-DD',                    
        });        
    });            

</script>


	<script type="text/javascript">
		$("#upload_link").on('click', function(e){
		    e.preventDefault();
		    $("#upload:hidden").trigger('click');
		});
		//$(document).ready(function() {
		$(".img-avata p ").on('click', function(e){
		    e.preventDefault();
		    $("#Avatar:hidden").trigger('click');
		});
		//});
		$('#upload').on('change', function () {
			//alert('oke');
			$('#cv').val($(this).val().split('\\').pop());
		})
		$('.add-expience').on('click', function(event) {
			$('#addEx').toggleClass('display');
		});
		$('.add-skill').on('click', function(event) {
			$('#addSkill').toggleClass('display');
		});

		$('#addExpre').on('click', function () {
			var comName = $('#comName').val();
			var jobPos = $('#jobPos').val();
			var jobDes = $('#jobDes').val();
			var FromDate = $("input[name='FromDate']").val();
			var ToDate = $("input[name='ToDate']").val();			
			var Salary = $('#Salary').val();
			$.ajax({
				url: '{!! route('public.myprofile.postCreateEx') !!}',
				type: 'POST',
				data: {CompanyName: comName,PositionName: jobPos,Description: jobDes,FromDate: FromDate,ToDate:ToDate,Salary:Salary,_token: '{!! csrf_token() !!}'},
			})
			.done(function(output) {
				//console.log(output)
				if(output.code == 200) {
					$('.des_mes').text(output.message);
					$('#popup .popup').attr('id', 'success');
					$('#popup').show();
					$('.your-expience').prepend(output.data);
					$('#comName').val('');
					$('#jobPos').val('');
					$('#jobDes').val('');
					$("input[name='FromDate']").val('');
					$("input[name='ToDate']").val('');
					$('#Salary').val('');
				}else{
					$('.des_mes').text(output.message);
					$('#popup .popup').attr('id', 'error');
					$('#popup').show();
				}

			});
		});

		function destroy(id) {
			var r = confirm('Bạn có muốn xóa không ?');
			if (r) {
				$.ajax({
					url: '{!! route('public.myprofile.getDeleteEx') !!}',
					type: 'GET',
					data: {id : id},
				})
				.done(function(output) {
					if(output.code == 200) {
						$('#ex_'+id).remove();
						$('.des_mes').text(output.message);
						$('#popup .popup').attr('id', 'success');
						$('#popup').show();
					}else{
						$('.des_mes').text(output.message);
						$('#popup .popup').attr('id', 'error');
						$('#popup').show();
					}
				});
			}
		}
		// add skill
		$('#addS').on('click', function () {
				var Skill = $('#Skill').val();
			$.ajax({
				url: '{!! route('public.myprofile.postCreateSkill') !!}',
				type: 'POST',
				data: {Skill : Skill, _token : '{!! csrf_token() !!}'},
			})
			.done(function(output) {
				//console.log(output);
				 if(output.code == 200) {
				// 	console.log(output);
				// 	$('#listSkill').html();
				// 	//alert(output.message);
					$('.des_mes').text(output.message);
					 $('#popup .popup').attr('id', 'success');
					 $('#popup').show();
					 location.reload();
				 }else{
				// 	console.log('miss');
				// 	//alert(output.message);
					 $('#popup .popup').attr('id', 'error');
					 $('#popup').show();
				 }
			});
		});
		$('#Avatar').on('change', function() {
			var form = new FormData(); 
			var file = $(this).prop('files');
			createFormData(file);
		});

		$('.RemoveSkill').on('click', function() {
			var id = $(this).attr('js_id');
			var token = '{!! csrf_token() !!}';
			$.ajax({
				url: '{!! Route("public.myprofile.postRemoveSkill") !!}',
				type: 'POST',
				dataType: 'JSON',
				data: {id: id, _token: token},
				success: function(result){
					
					if(result.code == 200) {
						$('.des_mes').text(result.message);
						$('#popup .popup').attr('id', 'success');
						$('#popup').show();
						$(".JobSeekerSkill"+id).remove();
					}else{
						$('.des_mes').text(result.message);
						$('#popup .popup').attr('id', 'error');
					 	$('#popup').show();
					}
				}
			});
			
			
		});

		function createFormData(image) {
			var formImage = new FormData();
			formImage.append('Avatar', image[0]);
			uploadFormData(formImage);
		}

		function uploadFormData(formData) {
			$('.img-avata img').attr('src' , '{!! Asset('ajax-loader.gif') !!}');
			$.ajax({
				url: "{!! route('public.myprofile.postAvatar') !!}",
				type: "POST",
				data: formData ,
				contentType:false,
				cache: false,
				processData: false,
				success: function(data){
					if(data.code == 200) {
						$('.img-avata img').attr('src' , '{!! Asset(Config('images.url')) !!}/'+data.data);
						$('.des_mes').text(data.message);
						$('#popup .popup').attr('id', 'success');
						$('#popup').show();
						// alert(data.message);
					}else{
						alert(data.message);
						location.reload();
					}
				}
			});
		}
		function savedJob(id) {
			var r = confirm('Bạn có muốn xóa không ?');
			if (r) {
				// var id = id;
				$.ajax({
					url: '{!! route('public.job.postSaved') !!}',
					type: 'POST',
					data: {idJob: id, _token : '{!! csrf_token() !!}'},
				})
				.done(function(output) {
					//console.log(output);
					if(output.code == 200){
						$('#saved_'+id).remove();
						$('p.save-job span').toggleClass('active');
						$('.des_mes').text('Job removed successfully');
						$('#count').text("(" +output.count + " jobs )");
						$('#popup .popup').attr('id', 'success');
						$('#popup').show();

					}else{
						alert('Error');
					}
				});				
			}
		}
		function ApplyJob(id) {
			var r = confirm('Bạn có muốn xóa không ?');
			if (r) {
				// var id = id;
				$.ajax({
					url: '{!! route('public.job.postApplyJob') !!}',
					type: 'POST',
					data: {idJob: id, _token : '{!! csrf_token() !!}'},
				})
				.done(function(output) {
					//console.log(output);
					if(output.code == 200){
						$('#apply_'+id).remove();
						$('p.save-job span').toggleClass('active');
						$('.des_mes').text('Job removed successfully');
						$('#count').text("(" +output.count + " jobs )");
						$('#popup .popup').attr('id', 'success');
						$('#popup').show();

					}else{
						alert('Error');
					}
				});				
			}
		}
		$(document).ready(function() {			
		});
	</script>
@stop
<div class="col-xs-4 col-sm-3 detail-user">
	<div class="border-u">
		<div class="detail col-sm-12">
			<div class="avata text-center">
				<div class="img-avata">
						@if(!empty(Auth::user()->jobseeker->Avatar ))
							@if(substr(Auth::user()->jobseeker->Avatar, 0,4) == 'http')
								<img src="{!! Auth::user()->jobseeker->Avatar !!}">
							@else
							@if(Auth::user()->jobseeker->Avatar != null)
								@if(@getimagesize(Asset(Config('images.url').Auth::user()->jobseeker->Avatar)))

									<img src="{!! Asset(Config('images.url').Auth::user()->jobseeker->Avatar) !!}" title="{!! Auth::user()->jobseeker->FullName !!}"  class="img-responsive">

								@else
									<img src="{!! Asset('uploads/images/logo.jpg') !!}" title="{!! Auth::user()->jobseeker->FullName !!}"  class="img-responsive">
								@endif
								@else
									<img src="{!! Asset('uploads/images/logo.jpg') !!}" title="{!! Auth::user()->jobseeker->FullName !!}"  class="img-responsive">
								@endif							
							@endif
							<p>
								<span class="glyphicon glyphicon-camera"></span>
							</p>
						@else
							<img class="img-responsive" src="{{ Asset('frontend/images/user-icon-20702.png') }}">
							<p>
								<span class="glyphicon glyphicon-camera"></span>
							</p>
						@endif										
					<form method="POST" enctype="multipart/form-data">
						<input type="file" style="display: none" name="Avatar" id="Avatar">
					</form>
				</div>
				<p class="name">{!! Auth::user()->jobseeker->FullName !!}</p>
				<p class="email">{!! Auth::user()->Email !!}</p>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="profile-u">
			<ul>
				<li class="pro @if(request()->is('MyProfile')) active @endif">
					<a href="{{ asset('MyProfile') }}"><i class="fa fa-user" aria-hidden="true"></i> <span>Thông tin cá nhân </span></a>
				</li>
				<li class="save-job @if(request()->is('MyProfile/saveJob')) active @endif">
					<a href="{!! route('public.myprofile.getSaveJob') !!}"><i class="fa fa-star" aria-hidden="true"></i><span>Việc làm đã lưu</span></a>
				</li>
				<li class="app-job @if(request()->is('MyProfile/appliedJob')) active @endif">
					<a href="{!! route('public.myprofile.getAppliedJob') !!}"><i class="glyphicon glyphicon-list-alt"></i><span>Việc làm đã ứng tuyển</span></a>
				</li>
				<li class="app-job @if(request()->is('MyProfile/interview')) active @endif">
					<a href="{!! route('public.myprofile.getInterview') !!}"><i class="glyphicon glyphicon-list-alt"></i><span>Phỏng vấn</span></a>
				</li>
				<li class="logout"><a href="{!! route('public.user.logout') !!}"><i class="fa fa-power-off" aria-hidden="true"></i><span>Đăng xuất</span></a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<script type="text/javascript">
	
</script>