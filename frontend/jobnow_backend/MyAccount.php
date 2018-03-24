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
                                <span>My Account</span>
                                <a href="" class="btn pull-right">Post A Job</a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="content">
                                <div class="my-account">
                                    
                                        <div class="container-fuild">
                                            <div class="border">
                                                <div class="top-content">
                                                    <ul class="my-tab" role="tablist">
                                                        <li class="active" role="presentation" class="active">
                                                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                                                My Company Profile
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a href="#change-mail" aria-controls="change-mail" role="tab" data-toggle="tab">
                                                                change email address
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a href="#change-pass" aria-controls="change-pass" role="tab" data-toggle="tab">
                                                                change password
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="main-content">
                                                    <div class="main-form">
                                                        <div class="tab-content">
                                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                                <form action="" method="POST" role="form">
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
                                                                        <label for="">Contact Name <span>*</span></label>
                                                                        
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control">
                                                                            <div class="input-group-addon">
                                                                                <select>
                                                                                    <option>Mr</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Phone Number <span>*</span></label>
                                                                        <input type="text" class="form-control" id="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Email Address <span>*</span></label>
                                                                        <input type="text" class="form-control" id="" disabled="disabled" value="jackieyang@gmail.com">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Company Profile <span>*</span></label>
                                                                        <input type="text" class="form-control" id="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Company Logo <span>*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control">
                                                                            <div class="input-group-addon">
                                                                                <a href="#"> Select file..</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Company Photos <span>*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control">
                                                                            <div class="input-group-addon">
                                                                                <a href="#"> Select file..</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-center">
                                                                        <button type="submit" class="submit btn btn-margin">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div role="tabpanel" class="tab-pane fade" id="change-mail">
                                                                <form action="" method="POST" role="form">
                                                    
                                                                    <div class="form-group">
                                                                        <label for="">Password</label>
                                                                        <input type="text" class="form-control" id="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">New Email</label>
                                                                        <input type="text" class="form-control" id="">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="">Confim new email</label>
                                                                        <input type="text" class="form-control" id="">
                                                                    </div>
                                                                    <div class="text-center">
                                                                        <button type="reset" class="cancel btn btn-primary">Canel</button>
                                                                        <button type="submit" class="submit btn btn-primary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
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
        </div>
        <!-- /#page-content-wrapper -->
<?php include 'block/footer.php'; ?>
