<?php include 'header.php'; ?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
        <?php include 'operation_message.php'; ?>
        <h1>
            Home
            <small>SMS Template Add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">SMS Template Add</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">                
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <h3>SMS Template Add</h3>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <a href="message_sms_templates_list.php" class="btn btn-primary pull-right"><span class="fa fa-list"></span>&nbsp;LIST </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" action="" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label><span class="text-danger">&nbsp;Required</span>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleName">Image File</label>
                                        <input type="file" class="form-control" id="image_file" placeholder="Add Image" name="image_file">
                                        <span class="text-danger">Max file size below 8MB</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleName">Audio File</label>
                                        <input type="file" class="form-control" id="audio_file" placeholder="Add Audio" name="audio_file">
                                        <span class="text-danger">Max file size below 8MB</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleName">Video File</label>
                                        <input type="file" class="form-control" id="video_file" placeholder="Add Video" name="video_file">
                                        <span class="text-danger">Max file size below 8MB</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="comment">Header:</label><span class="text-danger">&nbsp;Required</span>
                                        <textarea class="form-control" rows="2" id="header" name="header"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="comment">Footer:</label><span class="text-danger">&nbsp;Required</span>
                                        <textarea class="form-control" rows="2" id="footer" name="footer"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comment">Body:</label><span class="text-danger">&nbsp;Required</span>
                                <textarea class="form-control" rows="6" id="body" name="body"></textarea>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" name="sms_template_save" value="Save" class="btn btn-primary btn-block">
                        </div>
                    </form>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
