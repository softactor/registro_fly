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
            Contact Info
            <small>Contact Create</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Contact Info</a></li>
            <li class="active">Contact Create</li>
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
                    <form role="form" action="" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <?php
                                    $user_id = $_SESSION['logged']['user_id'];
                                    $table = ((is_super_admin($user_id)) ? "groups" : "groups WHERE client_id=$user_id");
                                    $order = 'ASC';
                                    $column = 'name';
                                    $dataType = 'obj';
                                    $groupData = getTableDataByTableName($table, $order, $column, $dataType);
                                ?>
                                <label for="sel1">Select Group:</label>
                                <select class="form-control" id="group_id" name="group_id">
                                    <option value="">Please Select</option>
                                    <?php
                                        foreach($groupData as $grp){
                                    ?>
                                    <option value="<?php echo $grp->id; ?>"><?php echo $grp->name; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Contact</label>
                                <input type="text" class="form-control" id="contact_no" placeholder="Enter Contact" name="contact_no" value="">
                            </div>
                            <div class="form-group">
                                <label for="exampleName">Import Contact CSV</label>
                                <input type="file" class="form-control" id="import_contact" placeholder="Import Contact" name="import_contact" value="">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" name="contact_create" class="btn btn-primary btn-block" value="Save">
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
                                <li><a href="contact_list.php"><i class="fa fa-dashboard"></i> List</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php include 'partial/contact_list.php'; ?>
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
