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
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/approval/view_approval">Leave Info</a></li>
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
                                    <hr>
                                    <center>
                                        <form id='declineinfo'>
                                        <table width="100%" >
                                            <tr>                                                
                                                <td><p>Reason for Declining Leave Request:</p></td>
                                            </tr>
                                            <tr>
                                                <td><textarea name="decline_reason" id="decline_reason" cols="30" rows="10" class="form-control"></textarea>
                                                <span id='reason_error' class='error_msg'></span></td>
                                            </tr>                                  
                                        </table>
                                        <input type="button" onclick='declineRequest()' name="submit_reason" class="btn btn-success btn-fill btn-block" value="Submit">
                                        <input type="hidden" name="leave_id" value="<?php echo $id; ?>">
                                        <input type="hidden" name="session_id" id="session_id" value="<?php echo $sessionid; ?>">
                                        <input type='hidden' name='base_url' id='base_url' value='<?php echo base_url(); ?>'>
                                    </form>
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
<script>
    function declineRequest(){
        var declineinfo = $("#declineinfo").serialize();
        var base_url= document.getElementById("base_url").value; 
        var sessionid= document.getElementById("session_id").value; 
        var location = base_url + 'index.php/Approval/decline_request';
        var decline_reason= document.getElementById("decline_reason").value; 
        if(decline_reason==''){
             $("#reason_error").html("Warning: Reason must not be empty.");
        } else {
             $.ajax({
                  type: "POST",
                  url: location,
                  data: declineinfo,
                  success: function(output){
                     if(output=='Success'){
                        alert('Leave request declined!');
                        window.location = base_url+'index.php/approval/approval_list/'+sessionid;
                     }
                  }
                 });
        }

    }
</script>
<style>
.error_msg{
    font-size:12px;
    color:red;
    font-style: italic;
}
</style>