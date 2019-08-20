            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?php echo base_url(); ?>index.php/masterfile/dashboard">
                                                <span class="ti-arrow-left"></span>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/masterfile/dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Vacation-Sick</li>
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
                                            <div class="chart-legend">
                                                 <?php foreach($info AS $i) { ?>
                                                <div class="m5">
                                                    <div class="btn-group">
                                                        <a class="btn btn-danger btn-fill">VL</a>
                                                        <a class="btn btn-danger btn-fill"><span class="badge"><?php echo $i['vl']; ?></span></a>
                                                    </div>
                                                </div>
                                                <div class="m5">
                                                    <div class="btn-group">
                                                        <a class="btn btn-warning btn-fill">SL</a>
                                                        <a class="btn btn-warning btn-fill"><span class="badge"><?php echo $i['sl']; ?></span></a>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        </center> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach($type AS $t){ ?>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <a href="<?php echo base_url(); ?>index.php/apply/form/<?php echo $t->type_id; ?>" class="card btn btn-info btn-fill btn-block">
                                <p class="appli"><?php echo $t->type_desc; ?>
                                </p>
                            </a>
                        </div>
                        <?php } ?>
                       <!--  <div class="col-lg-12 col-md-12 col-sm-12">
                            <a href="<?php echo base_url(); ?>index.php/apply/form/sl" class="card btn btn-info btn-fill btn-block">
                                <p class="appli">SICK</p>
                            </a>
                        </div> -->
                    </div>                      
                </div>
            </div>
        </div>
    </div>


</body>
