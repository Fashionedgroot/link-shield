      <!-- Vertical Nav -->
        <nav class="hk-nav hk-nav-dark">
            <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
            <div class="nicescroll-bar">
                <div class="navbar-nav-wrap">
                    <ul class="navbar-nav flex-column">
                       <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">
                                <span class="feather-icon"><i data-feather="activity"></i></span>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
						<li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='all_links.php'){echo'active';}?>">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_drp">
                                <i class="fa fa-link"></i>
                                <span class="nav-link-text">Manage Links</span>
                            </a>
                            <ul id="pages_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="all_links.php?s=active">Active</a>
                                        </li>
										 <li class="nav-item">
                                            <a class="nav-link" href="all_links.php?s=blocked">Blocked</a>
                                        </li>
										 <li class="nav-item">
                                            <a class="nav-link" href="all_links.php?s=removed">Removed</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
						<li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='refer.php'){echo'active';}?>">
                            <a class="nav-link" href="refer.php">
                               <i class="fa fa-trophy"></i>
                                <span class="nav-link-text">Refer & Earn</span>
                            </a>
                        </li>
						<li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='withdraw.php'){echo'active';}?>">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#pages_drp1">
                                <i class="fa fa-link"></i>
                                <span class="nav-link-text">Money Withdraw</span>
                            </a>
                            <ul id="pages_drp1" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="withdraw.php?s=paid">Paid</a>
                                        </li>
										 <li class="nav-item">
                                            <a class="nav-link" href="withdraw.php?s=pending">Pending</a>
                                        </li>
										 <li class="nav-item">
                                            <a class="nav-link" href="withdraw.php?s=cancalled">Cancalled</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
						<li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='mywallet.php'){echo'active';}?>">
						 <a class="nav-link" href="mywallet.php">
                           <i class="fa fa-money"></i>
                                <span class="nav-link-text">My Wallet</span>
                            </a>
                        </li>
                    </ul>
					<hr class="nav-separator">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='account.php'){echo'active';}?>">
                            <a class="nav-link" href="account.php">
                                <span class="feather-icon"><i data-feather="user"></i></span>
                                <span class="nav-link-text">Account Settings</span>
                            </a>
                        </li>
						 <li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='password.php'){echo'active';}?>">
                            <a class="nav-link " href="password.php">
                                <i class="fa fa-lock"></i>
                                <span class="nav-link-text">Change Password</span>
                            </a>
                        </li>
						  <li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=='payment.php'){echo'active';}?>">
                            <a class="nav-link" href="payment.php">
                                <i class="fa fa-exchange"></i>
                                <span class="nav-link-text">Payment Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
        <!-- /Vertical Nav -->