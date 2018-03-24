@extends('company.main')

@section('extra-lib')
    
	<style type="text/css">
		.upload_link{
    		text-decoration:none;
		}
		#upload1, #upload2{
		    display:none
		}
	</style>
	<script type="text/javascript">
		$("#Logo").on('click', function(e){
		    e.preventDefault();
		    $("#upload1:hidden").trigger('click');
		});
        $("#CompanyImage").on('click', function(e){
            e.preventDefault();
            $("#upload2:hidden").trigger('click');
        });
        @if(session()->has('event'))
            $('.my-tab li').removeClass('active');
            $('.{!! session()->get('event') !!}').addClass('active');
            $('.tab-content .tab-pane').removeClass('active');
            $('#{!! session()->get('event') !!}').addClass('active').addClass('in');
            
        @endif

        $("#upload2").on("change", function(){  
          var numFiles = $(this).get(0).files.length
           $("#CompanyImageText").val('You are select '+numFiles+' file');
        });
        
        $("#upload1").on("change", function(){  
          var numFiles = $(this).val()
           $("#CompanyLogo").val('You are select file ' + numFiles);
        });
	</script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.validator.addMethod("PHONE", function(value, element) {
                return this.optional(element) || /^[0-9\s\+]{9,15}$/i.test(value);
            }, "Phone Number failse.");
            $('#main-form').validate({
                rules : {
                    Name :"required",
                    CompanySizeID :"required",
                    Address :"required",                    
                    ContactNumber :"required PHONE",                    
                    IndustryID :"required",
                    Website :"required",
                    FaceBookPage :"required",                    
                    Overview : "required",
                    WhyJoinUs : "required"                   
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
                        <span>Tài khoản của tôi</span>
                        <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Đăng tin</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div class="my-account">                            
                                <div class="container-fuild">
                                    <div class="border">
                                        <div class="top-content">
                                            <ul class="my-tab" role="tablist">
                                                <li class="active" role="presentation">
                                                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                                        Hồ sơ công ty của tôi
                                                    </a>
                                                </li>
                                                <li role="presentation" class="change-mail">
                                                    <a href="#change-mail" aria-controls="change-mail" role="tab" data-toggle="tab">
                                                        Thay đổi địa chỉ email
                                                    </a>
                                                </li>                                                
                                            </ul>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="main-content">
                                            <div class="main-form">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                        {!! Form::open(["url" => route('public.company.account.postUpdate'), "enctype"=>"multipart/form-data", 'id' => 'main-form']) !!}
                                                            <div class="form-group">
                                                                <label for="">Tên công ty  <span>*</span></label>
                                                                <input type="text" class="form-control" id="" name="Name" value="{!! ($user->companyProfile && $user->companyProfile->Name)?$user->companyProfile->Name:"" !!}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Quy mô công ty <span>*</span></label>
                                                                <select class="form-control" name="CompanySizeID">
                                                                <?php

                                                                    if($user->companyProfile->CompanySizeID != null){
                                                                        $cid = $user->companyProfile->CompanySizeID;
                                                                    }else{
                                                                        $cid = 1;
                                                                    }
                                                                ?>
                                                                    @foreach($companySize as $val)
                                                                        
                                                                            <option value="{!! $val->id !!}" @if($val->id == $cid) selected @endif>{!! $val->Name !!}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Địa chỉ công ty <span>*</span></label>
                                                                <input type="text" id="Address" class="form-control" name="Address" value="{!! ($user->companyProfile && $user->companyProfile->Address)?$user->companyProfile->Address:"" !!}">
                                                            </div>

                                                            <div class="form-group">
                                                                <div id="map"></div>                                                            
                                                            </div>                                                           
                                                            <div class="form-group" style="display: none">
                                                               <div class="col-xs-6" style="padding-right: 10px; padding-left: 0">
                                                                    <label for="">Latitude (for Google Maps) <span>*</span></label>
                                                                <div class="clearfix"></div>
                                                                    <input type="text" value="{!! $user->companyProfile->Latitude !!}" name="Latitude" class="form-control" id="Latitude" readonly>
                                                                </div>
                                                                <div class="col-xs-6" style="padding-left: 10px; padding-right: 0">
                                                                <label for="">Longitude (for Google Maps) <span>*</span></label>
                                                                <div class="clearfix"></div>
                                                                    <input type="text" value="{!! $user->companyProfile->Longitude !!}" name="Longitude" class="form-control" id="Longitude" readonly>
                                                                </div>
                                                            </div>                                                      
                                                            <div class="form-group" style="display: none" >
                                                                <label for="">EA Reg. ID</label>
                                                                <input type="text" class="form-control" name="EA_Reg" value="{!! ($user->companyProfile && $user->companyProfile->EA_Reg)?$user->companyProfile->EA_Reg:"" !!}">
                                                            </div>
                                                            <div class="form-group"  style="display: none">
                                                                <label for="">EA No </label>
                                                                <input type="text" class="form-control" id="" name="EA_No" value="{!! ($user->companyProfile && $user->companyProfile->EA_No)?$user->companyProfile->EA_No:"" !!}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Ngành <span>*</span> </label>
                                                                <select class="form-control" name="IndustryID">       
                                                                    @foreach($Industry as $val)
                                                                        @if($val->id == $industryID->IndustryID)
                                                                            <option value="{!! $val->id !!}" selected="" >{!! $val->Name !!}</option>
                                                                        @else
                                                                            <option value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                                        @endif                       
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Website <span>*</span> </label>
                                                                <input type="text" class="form-control" id="" name="Website" value="{!! ($user->companyProfile && $user->companyProfile->Website)?$user->companyProfile->Website:"" !!}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Facebook Fan Page <span>*</span></label>
                                                                <input type="text" class="form-control" id="" name="FaceBookPage" value="{!! ($user->companyProfile && $user->companyProfile->FaceBookPage)?$user->companyProfile->FaceBookPage:"" !!}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Số điện thoại <span>*</span></label>
                                                                <input type="text" class="form-control" id="" name="ContactNumber" value="{!! ($user->companyProfile && $user->companyProfile->ContactNumber)?$user->companyProfile->ContactNumber:"" !!}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Email <span>*</span></label>
                                                                <input type="text" class="form-control" id="" disabled="disabled"  name="Email" value="{!! $user->Email !!}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Hồ sơ công ty <span>*</span></label>
                                                                <textarea class="form-control" rows="8" name="Overview">{!! ($user->companyProfile && $user->companyProfile->Overview)?$user->companyProfile->Overview:"" !!}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Tại sao tham gia cùng chúng tôi ? <span>*</span></label>
                                                                <textarea class="form-control" rows="8" name="WhyJoinUs">{!! HTML::decode(($user->companyProfile && $user->companyProfile->WhyJoinUs)?$user->companyProfile->WhyJoinUs:"") !!}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Logo Công ty </label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="CompanyLogo" value="{!! $user->companyProfile->Logo !!}" readonly>
                                                                    <input id="upload1" type="file" name="Logo" name="CompanyLogo">
                                                                    <div class="input-group-addon">
                                                                        <a href="#" id="Logo"> Chọn file..</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Hình ảnh công ty </label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" readonly id="CompanyImageText">
                                                                    <input id="upload2" type="file" name="CompanyImage[]" multiple="multiple">
                                                                    <div class="input-group-addon">
                                                                        <a href="#" id="CompanyImage"> Chọn ảnh..</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                            @if($user->companyImage)
                                                            @forelse ($user->companyImage as $value)
                                                                <div class="col-xs-4 radio-image" id="CompanyImage{{ $value->id }}">
                                                                    <label for="image{!! $value->id !!}">
                                                                    <img id="" src="{!! url() !!}/{!! Config::get('images.company_image_url') !!}{!! $value->ImageUrl !!}" class="img-responsive">
                                                                    <input style="float: left" type="radio" name="CoverImage" id="image{!! $value->id !!}" value="{!! $value->id !!}" @if(trim($user->companyProfile->CoverImage) == trim($value->ImageUrl)) checked @endif><span style="float: left; color: #333;padding: 12px 0px 0px 9px;">Xét ảnh này làm banner</span>
                                                                    </label>
                                                                    <i class="glyphicon glyphicon-remove RemoveImage" js_id="{!! $value->id !!}"></i>
                                                                </div>
                                                            @endforeach
                                                                
                                                            @endif
                                                            </div>
                                                            <div class="clearfix"></div>
                                                            <div class="text-center">
                                                                <button type="submit" class="submit btn btn-margin">Lưu</button>
                                                            </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="change-mail">
                                                        {!! Form::open(['url' => route('public.company.postChangeMail'), 'method' => 'POST']) !!}
                                            
                                                            <div class="form-group">
                                                                <label for="">Mật khẩu</label>
                                                                <input type="password" class="form-control" name="Password">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Email mới</label>
                                                                <input type="text" class="form-control" name="Email">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Nhập lại email</label>
                                                                <input type="text" class="form-control" name="Re_Email">
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="reset" class="cancel btn btn-primary">Hủy</button>
                                                                <button type="submit" class="submit btn btn-primary">Lưu</button>
                                                            </div>
                                                        {!! Form::close() !!}
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
    <script src ="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $(".RemoveImage").click(function (){
                var id = $(this).attr('js_id');
                var token = '{!! csrf_token() !!}';
                $.ajax({
                    url: '{!! route("public.company.job.postDeleteImageCompany") !!}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {id: id, _token: token},
                    success: function (result){
                        if(result.code == 200){
                            $("#CompanyImage"+id).remove();
                            $('.des_mes').text('Ảnh được xóa thành công');
                            $('#popup .popup').attr('id', 'success');
                            $('#popup').show();
                        }else{
                            $('.des_mes').text('Remove Fail');
                            $('#popup .popup').attr('id', 'error');
                            $('#popup').show();
                        }
                    }
                });
                
            });
        });
        </script>

        <script>
  var map;
  var markers = [];
  var image = '{!! Asset("frontend/images/macker.png") !!}';
  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: {!! ($user->companyProfile->Latitude)?$user->companyProfile->Latitude:20.999211 !!}, lng: {!! ($user->companyProfile->Longitude)?$user->companyProfile->Longitude:105.814851 !!}},
      //center: {lat: 21.024316, lng: 105.818286},
      zoom: 14
    });

    var marker = new google.maps.Marker({
          position: {lat: {!! ($user->companyProfile->Latitude)?$user->companyProfile->Latitude:0 !!}, lng: {!! ($user->companyProfile->Longitude)?$user->companyProfile->Longitude:0 !!}},
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
    //google.maps.event.addDomListener(window, 'load', initialize);

    var input = document.getElementById('Address');
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    //var infowindow = new google.maps.InfoWindow();
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
                    $("#Address").val(obj.data);
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
  /*function initialize() {

    var input = document.getElementById('searchTextField');
    var autocomplete = new google.maps.places.Autocomplete(input);
    }*/
</script>
<style type="text/css">
    <style>
    #searchTextField {
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

      #searchTextField:focus {
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
</style>
@stop