<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if ($user_id != NULL) {
            redirect('app', 'refresh');
        }
    }

    public function index() {
        $this->load->view('login');
    }

    public function login_process() {
        $data = array();
        $data['user_name'] = $this->input->post('user_name', true);
        $data['user_password'] = $this->input->post('user_password', true);
        $result = $this->app_model->user_login_check($data);
        $sdata = array();
        $activity = array();
        if ($result != NULL) {
            $sdata['user_id'] = $result->pk_user_id;
            $sdata['user_name'] = $result->user_name;
            $sdata['login_time'] = time();
            $this->session->set_userdata($sdata);
            
            $activity['activity_type'] = 'success';
            $activity['fk_user_id'] = $sdata['user_id'];
            $activity['activity_name'] = $sdata['user_name'] . ' login success';
            $activity['created_by'] = $sdata['user_id'];
            $this->app_model->save_activity($activity);
            echo 'success';
        }
        if ($result == NULL) {            
            //whether ip is from share internet
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            }
            //whether ip is from proxy
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            //whether ip is from remote address
            else {
                $ip_address = $_SERVER['REMOTE_ADDR'];
            }
            echo $ip_address;

            $activity['activity_type'] = 'warning';
            $activity['fk_user_id'] = NULL;
            $activity['activity_name'] = $ip_address;
            $activity['created_by'] = NULL;   
            $this->app_model->save_activity($activity);
        }
    }
}