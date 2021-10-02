<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller {

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
        $this->load->model('sales_model');
    }

    public function index() {
        $data = array();
        $data['title'] = 'Sales';
        $data['all_sales'] = $this->sales_model->get_sales();
        $data['home'] = $this->load->view('sale/sales', $data, true);
        $this->load->view('app/master', $data);
    }

    public function add_sale($edit = NULL) {
        $data = array();
        $data['edit'] = $edit;
        if ($edit):
            $data['title'] = "Edit Sale";
            $data['sale_info'] = $this->sales_model->get_sales($edit);
        else:
            $data['title'] = "Add Sale";
        endif;
        $data['home'] = $this->load->view('sale/add_sale', $data, true);
        $this->load->view('app/master', $data);
    }

    public function save_sale($edit = NULL) {
        $time = date('H:i:s');
        $date = date('Y-m-d');
        $first_name = $this->input->post('first_name', true);

        if ($first_name) {
            $data = array();
            $data['client_type'] = 'sale';
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
                $activity['activity_name'] = $this->session->userdata('user_name') . ' updated a sale. Which ID -' . $edit;
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
                $activity['activity_name'] = $this->session->userdata('user_name') . ' add a sale. Which ID -' . $insert_id;
                $activity['created_by'] = $this->session->userdata('user_id');
                $this->app_model->save_activity($activity);
            endif;
            if ($result):
                echo 'success';
            endif;
        }
    }
}