
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active" aria-current="page">Approval List</li>
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
                                                <th>Application Date</th>
                                                <th>Employee</th>
                                                <th>Leave Type</th>
                                                <th><center>Action</center></th>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(!empty($application)){
                                                foreach($application AS $a){ ?>
                                                <tr>
                                                    <td><?php echo $a['app_date']; ?></td>
                                                    <td><?php echo $a['emp_name']; ?></td>
                                                    <td><?php echo $a['leave_type']; ?></td>
                                                    <td>
                                                        <center>
                                                            <a href="<?php echo base_url(); ?>index.php/approval/view_approval/<?php echo $a['leave_id']; ?>" class="btn btn-warning btn-sm btn-fill"> View</a>
                                                        </center>
                                                    </td>
                                                </tr>    
                                                <?php }
                                                } ?>                                      
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
