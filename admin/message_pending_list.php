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
            <small>Message Status List</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Message Status List</li>
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
                                <h3>Message Status List</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        $user_id    =   $_SESSION['logged']['user_id'];
                        $table      =   ((is_super_admin($user_id)) ? "message_send_history":"message_send_history WHERE client_id=$user_id");
                        $order      = 'DESC';
                        $column     = 'created_at';
                        $groupList  = getTableDataByTableName($table,$order,$column);
                        if(isset($groupList) && !empty($groupList)){
                        ?>
                        <div class="table-responsive">          
                            <table class="table table-bordered table-striped table-hover" id="group_list">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Client Name</th>
                                        <th>Contact No</th>
                                        <th>Create Date</th>
                                        <th>Message</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $count  =   1;
                                        foreach($groupList as $data){
                                    ?>
                                    <tr id="group_name_row_<?php echo $data->id; ?>">
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo get_client_name($data->client_id) ?></td>
                                        <td><?php echo $data->contact_no ?></td>
                                        <td><?php echo human_format_date($data->created_at) ?></td>
                                        <td><span style="cursor: pointer;" class="fa fa-comment-o" onclick="show_sending_message_details(<?php echo $data->id; ?>)">&nbsp;Show Message</span></td>
                                        <td>
                                            <?php
                                                if($data->sent_status == 0){
                                                    echo '<small class="label pull-right bg-yellow">Pending</small>';
                                                }
                                                if($data->sent_status == 1){
                                                    echo '<small class="label pull-right bg-green">Success</small>';
                                                }
                                                if($data->sent_status == 3){
                                                    echo '<small class="label pull-right bg-red">Failed to sent</small>';
                                                }
                                            ?>
                                        </td>
                                    </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <?php }else{ ?>
                            <div class="alert alert-info">
                                <strong>Sorry!</strong> No Result Found!.
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
