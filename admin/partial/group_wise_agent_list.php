<?php
$sql      = "SELECT group_id,COUNT(agent_id) as total_agent FROM group_wise_agent GROUP BY group_id";
$gwa = getDataRowIdAndTableBySQL($sql);
if (isset($gwa) && !empty($gwa)) {
    ?>
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped list-table-custom-style">
            <thead>
                <tr>
                    <th>SLN#</th>
                    <th>Group name</th>
                    <th>Number Of Agent</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sl = 0;
                $redirectUrl    =   'group_wise_agent_list.php';
                foreach ($gwa as $adata) {
                    $table =    "group_details where id=".$adata->group_id;
                    ?>
                    <tr>
                        <td><?php echo ++$sl; ?></td>
                        <td><?php echo (isset($adata->group_id) && !empty($adata->group_id) ? getNameByIdAndTable($table) : 'No data'); ?></td>
                        <td><?php echo (isset($adata->total_agent) && !empty($adata->total_agent) ? $adata->total_agent : 'No data'); ?></td>
                        <td style="color: white;">
                            <a href="javascript:void(0)" title="Details" onclick="openGroupWiseAgentDetailsModal('<?php echo $adata->group_id; ?>')"><i class="fa fa-desktop"></i></a>
                            <a href="javascript:void(0)" title="Delete" onclick="deleteGroupAgentFromGroup('<?php echo $adata->group_id; ?>','group_id','<?php echo $redirectUrl; ?>');"><i class="fa fa-close text-danger"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="alert alert-warning">
        <strong>Sorry there is no Data !</strong>
    </div>
<?php } ?>