<!-- <script type="text/javascript">
    function doesConnectionExist() {
        var xhr = new XMLHttpRequest();
        var file = "http://putokbatok.biz/ELA";
        var randomNum = Math.round(Math.random() * 10000);
        xhr.open('HEAD', file + "?rand=" + randomNum, true);
        xhr.send();
        xhr.addEventListener("readystatechange", processRequest, false);
        function processRequest(e) {
            if (xhr.readyState == 4) {
                if (xhr.status >= 200 && xhr.status < 304) {
                    alert("connection exists!");
                } else {
                    alert("connection doesn't exist!");
                }
            }
        }
    }
</script> -->
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>ELA MOBILE</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="<?php echo base_url(); ?>assets/assets/css/style.css" rel="stylesheet" /> 
    <link href="<?php echo base_url(); ?>assets/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="<?php echo base_url(); ?>assets/assets/css/animate.min.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/assets/css/animation.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo base_url(); ?>assets/assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo base_url(); ?>assets/assets/css/demo.css" rel="stylesheet" /> 
    
    <!--  Fonts and icons     -->
    <link href="<?php echo base_url(); ?>assets/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href='<?php echo base_url(); ?>assets/assets/css/font.css' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>assets/assets/css/themify-icons.css" rel="stylesheet">

</head>
<!-- onload="doesConnectionExist()" -->
<body class="pgreen" >

<div class="wrapper1 ">
    <div class="margin_top"></div>
    <div class="main-panel1">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <?php
                            $error_msg= $this->session->flashdata('error_msg');  
                        ?>
                        <?php 
                            if($error_msg){
                        ?>
                            <div class="alert alert-danger alert-shake boxshadow text_white animated headShake">
                                <center><?php echo $error_msg; ?></center>                    
                            </div>
                        <?php } ?>
                        <div class="card" style="box-shadow: 0 2px 2px rgba(204, 197, 185, 0)!important;background-color: #ffffff00!important;">
                            <div class="header">
                                <div style="background-color: gray">
                                    <a href="#" style="text-transform: uppercase;padding: 4px 0px;display: block;font-size: 18px;text-align: center;line-height: 30px;letter-spacing: 7px;font-weight: 900;color:white; ">
                                        ELA Mobile
                                    </a>
                                </div>
                            </div>
                            <div class="header">
                                <form method="POST" action = "<?php echo base_url(); ?>index.php/masterfile/login_process"> 
                                    <input type="text" name="username" class="form-control" placeholder="Username">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <br>
                                    <button class="btn btn-block btn-fill btn-default" type = "submit">Login</button>
                                </form>
                                <!-- <a href="<?php //echo base_url(); ?>index.php/masterfile/dashboard">login</a> -->
                            </div>
                            <div class="content all-icons">
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="<?php echo base_url(); ?>assets/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>assets/assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="<?php echo base_url(); ?>assets/assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="<?php echo base_url(); ?>assets/assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url(); ?>assets/assets/js/bootstrap-notify.js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="<?php echo base_url(); ?>assets/assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="<?php echo base_url(); ?>assets/assets/js/demo.js"></script>


</html>
