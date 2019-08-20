          <?php $sessionid= $_SESSION['personal_id']; ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?php echo base_url(); ?>index.php/approval/approval_list">
                                                <span class="ti-arrow-left"></span>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/approval/approval_list">Approval List</a></li>
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
                                <?php 

                                    foreach($info AS $i){ 
                                ?>
                                    <div class="chart-legend">
                                        <div class="m5">
                                            <div class="btn-group">
                                                <a class="btn btn-danger btn-fill">VL Balance</a>
                                                <a class="btn btn-danger btn-fill"><span class="badge"><?php echo $i['vl'];?></span></a>
                                            </div>
                                            <div class="btn-group">
                                                <a class="btn btn-warning btn-fill">SL Balance</a>
                                                <a class="btn btn-warning btn-fill"><span class="badge"><?php echo $i['sl'];?></span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <center>

                                        <table class="table table-hover table-stripes" >
                                            <tr>
                                                <td width="25%"><p>Application Date</p></td>
                                                <td width="70%"><p><?php echo $i['app_date']; ?></p></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><p>Employee Name</p></td>
                                                <td width="70%"><p><?php echo $i['employee']; ?></p></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><p>Leave Type</p></td>
                                                <td width="70%"><p><?php echo $i['leave_type']; ?></p></td>
                                            </tr>
                                            <tr>
                                                <td width="25%"><p>From Date</p></td>
                                                <td width="70%"><p><?php echo $i['from_date']; ?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>To Date</p></td>
                                                <td width="70%"><p><?php echo $i['to_date']; ?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>No. of Days</p></td>
                                                <td width="70%"><p><?php echo $i['no_of_days']; ?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>Return Date</p></td>
                                                <td width="70%"><p><?php echo $i['return_date']; ?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>Reason for leave</p></td>
                                                <td width="70%"><p><?php echo $i['reason']; ?></p></td>
                                            </tr>  
                                            <?php if(!empty($i['endorsed_by'])){ ?>
                                            <tr>
                                                <td width="25%"><p>Endorsed By</p></td>
                                                <td width="70%"><p><?php echo $i['endorsed_by']; ?></p></td>
                                            </tr>  
                                            <tr>
                                                <td width="25%"><p>Endorsed Date</p></td>
                                                <td width="70%"><p><?php echo $i['endorsed_date']; ?></p></td>
                                            </tr>  
                                            <?php } ?>                                 
                                        </table>
                                        <a onclick="declineLeave(<?php echo $i['leave_id']; ?>)" class="btn btn-danger btn-fill">Decline</a>
                                         <a onclick="approveLeave()" class="btn btn-success btn-fill">Approve</a>
                                       <!--  <input type="button" name="" class="btn btn-danger btn-fill" value="Decline">
                                        <input type="button" name="" class="btn btn-info btn-fill" value="Approve"> -->
                                        <input type='hidden' name='base_url' id='base_url' value='<?php echo base_url(); ?>'>
                                        <input type='hidden' name='leave_id' id='leave_id' value='<?php echo $i['leave_id']; ?>'>
                                        <input type='hidden' name='session_id' id='session_id' value='<?php echo $sessionid; ?>'>
                                    </center>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>


</body>
<script>
    function declineLeave(leaveid){
        var base_url= document.getElementById("base_url").value; 
        if(confirm('Are you sure you want to decline leave request?')){
            window.location = base_url+'index.php/approval/reason/'+leaveid;
        }
    }

    function approveLeave(leaveid){
        var base_url= document.getElementById("base_url").value; 
        var leave_id= document.getElementById("leave_id").value; 
        var session_id= document.getElementById("session_id").value; 
        var location = base_url+'index.php/approval/approve_request';
        if(confirm('Are you sure you want to approve leave request?')){
            $.ajax({
                  type: "POST",
                  url: location,
                  data: 'leave_id='+leave_id+'&session_id='+session_id+'&base_url='+base_url,
                  success: function(output){
                     if(output=='Success'){
                        alert('Leave request approved!');
                        window.location = base_url+'index.php/approval/approval_list/'+session_id;
                     }
                  }
                 });
        }
    }
</script>