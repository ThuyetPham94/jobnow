@extends('company.main')

@section('extra-lib')

<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#datetimepicker2').datetimepicker({
            format: 'YYYY-MM-DD',
        });        
    });        
</script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#postJob').validate({
                rules : {
                    Title : 'required',
                    //Position : 'required',
                    JobLevelID : 'required',
                    IndustryID : 'required',
                    // LocationID : 'required',
                    FromSalary : 'required',
                    ToSalary : 'required',
                    // CurrencyID : 'required',
                    Description : 'required',
                    Requirement : 'required',
                    //Skill : 'required',
                    Start_date: 'required',
                    //End_date : 'required',
                    WorkingHours :'required'
                }
            });
        });
    </script>
    <style type="text/css">
        .error {
            color :red;
        }
    </style>
@stop

@section('content')
	<div class="main">
        <div >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 header-main">
                        <span>Đăng tin</span>
                        <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Đăng tin</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div id="applicatant" class="post-job">
                            <div class="container-fuild">
                                {!! Form::open(['url' => route('public.company.job.postUpdate'), 'method' => 'POST', 'id' => 'postJob']) !!}
                                    {!! Form::hidden('id',$job->id) !!}
                                    <div class="border">
                                        <div class="top-content">
                                            Đăng thông tin tuyển dụng
                                        </div>
                                        <div class="main-content">
                                            <div class="col-xs-2"></div>
                                            <div class="col-xs-8">
                                                    @if(count($errors))
                                                        @foreach($errors->all() as $error)
                                                            <p style="color: red;"><strong>(*) {!! $error !!}</strong></p>
                                                        @endforeach
                                                    @endif
                                                    <div class="main-form">
                                                        <div class="form-group">
                                                            <label for="">Vị trí công việc <span>*</span></label>
                                                            <input type="text" class="form-control" value="{!! $job->Title !!}" name="Title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Loại công việc <span>*</span></label>
                                                            <select class="form-control" name="EmploymentID">
                                                                @foreach($employment as $val)
                                                                    @if($val->id == $job->EmploymentID)
                                                                    <option selected="" value="{!! $val->id !!}">{!! $val->NameType !!}</option>
                                                                    @else
                                                                    <option value="{!! $val->id !!}">{!! $val->NameType !!}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Cấp bậc công việc <span>*</span></label>
                                                            <select class="form-control" name="JobLevelID">
                                                                @foreach($joblevel as $val)
                                                                    @if($val->id == $job->JobLevelID)
                                                                    <option selected value="{!! $val->id !!}">{!! $val->Name !!}
                                                                    @else
                                                                    <option value="{!! $val->id !!}">{!! $val->Name !!}
                                                                    @endif
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <label for="">Ngành nghề<span>*</span></label>
                                                            <div class="form-group">
                                                                <select name="IndustryID" class="form-control">
                                                                    @foreach($industry as $val) 
                                                                        @if($job->IndustryID == $val->id )
                                                                            <option value="{!! $val->id !!}" selected="selected">{!! $val->Name !!}</option>
                                                                        @else   
                                                                            <option value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Năm kinh nghiệm <span>*</span></label>
                                                            <div class="form-group">                                        
                                                                <select name="ExperienceID" class="form-control">     
                                                                    @foreach($experience as $val)
                                                                        @if($val->id == $job->ExperienceID) 
                                                                            <option selected="" value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                                        @else
                                                                            <option value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Nơi làm việc<span>*</span></label>
                                                            <select class="form-control" name="LocationID">
                                                                @foreach($location as $val)
                                                                    @if($val->id == $job->LocationID)
                                                                    <option value="{!! $val->id !!}" selected="">{!! $val->Name !!}</option>
                                                                    @else
                                                                    <option value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <div id="map"></div>
                                                            
                                                        </div>
                                                    <div class="form-group" style="display: none">
                                                       <div class="col-xs-6" style="padding-right: 10px; padding-left: 0">
                                                            <label for="">Latitude (for Google Maps) <span>*</span></label>
                                                        <div class="clearfix"></div>
                                                            <input type="text" value="{!! $job->Latitude !!}" name="Latitude" class="form-control" id="Latitude" readonly>
                                                        </div>
                                                        <div class="col-xs-6" style="padding-left: 10px; padding-right: 0">
                                                        <label for="">Longitude (for Google Maps) <span>*</span></label>
                                                        <div class="clearfix"></div>
                                                            <input type="text" value="{!! $job->Longitude !!}" name="Longitude" class="form-control" id="Longitude" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                        <div class="form-group">
                                                            <label for="">Lương (VNĐ) <span>*</span></label>
                                                            <div class="clearfix"></div>
                                                            <div class="form-group col-xs-8 clear-padding">
                                                                <input type="text" value="{!! $job->FromSalary !!}" name="FromSalary" class="form-control" placeholder="Salary from !">
                                                            </div>
                                                            <div class="form-group col-xs-8 clear-padding">
                                                                <input type="text" value="{!! $job->ToSalary !!}" name="ToSalary" class="form-control" placeholder="Salary to !">
                                                            </div>
                                                            <div class="col-xs-4 clear-padding">
                                                                <div class="checkbox">
                                                                    @if($job->IsDisplaySalary == 1)
                                                                        <label style="vertical-align: middle;"><input checked="checked" type="checkbox" value="1" name="IsDisplaySalary"><span class="m-check" style="vertical-align: middle;"></span><span class="salary" style="vertical-align: middle;">Show the salary</span></label>
                                                                    @else
                                                                        <label style="vertical-align: middle;"><input type="checkbox" value="1" name="IsDisplaySalary"><span class="m-check" style="vertical-align: middle;"></span><span class="salary" style="vertical-align: middle;">Show the salary</span></label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="clearfix"></div>
                                                        <div class="form-group">
                                                            <div class="col-xs-6" style="padding-left: 0">
                                                                <label>Ngày bắt đầu <span>*</span></label>
                                                                <div class='input-group date' id='datetimepicker1'>
                                                                    <input type='text' name="Start_date" class="form-control" value="{!! $job->Start_date !!}" />
                                                                    <span class="input-group-addon">
                                                                        <b class="glyphicon glyphicon-calendar"></b>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6" style="padding-right: 0">
                                                                <label>Ngày kết thúc <span>*</span></label>
                                                                <div class='input-group date' id='datetimepicker2'>
                                                                    <input type='text' name="End_date" class="form-control" value="{!! $job->End_date !!}" />
                                                                    <span class="input-group-addon">
                                                                        <b class="glyphicon glyphicon-calendar"></b>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="form-group">
                                                            <label for="">Mô tả công việc<span>*</span></label>
                                                            <textarea name="Description" id="input" class="form-control" rows="8" style="resize: none;" required="required">{!! $job->Description !!}</textarea>
                                                            <p class="pull-right note">(Tối đa 14500 ký tự)</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Yêu cầu công việc<span>*</span></label>
                                                            <textarea name="Requirement" id="input" class="form-control" rows="8" style="resize: none;" required="required">{!! $job->Requirement !!}</textarea>
                                                            <p class="pull-right note">(Tối đa 14500 ký tự)</p>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Giờ làm việc <span>*</span></label>
                                                            <input type="text" class="form-control" value="{!! $job->WorkingHours !!}" name="WorkingHours">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Trạng thái <span>*</span></label>
                                                            {!! Form::select('IsActive', [
                                                                1 => 'Công bố',
                                                                0 => 'Tạm hoãn',
                                                            ], $job->IsActive, ['class' => 'form-control']) !!}
                                           
                                                        </div>
                                                    </div>
                                            </div>  
                                            <div class="clearfix"></div>
                                        </div><!-- end .main-content -->
                                    </div><!-- end .border -->
                                   
                                    <div class="save-button">
                                        {{-- <input type="button" value="Save a Draft" class="btn save-draft"> --}}
                                        <input type="submit" value="Lưu" class="btn save-continue">
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div> 
                        <div class="clearfix"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
  var map;
  var markers = [];
  var image = '{!! Asset("frontend/images/macker.png") !!}';
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: {!! $job->Latitude !!}, lng: {!! $job->Longitude !!}},
      zoom: 14
    });

    var marker = new google.maps.Marker({
          position: {lat: {!! $job->Latitude !!}, lng: {!! $job->Longitude !!}},
          map: map,
          icon:image
        });
    markers.push(marker);



    map.addListener('click', function(e) {
      placeMarkerAndPanTo(e.latLng, map);
    });
    google.maps.event.addListener(map, 'click', function( event ){
        //console.log(event.latLng.lat());
        $("#Latitude").val(event.latLng.lat());
        $("#Longitude").val(event.latLng.lng());

        var latlng1 = event.latLng.lat()+','+event.latLng.lng();        
        getLocation(latlng1);
        
      //alert( "Latitude: "+event.latLng.lat()+" "+", longitude: "+event.latLng.lng() ); 
    });
  }

  // get location
    var obj = {
        "data":""
    };
    function getLocation(latlng){
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
                    $("#Location").val(obj.data);
                }
            });

    }

  function placeMarkerAndPanTo(latLng, map) {
    deleteMarkers();
    
    var marker = new google.maps.Marker({
      position: latLng,
      map: map,
      icon:image
    });

    markers.push(marker);
  }
  function clearMarkers() {
    setMapOnAll(null);
  }
  function deleteMarkers() {
    clearMarkers();
    markers = [];
  }
  function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }
</script>
@stop