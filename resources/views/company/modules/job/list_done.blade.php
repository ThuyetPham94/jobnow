@extends('company.main')

@section('extra-lib')
    <script type="text/javascript">
        function detroy(id)  {
            var token = '{!! csrf_token() !!}';
            //this.preventDefault();
            var r = confirm('Bạn có muốn xóa không ?');
            if (r) {
                $.ajax({
                    url: '{!! route('public.company.job.postDelete') !!}',
                    type: 'POST',
                    data: {id : id, _token : token},
                })
                .done(function(output) {
                    if(output.code == 200) {
                        $('#tr_'+id).hide();
                        $('.des_mes').text('Job deleted successfully');
                        $('#count').text(output.count + "JOBS");
                        $('#popup .popup').attr('id', 'success');
                        $('#popup').show();
                    }else{
                        $('.des_mes').text('Deleted Failse');
                        $('#popup .popup').attr('id', 'error');
                        $('#popup').show();
                    }
                })
            }
        }

    </script>
    
    <!-- update by hung -->
        <script type="text/javascript">
            var obj = {
                "data":""
            };
           function getLocation(latlng,id){
              var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=";
             
              // var latlng = "21.025065587036384,105.78829765319824";
            var key = "AIzaSyBv5DQpiye2WEKFfzKVW-56fI_BX5fqRYc";
            url+=latlng+"&key="+key;
            
            $.ajax({
                dataType: "json",
                type: "GET",
                url: url,
                cache: false,
                data: {'latlng':latlng,'key':key},
                success: function(data){
                    obj.data = data.results[0].formatted_address;
                    $("#job-"+id).append(obj.data);
                }
            });
        }
        
        </script>
        @foreach($data as $job)
            <script type="text/javascript">
                var latlng = "{!!$job->Latitude.','.$job->Longitude!!}";
                var id = '{!! $job->id !!}';
                getLocation(latlng,id);
            </script>
        @endforeach
        <!-- end update by hung -->
   
@stop

@section('content')
    <div class="main">
        <div >
            <div class="container-fluid">
                <ul class="append">
                </ul>
                <div class="row">
                    <div class="col-sm-12 header-main">
                        <span>CHI TIẾT VIỆC LÀM CỦA TÔI</span>
                        <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Đăng tin</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div id="applicatant" class="my-job">
                            <div class="container-fuild">
                                <div class="border">
                                    <div class="top-content">
                                        Đã tuyển<span id="count" style="color:#AAAAAA">{!! ' ('.$countJob.' JOBS)' !!}</span>
                                    </div>
                                    <div class="main-content">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Mã bài</th>
                                                    <th>Tiêu đề</th>
                                                   <!--  <th>Views</th>
                                                    <th>No. of Applicants</th>
                                                    <th>Status</th> -->
                                                    <th>Lương</th>
                                                    <th>Địac chỉ</th>
                                                    <th>Trạng thái</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $job)

                                                    <tr id="tr_{!! $job->id !!}">
                                                        <td>{!! $job->id !!}</td>
                                                        <td><a href="">{!! $job->Title !!}</a></td>
                                                        <td>{!!"$ ".number_format($job->FromSalary,0,',','.')."-"!!}{!!"$ ".number_format($job->ToSalary,0,',','.')!!}</td>
                                                        <td id="job-{!! $job->id !!}">
                                                        </td>
                                                        
                                                        <!-- <td>
                                                            @if($job->IsActive == 1)
                                                                <span class="active">Active</span>
                                                            @else
                                                                <span class="dective">Dective</span>
                                                            @endif
                                                        </td> -->
                                                        <td style="display:block">
                                                            <a class="view" href="{!! route('public.job.getDetail', ['id'=>$job->id, 'name'=>str_slug($job->Title)]) !!}">Chi tiết</a>
                                                           <a class="edit" href="{!! route('public.company.job.getUpdate').'?id='. $job->id !!}">Cập nhật</a>
                                                            <a class="delete" href="javascript:void(0)" onclick="detroy({!! $job->id !!})">Xóa</a>
                                                            <a class="extend" href="{!! route('public.company.job.extend', ['id'=>$job->id]) !!}">Gia hạn</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="pull-right">
                                            {!! $data->render() !!}
                                        </div>
                                        <div class="clearfix"></div>
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