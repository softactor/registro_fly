<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Settings</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if(is_super_admin($_SESSION['logged']['user_id'])){ ?>
                        <li class=""><a href="users_list.php"><i class="fa fa-user" aria-hidden="true"></i> User List</a></li>
                        <li class=""><a href="client_list.php"><i class="fa fa-id-badge" aria-hidden="true"></i> Client List</a></li>
                    <?php } ?>
                    <li class=""><a href="group_list.php"><i class="fa fa-users" aria-hidden="true"></i> Group List</a></li>
                    <li class=""><a href="contact_list.php"><i class="fa fa-address-book" aria-hidden="true"></i> Contact List</a></li>
                    <li class=""><a href="csv/contact_csv.csv"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Download CSV Format</a></li>
                    <li class=""><a href="message_templates_list.php"><i class="fa fa-newspaper-o" aria-hidden="true"></i> Template</a></li>
                    <li><a href="message_queue_manage.php"><i class="fa fa-circle-o"></i> Queue Manage</a></li>
                </ul>
            </li>
            <li class="header">Links</li>
            <li><a href="send_message.php"><i class="fa fa-commenting" aria-hidden="true"></i> <span>SMS</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>