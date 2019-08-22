<script type="text/javascript">
    function val_cpass() {
        var password = $("#pass").val();
        var confirm_password = $("#cpass").val();
        if(password != confirm_password) {
            $("#cpass_msg").show();
            $("#cpass_msg").html("Confirm password not match!");
            $("#submit_pass").hide();
        }
        else{
            $("#cpass_msg").hide();
            $("#submit_pass").show();
        }
    }
</script>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?php echo base_url(); ?>index.php/masterfile/registration">
                                                <span class="ti-arrow-left"></span>
                                            </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php/masterfile/registration">Employee List</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Register Employee</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card" style="padding: 30px">
                                <div>
                                    <form method = 'POST' action = '<?php echo base_url();?>index.php/masterfile/insert_reg'>
                                        <table style="width: 100%">
                                            <?php 
                                                /*$lname = $this->super_model->select_column_where("personal_data", "lname", "personal_id", $id);
                                                $fname = $this->super_model->select_column_where("personal_data", "fname", "personal_id", $id);
                                                $mname = $this->super_model->select_column_where("personal_data", "mname", "personal_id", $id);
                                                $username = $this->super_model->select_column_where("user", "username", "personal_id", $id);
                                                $user_lvl = $this->super_model->select_column_where("user", "user_level", "personal_id", $id);
                                                $type_id  = $this->super_model->select_column_where("leave_info", "li_id", "personal_id", $id);
                                                $vl  = $this->super_model->select_column_where("leave_info", "vl_credits", "personal_id", $id);
                                                $sl  = $this->super_model->select_column_where("leave_info", "sl_credits", "personal_id", $id);
                                                $position=5; // Define how many character you want to display.
                                                $password = $this->super_model->select_column_where("user", "password", "personal_id", $id); 
                                                $pass = substr($password, 0, $position); */
                                                foreach($person AS $per){
                                                    $position=5; // Define how many character you want to display.
                                                    $pass = substr($per['password'], 0, $position);
                                            ?>
                                            <tr>
                                                <td><p>Employee Name:</p></td>
                                                <td><input type="text" name = "emp_name" class="form-control" value = "<?php echo $per['lname'].', '.$per['fname'].', '.$per['mname']?>" readonly=""></td>
                                            </tr>
                                            <tr>
                                                <td><p>Username:</p></td>
                                                <td><input type="text" name = 'username' value = '<?php if(!empty($per['username'])){ echo $per['username'];}else { echo '';}?>' class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><p>Password:</p></td>
                                                <td><input type="password" name = 'password' id = "pass" value = '<?php if(!empty($per['password'])){ echo $pass;}else { echo '';}?>' class="form-control" required></td>
                                            </tr>
                                            <tr>
                                                <td><p>Confirm Password:</p></td>
                                                <td><input type="password" name = 'cpass' onchange="val_cpass()" value = '<?php if(!empty($per['password'])){ echo $pass;}else { echo '';}?>' id="cpass" class="form-control" required></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <div class="alert alert-danger alert-shake" id="cpass_msg" style = "display:none;">
                                                       <center>Confirm Password not Match!</center>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><p>User Level:</p></td>
                                                <td>
                                                    <select class="form-control" name = "user_lvl">
                                                        <option value="" readonly >Select User Level</option>
                                                        <option value="4"<?php echo (($per['user_lvl'] == '4') ? ' selected' : '');?>>HR</option> 
                                                        <option value="1"<?php echo (($per['user_lvl'] == '1') ? ' selected' : '');?>>Manager</option> 
                                                        <option value="2"<?php echo (($per['user_lvl'] == '2') ? ' selected' : '');?>>Supervisor</option> 
                                                        <option value="3"<?php echo (($per['user_lvl'] == '3') ? ' selected' : '');?>>Rank & File</option> 
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><p>Vacation Leave Credits:</p></td>
                                                <td><input type="number" name = 'vl' value = '<?php if($per['vlb']=='0.00'){ echo $per['vl']; } else { echo $per['vlb']; } ?>' class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><p>Sick Leave Credits:</p></td>
                                                <td><input type="number" name = 'sl' value = '<?php if($per['slb']=='0.00'){ echo $per['sl']; } else { echo $per['slb']; } ?>' class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"><br><input type="submit" id = 'submit_pass' name="" class="btn btn-danger btn-fill btn-block"></td>
                                            </tr>
                                            <input type="hidden" name="personal_id" value = "<?php echo $id;?>">
                                            <input type="hidden" name="type_id" value = "<?php echo $per['type_id'];?>">
                                            <?php } ?>
                                        </table>
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
