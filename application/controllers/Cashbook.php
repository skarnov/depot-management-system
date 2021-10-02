<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cashbook extends CI_Controller {

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
        $this->load->model('cashbook_model');
    }

    public function index() {
        $args = array(
            'cashbook' => true,
        );
        $data = array();
        $data['title'] = 'Cashbook';
        $data['args'] = $args;
        $data['cashbook'] = $this->cashbook_model->get_cashbook($args);
        $data['home'] = $this->load->view('cashbook/cashbook', $data, true);
        $this->load->view('app/master', $data);
    }
    
    public function cash_in() {
        $args = array(
            'cash_in' => true,
        );
        $data = array();
        $data['title'] = 'Cashbook';
        $data['args'] = $args;
        $data['cashbook'] = $this->cashbook_model->get_cashbook($args);
        $data['home'] = $this->load->view('cashbook/cashbook', $data, true);
        $this->load->view('app/master', $data);
    }
    
    public function cash_out() {
        $args = array(
            'cash_out' => true,
        );
        $data = array();
        $data['title'] = 'Cashbook';
        $data['args'] = $args;
        $data['cash_out'] = true;
        $data['cashbook'] = $this->cashbook_model->get_cashbook($args);
        $data['home'] = $this->load->view('cashbook/cashbook', $data, true);
        $this->load->view('app/master', $data);
    }
}