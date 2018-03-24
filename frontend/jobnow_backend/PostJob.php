<?php include 'block/header.php'; ?>
<?php include 'block/sidebar.php'; ?>
<?php include 'block/topmenu.php'; ?>
<!-- Page Content -->
<div id="page-content-wrapper">
    <div class="main">
        <div >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 header-main">
                        <span>Post a job</span>
                        <a href="PostJob.php" class="btn pull-right">Post A Job</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div id="applicatant" class="post-job">
                            <div class="container-fuild">
                                <form>
                                    <div class="border">
                                        <div class="top-content">
                                            Post job informations
                                        </div>
                                        <div class="main-content">
                                            <div class="col-xs-2"></div>
                                            <div class="col-xs-8">
                                                    <div class="main-form">
                                                        <div class="form-group">
                                                            <label for="">Job Title  <span>*</span></label>
                                                            <input type="text" class="form-control" id="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Job Level <span>*</span></label>
                                                            <select class="form-control">
                                                                <option>Less than 10</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Job Category (Up To 3 Categories) <span>*</span></label>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control" id=""data-role="tagsinput">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Job Location <span>*</span></label>
                                                            
                                                            <div class="form-group">
                                                                <input type="text" class="form-control">
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Experience <span>*</span></label>
                                                            <select class="form-control">
                                                                <option>Less than 10</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Salary (USD) <span>*</span></label>
                                                            <div class="clearfix"></div>
                                                           <div class="form-group col-xs-8 clear-padding">
                                                                <select class="form-control ">
                                                                    <option>Less than 10</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xs-4 clear-padding">
                                                                <div class="checkbox">
                                                                    <label><input type="checkbox" value=""><span class="m-check"></span><span class="salary">Show the salary</span></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <div class="form-group">
                                                            <label for="">Responsibilities<span>*</span></label>
                                                            <textarea name="" id="input" class="form-control" rows="5" required="required"></textarea>
                                                            <p class="pull-right note">(You have 14500 character remainings)</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Requirements<span>*</span></label>
                                                            <textarea name="" id="input" class="form-control" rows="5" required="required"></textarea>
                                                            <p class="pull-right note">(You have 14500 character remainings)</p>
                                                        </div>
                                                    </div>
                                            </div>  
                                            <div class="clearfix"></div>
                                        </div><!-- end .main-content -->
                                    </div><!-- end .border -->
                                    <div class="border company-detail">
                                        <div class="top-content">
                                            Your company
                                        </div>
                                        <div class="main-content">
                                            <div class="col-xs-2"></div>
                                            <div class="col-xs-8">
                                                    <div class="main-form">
                                                        <div class="form-group">
                                                            <label for="">Company Name  <span>*</span></label>
                                                            <input type="text" class="form-control" id="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Company Size <span>*</span></label>
                                                            <select class="form-control">
                                                                <option>Less than 10</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Company Address <span>*</span></label>
                                                            <input type="text" class="form-control" id="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Company Profile<span>*</span></label>
                                                            <textarea name="" id="input" class="form-control" rows="5" required="required"></textarea>
                                                            <p class="pull-right note">(You have 14500 character remainings)</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Company Logo <span>*</span></label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control">
                                                                <div class="input-group-addon">
                                                                    <a href="#"> Select file..</a>
                                                                </div>
                                                                
                                                            </div>
                                                            <p class="pull-right note">(File type .jpg .jped .png .gif ; file size <1MB)</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Company Photos <span>*</span></label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control">
                                                                <div class="input-group-addon">
                                                                    <a href="#"> Select file..</a>
                                                                </div>

                                                            </div>
                                                            <p class="pull-right note">(File type .jpg .jped .png .gif ; file size <1MB)</p>
                                                        </div>
                                                    </div>
                                            </div>  
                                            <div class="clearfix"></div>
                                        </div><!-- end .main-content -->
                                    </div><!-- end .border -->
                                    <div class="save-button">
                                        <input type="button" value="Save a Draft" class="btn save-draft">
                                        <input type="submit" value="Save and Continue" class="btn save-continue">
                                    </div>
                                </form>
                            </div>
                        </div> 
                        <div class="clearfix"></div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->
<?php include 'block/footer.php'; ?>
