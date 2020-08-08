<?php
$user_id        =   $_SESSION['logged']['user_id'];
if(is_super_admin($user_id)){
    $table = 'contact_details';
}else{
    $table = 'contact_details WHERE client_id='.$user_id;
}

$order = 'DESC';
$column = 'created_at';
$dataType = 'obj';
$agencyData = getTableDataByTableName($table, $order, $column, $dataType);
if (isset($agencyData) && !empty($agencyData)) {
    ?>
    <div class="table-responsive">
        <table id="client_list" class="table table-bordered table-striped list_table_custom_style">
            <thead>
                <tr>
                    <th>SLN#</th>
                    <th>Client</th>
                    <th>Group</th>
                    <th>Contact</th>
                    <th>Created</th>
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
                        <td><?php echo (isset($adata->client_id) && !empty($adata->client_id) ? get_client_name($adata->client_id) : 'No data'); ?></td>
                        <td><?php echo (isset($adata->group_id) && !empty($adata->group_id) ?   get_group_name($adata->group_id) : 'No Group'); ?></td>
                        <td><?php echo (isset($adata->contact_no) && !empty($adata->contact_no) ? $adata->contact_no : 'No data'); ?></td>
                        <td><?php echo (isset($adata->created_at) && !empty($adata->created_at) ? $adata->created_at : 'No data'); ?></td>
                        <td>
                            <a href="message_whatsapp_templates_edit.php?edit_id=<?php echo $data->id ?>" class="btn btn-info">
                                <span class="fa fa-pencil-square-o"></span>&nbsp;Edit
                            </a>
                            <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_templates('<?php echo $data->id; ?>');">
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