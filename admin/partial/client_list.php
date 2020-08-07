<?php
$table = 'client_information';
$order = 'ASC';
$column = 'first_name';
$dataType = 'obj';
$agencyData = getTableDataByTableName($table, $order, $column, $dataType);
if (isset($agencyData) && !empty($agencyData)) {
    ?>
    <div class="table-responsive">
        <table id="client_list" class="table table-bordered table-striped list_table_custom_style">
            <thead>
                <tr>
                    <th>SLN#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>SMS rate</th>
                    <th>Whatsapp rate</th>
                    <th>Balance</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sl = 0;
                foreach ($agencyData as $adata) {
                    ?>
                    <tr>
                        <td><?php echo ++$sl; ?></td>
                        <td><?php echo (isset($adata->first_name) && !empty($adata->first_name) ? $adata->first_name : 'No data'); ?></td>
                        <td><?php echo (isset($adata->last_name) && !empty($adata->last_name) ? $adata->last_name : 'No data'); ?></td>
                        <td><?php echo 'email';//get_client_email();; ?></td>
                        <td><?php echo (isset($adata->sms_rate) && !empty($adata->sms_rate) ? $adata->sms_rate : 'No data'); ?></td>
                        <td><?php echo (isset($adata->whatsapp_rate) && !empty($adata->whatsapp_rate) ? $adata->whatsapp_rate : 'No data'); ?></td>
                        <td><?php echo (isset($adata->balance) && !empty($adata->balance) ? $adata->balance : 'No data'); ?></td>
                        <td>
                            <a href="user_edit.php" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" title="Delete"><i class="fa fa-close text-danger"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="alert alert-warning">
        <strong>Sorry there is no data!</strong>
    </div>
<?php } ?>