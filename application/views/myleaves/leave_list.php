            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">My Leave List</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <div class="row">
                                        <form method="POST" action = '<?php echo base_url(); ?>index.php/myleave/generateYear'>
                                            <label class="col-md-2 col-md-offset-2" for="year">Year:
                                                <select name="year" class="form-control btn-block">
                                                <?php 
                                                    $firstYear = (int)date('Y');
                                                    $lastYear = $firstYear + 30;
                                                    for($i=$firstYear;$i<=$lastYear;$i++){
                                                ?>
                                                    <option value='<?php echo $i;?>'><?php echo $i;?></option>
                                                <?php } ?>
                                                  
                                                </select>
                                            </label>
                                            <label class="col-md-4" for="year">Month:
                                                <select name="year_name" class="form-control btn-block">
                                                <?php
                                                    $months = array("January", "February", "March","April","May","June","July","August","September","October","November", "December");

                                                    foreach ($months as $month) {
                                                    if($month == 'January'){
                                                        $mont = '01';
                                                    }

                                                    if($month == 'February'){
                                                        $mont = '02';
                                                    }

                                                    if($month == 'March'){
                                                        $mont = '03';
                                                    }

                                                    if($month == 'April'){
                                                        $mont = '04';
                                                    }

                                                    if($month == 'May'){
                                                        $mont = '05';
                                                    }

                                                    if($month == 'June'){
                                                        $mont = '06';
                                                    }

                                                    if($month == 'July'){
                                                        $mont = '07';
                                                    }

                                                    if($month == 'August'){
                                                        $mont = '08';
                                                    }

                                                    if($month == 'September'){
                                                        $mont = '09';
                                                    }

                                                    if($month == 'October'){
                                                        $mont = '10';
                                                    }

                                                    if($month == 'November'){
                                                        $mont = '11';
                                                    }

                                                    if($month == 'December'){
                                                        $mont = '12';
                                                    }
                                                ?>
                                                    <option value="<?php echo $mont;?>"><?php echo $month;?></option>
                                                <?php } ?>
                                                 
                                                </select>
                                            </label>
                                            <label class="col-md-2" for="year"><br>
                                                <input type="submit" class="btn btn-info btn-fill m5" value="Generate">
                                                <input type="hidden" name = 'id' value = '<?php echo $_SESSION['personal_id'];?>'>
                                                <input type='hidden' name='base_url' id='base_url' value='<?php echo base_url(); ?>'>
                                            </label>
                                        </form>
                                    </div>
                                    <hr>
                                </div>
                                <div class="m20">
                                    <div class="content table-responsive table-full-width">
                                    <?php
                                  
                                     if(!empty($personal) && !empty($id)){ ?>
                                       <table class="table table-hover" id="myTable">
                                            <thead>
                                                <th>ID</th>
                                                <th>Application Date</th>
                                                <th>Leave Status</th>
                                                <th>Leave Date (From / To)</th>
                                                <th><center>Action</center></th>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $x = 1;
                                                    foreach($personal AS $per){ 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $x;?></td>
                                                        <td><?php echo $per['app_date'];?></td>
                                                        <td>
                                                            <?php 
                                                                if($per['endorsed_by'] != '0' && $per['approved_by'] == '0' && $per['receive_by'] == '0'){
                                                                    $status = 'Supervisor Approved';
                                                                    if($per['supervisor_approval'] == '1'){
                                                                        echo $status;
                                                                    }else if($per['supervisor_approval'] == '2'){
                                                                        echo '<span style = "color:red;">Supervisor Declined</span>';
                                                                    }
                                                                }

                                                                if($per['endorsed_by'] != '0' && $per['approved_by'] != '0' && $per['receive_by'] == '0'){
                                                                    $status = 'Manager Approved';
                                                                    if($per['manager_approval'] == '1'){
                                                                        echo $status;
                                                                    }else if($per['manager_approval'] == '2') {
                                                                        echo '<span style = "color:red;">Manager Declined</span>';
                                                                    }
                                                                }

                                                                if($per['endorsed_by'] != '0' && $per['approved_by'] != '0' && $per['receive_by'] != '0'){
                                                                    $status = 'HR Approved';
                                                                    if($per['receive_by'] == '1'){
                                                                        echo $status;
                                                                    }else if($per['receive_by'] == '2') {
                                                                        echo '<span style = "color:red;">HR Declined</span>';
                                                                    }
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $per['from_date']." / ".$per['to_date'];?></td>
                                                        <td>
                                                            <center>
                                                                <a href="<?php echo base_url();?>index.php/myleave/view_leave/<?php echo $per['leave_id'];?>" class="btn btn-warning btn-sm btn-fill"> View</a>
                                                            </center>
                                                        </td>
                                                    </tr> 
                                                <?php $x++; } ?>                                         
                                            </tbody>
                                        </table>
                                    <?php } ?>
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
