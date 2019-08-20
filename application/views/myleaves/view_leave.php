            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?php echo base_url(); ?>index.php/myleave/leave_list">
                                                <span class="ti-arrow-left"></span>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/myleave/leave_list">My Leave List</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Leave Info</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card" style="padding: 6%">
                                <div>
                                    <h3>Leave Information</h3>
                                    <hr>
                                    <center>
                                        <table class="table table-hover table-stripes" >
                                        <?php 
                                            foreach($leave AS $lv){ 
                                        ?>
                                            <tr>
                                                <td width="25%"><p>Application Date</p></td>
                                                <td width="70%"><p><?php echo $lv['app_date'];?></p></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><p>Leave Type</p></td>
                                                <td width="70%"><p><?php echo $lv['type_name'];?></p></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><p>From Date</p></td>
                                                <td width="70%"><p><?php echo $lv['from_date'];?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>To Date</p></td>
                                                <td width="70%"><p><?php echo $lv['to_date'];?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>No. of Days</p></td>
                                                <td width="70%"><p><?php echo $lv['no_of_days'];?></p></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><p>Return Date</p></td>
                                                <td width="70%"><p><?php echo $lv['return_date'];?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>Reason for leave</p></td>
                                                <td width="70%"><p><?php echo $lv['leave_reason'];?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>Endorsed By</p></td>
                                                <td width="70%"><p><?php echo $lv['end_lname'].", ".$lv['end_fname'].", ".$lv['end_mname'];?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>Endorsed Date</p></td>
                                                <td width="70%"><p><?php echo $lv['endorse_date'];?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>Approved By</p></td>
                                                <td width="70%"><p><?php echo $lv['app_lname'].", ".$lv['app_fname'].", ".$lv['app_mname'];?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>Approved Date</p></td>
                                                <td width="70%"><p><?php echo $lv['approve_date'];?></p></td>
                                            </tr>   
                                            <tr>
                                                <td width="25%"><p>Received By</p></td>
                                                <td width="70%"><p><?php echo $lv['rec_lname'].", ".$lv['rec_fname'].", ".$lv['rec_mname'];?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>Received Date</p></td>
                                                <td width="70%"><p><?php echo $lv['receive_date'];?></p></td>
                                            </tr>
                                            <?php } ?>                                       
                                        </table>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>


</body>
