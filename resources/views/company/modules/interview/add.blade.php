@extends('company.main')

@section('extra-style')

<style type="text/css">
    .func a:hover {
        text-decoration: none;
    }
    td{
        vertical-align: middle !important;
    }

    .form-inline button {
        border: none; background: none; color: #7d7d7d;
    }
    .form-inline input {
        border-right: none;
    }
    .form-inline .input-group-addon{
        background: #fff;
    }
    .accept{
        color: #00BCD4;
    }
    .progres{
        color: #00bf17;
    }
    .reject{
        color: #e20000;
    }
</style>
@stop
@section('initMap')
@stop
@section('extra-lib')
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    function getLocation(latlng, id) {
    var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=";
    // var latlng = "21.025065587036384,105.78829765319824";
    var key = "AIzaSyBv5DQpiye2WEKFfzKVW-56fI_BX5fqRYc";
    url += latlng + "&key=" + key;
    $.ajax({
    dataType: "json",
            type: "GET",
            url: url,
            cache: false,
            data: {'latlng': latlng, 'key': key},
            success: function (data) {
            obj.data = data.results[0].formatted_address;
            $("#job-" + id).append(obj.data);
            }
    });
    }

    function search() {        
    $('#loading').show();
    $.ajax({
    url: '{!! route('public.company.employee.SearchEmployee') !!}',
            type: 'POST',
            data: {name: $("input[name='name']").val(),CategoryID:{!! $categoryID !!}, country: $('#combo option:selected').val(), _token: '{!! csrf_token() !!}'},
    })
            .done(function (output) {
            $('#loading').hide();
            if (output.code == '200') {
            var html = "";
            for (i = 0; i < output.user.length; i++) {
            html += "<tr id='tr"+output.user[i].user_id+"'>";
            html += "<td>" + (i + 1) + "</td>";
            html += "<td style='text-align: center;width: 8%;'>";
                    if(output.user[i].Avatar.startsWith('http')){
                        html +="<img src='"+output.user[i].Avatar+"' style='width:65px' />";
                    }else if(output.user[i].Avatar !=null ){
                        
                        var newImg = new Image();
                        newImg.src = "http://jobnow.com.sg/uploads/images/"+output.user[i].Avatar;
                        var height = newImg.height;
                        var width = newImg.width;
                        if(width >0){
                             html +="<img src='uploads/images/'"+output.user[i].Avatar+"' style='width:65px'  />";
                        }else{
                             html += "<img src='{{asset('upload/images/seeker/btn_locate_profile_not_active.png')}}' style='width:65px'  />"
                        }                       
                    }else{
                        html += "<img src='{{asset('upload/images/seeker/btn_locate_profile_not_active.png')}}' style='width:65px'  />"
                    }

            html += "</td>";
            html += "<td>" + output.user[i].FullName + "</td>";
            html += "<td>" + output.user[i].Name + "</td>";
            html += "<td>" + output.user[i].Title + "</td>";
            html += "<td>" + convert(output.user[i].created_at) + "</td>";
            html += "<td style='width: 22%' id='addShort"+output.user[i].user_id+"'>";
            if(output.user[i].exist == 'true'){
                html += "<div class='header-main5' style='padding:0'><a class='btn pull-left' style='margin-left: 20px;'>Added to Shortlist</a></div>";
            }else{
                html += "<div class='header-main4'>";
                html += "<a href='javascript:void(0)' onclick='addShort(" + output.user[i].user_id +"," +output.user[i].JobID + ")' class='btn pull-left' style='margin-left: 20px;'>";
                html += "Add to Shortlist</a>";
                html += "</div>";
            }            
            html += "</td>";
            html += "</tr>";
            }
            $('#result').html(output.user.length + " kết quả");
            $('#data-table').html(html);            
            } else {
                $('.des_mes').text('No results found');
                $('#popup .popup').attr('id', 'error');
                $('#popup').show();
            }

            });
    }

    //get size image
    function getMeta(url, callback) {
        var img = new Image();
        img.src = url;
        img.onload = function() { callback(this.width, this.height); }
    }

    /*
    convert date
     */
    function convert(date) {
        var sub_str = date.substring(0, 10);
        var parts = sub_str.split("-");
        return parts[2] + "-" + parts[1] + "-" + parts[0];
    }
    /*
    Add to shortlist
     */

    function addShort(id,jobid){
        var r = confirm("Bạn có muốn thêm vào danh sách ?");
        if (r == true) {
        $.ajax({
        url: '{!! route('public.company.shortlist.AddShortlist') !!}',
                type: 'POST',
                data: {CategoryID: {!! $categoryID !!}, UserID: id,JobID:jobid, _token: '{!! csrf_token() !!}'},
        })
        .done(function (output) {
            $('#loading').hide();
                if (output.code == '200') {
                    $('#addShort'+id).html("<div class='header-main5' style='padding:0'><a class='btn pull-left' style='margin-left: 20px;'>Đã thêm</a></div>");
                }
            });
        }
    }

    function reset(){
        $("input[name='name']").val('');
    }
    $(document).ready(function () {
                $('#example').DataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
            });
</script>
<style type="text/css">
    .error {
        color :red;
    }
</style>

@section('content')
<div class="main">
    <div >
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 header-main">
                    <span>Thêm ứng viên</span>

                </div>
                <div class="clearfix"></div>
                <div class="content">
                    <div id="applicatant" class="my-job searchresume">
                        <div class="container-fuild">
                            <div class="border data-search">
                                <div class="top-content" style="position: relative;">
                                    Tìm kiếm ứng viên                                     
                                </div> 
                                <div class="main-content">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8 col-xs-12">
                                        <!--<form action="" method="POST" id="form-interview">-->
                                            <!--<input type="hidden" value="{!! csrf_token() !!}" name="_token">-->                                            
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Tìm kiếm theo tên <span>*</span></label>                                                    
                                                <input type='text' name="name" class="form-control" placeholder="Enter Keyword" />                                                   
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Địa điểm <span>*</span></label>
                                                <select class="form-control" name="Location" id="combo">
                                                    @foreach($country as $item)
                                                    <option value="{!! $item->id !!}">{!! $item->Name !!}</option>                                                        
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="text-center">
                                            <input type="button" onclick="reset()" class="btn save-draft" value="Reset">
                                            <input type="button" onclick="search()" class="btn save-continue" value="Search">
                                        </div>
                                        <div class="text-center" id="loading" style="display:none">
                                            <img src="{!!asset('frontend/jobnow_backend/images/loading.gif')!!}" style="width:30%">                                                
                                        </div>
                                        <!--</form>-->
                                    </div>  
                                    <div class="clearfix"></div>
                                </div><!-- end .main-content -->
                            </div><!-- end .border -->
                        </div>
                    </div> 
                    <div id="applicatant" class="my-job searchresume">
                        <div class="container-fuild">
                            <div class="border data-search">
                                <div class="top-content" style="position: relative;" id="result">
                                    {{ count($user) }} Kết quả
                                </div> 
                                <div class="main-content">
                                    <div class="col-xs-12">                                        
                                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead style="background-color: #fafafa">
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Ảnh</th>
                                                    <th>Tên</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Vị trí ứng tuyển</th>
                                                    <th>Ngày ứng tuyển</th>
                                                    <th>Trạng thái</th>
                                                </tr>
                                            </thead>
                                            <tbody id="data-table">
                                                @foreach($user as $key=>$item)
                                                    <tr id="tr{{ $item->user_id }}">
                                                        <td>{{ $key+1 }}</td>
                                                        <td style='text-align: center;width: 8%;'>
                                                            @if(@getimagesize($item->Avatar))
                                                                <img src="{{ $item->Avatar }}" style='width:65px' />
                                                            @elseif($item->Avatar !=null )
                                                                @if(@getimagesize(asset('uploads/images/'.$item->Avatar)))
                                                                    <img src='{{asset('uploads/images/'.$item->Avatar)}}' style='width:65px'  />
                                                                @else
                                                                    <img src='{{asset('upload/images/seeker/btn_locate_profile_not_active.png')}}' style='width:65px'  />
                                                                @endif
                                                            @else
                                                                <img src='{{asset('upload/images/seeker/btn_locate_profile_not_active.png')}}' style='width:65px'  />
                                                            @endif
                                                        </td>
                                                        <td>{{ $item->FullName }}</td>
                                                        <td>{{ $item->Name }}</td>
                                                        <td>{{ $item->Title }}</td>
                                                        <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                                        <td style='width: 22%' id='addShort{{ $item->user_id }}'>
                                                            @if($item->exist == 'true')
                                                                <div class='header-main5' style='padding:0'><a class='btn pull-left' style='margin-left: 20px;'>Đã thêm</a></div>
                                                            @else
                                                                <div class='header-main4'>
                                                                    <a href='javascript:void(0)' onclick='addShort({{ $item->user_id}},{{$item->JobID}})' class='btn pull-left' style='margin-left: 20px;'>Thêm vào danh sách</a>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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