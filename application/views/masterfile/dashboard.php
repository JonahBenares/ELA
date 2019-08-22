<?php 
    $personal_id = $_SESSION['personal_id'];
?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">                                        
                                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="content">
                                    <div class="footer">
                                        <center>  
                                            <?php foreach($info AS $i) { ?>
                                            <div class="chart-legend">
                                                <div class="m5">
                                                    <a class="btn btn-danger btn-fill">VL
                                                        <span class="badge" style="margin-left:30px"><?php echo $i['vl']; ?></span>
                                                    </a>                                                    
                                                </div>
                                                <div class="m5">
                                                    <a class="btn btn-warning btn-fill">SL
                                                        <span class="badge" style="margin-left:30px"><?php echo $i['sl']; ?></span>
                                                    </a> 
                                                </div>
                                                <div class="m5">
                                                    <a class="btn btn-success btn-fill">FA
                                                        <span class="badge" style="margin-left:30px">10</span>
                                                    </a> 
                                                </div>
                                                <div class="m5">
                                                    <a class="btn btn-info btn-fill">TBR
                                                        <span class="badge" style="margin-left:30px">10</span>
                                                    </a> 
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </center> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <a href="<?php echo base_url(); ?>index.php/apply/va_sick" class=" card btn btn-success btn-fill btn-block">
                                <p class="appli">APPLICATION</p>
                            </a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <a href="<?php echo base_url(); ?>index.php/myleave/leave_list/<?php echo $personal_id;?>" class=" card btn btn-success btn-fill btn-block">
                                <p class="appli">MY LEAVES</p>
                            </a>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <a href="<?php echo base_url(); ?>index.php/approval/approval_list/<?php echo $personal_id; ?>" class=" card btn btn-success btn-fill btn-block">
                                <p class="appli">APPROVAL <span class = "label label-danger"><?php echo $approval_count; ?></span></p>
                            </a>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</body>

