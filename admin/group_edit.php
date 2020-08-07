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
            <small>Group Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Group Edit</li>
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
                                <h3>Group Edit</h3>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <a href="group_list.php" class="btn btn-primary pull-right"><span class="fa fa-list"></span>&nbsp;LIST </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" action="" method="post">
                        <div class="box-body">
                            <?php
                                $id         =   $_GET['edit_id'];
                                $groupData  = getDataRowByTableAndId('groups', $id);
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="<?php echo $groupData->name; ?>">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="edit_id" value="<?php echo $id; ?>" >
                            <input type="submit" name="group_update" value="Update" class="btn btn-primary btn-block">
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
