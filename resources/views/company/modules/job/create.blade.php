@extends('company.main')

@section('extra-lib')
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: "{{ Date("20y-m-d") }}",                           
        }).on('dp.change', function (e) {
            $('#End_date').val(addDays(e.date.format('YYYY-MM-DD'),30));
        });                
    });

    function addDays(date, days) {
        var result = new Date(date);
        result.setDate(result.getDate() + days);
        if((result.getMonth()+1) <10 ){
            return result.getFullYear()+'-0'+ (result.getMonth()+1) + '-' + result.getDate();
        }else{
            return result.getFullYear()+'-'+ (result.getMonth()+1) + '-' + result.getDate();
        }
    }   

</script>

    <script type="text/javascript">
    $(function () {
        $(document).ready(function() {
            $('#postJob').validate({
                rules : {
                    Title : 'required',                    
                    JobLevelID : 'required',
                    IndustryID : 'required',                    
                    FromSalary : 'required',
                    ToSalary : 'required',                    
                    Description : 'required',
                    Requirement : 'required',
                    Skill : 'required',
                    Start_date: 'required',
                    End_date : 'required',
                    WorkingHours :'required',
                    
                }
               
            });
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
                        {{-- <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Post A Job</a> --}}
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div id="applicatant" class="post-job">
                            <div class="container-fuild">
                                {!! Form::open(['url' => route('public.company.job.postCreate'), 'method' => 'POST', 'id' => 'postJob']) !!}
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
                                                            <input type="text" class="form-control" value="{!! old('Title') !!}" name="Title">
                                                        </div>
                                                        {{-- <div class="form-group">
                                                            <label for="">Position <span>*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" value="{!! old('Position') !!}"  name="Position">
                                                            </div>
                                                        </div> --}}
                                                        <div class="form-group">
                                                            <label for="">Loại công việc <span>*</span></label>
                                                            <select class="form-control" name="EmploymentID">
                                                                @foreach($employment as $val)
                                                                    <option value="{!! $val->id !!}">{!! $val->NameType !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Cấp bậc công việc <span>*</span></label>
                                                            <select class="form-control" name="JobLevelID">
                                                                @foreach($joblevel as $val)
                                                                    <option value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Ngành nghề <span>*</span></label>
                                                            <div class="form-group">                                        
                                                                <select name="IndustryID" id="IndustryID" class="form-control">
                                                                    @foreach($industry as $val) 
                                                                        <option value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Số năm kinh nghiệm <span>*</span></label>
                                                            <div class="form-group">                                        
                                                                <select name="ExperienceID" class="form-control">     
                                                                    @foreach($experience as $val) 
                                                                        <option value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Nơi làm việc<span>*</span></label>
                                                            <select class="form-control" name="LocationID">
                                                                @foreach($location as $val)
                                                                    <option value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group" style="display: none">
                                                            <label for="">Job Location <span>*</span></label>
                                                            <div class="form-group">
                                                            	<input id="Location" class="form-control" type="text" placeholder="Location" readonly="" name="Location">
                                                            </div>
                                                        </div>
                                                        <div class="form-group" style="position: relative">
                                                        <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                                                        <div id="map"></div>
                                                            
                                                        </div>
                                                    <div class="form-group" style="display: none">
                                                       <div class="col-xs-6" style="padding-right: 10px; padding-left: 0">
                                                            <label for="">Latitude (for Google Maps) <span>*</span></label>
                                                        <div class="clearfix"></div>
                                                            <input type="text" value="{!! old('Latitude') !!}" name="Latitude" class="form-control" id="Latitude" readonly>
                                                        </div>
                                                        <div class="col-xs-6" style="padding-left: 10px; padding-right: 0">
                                                        <label for="">Longitude (for Google Maps) <span>*</span></label>
                                                        <div class="clearfix"></div>
                                                            <input type="text" value="{!! old('Longitude') !!}" name="Longitude" class="form-control" id="Longitude" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                        <div class="form-group">
                                                            <label for="">Lương (VND) <span>*</span></label>
                                                            <div class="clearfix"></div>
                                                            <div class="form-group col-xs-8 clear-padding">
                                                                <input type="text" value="{!! old('FromSalary') !!}" name="FromSalary" class="form-control" placeholder="Salary from !">
                                                            </div>
                                                            <div class="form-group col-xs-8 clear-padding">
                                                                <input type="text" value="{!! old('ToSalary') !!}" name="ToSalary" class="form-control" placeholder="Salary to !">
                                                            </div>
                                                            <div class="col-xs-4 clear-padding">
                                                                <div class="checkbox">
                                                                    <label style="vertical-align: middle;"><input type="checkbox" value="1" name="IsDisplaySalary"><span class="m-check" style="vertical-align: middle;"></span><span class="salary" style="vertical-align: middle;">Hiển thị mức lương</span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="clearfix"></div>
                                                        <div class="form-group">            
                                                            <div class="col-xs-6" style="padding-left: 0">
                                                                <label>Ngày bắt đầu <span>*</span></label>
                                                                <div class='input-group date' id='datetimepicker1'>
                                                                    <input type='text' name="Start_date" class="form-control" id="Start_date" />
                                                                    <span class="input-group-addon">
                                                                        <b class="glyphicon glyphicon-calendar"></b>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6" style="padding-right: 0">
                                                                <label>Ngày kết thúc <span>*</span></label>
                                                                    <input type='text' name="End_date" class="form-control" value="{{ date('Y-m-d', strtotime(Date("20y-m-d"). ' + 30 days')) }}" id="End_date" />               
                                                            </div>
                                                        </div>                                                        
                                                        <div class="clearfix"></div>
                                                        <div class="form-group">
                                                            <label for="">Mô tả công việc<span>*</span></label>
                                                            <textarea name="Description" id="input" class="form-control" rows="8" style="resize: none;">{!! old('Description') !!}</textarea>
                                                            <p class="pull-right note">(Tối đa 14500 ký tự)</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Yêu cầu công việc<span>*</span></label>
                                                            <textarea name="Requirement" id="input" class="form-control" rows="8" style="resize: none;">{!! old('Requirement') !!}</textarea>
                                                            <p class="pull-right note">(Tối đa 14500 ký tự)</p>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Giờ làm việc <span>*</span></label>
                                                            <input type="text" class="form-control" value="" name="WorkingHours">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Thêm kỹ năng</label>
                                                            <div class="form-group">
                                                                <!-- <input type="text" class="form-control" value="" name="Skill" id="Skill" data-role="tagsinput"> -->
                                                                <select class="js-example-basic-multiple" id="Skill" name="Skill[]" multiple="multiple">
                                                                    
                                                                </select>
                                                                <div style="display: none">
                                                                    @foreach ($skill as $sk)
                                                                        <option class="industry_{!! $sk->IndustryID !!}" value="{!! $sk->id !!}">{!! $sk->Name !!}</option>
                                                                    @endforeach
                                                                </div>
                                                                <style type="text/css">
                                                                    span.select2.select2-container.select2-container--default{
                                                                        width: 100%;
                                                                    }
                                                                </style>
                                                                <link rel="stylesheet" href="{!! Asset('frontend/select2/css/select2.css') !!}">
                                                                <!-- jQuery -->
                                                                <script src="https://code.jquery.com/jquery.js"></script>
                                                                <script type="text/javascript" src="{!! Asset('frontend/select2/js/select2.full.js') !!}"></script>
                                                                <script type="text/javascript">
                                                                $(".js-example-basic-multiple").select2();
                                                                $(document).ready(function() {
                                                                    $('#IndustryID').on('change', function() {
                                                                        $('#Skill').html($('.industry_'+$(this).val()));
                                                                    });
                                                                    $('span.select2.select2-container').css('width', '100%');
                                                                });
                                                                </script>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="form-group">
                                                            <label for="">Trạng thái <span>*</span></label>
                                                            {!! Form::select('IsActive', [
                                                                1 => 'Công bố',
                                                                0 => 'Tạm hoãn',
                                                            ], old('IsActive'), ['class' => 'form-control']) !!}
                                           
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
      center: {lat: 20.999211, lng: 105.814851},
      zoom: 14
    });
    map.addListener('click', function(e) {
      placeMarkerAndPanTo(e.latLng, map);
    });
    google.maps.event.addListener(map, 'click', function( event ){
        //console.log(event.latLng.lat());
        $("#Latitude").val(event.latLng.lat());
        $("#Longitude").val(event.latLng.lng());

        var latlng1 = event.latLng.lat()+','+event.latLng.lng();        
        getLocation(latlng1);

        //alert(latlng1); 
    });
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);
    var marker = new google.maps.Marker({
      map: map,
      anchorPoint: new google.maps.Point(0, -29),
      icon: image
    });
    autocomplete.addListener('place_changed', function() {
            //deleteMarkers();
          //infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            //map.setZoom(14);  // Why 17? Because it looks good.
            //console.log(place.geometry.location.lat());
            $("#Latitude").val(place.geometry.location.lat());
            $("#Longitude").val(place.geometry.location.lng());             
            
          }
          marker.setIcon(/** @type {google.maps.Icon} */({
            url: image,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35),
          }));
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);
          markers.push(marker);
          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          //infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          //infowindow.open(map, marker);
        });
  }

    // get location
    var obj = {
        "data":""
    };
    function getLocation(latlng){
    var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=";        
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
    var image = '{!! Asset("frontend/images/macker.png") !!}';
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
<style>
    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
            position: absolute;
    top: 0;
    left: 0;
    z-index: 9999999;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }
      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
</style>
@stop