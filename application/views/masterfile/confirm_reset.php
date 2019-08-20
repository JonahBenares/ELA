            <div class="content">
                <div class="container-fluid">                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card" style="padding: 30px">
                                <center>
                                    <form method="POST">
                                        <h1 style="font-size:100px;color:#ca4a4a;" class="mt2 animated pulse infinite "><span class="ti-alert"></span></h1>
                                        <h3>Are you sure you want to reset user credentials?</h3>
                                        <hr>
                                        <a class="btn btn-default btn-fill" href="<?php echo base_url();?>index.php/masterfile/registration">No</a>
                                        <a class="btn btn-super-danger btn-fill" href="<?php echo base_url();?>index.php/masterfile/reset_reg/<?php echo $user_id;?>">Yes</a>
                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>


</body>
