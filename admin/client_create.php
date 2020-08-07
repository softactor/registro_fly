<?php
include 'header.php';
$_SESSION['activeMenu'] = 'agency';
?>
<?php include 'top_sidebar.php'; ?>
<!-- Left side column. contains the logo and sidebar -->
<?php include 'left_sidebar.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php include 'operation_message.php'; ?>
        <h1>
            Client Info
            <small>Client Create</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Client Info</a></li>
            <li class="active">Client Create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- left column -->
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" method="post">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleName">First Name</label>
                                        <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleName">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" value="">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exampleName">Service</label>
                                <label class="checkbox-inline"><input type="checkbox" name="service_type[]" value="sms">&nbsp;SMS</label>
                                <label class="checkbox-inline"><input type="checkbox" name="service_type[]" value="whatsapp">&nbsp;WhatsApp</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                            
                                    <div class="form-group">
                                        <label for="exampleName">SMS Rate</label>
                                        <input type="text" class="form-control" id="sms_rate" placeholder="Enter SMS Rate" name="sms_rate" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleName">Whatsapp Rate</label>
                                        <input type="text" class="form-control" id="whatsapp_rate" placeholder="Enter Whats App" name="whatsapp_rate" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Balance</label>
                                <input type="text" class="form-control" id="balance" placeholder="Enter Balance" name="balance" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" name="client_create" class="btn btn-primary btn-block" value="Create">
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="box-tools">
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li><a href="user_create.php"><i class="fa fa-dashboard"></i> Create</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php include 'partial/users_list.php'; ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
