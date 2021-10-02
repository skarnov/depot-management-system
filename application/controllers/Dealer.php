<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dealer extends CI_Controller {

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
        $this->load->model('dealer_model');
    }

    public function index() {
        $data = array();
        $data['title'] = 'Dealers';
        $data['all_dealers'] = $this->dealer_model->get_dealers();
        $data['home'] = $this->load->view('dealer/dealers', $data, true);
        $this->load->view('app/master', $data);
    }

    public function add_dealer($edit = NULL) {
        $data = array();
        $data['edit'] = $edit;
        if ($edit):
            $data['title'] = "Edit Dealer";
            $data['dealer_info'] = $this->dealer_model->get_dealers($edit);
        else:
            $data['title'] = "Add Dealer";
        endif;
        $data['home'] = $this->load->view('dealer/add_dealer', $data, true);
        $this->load->view('app/master', $data);
    }

    public function save_dealer($edit = NULL) {
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $first_name = $this->input->post('first_name', true);

        if ($first_name) {
            $data = array();
            $data['client_type'] = 'dealer';
            $data['first_name'] = $this->input->post('first_name', true);
            $data['last_name'] = $this->input->post('last_name', true);
            $data['client_mobile'] = $this->input->post('mobile', true);
            $data['client_address'] = $this->input->post('address', true);

            if ($edit):
                $data['update_time'] = $time;
                $data['update_date'] = $date;
                $data['updated_by'] = $this->session->userdata('user_id');
                $this->db->where('pk_client_id', $edit);
                $result = $this->db->update('tbl_clients', $data);
                $activity = array();
                $activity['activity_type'] = 'warning';
                $activity['fk_user_id'] = $this->session->userdata('user_id');
                $activity['activity_name'] = $this->session->userdata('user_name') . ' updated a dealer. Which ID -' . $edit;
                $activity['created_by'] = $this->session->userdata('user_id');
                $this->app_model->save_activity($activity);
            else:
                $data['create_time'] = $time;
                $data['create_date'] = $date;
                $data['created_by'] = $this->session->userdata('user_id');
                $result = $this->db->insert('tbl_clients', $data);
                $insert_id = $this->db->insert_id();
                $activity = array();
                $activity['activity_type'] = 'success';
                $activity['fk_user_id'] = $this->session->userdata('user_id');
                $activity['activity_name'] = $this->session->userdata('user_name') . ' add a dealer. Which ID -' . $insert_id;
                $activity['created_by'] = $this->session->userdata('user_id');
                $this->app_model->save_activity($activity);
            endif;
            if ($result):
                echo 'success';
            endif;
        }
    }
}