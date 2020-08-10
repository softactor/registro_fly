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
            Client Profile
            <small>Client Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Client Profile</a></li>
            <li class="active">Client Profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" method="post">
                        <div class="box-body">
                            <?php
                            $userId = get_client_id_by_user_id($_SESSION['logged']['user_id']);
                            $rowData = getDataRowByTableAndId('client_information', $userId);

                            $userData = getDataRowByTableAndId('users', $_SESSION['logged']['user_id']);
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">First Name</label>
                                                <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name" value="<?php echo $rowData->first_name; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name" value="<?php echo $rowData->last_name; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">                            
                                            <div class="form-group">
                                                <label for="exampleName">SMS Rate</label>
                                                <input type="text" class="form-control" id="sms_rate" placeholder="Enter SMS Rate" name="sms_rate" value="<?php echo $rowData->sms_rate; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Whatsapp Rate</label>
                                                <input type="text" class="form-control" id="whatsapp_rate" placeholder="Enter Whats App" name="whatsapp_rate" value="<?php echo $rowData->whatsapp_rate; ?>">
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $userData->email; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password" value="">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Current Balance</label>
                                                <span class="pull-right-container form-control">
                                                    <small class="label pull-right bg-green"><?php echo get_whatsapp_balance($userData->id); ?></small>
                                            </span>
                                            </div>
                                        </div>
                                        <?php if(is_super_admin($userData->id)){ ?>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Topup Balance</label>
                                                <input type="text" class="form-control" id="top_up_balance" placeholder="Enter Toup Balance" name="top_up_balance" value="">
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Company Name</label>
                                                <input type="text" class="form-control" id="company_name" placeholder="Enter Company Name" name="company_name" value="<?php
                                                if (!empty($rowData->company_name)) {
                                                    echo $rowData->company_name;
                                                };
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Company Nature</label>
                                                <input type="text" class="form-control" id="company_nature" placeholder="Enter Company Nature" name="company_nature" value="<?php
                                                if (!empty($rowData->company_nature)) {
                                                    echo $rowData->company_nature;
                                                };
                                                ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="comment">Company Description:</label>
                                                <textarea class="form-control" rows="5" id="company_description" name="company_description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Company Email</label>
                                                <input type="text" class="form-control" id="company_email" placeholder="Enter Company Email" name="company_email" value="<?php
                                                if (!empty($rowData->company_email)) {
                                                    echo $rowData->company_email;
                                                };
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleName">Company Web Link</label>
                                                <input type="text" class="form-control" id="company_weblink" placeholder="Enter Web Link" name="company_weblink" value="<?php
                                                if (!empty($rowData->company_weblink)) {
                                                    echo $rowData->company_weblink;
                                                };
                                                ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="comment">Company Address:</label>
                                                <textarea class="form-control" rows="5" id="company_address" name="company_address"><?php
                                                    if (!empty($rowData->company_address)) {
                                                        echo $rowData->company_address;
                                                    };
                                                    ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="hidden" name="edit_id" value="<?php echo $rowData->id; ?>" />
                            <input type="hidden" name="user_id" value="<?php echo $userData->id; ?>" />
                            <input type="submit" name="client_profile_update" class="btn btn-primary btn-block" value="Update">
                        </div>
                    </form>
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
