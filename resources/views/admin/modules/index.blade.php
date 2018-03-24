@extends('admin.main')
@section('extra-lib')
<script type="text/javascript" src="{!! Asset('backend/plugins/chartjs/Chart.min.js') !!}"></script>
<?php $label = array(); $data = array(); ?>
<?php $label_job = array(); $data_job = array(); ?>
<?php $label_seeker = array(); $data_seeker = array(); ?>
@if($chart_company)
@foreach ($chart_company as $item)
	<?php $label[] = $item->day; ?>
	<?php $data[] = $item->company_count; ?>
@endforeach
@endif
@if($chart_job)
@foreach ($chart_job as $item)
	<?php $label_job[] = $item->day; ?>
	<?php $data_job[] = $item->job_count; ?>
@endforeach
@endif
@if($chart_seeker)
@foreach ($chart_seeker as $item)
	<?php $label_seeker[] = $item->day; ?>
	<?php $data_seeker[] = $item->seeker_count; ?>
@endforeach
@endif
<script type="text/javascript">
	var label_array = <?php echo json_encode($label); ?>;
	var data_array = <?php echo json_encode($data); ?>;
	var areaChartData = {
      labels: label_array,
      datasets: [
        {
          label: "Company",
          fillColor: "rgba(47, 198, 69, 0.87)",
          strokeColor: "rgba(47, 198, 69, 0.87)",
          pointColor: "rgba(47, 198, 69, 0.87)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: data_array
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    //areaChart.Line(areaChartData, areaChartOptions);


	var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(areaChartData, lineChartOptions);
</script>

<script type="text/javascript">
	var label_array_job = <?php echo json_encode($label_job); ?>;
	var data_array_job = <?php echo json_encode($data_job); ?>;
	var areaChartDataJob = {
      labels: label_array_job,
      datasets: [
        {
          label: "Job",
          fillColor: "rgba(47, 198, 69, 0.87)",
          strokeColor: "rgba(47, 198, 69, 0.87)",
          pointColor: "rgba(47, 198, 69, 0.87)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: data_array_job
        }
      ]
    };


    var lineChartCanvas_job = $("#lineChartJob").get(0).getContext("2d");
    var lineChart_job = new Chart(lineChartCanvas_job);
    var lineChartOptions_job = areaChartOptions;
    lineChartOptions_job.datasetFill = false;
    lineChart_job.Line(areaChartDataJob, lineChartOptions_job);
</script>

<script type="text/javascript">
	var label_array_seeker = <?php echo json_encode($label_seeker); ?>;
	var data_array_seeker = <?php echo json_encode($data_seeker); ?>;
	var areaChartDataSeeker = {
      labels: label_array_seeker,
      datasets: [
        {
          label: "Seeker",
          fillColor: "rgba(47, 198, 69, 0.87)",
          strokeColor: "rgba(47, 198, 69, 0.87)",
          pointColor: "rgba(47, 198, 69, 0.87)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: data_array_seeker
        }
      ]
    };


    var lineChartCanvas_seeker = $("#lineChartSeeker").get(0).getContext("2d");
    var lineChart_seeker = new Chart(lineChartCanvas_seeker);
    var lineChartOptions_seeker = areaChartOptions;
    lineChartOptions_seeker.datasetFill = false;
    lineChart_seeker.Line(areaChartDataSeeker, lineChartOptions_seeker);
</script>

@stop
@section('content')
	

	

	<div class="row">
		<div class="col-md-4 col-sm-4 col-xs-12">
			<a href="">
				<div class="info-box">
					<span class="info-box-icon bg-green"><i class="fa fa-institution"></i></span>

					<div class="info-box-content">
						<span class="info-box-text" style="color: #666666">Công ty</span>
						<span class="info-box-number" style="color: #666666">{!! $company->count() !!}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</a>
		<!-- /.info-box -->
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<a href="">
				<div class="info-box">
					<span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

					<div class="info-box-content">
						<span class="info-box-text" style="color: #666666">Ứng viên</span>
						<span class="info-box-number" style="color: #666666">{!! $seeker->count() !!}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</a>
		<!-- /.info-box -->
		</div>
		<div class="col-md-4 col-sm-4 col-xs-12">
			<a href="">
				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="glyphicon glyphicon-briefcase"></i></span>

					<div class="info-box-content">
						<span class="info-box-text" style="color: #666666">Việc làm</span>
						<span class="info-box-number" style="color: #666666">{!! $job->count() !!}</span>
					</div>
					<!-- /.info-box-content -->
				</div>
			</a>
		<!-- /.info-box -->
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Biểu đồ công ty đã đăng ký</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Biểu đồ việc làm</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChartJob" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
	</div>
	<div class="row">
		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			<!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Biểu đồ ứng viên</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChartSeeker" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
		</div>
	</div>
@stop