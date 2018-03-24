@extends('admin.main')

@section('extra-lib')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#postJob').validate({
                rules : {
                    Title : 'required',
                    Position : 'required',
                    Level : 'required',
                    IndustryID : 'required',
                    LocationID : 'required',
                    FromSalary : 'required',
                    ToSalary : 'required',
                    CurrencyID : 'required',
                    Description : 'required',
                    Requirement : 'required',
                    Skill : 'required'
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
                        <span>Post a job</span>
                        {{-- <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Post A Job</a> --}}
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div id="applicatant" class="post-job">
                            <div class="container-fuild">
                                {!! Form::open(['url' => route('admin.job.postCreate'), 'method' => 'POST', 'id' => 'postJob']) !!}
                                <div class="border">
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
                                                    <label for="">Select Company <span>*</span></label>
                                                    <div class="form-group">
                                                        {{-- <input type="text" class="form-control" value="{!! old('Category') !!}" name="Category" id=""data-role="tagsinput"> --}}
                                                        <select name="CompanyID" id="CompanyID" class="form-control">
                                                            @foreach($company as $val)
                                                                <option value="{!! $val->id !!}">{!! $val->companyProfile->Name !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Job Title  <span>*</span></label>
                                                    <input type="text" class="form-control" value="{!! old('Title') !!}" name="Title">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Position <span>*</span></label>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" value="{!! old('Position') !!}"  name="Position">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Job Level <span>*</span></label>
                                                    {!! Form::select('Level', [
                                                        1 => 'Entry Level',
                                                        2 => 'Experienced (non-manager)',
                                                        3 => 'Manager',
                                                        4 => 'Director and above'
                                                    ], old('Level'), ['class' => 'form-control']) !!}
                                                    {{-- <select class="form-control">
                                                        <option>Less than 10</option>
                                                    </select> --}}
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Job Category <span>*</span></label>
                                                    <div class="form-group">
                                                        {{-- <input type="text" class="form-control" value="{!! old('Category') !!}" name="Category" id=""data-role="tagsinput"> --}}
                                                        <select name="IndustryID" id="IndustryID" class="form-control">
                                                            <option value="">---</option>
                                                            @foreach($industry as $val)
                                                                <option value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Job Location <span>*</span></label>

                                                    <div class="form-group">
                                                        <select name="LocationID" class="form-control">
                                                            @foreach($location as $val)
                                                                <option value="{!! $val->id !!}">{!! $val->Name !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div id="map"></div>

                                                </div>
                                                <div class="form-group">
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
                                                <!-- <div class="form-group">
                                                    <label for="">Experience <span>*</span></label>
                                                    <select class="form-control">
                                                        <option>Less than 10</option>
                                                    </select>
                                                </div> -->
                                                <div class="form-group">
                                                    <label for="">Salary (USD) <span>*</span></label>
                                                    <div class="clearfix"></div>
                                                    <div class="form-group col-xs-8 clear-padding">
                                                        <input type="text" value="{!! old('FromSalary') !!}" name="FromSalary" class="form-control" placeholder="Salary from !">
                                                    </div>
                                                    <div class="form-group col-xs-8 clear-padding">
                                                        <input type="text" value="{!! old('ToSalary') !!}" name="ToSalary" class="form-control" placeholder="Salary to !">
                                                    </div>
                                                    <div class="col-xs-4 clear-padding">
                                                        <div class="checkbox">
                                                            <label style="vertical-align: middle;"><input type="checkbox" value="1" name="IsDisplaySalary"><span class="m-check" style="vertical-align: middle;"></span><span class="salary" style="vertical-align: middle;">Show the salary</span></label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="clearfix"></div>
                                                <div class="form-group">
                                                    <label for="">Currency <span>*</span></label>

                                                    <div class="form-group">
                                                        <select name="CurrencyID" class="form-control">
                                                            @foreach($currency as $val)
                                                                <option value="{!! $val->id !!}">{!! $val->Symbol !!}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Responsibilities<span>*</span></label>
                                                    <textarea name="Description" id="input" class="form-control" rows="8" style="resize: none;">{!! old('Description') !!}</textarea>
                                                    <p class="pull-right note">(You have 14500 character remainings)</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Requirements<span>*</span></label>
                                                    <textarea name="Requirement" id="input" class="form-control" rows="8" style="resize: none;">{!! old('Requirement') !!}</textarea>
                                                    <p class="pull-right note">(You have 14500 character remainings)</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">All skill</label>
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
                                                                //$('#Skill').html($('.industry_'+$('#IndustryID').val()));
                                                                $('#IndustryID').on('change', function() {
                                                                    //console.log($(this).val());
                                                                    $('#Skill').html($('.industry_'+$(this).val()));
                                                                });
                                                                $('span.select2.select2-container').css('width', '100%');
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="form-group">
                                                    <label for="">Status <span>*</span></label>
                                                    {!! Form::select('IsActive', [
                                                        1 => 'Active',
                                                        0 => 'Dective',
                                                    ], old('IsActive'), ['class' => 'form-control']) !!}

                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div><!-- end .main-content -->
                                </div><!-- end .border -->

                                <div class="save-button">
                                    {{--<input type="button" value="Save a Draft" class="btn save-draft">--}}
                                    <input type="submit" value="Save and Continue" class="btn save-continue">
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
        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 21.027939, lng: 105.809949},
                zoom: 14
            });
            map.addListener('click', function(e) {
                placeMarkerAndPanTo(e.latLng, map);
            });
            google.maps.event.addListener(map, 'click', function( event ){
                //console.log(event.latLng.lat());
                $("#Latitude").val(event.latLng.lat());
                $("#Longitude").val(event.latLng.lng());
                //alert( "Latitude: "+event.latLng.lat()+" "+", longitude: "+event.latLng.lng() );
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
@stop