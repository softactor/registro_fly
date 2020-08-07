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
            User Info
            <small>User Create</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> User Info</a></li>
            <li class="active">User Create</li>
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
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="sel1">User Type:</label>
                                <select class="form-control" id="sel1">
                                    <option value="">Please Select</option>
                                    <option value="sa">Super Admin</option>
                                    <option value="client">Client</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleName">First Name</label>
                                <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Last Name</label>
                                <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" value="">
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
                            <input type="submit" name="user_create" class="btn btn-primary" value="Create">
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
