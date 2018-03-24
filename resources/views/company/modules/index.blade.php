@extends('company.main')
@section('extra-lib')
<script type="text/javascript" src="{!! Asset('backend/plugins/chartjs/Chart.min.js') !!}"></script>
<script type="text/javascript" src="{!! Asset('/frontend/js/canvasjs.min.js') !!}"></script>
<?php $label = array(); $data = array(); ?>
@if($chart_month_job)
  @foreach ($chart_month_job as $key => $value)
    <?php $label_month_job[] = $key; ?>
    <?php $data_month_job[] = $value; ?>
  @endforeach
@endif
@if($chart_month_interview)
  @foreach ($chart_month_interview as $key => $value)
    <?php $label_month_interview[] = $key; ?>
    <?php $data_month_interview[] = $value; ?>
  @endforeach
@endif



<script type="text/javascript">
    var month_label = <?php echo json_encode($month_arr); ?>;
    var year = <?php echo $year; ?>;
    $(document).ready(function(){
    var label_month_job_array = <?php echo json_encode($label_month_job); ?>;
    var data_month_job_array = <?php echo json_encode($data_month_job); ?>;
    
    var chart = new CanvasJS.Chart("job_month_chartContainer", {
      title: {
        text: ""
      },
      data: [
      {
        type: "splineArea",
        dataPoints: [
                  
                ]
      }
      ]
    });
    var dataPoints = [];
    for (var i = 0; i < month_label.length; i++) {
        dataPoints.push({ label: month_label[i], y: data_month_job_array[i] });
    }
    chart.options.data[0].dataPoints = dataPoints;
    chart.render();
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
    var label_month_interview_array = <?php echo json_encode($label_month_interview); ?>;
    var data_month_interview_array = <?php echo json_encode($data_month_interview); ?>;
    var chart = new CanvasJS.Chart("interview_month_chartContainer", {
      title: {
        text: ""
      },
      data: [
      {
        type: "splineArea",
        dataPoints: [
                  
                ]
      }
      ]
    });
    var dataPoints = [];
    for (var i = 0; i < month_label.length; i++) {
        dataPoints.push({ label: month_label[i], y: data_month_interview_array[i] });
    }

    chart.options.data[0].dataPoints = dataPoints;
    chart.render();
    });
</script>

@stop


@section('content')
	<link media="all" type="text/css" rel="stylesheet" href="{!! Asset('backend/dist/css/AdminLTE.min.css') !!}">
	<style type="text/css">
		.mess_new .post-job {
		    background: #278bca; float: left; padding: 20px; margin-right: 15px; margin-bottom: 15px;
		}
		.mess_new span {
			font-size: 26px; font-weight: bold; color: #47555e; text-decoration: none; margin-top: 12px; display: inline-block;
		}
		.mess_new p {
			text-decoration: none; color: #666;
		}
	</style>
	<div class="main">
        <div >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 header-main">
                        <span>Dashboard</span>
                        <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Đăng tin</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div id="dashboard">
                            <div class="col-sm-12" style="margin-bottom: 20px">
                                <div class="row">
                                    <div class="col-sm-3 mess_new">
                                        <div class="border">
                                            <a href="{!! route('public.company.job.index') !!}">
                                                <div class="icon-img post-job">
                                                	<img src="{!! Asset('/frontend/jobnow_backend/images/icon/1.1.png') !!}">
                                                </div>
                                                <span class="number">{!! $job->count() !!}</span>
                                                <p>Việc làm của tôi</p>
                                                <div class="clearfix"></div>
                                            </a>
                                        </div>
                                    </div>                                   
                                    <div class="col-sm-3 mess_new">
                                        <div class="border">
                                            <a href="">
                                                <div class="icon-img post-job">
                                                  <img src="{!! Asset('/frontend/jobnow_backend/images/icon/1.2.png') !!}">
                                                </div>
                                                <span class="number">{!! $countJob !!}</span>
                                                <p>Việc đã hoàn thành</p>
                                                <div class="clearfix"></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 mess_new">
                                        <div class="border">
                                            <a href="">
                                                <div class="icon-img post-job">
                                                  <img src="{!! Asset('/frontend/jobnow_backend/images/icon/1.2.png') !!}">
                                                </div>
                                                <span class="number">{!! $countHiring !!}</span>
                                                <p>Đang tuyển dụng</p>
                                                <div class="clearfix"></div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>                               
                            </div>
                            <div class="col-md-12">                                 
                                <div class="row">                                  
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">                                  
                                      <div class="box box-info">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">Biểu đồ tháng việc làm</h3>
                                          <div class="box-tools pull-right">                                          
                                          </div>
                                        </div>
                                        <div class="box-body">
                                          <div class="chart">
                                            <div id="job_month_chartContainer" style="height:250px;width:100%"></div>
                                          </div>
                                        </div>                                        
                                      </div>                                      
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">                                  
                                      <div class="box box-info">
                                        <div class="box-header with-border">
                                          <h3 class="box-title">Biểu đồ tháng lịch phỏng vấn</h3>
                                          <div class="box-tools pull-right">                                           
                                          </div>
                                        </div>
                                        <div class="box-body">
                                          <div class="chart">
                                            <div id="interview_month_chartContainer" style="height:250px;width:100%"></div>
                                          </div>
                                        </div>                                        
                                      </div>                                      
                                    </div>
                                </div>                                
                            </div>                           
                        </div> 
                        <div class="clearfix"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop