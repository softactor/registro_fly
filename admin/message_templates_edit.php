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
            <small>Template Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Template Edit</li>
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
                                <h3>Template Edit</h3>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <a href="message_templates_list.php" class="btn btn-primary pull-right"><span class="fa fa-list"></span>&nbsp;LIST </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" action="" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php
                                $id         =   $_GET['edit_id'];
                                $user_id    =   $_SESSION['logged']['user_id'];
                                $table      =   ((is_super_admin($user_id)) ? "template_details":"template_details WHERE client_id=$user_id AND id=$id");
                                $editData  = getDataRowIdAndTable($table);
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Template Type</label>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="radio-inline"><input type="radio" name="template_type" value="whatsapp" <?php if(isset($editData->template_type) && $editData->template_type == 'whatsapp'){ echo 'checked'; } ?>>Whatsapp</label>
                                        <label class="radio-inline"><input type="radio" name="template_type" value="sms"<?php if(isset($editData->template_type) && $editData->template_type == 'sms'){ echo 'checked'; } ?>>SMS</label>
                                    </div>                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label><span class="text-danger">&nbsp;Required</span>
                                        <input value="<?php if(isset($editData->name) && !empty($editData->name)){ echo $editData->name; } ?>" type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Image File</label>
                                                <input type="file" class="form-control" id="image_file" placeholder="Add Image" name="image_file">
                                                <span class="text-danger">Max file size below 8MB</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                                if(isset($editData->image_file) && !empty($editData->image_file)){ ?>
                                            <a class="btn btn-app" id="file_view_id_i">
                                                <span class="badge bg-red" onclick="delete_multimedia_file('<?php echo $editData->id; ?>','i')"><i class="fa fa-close"></i></span>
                                                <img src="../resource/image/<?php echo $editData->image_file; ?>" width="50" />
                                            </a>
                                            <?php    }
                                            ?>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Audio File</label>
                                                <input type="file" class="form-control" id="audio_file" placeholder="Add Audio" name="audio_file">
                                                <span class="text-danger">Max file size below 8MB</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                                if(isset($editData->audio_file) && !empty($editData->audio_file)){ ?>
                                            <a class="btn btn-app" id="file_view_id_a">
                                                <span class="badge bg-red" onclick="delete_multimedia_file('<?php echo $editData->id; ?>','a')"><i class="fa fa-close"></i></span>
                                                <i class="fa fa-file-audio-o" aria-hidden="true"></i> Audio
                                            </a>
                                            <?php    }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Video File</label>
                                                <input type="file" class="form-control" id="video_file" placeholder="Add Video" name="video_file">
                                                <span class="text-danger">Max file size below 8MB</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            if(isset($editData->video_file) && !empty($editData->video_file)){ ?>
                                                <a class="btn btn-app" id="file_view_id_v">
                                                    <span class="badge bg-red" onclick="delete_multimedia_file('<?php echo $editData->id; ?>','v')"><i class="fa fa-close"></i></span>
                                                    <i class="fa fa-file-video-o" aria-hidden="true"></i> Video
                                                </a>
                                        <?php    }
                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="comment">Header:</label><span class="text-danger">&nbsp;Required</span>
                                        <textarea class="form-control" rows="2" id="header" name="header"><?php if(isset($editData->header) && !empty($editData->header)){ echo $editData->header; } ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="comment">Footer:</label><span class="text-danger">&nbsp;Required</span>
                                        <textarea class="form-control" rows="2" id="footer" name="footer"><?php if(isset($editData->footer) && !empty($editData->footer)){ echo $editData->footer; } ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comment">Body:</label><span class="text-danger">&nbsp;Required</span>
                                <textarea class="form-control" rows="6" id="body" name="body"><?php if(isset($editData->body) && !empty($editData->body)){ echo $editData->body; } ?></textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="edit_id" value="<?php echo $editData->id ?>">
                            <input type="submit" name="whatsapp_template_update" value="Update" class="btn btn-primary btn-block">
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
