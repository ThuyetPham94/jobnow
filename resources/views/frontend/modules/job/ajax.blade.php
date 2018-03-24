<ul class="list-job">
	@if($data->count() > 0)
		@foreach($data as $job)
			<li class="col-xs-12">
				<h2 class="title-job"><a href="{!! route('public.job.getDetail', ['id' => $job->id, 'name' => str_slug($job->Title).'.html']) !!}">{!! $job->Title !!}</a></h2>
				<div class="des-location">
					<a class="location">{!! $job->location->Name !!}</a>
					<a class="salary" href="">Trên mức lương mong muốn</a>
				</div>
				<div class="description">
					<span>Trách nhiệm:</span>
					<p>
						{!! nl2br(str_limit($job->Description, 300), true) !!} ... 
						<a href="{!! route('public.job.getDetail', ['id' => $job->id, 'name' => str_slug($job->Title).'.html']) !!}">Xem thêm</a>
					</p>
				</div>
				<div class="des-company">
					<div class="pull-left de-com">
													<div class="img pull-left">
													<?php
														$com_id = $job->company_info->id;
														$com_name = $job->company_info->Name;
														$com_logo = $job->company_info->Logo;
														//var_dump($com_id."_".$com_name."_".$com_logo); die;
													?>
														<a href="{!! route('public.company.getDetail', ['id' => $com_id, 'name' => str_slug($com_name).'.html']) !!}">
														{{-- //fix load image default --}}
														@if(Config::get('images.image_company_url_logo').$com_logo != null)
															@if(@getimagesize(Config::get('images.image_company_url_logo').$com_logo))
																<img src="{!! Asset(Config::get('images.image_company_url_logo').$com_logo) !!}" title="{!! $com_name !!}" style="width: 100%">
															@else
																<img src="{!! Asset('uploads/images/logo.jpg') !!}" title="{!! $com_name !!}" style="width: 100%;">
															@endif
														@else
															<img src="{!! Asset('uploads/images/logo.jpg') !!}" title="{!! $com_name !!}" style="width: 100%;">
														@endif
														
													</div>
													<div class="detail pull-left">
														<h2><a href="{!! route('public.company.getDetail', ['id' => $com_id, 'name' => str_slug($com_name).'.html']) !!}">{!! $com_name !!}</a></h2>
														<span class="time-post">
															Đã đăng: {!! \Carbon\Carbon::createFromTimeStamp(strtotime($job->created_at))->diffForHumans(); !!}
														</span>
													</div>
													<div class="clearfix"></div>
												</div>
					<div class="pull-right">
						<p class="text-right">
							<a href="">{{ $job->joblevel }}</a>
						</p>
						<p class="text-right">
							Ngành: {{ $job->industry->Name }}
						</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</li>
		@endforeach
	@else
		<li>
			<h1 class="text-center" style="margin: 20px 0; font-size: 25px;">không có kết quả nào được tìm thấy</h1>
		</li>
	@endif
</ul>
<div class="clearfix"></div>
<div class="main-bottom">
	<div class="col-sm-4">
		<p>Hiển thị <span id="currentPage">@if($data->lastPage() == 0) 0 @else {!! $data->currentPage() !!} @endif</span> of <span id="total">{!! $data->lastPage() !!}</span> Kết quả</p>
	</div>
	<div class="col-sm-8">
		<div class="pull-right">
			@if (isset($data) && $data->lastPage() > 1)

									    <ul class="pagination">
									        
									        <?php
									        $interval = isset($interval) ? abs(intval($interval)) : 3 ;
									        $from = $data->currentPage() - $interval;
									        if($from < 1){
									            $from = 1;
									        }
									        
									        $to = $data->currentPage() + $interval;
									        if($to > $data->lastPage()){
									            $to = $data->lastPage();
									        }
									        ?>
									        
									        <!-- first/previous -->
									        @if($data->currentPage() > 1)
									            <li>
									                <a href="{{ $data->url(1) }}" aria-label="First">
									                    <span aria-hidden="true">First</span>
									                </a>
									            </li>

									            <li>
									                <a href="{{ $data->url($data->currentPage() - 1) }}" aria-label="Previous">
									                    <span aria-hidden="true">&lsaquo;</span>
									                </a>
									            </li>
									        @endif
									        
									        <!-- links -->
									        @for($i = $from; $i <= $to; $i++)
									            <?php 
									            $isCurrentPage = $data->currentPage() == $i;
									            ?>
									            <li class="{{ $isCurrentPage ? 'active' : '' }}">
									                <a href="{{ !$isCurrentPage ? $data->url($i) : '#' }}">
									                    {{ $i }}
									                </a>
									            </li>
									        @endfor
									        
									        <!-- next/last -->
									        @if($data->currentPage() < $data->lastPage())
									            <li>
									                <a href="{{ $data->url($data->currentPage() + 1) }}" aria-label="Next">
									                    <span aria-hidden="true">&rsaquo;</span>
									                </a>
									            </li>

									            <li>
									                <a href="{{ $data->url($data->lastpage()) }}" aria-label="Last">
									                    <span aria-hidden="true">Last</span>
									                </a>
									            </li>
									        @endif
									        
									    </ul>

									@endif
			
		</div>
	</div>
	<div class="clearfix"></div>
</div>