<?php include 'block/header-company.php'; ?>
			<div class="main"> 
				<div class="company company-detail margin">
					<div class="top-main">
						<div class="profile text-center">
							<h2>Company Profiles</h2>
							<p>Get the inside track on 21,044 companies in Singapore</p>
							<form class="form-inline" action="CompanyProfile-Details.php">
								<div class="form-group">
									<div class="input-group">
										<input type="text" class="form-control" id="exampleInputAmount" placeholder="Search for a company">
										<div class="input-group-addon"><button type="submit"><i class="glyphicon glyphicon-search"></i><span>Search</span></button></div>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="center-main">
						<div class="container">
							<div class="row">
								<div class="text-center text-find">
									<h3><span>Find</span> Company Profile</h3>
								</div>
								<div class="col-xs-4 compa text-center">
									<div class="img">
										<img src="images/icon/compa.png">
									</div>
									<h3>All Companies</h3>
									<p class="preview">Search for information on all the top Vietnamese , on all the top Vietnamese </p>
								</div>
								<div class="col-xs-4 info text-center">
									<div class="img">
										<img src="images/icon/info.png">
									</div>
									<h3>Easily Find Information</h3>
									<p class="preview">Search for information on all the top Vietnamese , on all the top Vietnamese </p>
								</div>
								<div class="col-xs-4 pro text-center pro">
									<div class="img">
										<img src="images/icon/pro.png">
									</div>
									<h3>Application Processing Time</h3>
									<p class="preview">Search for information on all the top Vietnamese , on all the top Vietnamese </p>
								</div>
							</div>
						</div>
					</div>
					<div class="bottom-main">
						<div class="container">
							<div class="row">
								<div class="col-xs-12 text-center">
									<div class="relation-text">
										Find out what it is like to work for featured employers in <span>Singapore</span>
									</div>
									<div class="relation-logo row">
										<ul class="list-logo">
											<li class="col-xs-4 col-sm-2"><img class="img-responsive" src="images/SB2011_black.png" img_color = "images/SB2011.png"></li>
											<li class="col-xs-4 col-sm-2"><img class="img-responsive" src="images/Yeos-logo_black.png" img_color = "images/Yeos-logo.png"></li>
											<li class="col-xs-4 col-sm-2"><img class="img-responsive" src="images/5284779_orig_black.png" img_color = "images/5284779_orig.png"></li>
											<li class="col-xs-4 col-sm-2"><img class="img-responsive" src="images/Singapore_Airlines_Logo.svg_black.png" img_color = "images/Singapore_Airlines_Logo.svg.png"></li>
											<li class="col-xs-4 col-sm-2"><img class="img-responsive" src="images/Luxury-Travel-Logo_black.png" img_color = "images/Luxury-Travel-Logo.png"></li>
											<li class="col-xs-4 col-sm-2"><img class="img-responsive" src="images/starhub-logo_black.png" img_color = "images/starhub-logo.png"></li>
										</ul>
									</div>
									<div class="text-center">
										<a class="btn" href="#">See all in the Company Directory</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
			<script type="text/javascript">
			jQuery(document).ready(function($) {
				$("ul.list-logo li img").hover(function() {
					var src = $(this).attr('src');
					$(this).attr('src', $(this).attr('img_color'));
					$(this).attr('img_color', src);
				}, function() {
					var src = $(this).attr('src');
					$(this).attr('src', $(this).attr('img_color'));
					$(this).attr('img_color', src);
				});
			});
			</script>
<?php include 'block/footer.php'; ?>