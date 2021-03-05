<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model', 'general');
    }

    public function index()
    {
        $this->data['title'] = "Metropoint - Admin Dashboard";
        // get all job tags
//        $get_users = array(
//            'table' => 'mp_bus',
//            'select' => '*',
//        );
//        $this->data['users'] = $this->general->get_data_with_param($get_users);
        $this->load->view('admin/dashboard/index', $this->data);
    }
}