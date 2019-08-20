<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apply extends CI_Controller {

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

    public function va_sick(){
        $personal_id = $this->session->userdata('personal_id');
        foreach($this->super_model->select_row_where("leave_info", "personal_id", $personal_id) as $info){
            $data['info'][]=array(
                "vl"=>$info->vl_balance,
                "sl"=>$info->sl_balance
            );
        }
        $data['type'] = $this->super_model->select_all('leave_type');  
    	$this->load->view('template/header');
    	$this->load->view('template/sidebar');
        $this->load->view('apply/va_sick',$data);
    	$this->load->view('template/script');
    }

    public function form(){  
        $type=$this->uri->segment(3);
        if($type=='1') $t = 'Vacation Leave';
        else if($type=='2') $t = 'Sick Leave';
        $data['type']=$t;
        $data['type_id']=$type;

        $personal_id = $this->session->userdata('personal_id');
        foreach($this->super_model->select_row_where("leave_info", "personal_id", $personal_id) as $info){
            $data['info'][]=array(
                "vl"=>$info->vl_balance,
                "sl"=>$info->sl_balance
            );
        }
        
    	$this->load->view('template/header');
    	$this->load->view('template/sidebar');
        $this->load->view('apply/form', $data);
    	$this->load->view('template/script');
    }

    public function confirm_leave(){  
    	$this->load->view('template/header');
    	$this->load->view('template/sidebar');
        $this->load->view('apply/confirm_leave');
    	$this->load->view('template/script');
    }

    public function insertLeave(){
        $today = date('Y-m-d H:i:s');
        if($this->input->post('leave_type')=='Vacation Leave'){
            $t = 1;
        } else {
            $t = 2;
        }
          $data = array(
                'personal_id'=>$this->input->post('emp_id'),
                'type_id'=>$this->input->post('type_id'),
                'app_date'=>$today,
                'from_date'=>$this->input->post('from_date'),
                'to_date'=>$this->input->post('to_date'),
                'return_date'=>$this->input->post('return_date'),
                'leave_reason'=>$this->input->post('reason'),
                'no_of_days'=>$this->input->post('nod')
            );
          if($this->super_model->insert_into('leave_application', $data)){
            echo "Success";
          }
    }

}
