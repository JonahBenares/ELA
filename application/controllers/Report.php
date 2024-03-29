<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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

    public function emp_rep(){  
    	$this->load->view('template/header');
    	$this->load->view('template/sidebar');
        foreach($this->super_model->select_all_order_by('user','fullname','ASC') AS $user){
            $vl = $this->super_model->select_column_where("leave_info", "vl_balance", "personal_id", $user->personal_id);
            $sl = $this->super_model->select_column_where("leave_info", "sl_balance", "personal_id", $user->personal_id);
            $leave_id = $this->super_model->select_column_where("leave_application", "leave_id", "personal_id", $user->personal_id);
            $data['user'][] = array(
                'fullname'=>$user->fullname,
                'personal_id'=>$user->personal_id,
                'vl'=>$vl,
                'sl'=>$sl
            );
        }
        $this->load->view('report/emp_rep',$data);
    	$this->load->view('template/script');
    }

    public function emp_leave(){  
        $id=$this->uri->segment(3);
        $data['id']=$this->uri->segment(3);
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $rows = $this->super_model->count_custom_where("leave_application", "personal_id = '$id'");
        if($rows!=0){
            foreach($this->super_model->select_row_where('leave_application','personal_id', $id) AS $leave){
                $data['lname']=$this->super_model->select_column_where("personal_data", "lname", "personal_id", $leave->personal_id);
                $data['fname']=$this->super_model->select_column_where("personal_data", "fname", "personal_id", $leave->personal_id);
                $data['mname']=$this->super_model->select_column_where("personal_data", "mname", "personal_id", $leave->personal_id);
                $data['vl'] = $this->super_model->select_column_where("leave_info", "vl_balance", "personal_id", $leave->personal_id);
                $data['sl'] = $this->super_model->select_column_where("leave_info", "sl_balance", "personal_id", $leave->personal_id);
                $data['leave'][] = array(
                    'leave_id'=>$leave->leave_id,
                    'app_date'=>$leave->app_date,
                    'type_id'=>$leave->type_id,
                    'from_date'=>$leave->from_date,
                    'to_date'=>$leave->to_date,
                    'endorsed_by'=>$leave->endorsed_by,
                    'receive_by'=>$leave->receive_by,
                    'approved_by'=>$leave->approved_by,
                    'supervisor_approval' => $leave->supervisor_approval,
                    'manager_approval' => $leave->manager_approval
                );
            }

        }else {
            $data['leave'] = array();
        }
        $this->load->view('report/emp_leave',$data);
        $this->load->view('template/script');
    }

    public function leave_details(){  
        $leave_id=$this->uri->segment(3);
        $data['leave_id']=$leave_id;
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        foreach($this->super_model->select_row_where('leave_application', 'leave_id', $leave_id) AS $leave){
            $type_name = $this->super_model->select_column_where("leave_type", "type_desc", "type_id", $leave->type_id);
            $end_lname = $this->super_model->select_column_where("personal_data", "lname", "personal_id", $leave->endorsed_by);
            $end_mname = $this->super_model->select_column_where("personal_data", "mname", "personal_id", $leave->endorsed_by);
            $end_fname = $this->super_model->select_column_where("personal_data", "fname", "personal_id", $leave->endorsed_by);

            $app_lname = $this->super_model->select_column_where("personal_data", "lname", "personal_id", $leave->approved_by);
            $app_fname = $this->super_model->select_column_where("personal_data", "fname", "personal_id", $leave->approved_by);
            $app_mname = $this->super_model->select_column_where("personal_data", "mname", "personal_id", $leave->approved_by);

            $rec_lname = $this->super_model->select_column_where("personal_data", "lname", "personal_id", $leave->receive_by);
            $rec_fname = $this->super_model->select_column_where("personal_data", "fname", "personal_id", $leave->receive_by);
            $rec_mname = $this->super_model->select_column_where("personal_data", "mname", "personal_id", $leave->receive_by);
            $data['leave'][] = array(
                'app_date' => $leave->app_date,
                'type_id' => $leave->type_id,
                'from_date' => $leave->from_date,
                'to_date' => $leave->to_date,
                'no_of_days' => $leave->no_of_days,
                'return_date' => $leave->return_date,
                'leave_reason' => $leave->leave_reason,
                'endorsed_by' => $leave->endorsed_by,
                'endorse_date' => $leave->endorse_date,
                'approved_by' => $leave->approved_by,
                'approve_date' => $leave->approve_date,
                'receive_by' => $leave->receive_by,
                'receive_date' => $leave->receive_date,
                'type_name' => $type_name,
                'end_lname' => $end_lname,
                'end_fname' => $end_fname,
                'end_mname' => $end_mname,
                'app_lname' => $app_lname,
                'app_fname' => $app_fname,
                'app_mname' => $app_mname,
                'rec_lname' => $rec_lname,
                'rec_fname' => $rec_fname,
                'rec_mname' => $rec_mname,
            );
        }
        $this->load->view('report/leave_details',$data);
        $this->load->view('template/script');
    }
}
