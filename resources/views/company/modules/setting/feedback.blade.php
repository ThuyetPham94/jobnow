@extends('company.main')
@section('content')
<script type="text/javascript">
    $(function () {
        $(document).ready(function() {
            $('#PostForm').validate({
                rules : {
                    Title : 'required',
                    Message : 'required',                    
                }
            });
        });
    </script>
<div class="main">
        <div >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 header-main">
                        <span>Phản hồi</span>
                        {{-- <a href="{!! route('public.company.job.getCreate') !!}" class="btn pull-right">Post A Job</a> --}}
                    </div>                      

                    <div class="clearfix"></div>
                        <div id="applicatant" class="post-job">
                            <div class="container-fuild">                                
                                    <div class="border">             
                                        <div class="main-content" style="font-family:arial ">
                                            <div class="row">
                                            	<div class="col-md-2"></div>
                                            	<div class="col-md-8">
                                                    <div style="text-align: center;">
                                                        <label style="font-size: 18px" for="">Chúng tôi muốn nghe từ bạn</label>
                                                        <div>
                                                            <p>Cảm ơn bạn đã dành thời gian để cung cấp cho chúng tôi thông tin phản hồi có giá trị của bạn. Chúng tôi cố gắng để cung cấp cho bạn chăm sóc tuyệt vời và chúng tôi đưa ý kiến của bạn vào trái tim.</p>    
                                                        </div>
                                                    </div>
                                                    @if( ! empty($status))
                                                    <div class="alert alert-danger">
                                                        <button type="button" class="close" data-dismiss='alert' aria-hiden ="true">&times;</button>
                                                        Gửi phản hồi thành công!
                                                    </div>
                                                    @endif
                                                    {!! Form::open(['url' => route('public.company.setting.postfeedback'), 'method' => 'POST','id'=>'PostForm']) !!}                                            
                                                            <div class="form-group">
                                                                <label for="">Tiêu đề</label>
                                                                <input type="text" class="form-control" name="Title">
                                                            </div>
                                                            @if($errors->has('Title'))
                                                                <p style="color: red">{{ $errors->first('Title') }}</p>
                                                            @endif
                                                            <div class="form-group">
                                                                <label for="">Phản hồi</label>
                                                                <textarea name="Message" id="input" class="form-control" rows="8" style="resize: none;"></textarea>
                                                                <p class="pull-left note">(Nhiều nhất 14500 ký tự)</p>
                                                            </div> 
                                                    
                                                            @if($errors->has('Message'))
                                                                <p style="color: red">{{ $errors->first('Message') }}</p>
                                                            @endif
                                                    
                                                            <div class="text-center">
                                                                <div class="save-button">
                                                                    <input type="reset" value="RESET" class="btn save-draft">
                                                                    <input type="submit" value="SEND" class="btn save-feedback">
                                                                </div>
                                                            </div>
                                                        {!! Form::close() !!}
                                            	</div>
                                                <div class="col-md-2"></div>
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