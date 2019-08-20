            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">                                        
                                        <li class="breadcrumb-item active" aria-current="page">Employee List</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <hr>
                                </div>
                                <div class="m20">
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover" id="myTable">
                                            <thead>
                                                <th>ID</th>
                                                <th>Employee Name</th>
                                                <th>Employment Status</th>
                                                <th>Username</th>
                                                <th>User Level</th>
                                                <th>VL / SL</th>
                                                <th><center>Action</center></th>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $x = 1;
                                                    foreach($personal AS $per){ 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $x;?></td>
                                                        <td><?php if(!empty($per['lname'])&!empty($per['fname'])&!empty($per['mname'])){ echo $per['lname'].", ".$per['fname'].", ".$per['mname']; }else { echo '';} ?></td>
                                                        <td><?php echo $per['emp_status']?></td>
                                                        <td><?php echo $per['username'];?></td>
                                                        <td>
                                                            <?php 
                                                                if($per['user_level'] == '1'){
                                                                    echo 'Manager'; 
                                                                }
                                                                else if($per['user_level'] == '2'){
                                                                    echo 'Supervisor'; 
                                                                }
                                                                else if($per['user_level'] == '3'){
                                                                    echo 'Rank and File'; 
                                                                }
                                                                else if($per['user_level'] == '4'){
                                                                    echo 'HR'; 
                                                                }
                                                            ?>
                                                            
                                                        </td>
                                                        <td><?php echo $per['vl']." / ".$per['sl'];?></td>
                                                        <td>
                                                            <center>
                                                                <a href="<?php echo base_url(); ?>index.php/masterfile/register/<?php echo $per['personal_id']?>" class="btn btn-warning btn-sm btn-fill"> Register</a>
                                                                <a href="<?php echo base_url(); ?>index.php/masterfile/confirm_reset/<?php echo $per['personal_id']?>/<?php if(!isset($per['user_id'])){ echo ''; }else { echo $per['user_id']; }?>" class="btn btn-danger btn-sm btn-fill"> Reset</a>
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
