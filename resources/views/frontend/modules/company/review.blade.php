<li class="item col-sm-12">
	<div class="detail-item">
		<span class="time pull-right">{!! date('d/m/Y', strtotime($item->created_at)) !!}</span>
		<h3 class="title-cmt">
			{!! $item->Title !!}
		</h3>
		<div class="detail-u">
			<span class="name">{!! $item->jobseeker->FullName !!}</span>
			@for($i = 1 ; $i <= 5; $i++)
				@if($i <= $item->OverallRating)
					<span class="list-start glyphicon glyphicon-star">
					</span>
				@else
					<span class="list-start not-rank glyphicon glyphicon-star">
						</span>
				@endif
			@endfor						    						
			<i>({!! $item->OverallRating !!}.00)</i>
		</div>
		<p class="detail-cmt">
			{!! $item->Review !!}
		</p>
	</div>	
</li>