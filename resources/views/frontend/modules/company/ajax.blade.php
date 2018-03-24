<ul class="list-job">
	@foreach($data->job as $job)
	<li class="col-xs-12">
		<div class="col-sm-12 border-item">
			<h2 class="title-job"><a href="{!! route('public.job.getDetail', ['id' => $job->id, 'name' => str_slug($job->Title).'.html']) !!}">{!! $job->Title !!}</a></h2>
			<div class="des-location">
				<a class="location">{!! $job->location->Name !!}</a>
				@if($job->DisplaySalary == 0)
				<a class="salary" href="">Trên mức lương mong muốn</a>
				@else
				<a class="salary" href="">{!! $job->FromSalary !!} - {!! $job->ToSalary !!} {!! $job->currency->Symbol !!}</a>
				@endif
			</div>
			<div class="description">
				<span>Trách nhiệm:</span>
				<p>
					{!! substr($job->Description, 0 , 300) !!} ... 
					<a href="{!! route('public.job.getDetail', ['id' => $job->id, 'name' => str_slug($job->Title).'.html']) !!}">xem thêm</a>
				</p>
			</div>
			
		</div>
	</li>
	@endforeach
</ul>
<div class="clearfix"></div>
<div class="main-bottom">
	<div class="col-sm-6">
		
	</div>
	<div class="col-sm-6">
		<div class="pull-right">
			{!! $data->job->render() !!}
		</div>
	</div>
	<div class="clearfix"></div>
</div>