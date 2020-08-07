<?php
$table = 'users';
$order = 'ASC';
$column = 'first_name';
$dataType = 'obj';
$agencyData = getTableDataByTableName($table, $order, $column, $dataType);
if (isset($agencyData) && !empty($agencyData)) {
    ?>
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped list-table-custom-style">
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
                    <tr>
                        <td><?php echo ++$sl; ?></td>
                        <td><?php echo (isset($adata->user_type) && $adata->user_type == 'sa' ? 'Super Admin' : 'Client'); ?></td>
                        <td><?php echo (isset($adata->first_name) && !empty($adata->first_name) ? $adata->first_name : 'No data'); ?></td>
                        <td><?php echo (isset($adata->last_name) && !empty($adata->last_name) ? $adata->last_name : 'No data'); ?></td>
                        <td><?php echo (isset($adata->email) && !empty($adata->email) ? $adata->email : 'No data'); ?></td>
                        <td>
                            <a href="user_edit.php?user_id=<?php echo $adata->id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
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