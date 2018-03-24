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
			<p style="text-transform: uppercase">FAQ</p>
		</div>
		<div class="container" style="margin-top: 30px;">
			<div class="list-content">
				<h3>1. Làm cách nào để tôi đăng quảng cáo việc làm?</h3>
				<p>Để đăng quảng cáo việc làm, trước tiên bạn phải đăng ký làm người dùng đã đăng ký. JobNow cung cấp miễn phí đăng việc không giới hạn trong một tháng cho khách hàng lần đầu. Bạn có thể hưởng lợi từ phiếu mua hàng này, hoặc, hoặc lựa chọn một kế hoạch đăng việc làm phù hợp nhất với ngân sách và sở thích của bạn.</p>
			</div>
			<div class="list-content">
				<h3>2. Công việc của tôi được đăng ở đâu?</h3>
				<p>Các công việc mà bạn đăng trên JobNow được đăng trên nền tảng trực tuyến của chúng tôi. Các công việc có thể được xem cho tất cả những người tìm việc đã đăng ký có thể duyệt qua các yêu cầu của việc mở công việc, xác định tính đủ điều kiện của họ, và áp dụng cho công việc ngay lập tức. </p>
			</div>
			<div class="list-content">
				<h3>3. Cần bao lâu để quảng cáo việc làm xuất hiện trong kết quả tìm kiếm?</h3>
				<p>Hầu hết các bài đăng công việc được xuất bản trên JobNow trong vòng 24 giờ sau khi nộp. Tương tự, nếu bạn muốn chỉnh sửa quảng cáo việc làm, những thay đổi sẽ được phản ánh trên quảng cáo đã xuất bản trong vòng 24 giờ.</p>
			</div>
			<div class="list-content">
				<h3>4.Làm thế nào tôi có thể loại bỏ một bài đăng công việc xuất bản trên JobNow?</h3>
				<p>Nếu bạn muốn xóa bài đăng công việc vì vị trí đã được điền hoặc do bất kỳ lý do nào khác, chỉ cần nhấp vào nút 'xóa bài đăng' và quảng cáo việc làm của bạn sẽ bị xóa trong vòng 24 giờ.</p>
			</div>
			<div class="list-content">
				<h3>5. Tôi có thể đăng bao nhiêu công việc?</h3>
				<p>JobNow cung cấp nhiều kế hoạch cho nhà tuyển dụng, những người muốn xuất bản quảng cáo việc làm của họ trên JobNow. Mỗi kế hoạch đăng ký có giới hạn khác nhau khi nói đến số lượng quảng cáo việc làm bạn có thể xuất bản mỗi tháng.</p>
				
			</div>
			<div class="list-content">
				<h3>6. Bạn có hoàn lại tiền cho người dùng muốn hủy đăng ký của họ?</h3>
				<p>JobNow cho phép bạn hủy đăng ký bất cứ lúc nào bạn muốn. Tuy nhiên, chúng tôi không cung cấp hoàn phí. Do đó, nếu bạn muốn xác định sự phù hợp của JobNow cho nhu cầu của bạn, bạn có thể đăng ký dùng thử miễn phí và khám phá các tính năng của cơ sở dữ liệu của chúng tôi.</p>
			</div>
			<div class="list-content">
				<h3>7. Làm thế nào tôi có thể duyệt qua cơ sở dữ liệu resume của bạn?</h3>
				<p>Để tìm hồ sơ, bạn phải đăng ký làm người sử dụng đã đăng ký. Một khi bạn đã đăng ký một trong những kế hoạch đăng ký của chúng tôi, bạn có thể duyệt qua cơ sở dữ liệu hồ sơ của chúng tôi để tìm các ứng cử viên phù hợp cho công ty của bạn.</p>
			</div>
			<div class="list-content">
				<h3>8. Tôi sẽ được lập hoá đơn sau khi kết thúc giai đoạn dùng thử miễn phí?</h3>
				<p>Bạn sẽ không bị tính phí nếu bạn đã hủy đăng ký trước khi thời gian dùng thử miễn phí kết thúc.</p>
			</div>
			<div class="list-content">
				<h3>9. Những thông tin nào nên được đưa vào một bài đăng công việc?</h3>
				<p>Mặc dù có nhiều trường thông tin khác nhau, nhưng bạn phải điền thông tin dưới đây để xuất bản một quảng cáo việc làm:</p>
				<ol>
					<li>Tiêu đề</li>
					<li>Địa chỉ</li>
					<li>Ngành</li>
					<li>Mô tả</li>
					<li>Email để ứng tuyển</li>
				</ol>
			</div>
			<div class="list-content">
				<h3>10. Bạn có thể giúp tôi viết một quảng cáo việc làm?</h3>
				<p>Vâng, JobNow có một đội ngũ chuyên gia nhân sự giàu kinh nghiệm và những nhà tiếp thị có thể giúp bạn viết một quảng cáo tuyển dụng hấp dẫn. </p>
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

	</style>
@stop