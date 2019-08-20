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
                                                <th>VL Bal</th>
                                                <th>SL Bal</th>
                                                <th><center>Action</center></th>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $x = 1; 
                                                foreach($user as $use){ 
                                            ?>
                                                <tr>
                                                    <td><?php echo $x;?></td>
                                                    <td><?php echo $use['fullname'];?></td>
                                                    <td><?php echo $use['vl']?></td>
                                                    <td><?php echo $use['sl']?></td>
                                                    <td>
                                                        <center>
                                                            <a href="<?php echo base_url();?>index.php/report/emp_leave/<?php echo $use['personal_id'];?>" class="btn btn-warning btn-sm btn-fill"> View</a>
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
