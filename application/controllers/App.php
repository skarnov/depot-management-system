<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');
        if ($user_id == NULL) {
            redirect('login', 'refresh');
        }
        if (time() - $this->session->userdata('login_time') > 900) {
            $activity = array();
            $activity['activity_type'] = 'error';
            $activity['fk_user_id'] = $user_id;
            $activity['activity_name'] = $this->session->userdata('user_name') . ' logout due to inactivity';
            $activity['created_by'] = $user_id;
            $this->app_model->save_activity($activity);
            $this->session->sess_destroy();
            redirect('login');
        } else {
            $sdata = array();
            $sdata['login_time'] = time();
            $this->session->set_userdata($sdata);
        }
    }

    public function index() {
        $data = array();
        $data['title'] = 'Home';
        $data['statics'] = $this->app_model->get_statics();        
        $data['home'] = $this->load->view('app/home', $data, true);
        $this->load->view('app/master', $data);        
    }

    public function logout() {
        $activity = array();
        $activity['activity_type'] = 'success';
        $activity['fk_user_id'] = $this->session->userdata('user_id');
        $activity['activity_name'] = $this->session->userdata('user_name') . ' logout success';
        $activity['created_by'] = $this->session->userdata('user_id');
        $this->app_model->save_activity($activity);
        $this->session->sess_destroy();
        redirect('login');
    }
}