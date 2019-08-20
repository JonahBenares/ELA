<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myleave extends CI_Controller {

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

    public function leave_list(){ 
        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $id=$this->uri->segment(3); 
        $year=$this->uri->segment(4);
        $year_name=$this->uri->segment(5); 
        $data['id']=$this->uri->segment(3);
        $data['year']=$this->uri->segment(4);
        $data['year_name']=$this->uri->segment(5);

        $appdate = $year."-".$year_name;
     
        if(isset($year)){
           $sql = " AND app_date LIKE '$appdate%'";
        } else {
            $sql='';
        }

       
        $count=$this->super_model->count_custom_where("leave_application","personal_id = '$id' ".$sql);
      //  echo $count;
        if($count!=0){
            foreach($this->super_model->custom_query("SELECT * FROM leave_application WHERE personal_id = '$id' ".$sql) AS $per){
                $data['personal'][] = array(
                    'personal_id' => $per->personal_id,
                    'supervisor_approval' => $per->supervisor_approval,
                    'manager_approval' => $per->manager_approval,
                    'leave_id' => $per->leave_id,
                    'app_date' => $per->app_date,
                    'type_id' => $per->type_id,
                    'from_date' => $per->from_date,
                    'to_date' => $per->to_date,
                    'return_date' => $per->return_date,
                    'leave_reason' => $per->leave_reason,
                    'endorsed_by' => $per->endorsed_by,
                    'endorse_date' => $per->endorse_date,
                    'approved_by' => $per->approved_by,
                    'approve_date' => $per->approve_date,
                    'receive_by' => $per->receive_by,
                    'receive_date' => $per->receive_date
                );          
            }
        } else {
            $data['personal']=array();
        } 
        //$data['personal'] = $this->super_model->select_row_where('leave_application', 'personal_id', $id);
        $this->load->view('myleaves/leave_list',$data);
    	$this->load->view('template/script');
    }

    public function view_leave(){
        $data['leave_id']=$this->uri->segment(3);
        $leave_id=$this->uri->segment(3);
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
        $this->load->view('myleaves/view_leave',$data);
        $this->load->view('template/script');
    }

    public function generateYear(){
        $baseurl = $this->input->post('base_url');
        $id=$this->input->post('id');
      
            $year = $this->input->post('year');
    
            $year_name = $this->input->post('year_name');
      
       
         redirect($baseurl."index.php/myleave/leave_list/".$id."/".$year."/".$year_name);
     }
}
?>
