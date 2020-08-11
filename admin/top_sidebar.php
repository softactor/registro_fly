<header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>FP</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>FP</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <?php
                $userId             =   $_SESSION['logged']['user_id'];
                $balance            =   get_whatsapp_balance($userId);
                $bgColor            =  ($balance <= 5 ? "text-danger": "text-success");
            ?>
            <div class="sms_balance_showing_top">
                <ul>
                    <li>
                        <i class="fa fa-bell-o"></i> Remaining Balance:&nbsp; <div style="float: right; padding: 0 1%; background-color: white;" class="<?php echo $bgColor; ?>">$<?php echo number_format($balance,2,".","."); ?></div>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs"><?php echo $_SESSION['logged']['user_name']; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <?php
                                if(is_super_admin($userId)){ ?>
                                    <a href="user_edit.php?user_id=<?php echo $userId;?>" class="btn btn-default btn-flat">Profile</a>
                                <?php }else{ ?>
                                    <a href="client_profile.php" class="btn btn-default btn-flat">Profile</a>
                                <?php } ?>
                            </div>
                            <div class="pull-right">
                                <a href="../function/logout.php" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>