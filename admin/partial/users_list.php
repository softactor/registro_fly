<?php
$table = 'users';
$order = 'ASC';
$column = 'first_name';
$dataType = 'obj';
$agencyData = getTableDataByTableName($table, $order, $column, $dataType);
if (isset($agencyData) && !empty($agencyData)) {
    ?>
    <div class="table-responsive">
        <table id="users_list" class="table table-bordered table-striped list_table_custom_style">
            <thead>
                <tr>
                    <th>SLN#</th>
                    <th>User Type</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sl = 0;
                foreach ($agencyData as $adata) {
                    ?>
                    <tr id="user_name_row_<?php echo $adata->id; ?>">
                        <td><?php echo ++$sl; ?></td>
                        <td><?php echo (isset($adata->user_type) && $adata->user_type == 'sa' ? 'Super Admin' : 'Client'); ?></td>
                        <td><?php echo (isset($adata->first_name) && !empty($adata->first_name) ? $adata->first_name : 'No data'); ?></td>
                        <td><?php echo (isset($adata->last_name) && !empty($adata->last_name) ? $adata->last_name : 'No data'); ?></td>
                        <td><?php echo (isset($adata->email) && !empty($adata->email) ? $adata->email : 'No data'); ?></td>
                        <td>
                            <a href="user_edit.php?user_id=<?php echo $adata->id; ?>" class="btn btn-info">
                                <span class="fa fa-pencil-square-o"></span>&nbsp;Edit
                            </a>
                            <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_users('<?php echo $adata->id; ?>');">
                                <span class="fa fa-close"></span>&nbsp;Delete
                            </a>
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