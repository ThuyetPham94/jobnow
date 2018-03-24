@extends('company.main')
@section('content')
<div class="main">
    <div >
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 header-main">
                    <span>CHÍNH SÁCH BẢO MẬT</span>
                    {{-- <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Post A Job</a> --}}
                               </div>
                    <div class="clearfix"></div>
                        <div id="applicatant" class="post-job">
                            <div class="container-fuild">                                             
                                    <div class="border">                                                         
                                        <div class="main-content" style="font-family:arial ">
                                @foreach($privacy as $item)
                                <div style="display: flex;">
                                {!! HTML::image('frontend/jobnow_backend/images/privacy/icon-left.png')!!} 
                                    <p style="margin:3px;font-weight: bold">{!! $item->Title !!}</p>
                                </div>
                                <p style="margin-top: 10px;margin-bottom: 10px">
                                    {!! $item->Description !!}    
                                </p>
                                @endforeach
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