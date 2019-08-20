<body>
    <div class="wrapper">
        <div class="sidebar" data-background-color="gray" data-active-color="success">
            <!--
                Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
                Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
            -->
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="#" class="simple-text">
                        <text id="logoname">ENERGREEN</text>
                    </a>
                </div>

                <ul class="nav">
                    <li class="active">
                        <a href="<?php echo base_url(); ?>index.php/masterfile/dashboard">
                            <i class="ti-panel"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/masterfile/registration">
                            <i class="ti-plus"></i>
                            <p>Registration</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/report/emp_rep">
                            <i class="ti-clipboard"></i>
                            <p>Report</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/masterfile/user_logout">
                            <i class="ti-power-off"></i>
                            <p>Logout</p>
                        </a>
                    </li>                   
                </ul>
            </div>
        </div>
        <div class="main-panel pgreen1">
            <nav class="navbar navbar-default pgreen">
                <div class="container-fluid">
                    <div class="navbar-header text_white">
                       <!--  <button type="button" class="navbar-toggle">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar bar1"></span>
                            <span class="icon-bar bar2"></span>
                            <span class="icon-bar bar3"></span>
                        </button> -->
                        <a class="text-strech navbar-brand text_white " href="#">
                            <text id="logoname">ELA MOBILE</text>
                        </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="ti-panel"></i>
                                    <p>Stats</p>
                                </a>
                            </li>
                            <li class="dropdown">
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="ti-bell"></i>
                                        <p class="notification">5</p>
                                        <p>Notifications</p>
                                        <b class="caret"></b>
                                  </a>
                                  <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                  </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ti-settings"></i>
                                    <p>Settings</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div style="background: #fff!important;height:10vmin; padding:5px">
                <div class="col-sm-3 col-xs-3"><center><a href="<?php echo base_url(); ?>index.php/masterfile/dashboard" style="font-size: 25px"><span class="ti-panel"></span></a><center></div>
                <div class="col-sm-3 col-xs-3"><center><a href="<?php echo base_url(); ?>index.php/masterfile/registration" style="font-size: 25px"><span class="ti-plus"></span></a><center></div>
                <div class="col-sm-3 col-xs-3"><center><a href="<?php echo base_url(); ?>index.php/report/emp_rep" style="font-size: 25px"><span class="ti-clipboard"></span></a><center></div>
                <div class="col-sm-3 col-xs-3"><center><a href="<?php echo base_url(); ?>index.php/masterfile/user_logout" style="font-size: 25px"><span class="ti-power-off"></span></a><center></div>
            </div>