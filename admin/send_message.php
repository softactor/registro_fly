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
            <small>Message Sender</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Message Sender</li>
        </ol>
    </section>
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-8">                
                <div class="box">
                    <!-- /.box-header -->
                    <form role="form" action="" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Message Type: &nbsp;</label>
                                        <label class="radio-inline"><input type="radio" name="message_type" value="whatsapp" checked>Whatsapp</label>
                                        <label class="radio-inline"><input type="radio" name="message_type" value="sms">SMS</label>
                                    </div>                                    
                                </div>
                            </div>

                            <div class="row receiver_rows" id="receiver_row_s">
                                <div class="col-md-12">
                                    <?php if(isset($_SESSION['contact']) && !empty($_SESSION['contact'])){ ?>
                                                <span class="text-red">
                                                    <?php 
                                                    echo $_SESSION['contact'];
                                                    unset($_SESSION['contact']);
                                                    ?>
                                                </span>
                                    <?php } ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Contact Number</label>
                                        <select class="form-control js-example-basic-multiple" id="message_receiver_multiple" name="receivers[]" multiple="multiple">
                                            <?php
                                            $user_id = $_SESSION['logged']['user_id'];
                                            $table = ((is_super_admin($user_id)) ? "contact_details" : "contact_details WHERE client_id=$user_id");
                                            $order = 'asc';
                                            $column = 'contact_no';
                                            $groupList = getTableDataByTableName($table, $order, $column);
                                            if (isset($groupList) && !empty($groupList)) {
                                                foreach ($groupList as $grp) {
                                                    ?> 
                                                    <option value="<?php echo $grp->id ?>"><?php echo $grp->contact_no ?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row receiver_rows" id="receiver_row_g">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Group</label>
                                        <select class="form-control js-example-basic-multiple" id="message_receiver_group" name="groups[]" multiple="multiple">
                                            <?php
                                            $user_id = $_SESSION['logged']['user_id'];
                                            $table = ((is_super_admin($user_id)) ? "groups" : "groups WHERE client_id=$user_id");
                                            $order = 'asc';
                                            $column = 'name';
                                            $groupList = getTableDataByTableName($table);
                                            if (isset($groupList) && !empty($groupList)) {
                                                foreach ($groupList as $grp) {
                                                    ?> 
                                                    <option value="<?php echo $grp->id ?>"><?php echo $grp->name ?></option>
                                                <?php }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Template Type</label>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="radio-inline"><input onchange="get_template_message_form();" type="radio" id="template_type_n" name="template_type" value="n" checked>New</label>
                                        <label class="radio-inline"><input type="radio" id="template_type_t" name="template_type" value="t">Template</label>
                                    </div>                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Template</label>
                                        <select class="form-control" id="template_id" name="template_id" onchange="get_template_message_form(this.value);">
                                            <option value="">Please Select</option>
                                        <?php
                                        $user_id = $_SESSION['logged']['user_id'];
                                        $table = ((is_super_admin($user_id)) ? "template_details" : "template_details WHERE client_id=$user_id");
                                        $order = 'asc';
                                        $column = 'name';
                                        $groupList = getTableDataByTableName($table, $order, $column);
                                        
                                        if (isset($groupList) && !empty($groupList)) {
                                            foreach ($groupList as $grp) {
                                                ?> 
                                                <option value="<?php echo $grp->id ?>"><?php echo $grp->name . '(' . $grp->template_type . ')' ?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                    </div>                                  
                                </div>
                            </div>
                            <div id="dynamic_message_fields">
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
                                            <?php if(isset($_SESSION['header']) && !empty($_SESSION['header'])){ ?>
                                                <span class="text-red">
                                                    <?php 
                                                    echo $_SESSION['header'];
                                                    unset($_SESSION['header']);
                                                    ?>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="comment">Footer:</label><span class="text-danger">&nbsp;Required</span>
                                            <textarea class="form-control" rows="2" id="footer" name="footer"></textarea>
                                            <?php if(isset($_SESSION['footer']) && !empty($_SESSION['footer'])){ ?>
                                                <span class="text-red">
                                                    <?php 
                                                    echo $_SESSION['footer'];
                                                    unset($_SESSION['footer']);
                                                    ?>
                                                </span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Body:</label><span class="text-danger">&nbsp;Required</span>
                                    <textarea class="form-control" rows="6" id="body" name="body"></textarea>
                                    <?php if(isset($_SESSION['body']) && !empty($_SESSION['body'])){ ?>
                                    <span class="text-red">
                                        <?php 
                                        echo $_SESSION['body'];
                                        unset($_SESSION['body']);
                                        ?>
                                    </span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" name="sending_message" value="Send" class="btn btn-primary btn-block">
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
