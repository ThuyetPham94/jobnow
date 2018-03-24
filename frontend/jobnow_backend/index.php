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
                        <span>Dashboard</span>
                        <a href="PostJob.php" class="btn pull-right">Post A Job</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="content">
                        <div id="dashboard">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6 mess_new">
                                        <div class="border">
                                            <a href="">
                                                <div class="icon-img my-job"></div>
                                                <span class="number">30</span>
                                                <p>My Job</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mess_new">
                                        <div class="border">
                                            <a href="">
                                                <div class="icon-img post-job"></div>
                                                <span class="number">30</span>
                                                <p>Post a Job</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="border">
                                    <ul class="list-group">
                                        <li class="list-group-item active"><span>15</span> Notifications</li>
                                        <li class="list-group-item">
                                            <div class="bor-bot">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                Lorem Ipsum has been the industry's standard dummy text.</p>
                                                <span>34 minutes ago</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="bor-bot">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                Lorem Ipsum has been the industry's standard dummy text.</p>
                                                <span>34 minutes ago</span>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="bor-bot">
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                                Lorem Ipsum has been the industry's standard dummy text.</p>
                                                <span>34 minutes ago</span>
                                            </div>
                                        </li>
                                    </ul>
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