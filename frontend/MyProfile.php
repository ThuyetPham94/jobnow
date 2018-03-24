<?php include 'block/header-user.php'; ?>
			<div class="main"> 
				<div class="app margin">
					<div class="container">
						<div class="row">
							<div class="col-xs-4 col-sm-3 detail-user">
								<div class="border-u">
									<div class="detail col-sm-12">
										<div class="avata text-center">
											<div class="img-avata">
												<img class="img-responsive" src="images/Luxury-Travel-Logo.png">
											</div>
											<p class="name">Jackie Yang</p>
											<p class="email">jackieyang@gmail.com</p>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="profile-u">
										<ul>
											<li class="pro active">
												<a href="MyProfile.php"><i class="fa fa-user" aria-hidden="true"></i> <span>My Profile </span></a>
											</li>
											<li class="save-job">
												<a href="SavedJobs.php"><i class="fa fa-star" aria-hidden="true"></i><span>Saved Jobs</span></a>
											</li>
											<li class="app-job">
												<a href="AppliedJobs.php"><i class="glyphicon glyphicon-list-alt"></i><span>Applied Jobs</span></a>
											</li>
											<li class="logout"><a href="index.php"><i class="fa fa-power-off" aria-hidden="true"></i><span>Log Out</span></a></li>
										</ul>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="col-xs-8 col-sm-9 list-app-job content-job">
								<div class="border">
									<div class="til">
									    <h3>My Profile</h3>
								    </div>
								    <div class="col-sm-1"></div>
									<div class="col-sm-11 content">
									    <div class="profile-detail">
									    	<form role="form">
											  <div class="form-group">
											    <div class="col-xs-12">
											    	<label for="fullname" class="label-title">Fullname: <span class="required">*</span></label>
											    	<input type="fullname" class="form-control" id="fullname" placeholder="Jakichan">
											    </div>
											  </div>
											  <div class="form-group">
											  	<div class="col-xs-12">
											  		<label for="gender" class="label-title">Gender: <span class="required">*</span></label>
												  	<div class="clearfix"></div>
												    <label class="radio-inline">
													  <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Male
													</label>
													<label class="radio-inline">
													  <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Female
													</label>
											  	</div>
											  </div>
											  <div class="form-group">
											  	<div class="col-xs-12">
											  		<label for="birthday" class="label-title">Bithday: <span class="required">*</span></label>
											  	</div>
											  	<div class="clearfix"></div>
											    <div class="col-xs-2">
											    	<select class="form-control">
													  <option>1</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													</select>
											    </div>
											    <div class="col-xs-4">
											    	<select class="form-control">
													  <option>5</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													</select>
											    </div>
											    <div class="col-xs-2">
											    	<select class="form-control">
													  <option>1991</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													</select>
											    </div>
											  </div>
											  <div class="clearfix"></div>
											  <div class="form-group">
											    <div class="col-xs-12">
											    	<label for="email" class="label-title">Email Address:<span class="required">*</span></label>
											    	<input type="email" class="form-control" id="email" placeholder="abcde@gmail.com">
											    </div>
											  </div>
											  <div class="form-group">
											    <div class="col-xs-12">
											    	<label for="phone" class="label-title">Phone Number:<span class="required">*</span></label>
											    	<input type="text" class="form-control" id="phone" placeholder="0987654321">
											    </div>
											  </div>
											  <div class="form-group">
											    <div class="col-xs-6">
											    <label for="country" class="label-title">Country:<span class="required">*</span></label>
											    	<select class="form-control" id="country">
													  <option>5</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													</select>
											    </div>
											    <div class="col-xs-6">
											    	<label for="postalcode" class="label-title">Postal Code:<span class="required">*</span></label>
											    	<select class="form-control" id="postalcode">
													  <option>1991</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													</select>
											    </div>
											  </div>
											  <div class="form-group">
											   	<div class="col-xs-12">
											   		<label for="description" class="label-title">Description:<span class="required">*</span></label>
											    	<textarea class="form-control" rows="5" id="description"></textarea>
											   	</div>
											  </div>
											  <div class="form-group">
											   	<div class="col-xs-12">
											   		<label for="description" class="label-title">Upload CV:<span class="required">*</span></label>
											   		<div class="clearfix"></div>

														<div class="input-group input-icon-left" id="row_1">
															<input placeholder="CV" class="form-control" id="cv" name="cv" type="text" value="">
															<span class="input-group-btn"> <a href="#" class="btn btn-default iframe-btn" style="    padding: 8px;"><img src="images/icon/file-select-icon.png"> Select file..</a> </span>
													</div>
											   	</div>
											  </div>
											  <div class="clearfix"></div>
											  <div class="form-group save-change-cv">
											  	<button type="submit" class="btn btn-default">Save Change</button>
											  </div>
											</form>
									    </div>
									    <div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="border expience">
									<div class="til">
									    <h3>Expience</h3>
									    <div class="pull-right add-expience"><a href="javascript:void(0)">+ Add Expience</a></div>
								    </div>
									<div class="content content-expire">
									<div class="col-sm-1"></div>
									<div class="col-sm-11">
										<div class="profile-detail">
									    	<form role="form">
											  <div class="form-group">
											    <div class="col-xs-6">
											    	<label for="comname" class="label-title">Company Name: <span class="required">*</span></label>
											    	<input type="fullname" class="form-control" id="comname" placeholder="">
											    </div>
											    <div class="col-xs-6">
											    	<label for="jobposition" class="label-title">Job or Position: <span class="required">*</span></label>
											    	<input type="text" class="form-control" id="jobposition" placeholder="">
											    </div>
											  </div>
											  <div class="form-group">
											   	<div class="col-xs-12">
											   		<label for="description" class="label-title">Description:<span class="required">*</span></label>
											    	<textarea class="form-control" rows="5" id="description"></textarea>
											   	</div>
											  </div>
											  
											  <div class="clearfix"></div>
											  <div class="form-group pull-right save-expience">
											  <button type="reset" class="btn btn-default">Cancel</button>
											  	<button type="submit" class="btn btn-primary">Save</button>
											  </div>
											</form>
									    </div>
									    <div class="clearfix"></div>
									</div>.<!-- end .content-expice -->
									<div class="expire-box">
										<div class="col-sm-1"></div>
										<div class="your-expience col-sm-10">
												<div class="box-pience">
													<div class="col-xs-12 det">
														<div class="company">MCI Career Services Pte Ltd - Central <a href="" class="pull-right"><img src="images/icon/delete-your-expience.png"></a></div>
														<div class="position">Financial Consultant</div>
														<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
													</div>
													<div class="clearfix"></div>
												</div>

												<div class="box-pience">
													<div class="col-xs-12 det">
														<div class="company">MCI Career Services Pte Ltd - Central <a href="" class="pull-right"><img src="images/icon/delete-your-expience.png"></a></div>
														<div class="position">Financial Consultant</div>
														<div class="description">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
													</div>
													<div class="clearfix"></div>
												</div>	
										</div>
									</div>
									</div>
									    
									<div class="clearfix"></div>
								</div>
								<div class="border skill">
									<div class="til">
									    <h3>Skill</h3>
									    <div class="pull-right add-skill"><a href="javascript:void(0)">+ Add Skill</a></div>
								    </div>
									<div class="content content-skill">
									    <div class="col-sm-1"></div>
									    <div class="col-sm-11">
									    	<div class="profile-detail">
									    	<form role="form">
											<div class="col-xs-4">
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Accouting</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Mathematic</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Accouting</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Mathematic</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Accouting</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Mathematic</label>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Accouting</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Mathematic</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Accouting</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Mathematic</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Accouting</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Mathematic</label>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Accouting</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Mathematic</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Accouting</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Mathematic</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Accouting</label>
												</div>
												<div class="checkbox">
													<label><input type="checkbox" value=""><span class="m-check"></span>Mathematic</label>
												</div>
											</div>
											  <div class="clearfix"></div>
											  <div class="form-group pull-right save-expience">
											  <button type="reset" class="btn btn-default">Cancel</button>
											  	<button type="submit" class="btn btn-primary">Save</button>
											  </div>
											</form>
									    </div>
									    </div>
									    <div class="clearfix"></div>
									</div>
									<div class="clearfix"></div>
									<div class="your-skill">
									<div class="col-sm-1"></div>
										<div class="col-xs-11">
											<div class="col-xs-4">
												<p><i class="fa fa-check" aria-hidden="true"></i> Meeting Rooms</p>
												<p><i class="fa fa-check" aria-hidden="true"></i> Kitchen</p>
												<p><i class="fa fa-check" aria-hidden="true"></i> 450 Lux Lighting</p>
											</div>
											<div class="col-xs-4">
												<p><i class="fa fa-check" aria-hidden="true"></i> Meeting Rooms</p>
												<p><i class="fa fa-check" aria-hidden="true"></i> Kitchen</p>
												<p><i class="fa fa-check" aria-hidden="true"></i> 450 Lux Lighting</p>
											</div>
											<div class="col-xs-4">
												<p><i class="fa fa-check" aria-hidden="true"></i> Meeting Rooms</p>
												<p><i class="fa fa-check" aria-hidden="true"></i> Kitchen</p>
												<p><i class="fa fa-check" aria-hidden="true"></i> 450 Lux Lighting</p>
											</div>
											
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php include 'block/footer.php'; ?>