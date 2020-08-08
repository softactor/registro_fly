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
            <small>Whatsapp Template List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Whatsapp Template List</li>
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
                                <h3>Whatsapp Template List</h3>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                <a href="message_whatsapp_templates_create.php" class="btn btn-primary pull-right"><span class="fa fa-plus-circle"></span>&nbsp;ADD </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        $user_id    =   $_SESSION['logged']['user_id'];
                        $table      =   ((is_super_admin($user_id)) ? "template_details":"template_details WHERE client_id=$user_id");
                        $order      = 'asc';
                        $column     = 'name';
                        $groupList  = getTableDataByTableName($table);
                        if(isset($groupList) && !empty($groupList)){
                        ?>
                        <div class="table-responsive">          
                            <table class="table table-bordered table-striped table-hover" id="group_list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Template Type</th>
                                        <th>Template Name</th>
                                        <th>Client Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $count  =   1;
                                        foreach($groupList as $data){
                                    ?>
                                    <tr id="group_name_row_<?php echo $data->id; ?>">
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo $data->template_type; ?></td>
                                        <td><?php echo $data->name ?></td>
                                        <td><?php echo get_client_name($data->client_id) ?></td>
                                        <td>
                                            <a href="message_whatsapp_templates_edit.php?edit_id=<?php echo $data->id ?>" class="btn btn-info">
                                                <span class="fa fa-pencil-square-o"></span>&nbsp;Edit
                                            </a>
                                            <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteGroupName('<?php echo $data->id; ?>');">
                                                <span class="fa fa-close"></span>&nbsp;Delete
                                            </a>
                                        </td>
                                    </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php }else{ ?>
                            <div class="alert alert-info">
                                <strong>Sorry!</strong> There is No Data.
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include 'footer.php'; ?>
