@extends('frontend.main')

@section('content')
	<div class="app save-job margin">
		<div class="container">
			<div class="row">
				@include('frontend.modules.profile.includes.detail-user')
				<div class="col-xs-8 col-sm-9 list-app-job content-job">
					<div class="border">
						<div class="til">
						    <h3>Lịch phỏng vấn <span>({!! $data->count() !!} interview) </span></h3>
					    </div>
						<div class="col-sm-12 content">

						    	@if(count($data))
						    		<table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tên của công ty</th>
                                                <th>Vị trí</th>
                                                <th>Ngày tháng</th>
                                                <th>Trạng thái</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($data as $item)
												<tr>
													<td>{!! $item->company->Name !!}</td>
													<td>{!! $item->company->Address !!}</td>
													<td>{{ $item->InterviewDate }}</td>
													<td><a href="javascript:void(0)" class="btn btn-primary">Xem chi tiết</a></td>
												</tr>
											@endforeach
                                        </tbody>
                                    </table>
							    	
								@else
									
								@endif
						    <div class="clearfix"></div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop