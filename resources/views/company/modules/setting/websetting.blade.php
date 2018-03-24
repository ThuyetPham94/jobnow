@extends('company.main')

<!-- //update by hung -->
@section('extra-lib')
<script type="text/javascript">
        function updatePhone(id, Phone)  {
            var token = '{!! csrf_token() !!}';
            $.ajax({
                url: '{!! route("public.company.setting.update-phone") !!}',
                type: 'POST',
                data: {id : id,Phone:Phone, _token : token},
            })
            .done(function(output) {
                if(output.code == 200) {
                    $('#tr_'+id).hide();
                    $('.des_mes').text(output.message);
                    $('#popup .popup').attr('id', 'success');
                    $('#popup').show();
                }else{
                    $('.des_mes').text(output.message);
                    $('#popup .popup').attr('id', 'error');
                    $('#popup').show();
                }
            })
        }

        $(document).ready(function(){
            $( "#update-phone" ).bind( "click", function() {                          
                updatePhone({!! $user->id !!},$("#phone").val());             
            });
        });
    </script>
@stop
<!-- end update by hung -->
@section('content')
<div class="main">
    <div >
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 header-main">
                    <span>CÀI ĐẶT</span>
                {{-- <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Post A Job</a> --}}
                    </div>    
                    <style type="text/css" media="screen">
                        /* enable absolute positioning */
                        .inner-addon {
                            position: relative;
                        }

                        /* style glyph */
                        .inner-addon .glyphicon {
                            position: absolute;
                            padding: 10px;
                            
                        }
                        .glyphicon{
                            
                            height: 80%;
                            margin-right: 10px;
                        }

                        /* align glyph */
                        .left-addon .glyphicon  { left:  0px;}
                        .right-addon .glyphicon { right: 0px;}

                        /* add padding  */
                        .left-addon input  { padding-left:  30px; }
                        .right-addon input { padding-right: 30px; }

                        .right-addon img{
                            position: absolute;
                            right:0px;
                            top:-1px;
                            cursor:pointer;
                        }
                    </style>                
                    <div class="clearfix"></div>
                    <div id="applicatant" class="post-job">
                        <div class="container-fuild">                                
                            <div class="border">  
                                <div class="top-content">
                                    Cài đặt web
                                </div>                                      
                                <div class="main-content" style="font-family:arial ">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div style="display: flex;">
                                                <label for="">Tên : </label> <p>{!! $user->Username !!}</p>
                                            </div>
                                            <div style="display: flex;">
                                                <label for="">Email address : </label> <p>{!! $user->Email !!}</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Phone </label> 
                                                <div class="inner-addon right-addon">
                                                    <input type="number"  id="phone" class="form-control" value="{!! $user->CompanyProfile->ContactNumber !!}" placeholder="Phone" />
                                                    <a href="#" class="glyphicon"></a>
                                                        <div class="glyphicon" style="background-image: url('../frontend/jobnow_backend/images/privacy/credit.png');cursor: pointer" id="update-phone"></div>
                                                                                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end .main-content -->
                            </div><!-- end .border -->                                      
                        </div>                            
                    </div>                        
                    <div id="applicatant" class="post-job" style="margin-top: 15px">
                        <div class="container-fuild">                                
                            <div class="border">  
                                <div class="top-content">
                                    Change password
                                </div>                                      
                                <div class="main-content" style="font-family:arial ">
                                    <div class="row">
                                        <div class="col-md-3">

                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::open(['url' => route('public.user.postChangePass'), 'method' => 'POST']) !!}

                                            <div class="form-group">
                                                <label for="">Old Password</label>
                                                <input type="password" class="form-control" name="Old_Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="">New Password</label>
                                                <input type="password" class="form-control" name="Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Confim new Password</label>
                                                <input type="password" class="form-control" name="Re_Password">
                                            </div>
                                            <div class="text-center">
                                                <input type="button" value="Cancel" class="btn save-draft">
                                                <input type="submit" value="Save" class="btn save-continue">
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div><!-- end .main-content -->
                            </div><!-- end .border -->                                      
                        </div>                            
                    </div> 
                    <div class="clearfix"></div> 
                </div>
            </div>
        </div>
    </div>
    @stop