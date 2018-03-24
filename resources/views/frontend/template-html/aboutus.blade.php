<?php
use App\Models\Job;
?>
@extends('frontend.main')

@section('content')
	<div id="wrapper-content">
		<div class="head">
			<p style="text-transform: uppercase">Về chúng tôi</p>
		</div>
		<div class="container" style="margin-top: 30px;">
			<div class="row">
				<div class="col-sm-6" style="line-height: 26px;">
					<h4 class="title">
						Chúng tôi là ai?
					</h4>
					<p>JobNow là một cổng công việc trực tuyến hàng đầu.<b> Chúng tôi làm việc với các công ty trong nước và toàn cầu được công nhận và có uy tín nhất. Tại JobNow, trọng tâm của chúng tôi là đặt người tìm việc vào đúng vị trí, cung cấp cho họ cơ hội nghề nghiệp phù hợp với sở thích của họ và cho phép họ đóng góp vào việc kinh doanh của chủ lao động. Trọng tâm của sự thành công của chúng tôi là cam kết của chúng tôi để tìm kiếm và tuyển dụng việc làm dễ dàng hơn cho người dùng của chúng tôi bằng cách cung cấp cho họ những giải pháp sáng tạo mới. Các giải pháp được thiết kế bởi các chuyên gia của chúng tôi không chỉ giúp người tìm việc tiết kiệm được thời gian và tiền bạc bằng cách tìm kiếm công việc phù hợp một cách nhanh chóng mà còn cho phép các công ty đưa ra những quyết định tuyển dụng thông minh hơn.</p>					
				</div>
				<div class="col-sm-6">
					<img class="img-responsive" src="{!! Asset('frontend/images/Business-Hands-PC.jpg') !!}"></img>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="container bot">
		<div class="row">
			<div class="col-sm-6" style="position: relative;">
				<img class="img-responsive" src="{!! Asset('frontend/images/map-all.png') !!}"></img>
				<span style="    position: absolute;
    left: 25%;
    top: 35%;
    color: #000000;;
    font-size: 20px;
    font-weight: bold;">{!! Job::all()->count() !!} Việc làm</span>
			</div>
			<div class="col-sm-6" style="line-height: 26px;">
				<h4 class="title">
					Chúng tôi làm gì?
				</h4>
				<p>
					Điều phân biệt JobNow từ các cổng công việc khác là cam kết của chúng tôi để làm cho việc tuyển dụng dễ dàng hơn cho người dùng của chúng tôi. Cơ sở dữ liệu phong phú, giàu tính năng của chúng tôi làm cho nhiệm vụ rườm rà khi duyệt qua hàng ngàn quảng cáo việc làm và tiếp tục trở nên dễ dàng hơn và nhanh hơn bằng cách cho phép người dùng lọc kết quả dựa trên nhiều tiêu chí, bao gồm vị trí, kỹ năng, kinh nghiệm và Công nghiệp.Ngoài việc xuất bản quảng cáo việc làm, JobNow còn giúp các nhà tuyển dụng xây dựng hồ sơ công ty của họ và viết những quảng cáo hấp dẫn với sức mạnh độc đáo này để thu hút những cá nhân tài năng nhất. Các chuyên gia về nhân sự và các chuyên gia trong ngành có kinh nghiệm làm việc cho nhiều ngành công nghiệp khác nhau cũng cung cấp lời khuyên và lời khuyên cho người tìm việc, giúp họ tự định vị mình tốt hơn cho các cơ hội nghề nghiệp trong tương lai.
				</p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<style type="text/css">
		#wrapper-content {
			background:#000000;
			padding-bottom: 50px;
		}
		#wrapper-content .head{
		    background: url('frontend/images/page-title-1.jpg') no-repeat left;
		    background-size: 100% 100%;
		}
		#wrapper-content .head p{
		    margin: 0;
		    padding: 70px 0;
		    text-align: center;
		    color: #000000;
		    font-size: 40px;
		    font-weight: bold;
		    background: rgba(36, 137, 206, 0.34);
		}
		h4.title{
	        color: #2489ce;
		    font-size: 20px;
		    font-weight: bold;
		    margin-bottom: 20px;
		}
		#wrapper-content p{
			
		}
		.bot {
			padding: 50px 0;
		}

	</style>
@stop