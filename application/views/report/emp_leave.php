            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?php echo base_url(); ?>index.php/report/emp_rep">
                                                <span class="ti-arrow-left"></span>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/report/emp_rep">Employee List</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Employee's Leave List</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <div class="col-lg-8 col-md-6 col-sm-12">
                                        <center><h4 class="m5"><?php if(!empty($leave)){ echo $lname.', '.$fname.', '.$mname; }else { echo '';} ?></h4></center>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 " style="border-bottom:1px solid #d2d2d2">
                                        <div class="footer">
                                            <center>  
                                                <div class="chart-legend">
                                                    <div class="m5">
                                                        <div class="btn-group">
                                                            <a class="btn btn-danger btn-fill">VL</a>
                                                            <a class="btn btn-danger btn-fill"><span class="badge"><?php if(!empty($vl)){ echo $vl; }else { echo '0.00'; }?></span></a>
                                                        </div>
                                                    </div>
                                                    <div class="m5">
                                                        <div class="btn-group">
                                                            <a class="btn btn-warning btn-fill">SL</a>
                                                            <a class="btn btn-warning btn-fill"><span class="badge"><?php if(!empty($sl)){ echo $sl; }else { echo '0.00'; }?></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </center> 
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <div class="m20">
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover" id="myTable">
                                            <thead>
                                                <th>ID</th>
                                                <th>Application Date</th>
                                                <th>Leave Type</th>
                                                <th>Leave Date(From / To)</th>
                                                <th>Status</th>
                                                <th><center>Action</center></th>
                                            </thead>
                                            <tbody>
                                                <?php $x = 1; foreach($leave as $l){ ?>
                                                <tr>
                                                    <td><?php echo $x;?></td>
                                                    <td><?php echo $l['app_date'];?></td>
                                                    <td><?php if($l['type_id'] == '1'){ echo 'Vacation Leave'; } else { echo 'Sick Leave'; };?></td>
                                                    <td><?php echo $l['from_date']." / ".$l['to_date'];?></td>
                                                    <td>
                                                        <?php 
                                                                if($l['endorsed_by'] != '0' && $l['approved_by'] == '0' && $l['receive_by'] == '0'){
                                                                    $status = 'Supervisor Approved';
                                                                    if($l['supervisor_approval'] == '1'){
                                                                        echo $status;
                                                                    }else if($l['supervisor_approval'] == '2'){
                                                                        echo '<span style = "color:red;">Supervisor Declined</span>';
                                                                    }
                                                                }

                                                                if($l['endorsed_by'] != '0' && $l['approved_by'] != '0' && $l['receive_by'] == '0'){
                                                                    $status = 'Manager Approved';
                                                                    if($l['manager_approval'] == '1'){
                                                                        echo $status;
                                                                    }else if($l['manager_approval'] == '2') {
                                                                        echo '<span style = "color:red;">Manager Declined</span>';
                                                                    }
                                                                }

                                                                if($l['endorsed_by'] != '0' && $l['approved_by'] != '0' && $l['receive_by'] != '0'){
                                                                    $status = 'HR Approved';
                                                                    if($l['receive_by'] == '1'){
                                                                        echo $status;
                                                                    }else if($l['receive_by'] == '2') {
                                                                        echo '<span style = "color:red;">HR Declined</span>';
                                                                    }
                                                                }
                                                            ?>
                                                    </td>
                                                    <td>
                                                        <center>
                                                            <a href="<?php echo base_url();?>index.php/report/leave_details/<?php echo $l['leave_id'];?>" class="btn btn-warning btn-sm btn-fill"> View</a>
                                                        </center>
                                                    </td>
                                                </tr> 
                                                <?php $x++; } ?>                                      
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>


</body>
