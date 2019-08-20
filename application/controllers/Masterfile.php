<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterfile extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        date_default_timezone_set("Asia/Manila");
        $this->load->model('super_model');
        function arrayToObject($array){
            if(!is_array($array)) { return $array; }
            $object = new stdClass();
            if (is_array($array) && count($array) > 0) {
                foreach ($array as $name=>$value) {
                    $name = strtolower(trim($name));
                    if (!empty($name)) { $object->$name = arrayToObject($value); }
                }
                return $object;
            } 
            else {
                return false;
            }
        }
    }

    public function index(){  
        $this->load->view('template/index');
    }

    public function dashboard(){  
        $personal_id = $this->session->userdata('personal_id');
        $row=$this->super_model->count_rows_where("leave_info", "personal_id", $personal_id);
        if($row!=0){
        foreach($this->super_model->select_row_where("leave_info", "personal_id", $personal_id) as $info){
            $data['info'][]=array(
                "vl"=>$info->vl_balance,
                "sl"=>$info->sl_balance
            );
        }
        }else {
            $data['info']=array();
        }
    	$this->load->view('template/header');
    	$this->load->view('template/sidebar');
        $this->load->view('masterfile/dashboard',$data);
    	$this->load->view('template/script');
    }

     public function login_process(){
        $username=$this->input->post('username');
        $password=$this->input->post('password');
        $count=$this->super_model->login_user($username,$password);
        if($count>0){   
            $password1 =md5($this->input->post('password'));
            $fetch=$this->super_model->select_custom_where("user", "username = '$username' AND (password = '$password' OR password = '$password1')");
            foreach($fetch AS $d){
                $userid = $d->user_id;
                $usertype = $d->usertype_id;
                $username = $d->username;
                $personal_id = $d->personal_id;
            }
            $newdata = array(
               'user_id'=> $userid,
               'usertype'=> $usertype,
               'username'=> $username,
               'personal_id'=> $personal_id,
               'logged_in'=> TRUE
            );
            $this->session->set_userdata($newdata);
            redirect(base_url().'index.php/masterfile/dashboard/');
        }
        else{
            $this->session->set_flashdata('error_msg', 'Username And Password Do not Exist!');
            $this->load->view('template/header_login');
            $this->load->view('template/index');
            $this->load->view('template/script');       
        }
    }

    public function registration(){  
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        /*$data['personal_data'] = $this->super_model->select_all_order_by('personal_data','lname','ASC');*/
        foreach($this->super_model->select_all_order_by('personal_data','lname','ASC') AS $per){
            $username = $this->super_model->select_column_where("user", "username", "personal_id", $per->personal_id);
            $user_level = $this->super_model->select_column_where("user", "user_level", "personal_id", $per->personal_id);
            $user_id = $this->super_model->select_column_where("user", "user_id", "personal_id", $per->personal_id);
            $vl = $this->super_model->select_column_where("leave_info", "vl_balance", "personal_id", $per->personal_id);
            $sl = $this->super_model->select_column_where("leave_info", "sl_balance", "personal_id", $per->personal_id);
            $data['personal'][] = array(
                'personal_id'=>$per->personal_id,
                'lname'=>$per->lname,
                'fname'=>$per->fname,
                'mname'=>$per->mname,
                'emp_status'=>$per->emp_status,
                'username'=>$username,
                'user_level'=>$user_level,
                'user_id'=>$user_id,
                'vl'=>$vl,
                'sl'=>$sl
            );
        }
        $this->load->view('masterfile/registration',$data);
        $this->load->view('template/script');
    }

    public function register(){  
        $data['id']=$this->uri->segment(3);
        $data['userid']=$this->uri->segment(4);
        $id=$this->uri->segment(3);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        foreach($this->super_model->select_row_where("personal_data", "personal_id", $id) as $person){
            $lname = $this->super_model->select_column_where("personal_data", "lname", "personal_id", $person->personal_id);
            $fname = $this->super_model->select_column_where("personal_data", "fname", "personal_id", $person->personal_id);
            $mname = $this->super_model->select_column_where("personal_data", "mname", "personal_id", $person->personal_id);
            $username = $this->super_model->select_column_where("user", "username", "personal_id", $person->personal_id);
            $user_lvl = $this->super_model->select_column_where("user", "user_level", "personal_id", $person->personal_id);
            $type_id  = $this->super_model->select_column_where("leave_info", "li_id", "personal_id", $person->personal_id);
            $vl  = $this->super_model->select_column_where("leave_info", "vl_credits", "personal_id", $person->personal_id);
            $sl  = $this->super_model->select_column_where("leave_info", "sl_credits", "personal_id", $person->personal_id);
            $password = $this->super_model->select_column_where("user", "password", "personal_id", $person->personal_id); 
              
            $data['person'][] = array(
                'lname'=>$lname,
                'fname'=>$fname,
                'mname'=>$mname,
                'username'=>$username,
                'user_lvl'=>$user_lvl,
                'type_id'=>$type_id,
                'vl'=>$vl,
                'sl'=>$sl,
                'password'=>$password
            ); 
        }
        $this->load->view('masterfile/register',$data);
        $this->load->view('template/script');
    }

    public function insert_reg(){  
        $personal_id = $this->input->post('personal_id');
        $username = trim($this->input->post('username')," ");
        $password = $this->input->post('password');
        $user_lvl = $this->input->post('user_lvl');
        $fullname = $this->input->post('emp_name');
        $vl = $this->input->post('vl');
        $sl = $this->input->post('sl');
        $data = array(
            'personal_id' => $personal_id, 
            'username' => $username, 
            'fullname' => $fullname, 
            'password' => md5($password),
            'user_level' => $user_lvl
        );

        $data2 = array(
            'personal_id' => $personal_id,
            'vl_credits' => $vl,
            'sl_credits' => $sl,
            'vl_balance' => $vl,
            'sl_balance' => $sl,
        );
        $count =$this->super_model->count_rows_where("user","personal_id",$personal_id);
        if($count==0){
            if($this->super_model->insert_into("user", $data)){
                $this->super_model->insert_into("leave_info", $data2);
                echo "<script>alert('Successfully Registered!');
                window.location ='".base_url()."index.php/masterfile/registration'; </script>";
            }
        }else {
            foreach($this->super_model->select_row_where("user", "personal_id", $personal_id) as $user){
                if($this->super_model->update_where("user", $data, "user_id", $user->user_id)){
                    $this->super_model->update_where("leave_info", $data2, "personal_id", $personal_id);
                    echo "<script>alert('Successfully Updated!');
                    window.location ='".base_url()."index.php/masterfile/registration'; </script>";
                }
            }
        }
    }

    public function reset_reg(){
        $user_id=$this->uri->segment(3);
        if(!empty($user_id)){
            if($this->super_model->delete_where('user', 'user_id', $user_id)){
                echo "<script>alert('Succesfully Deleted!'); 
                    window.location ='".base_url()."index.php/masterfile/registration'; </script>";
            } 
        }else{
            echo "<script>alert('Not Registered Yet Cannot Reset Credentials.'); 
                    window.location ='".base_url()."index.php/masterfile/registration'; </script>";
        } 
     }

    public function confirm_reset(){  
        $data['user_id']=$this->uri->segment(4);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('masterfile/confirm_reset',$data);
        $this->load->view('template/script');
    }

    public function user_logout(){
        $this->session->sess_destroy();
        $this->load->view('template/index');
        echo "<script>alert('You have successfully logged out.'); 
       window.location ='".base_url()."index.php/masterfile/index';</script>";
    }
}
