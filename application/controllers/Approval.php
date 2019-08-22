<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approval extends CI_Controller {

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

    public function approval_list(){  
        $id=$this->uri->segment(3);

        $level = $this->super_model->select_column_where("user", "user_level", "personal_id", $id);
        
        if($level=='2'){
            $query = "(";
            foreach($this->super_model->select_row_where("personal_data", "current_supervisor", $id) AS $i){
                $query.="'".$i->personal_id."',";
            }
            $query=substr($query,0,-1);
            $query.=")";
            $rows=$this->super_model->count_custom_where("leave_application", "personal_id IN ".$query." AND endorsed_by is NULL AND approved_by is NULL");
            if($rows!=0){
                foreach($this->super_model->select_custom_where("leave_application", "personal_id IN ".$query." AND endorsed_by is NULL AND approved_by is NULL") AS $app){
                    $lname=$this->super_model->select_column_where("personal_data", "lname", "personal_id", $app->personal_id);
                    $fname=$this->super_model->select_column_where("personal_data", "fname", "personal_id", $app->personal_id);
                    $empname = $lname .", ".$fname;

                    $leave=$this->super_model->select_column_where("leave_type", "type_desc", "type_id", $app->type_id);
                    $data['application'][] = array(
                        'leave_id'=>$app->leave_id,
                        'app_date'=>$app->app_date,
                        'emp_name'=>$empname,
                        'leave_type'=>$leave
                    );
                }
            } else {
                $data['application']=array();
            }
        } else if($level=='1'){
            $query = "(";
            foreach($this->super_model->select_row_where("department", "department_head", $id) AS $i){
              $query.="'".$i->dept_id."',";
            }
            $query=substr($query,0,-1);
            $query.=")";

            //echo $query;
            $query2 = "(";
            foreach($this->super_model->select_custom_where("personal_data", "current_dept IN ".$query) AS $d){
                $query2.="'".$d->personal_id."',";
            }
            $query2=substr($query2,0,-1);
            $query2.=")";
            
            $rows=$this->super_model->count_custom_where("leave_application", "personal_id IN ".$query2." AND supervisor_approval = '1' AND approved_by is NULL");
            //$rows=$this->super_model->count_custom_where("leave_application", "supervisor_approval = '1' AND approved_by is NULL");
            if($rows!=0){
                foreach($this->super_model->select_custom_where("leave_application", "personal_id IN ".$query2." AND supervisor_approval = '1' AND approved_by is NULL") AS $app){
                //foreach($this->super_model->select_custom_where("leave_application", "supervisor_approval = '1' AND approved_by is NULL") AS $app){
                    $lname=$this->super_model->select_column_where("personal_data", "lname", "personal_id", $app->personal_id);
                    $fname=$this->super_model->select_column_where("personal_data", "fname", "personal_id", $app->personal_id);
                    $empname = $lname .", ".$fname;
                    $leave=$this->super_model->select_column_where("leave_type", "type_desc", "type_id", $app->type_id);
                    $data['application'][] = array(
                        'leave_id'=>$app->leave_id,
                        'app_date'=>$app->app_date,
                        'emp_name'=>$empname,
                        'leave_type'=>$leave
                    );
                }
            } else {
                 $data['application']=array();
            }
        } else {
            $data['application']=array();
        }
    	$this->load->view('template/header');
    	$this->load->view('template/sidebar');
        $this->load->view('approval/approval_list',$data);
    	$this->load->view('template/script');
    }

    public function view_approval(){  
        $id=$this->uri->segment(3);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        foreach($this->super_model->select_row_where("leave_application", "leave_id", $id) AS $info){
            $lname=$this->super_model->select_column_where("personal_data", "lname", "personal_id", $info->personal_id);
            $fname=$this->super_model->select_column_where("personal_data", "fname", "personal_id", $info->personal_id);
            $empname=$lname.", ".$fname;

            $end_lname=$this->super_model->select_column_where("personal_data", "lname", "personal_id", $info->endorsed_by);
            $end_fname=$this->super_model->select_column_where("personal_data", "fname", "personal_id", $info->endorsed_by);
            $endname = $end_lname.", ".$end_fname;

            $app_lname=$this->super_model->select_column_where("personal_data", "lname", "personal_id", $info->approved_by);
            $app_fname=$this->super_model->select_column_where("personal_data", "fname", "personal_id", $info->approved_by);
            $appname = $app_lname.", ".$app_fname;

            $vl = $this->super_model->select_column_where("leave_info", "vl_balance", "personal_id", $info->personal_id);
            $sl = $this->super_model->select_column_where("leave_info", "sl_balance", "personal_id", $info->personal_id);
            $leave=$this->super_model->select_column_where("leave_type", "type_desc", "type_id", $info->type_id);

            $data['info'][]= array(
                "leave_id"=>$info->leave_id,
                "personal_id"=>$info->personal_id,
                "employee"=>$empname,
                "leave_type"=>$leave,
                "app_date"=>$info->app_date,
                "from_date"=>$info->from_date,
                "to_date"=>$info->to_date,
                "no_of_days"=>$info->no_of_days,
                "return_date"=>$info->return_date,
                "reason"=>$info->leave_reason,
                "endorsed_by"=>$endname,
                "endorsed_date"=>$info->endorse_date,
                "approved_by"=>$appname,
                "approve_date"=>$info->approve_date,
                "vl"=>$vl,
                "sl"=>$sl
            );
        }
        $this->load->view('approval/view_approval',$data);
        $this->load->view('template/script');
    }

    public function reason(){  
        $data['id']=$this->uri->segment(3);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('approval/reason',$data);
        $this->load->view('template/script');
    }

    public function decline_request(){
        $leave_id = $this->input->post('leave_id');
        $reason = $this->input->post('decline_reason');
        $sessionid = $this->input->post('session_id');
        $baseurl = $this->input->post('base_url');
        $today = date('Y-m-d H:i:s');
        $level = $this->super_model->select_column_where("user", "user_level", "personal_id", $sessionid);
        if($level=='2'){
            $data = array(
                "supervisor_approval"=>'2',
                "endorsed_by"=>$sessionid,
                "endorse_date"=>$today,
                "sup_reason"=>$reason
            );

            if($this->super_model->update_where("leave_application", $data, "leave_id", $leave_id)){ 
                echo "Success";
            }
        } else if($level=='1'){
             $data = array(
                "manager_approval"=>'2',
                "approved_by"=>$sessionid,
                "approve_date"=>$today,
                "manager_reason"=>$reason
            );

            if($this->super_model->update_where("leave_application", $data, "leave_id", $leave_id)){ 
                echo "Success";
            }
        }
    }

     public function approve_request(){
        $leave_id = $this->input->post('leave_id');
        $sessionid = $this->input->post('session_id');
        $baseurl = $this->input->post('base_url');
        $today = date('Y-m-d H:i:s');
        $type = $this->super_model->select_column_where("leave_application", "type_id", "leave_id", $leave_id);
        $personal_id = $this->super_model->select_column_where("leave_application", "personal_id", "leave_id", $leave_id);
        $level = $this->super_model->select_column_where("user", "user_level", "personal_id", $sessionid);
        if($level=='2'){
            $data = array(
                "supervisor_approval"=>'1',
                "endorsed_by"=>$sessionid,
                "endorse_date"=>$today
            );

            if($this->super_model->update_where("leave_application", $data, "leave_id", $leave_id)){ 
               
                echo "Success";
            }
        } else if($level=='1'){
            $data = array(
                "manager_approval"=>'1',
                "approved_by"=>$sessionid,
                "approve_date"=>$today
            );


            $vl_bal = $this->super_model->select_column_where("leave_info", "vl_balance", "personal_id", $personal_id);
            $sl_bal = $this->super_model->select_column_where("leave_info", "sl_balance", "personal_id", $personal_id);
            $no_days = $this->super_model->select_column_where("leave_application", "no_of_days", "leave_id", $leave_id);

            if($type=='1'){
                $new_vl = $vl_bal - $no_days;

                $data2 = array(
                    "vl_balance"=>$new_vl
                );
                $this->super_model->update_where("leave_info", $data2, "personal_id", $personal_id);
            } else if($type=='2'){
                $new_sl = $sl_bal - $no_days;

                $data2 = array(
                    "sl_balance"=>$new_sl
                );
                $this->super_model->update_where("leave_info", $data2, "personal_id", $personal_id);
            }

            if($this->super_model->update_where("leave_application", $data, "leave_id", $leave_id)){ 
               
                echo "Success";
            }
        }
    }
}
