<div class="pull-left input">
	<form class="form-inline" method="GET" action="{!! route('public.job.index') !!}">
		<div class="form-group">
			<div class="input-group" style="position: relative">
				<input type="text" class="form-control" id="exampleInputAmount" placeholder="Tìm kiếm tên hoặc địa chỉ" name="Title" value="{!! request()->Title !!}">
				<button type="submit" class="input-group-addon" style="position: absolute; right: 0; z-index: 999;height: 100%;width: 50px;"><i class="fa fa-search" aria-hidden="true"></i></button>				
			</div>
		</div>
	</form>
</div>
<div class="pull-left advanced">
	<a href="{!! route('public.job.index') !!}"><span>
		Nâng cao
	</span></a>
</div>
<div class="clearfix"></div>