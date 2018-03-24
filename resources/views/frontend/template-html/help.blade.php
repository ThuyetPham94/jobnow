@extends('frontend.main')

@section('content')
	<style>
		.list-content{
			line-height: 26px;
		    text-align: justify;
		}
	</style>
	<div id="wrapper-content">
		<div class="head">
			<p style="text-transform: uppercase">Trợ giúp</p>
		</div>

		<div class="container" style="margin-top: 30px;">
			<div class="title"><h2>1. Làm thế nào để duyệt cho việc làm ngay?</h2></div>
			<div class="list-content">
				<h3>Duyệt qua Thông tin trên Việt nam</h3>				
				<p>Là một cổng công việc trực tuyến hàng đầu, JobNow xuất bản hàng chục lần mở việc làm mới hàng ngày. Đăng ký miễn phí để khám phá hàng ngàn cơ hội việc làm tiềm năng và tìm công việc tiếp theo của bạn.</p>
			</div>
			<div class="list-content">
				<h3>Lọc kết quả</h3>
				<p>Tìm một công việc đáp ứng tốt nhất nguyện vọng nghề nghiệp và kỹ năng của bạn bằng cách sử dụng các bộ lọc tìm kiếm việc làm tiên tiến của chúng tôi. Nhận các kết quả phù hợp nhất dựa trên ngành, vị trí, kinh nghiệm và mức lương.</p>				
			</div>
			<div class="list-content">
				<h3>Áp dụng với một cú nhấp chuột</h3>
				<p>JobNow giúp bạn dễ dàng hơn trong việc xin việc làm nhiều lần. Chỉ cần gửi CV cập nhật của bạn và một tin nhắn nhỏ để thể hiện sự quan tâm của bạn đến vị trí của người sử dụng lao động kế tiếp.</p> 		
			</div>
					
		</div>
		
		<div class="container" style="margin-top: 30px;">
			<div class="title"><h2>2. Tìm kiếm việc làm nâng cao</h2></div>
			<div class="list-content">
				<h3>Công việc theo Địa điểm</h3>				
				<p>Tìm kiếm một công việc trong một khu phố cụ thể? JobNow cho phép bạn lọc các vị trí tuyển dụng dựa trên vị trí và tìm địa điểm nằm gần nhà bạn.</p>
			</div>
			<div class="list-content">
				<h3>Công việc theo ngành</h3>
				<p>Nhân sự, Tiếp thị, Thiết kế hoặc tài chính - JobNow cung cấp cho bạn cơ hội nghề nghiệp tốt nhất trong ngành mà bạn chọn.</p>				
			</div>
			<div class="list-content">
				<h3>Tuyển dụng bằng Kỹ năng</h3>
				<p>Bạn có biết làm thế nào để mã? Hoặc có lẽ bạn đang giỏi kế toán? Tìm một công việc tốt hơn dựa trên các kỹ năng bạn có bằng cách sử dụng các bộ lọc tìm kiếm của JobNow.</p> 				
			</div>
			<div class="list-content">
				<h3>Mẹo vặt</h3>
				<p>Cần mẹo để viết một lá thư xin việc hấp dẫn hoặc muốn được giúp đỡ để cập nhật bản lý lịch của bạn? JobNow cung cấp cho bạn lời khuyên chuyên gia của các chuyên gia về nhân sự và các chuyên gia trong ngành.</p> 				
			</div>						
		</div>

		<div class="container" style="margin-top: 30px;">
			<div class="title"><h2>3. Câu chuyện thành công của chúng tôi</h2></div>
			<div class="list-content">						
				<p>- “Nhờ JobNow Tôi đã có một công việc mà tôi yêu thích hàng ngày.” — <b>Ứng viên</b></p>
				<p>- “Tôi luôn tìm kiếm cơ hội nghề nghiệp tốt hơn, và do đó, hãy ghé thăm JobNow gần như hàng ngày. Trang web của họ rất dễ sử dụng và có một giao diện người dùng tốt đẹp cho phép bạn tìm kiếm thông tin có liên quan một cách nhanh chóng và dễ dàng.” — <b>ứng viên</b></p>
				<p>- “JobNow có lẽ là cổng công việc thân thiện nhất mà tôi đã sử dụng cho đến nay. Bộ lọc tìm kiếm rất hữu ích vì bạn có thể sử dụng chúng để lọc kết quả dựa trên nơi bạn muốn làm việc, mức lương dự kiến và kỹ năng của bạn.” — <b>Ứng viên</b></p>
			</div>									
		</div>

	</div>
	<style type="text/css">
		#wrapper-content {
			background: #fff;
			padding-bottom: 50px;
		}
		#wrapper-content .head{
		    background: url('frontend/images/term.jpg') no-repeat left;
		    background-position: 0 -140px;
		    background-size: 100%;
		}
		#wrapper-content .head p{
		    margin: 0;
		    padding: 70px 0;
		    text-align: center;
		    color: #fff;
		    font-size: 40px;
		    font-weight: bold;
	        background: rgba(36, 137, 206, 0.34);
		}
		#wrapper-content h3{
		    color: #026dbb;
		    font-size: 18px;
		    font-weight: bold;
		    margin-bottom: 20px;
		}
		#wrapper-content p{
			
		}
		#wrapper-content ol { counter-reset: item; }
		#wrapper-content ol li { display: block; }
		#wrapper-content ol li:before {
			content: counter(item) ". ";
			counter-increment: item;
			color: #026dbb;
		}
		.title{
			margin-bottom: 20px;
			font-weight: bold;
		}
	</style>
@stop