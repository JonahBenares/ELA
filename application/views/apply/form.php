            <?php $id= $_SESSION['personal_id']; ?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?php echo base_url(); ?>index.php/apply/va_sick">
                                                <span class="ti-arrow-left"></span>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/masterfile/dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/apply/va_sick">Vacation-Sick</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Form</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card" style="padding: 30px">
                                <div>
                                    <div class="chart-legend">
                                        <?php foreach($info AS $i){ 
                                            $vl=$i['vl'];
                                            $sl= $i['sl'];
                                        }
                                        if($type_id == '1'){
                                            $max=$vl;
                                        } else {
                                            $max=$sl;
                                        }?>
                                                
                                                    <a class="btn btn-danger btn-fill">VL
                                                        <span class="badge" style="margin-left:30px"><?php echo $vl; ?></span>
                                                    </a>                                                    
                                              
                                                    <a class="btn btn-warning btn-fill">SL
                                                        <span class="badge" style="margin-left:30px"><?php echo $sl; ?></span>
                                                    </a> 
                                              
                                           
                                        </div>
                                        <br>
                                    <form id='leaveinfo'>
                                        <table style="width: 100%">
                                            <tr>
                                                <td><p>Type of Leave:</p></td>
                                                <td><?php echo $type; ?></td>
                                            </tr>
                                            <tr>
                                                <td><p>From Date:</p></td>
                                                <td><input type="date" name="from_date" id="from_date" class="form-control" >
                                                <span id='from_error' class='error_msg'></span></td>
                                            </tr>
                                            <tr>
                                                <td><p>To Date:</p></td>
                                                <td><input type="date" name="to_date" id="to_date" class="form-control">
                                                <span id='to_error' class='error_msg'></span></td>
                                            </tr>
                                            <tr>
                                                <td><p>No. Of Days:</p></td>
                                                <td><input type="number" name="nod" id="nod" class="form-control" max="<?php echo $max; ?>">
                                                <span id='nod_error' class='error_msg'></span></td>
                                            </tr>
                                            <tr>
                                                <td><p>Return Date:</p></td>
                                                <td><input type="date" name="return_date" id="return_date" class="form-control" ><span id='return_error' class='error_msg'></span></td>
                                            </tr>
                                            <tr>
                                                <td><p>Reason of Leave:</p></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><textarea name="reason" id="reason" cols="30" rows="10" class="form-control" ></textarea><span id='reason_error' class='error_msg'></span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><input type="button" name="file_leave" value="File Leave" class="btn btn-danger btn-fill btn-block" onclick='fileLeave()'>
                                                  <!--   <a href="<?php echo base_url(); ?>index.php/apply/confirm_leave">submit</a> -->
                                                </td>
                                            </tr>
                                        </table>
                                        <input type='hidden' name='base_url' id='base_url' value='<?php echo base_url(); ?>'>
                                        <input type='hidden' name='emp_id' id='emp_id' value='<?php echo $id; ?>'>
                                         <input type='hidden' name='max' id='max' value='<?php echo $max; ?>'>
                                        <input type="hidden" class="form-control "  name='type_id' id='type_id' value='<?php echo $type_id; ?>'>
                                    </form>
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
    /*$(document).ready(function(){
        var from_date= document.getElementById("from_date").value; 
        var to_date= document.getElementById("to_date").value;    
        var date1 = new Date(from_date);
        var date2 = new Date(to_date);
        var timeDiff = Math.abs(date2.getTime() - date1.getTime());
        var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        alert(diffDays);
        //document.getElementById("nod").value= diffDays;
    });*/
 
    function fileLeave(){
        var base_url= document.getElementById("base_url").value; 
        var location = base_url + 'index.php/Apply/insertLeave';
        var leaveinfo = $("#leaveinfo").serialize();

        var from_date= document.getElementById("from_date").value; 
        var max= parseFloat(document.getElementById("max").value); 
        var nod= parseFloat(document.getElementById("nod").value); 
        
        var to_date= document.getElementById("to_date").value;    
        var return_date= document.getElementById("return_date").value;     
        var reason= document.getElementById("reason").value;         
        if(from_date == ''){
            $("#from_error").html("Warning: From date field must not be empty.");
        }
        if(to_date == ''){
            $("#to_error").html("Warning: To date field must not be empty.");
        }
         if(nod == ''){
            $("#nod_error").html("Warning: Number of days field must not be empty.");
        }
        if(return_date == ''){
            $("#return_error").html("Warning: Return date field must not be empty.");
        }
        if(reason == ''){
            $("#reason_error").html("Warning: Reason field must not be empty.");
        }
        if(nod>max){
            alert('The number of days for your leave application is more than your remaining leave balance.');
        }
        if(from_date != '' && to_date != '' && return_date != '' && reason != '' && nod<=max){

            if(confirm('Are you sure you want to file leave?')){
                $.ajax({
                  type: "POST",
                  url: location,
                  data: leaveinfo,
                  success: function(output){
                     if(output=='Success'){
                        alert('You have successfully filed a leave request. Leave request is still due for approval.');
                        window.location = base_url+'index.php/masterfile/dashboard';
                     }
                  }
                 });
             }
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
