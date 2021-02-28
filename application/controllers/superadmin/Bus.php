<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model', 'general');
    }

    public function index()
    {
        $this->data['title'] = "Metropoint - Bus";
        // get all job tags
        $get_users = array(
            'table' => 'mp_bus',
            'select' => '*',
        );
        $this->data['users'] = $this->general->get_data_with_param($get_users);
        $this->load->view('superadmin/users/index', $this->data);
    }

    public function add(){
        $input = $this->input->post();
        if ($input) {
            $email = urlencode($input['email_address']);
            $pass1 = $input['password'];
            $pass2 = $input['re_password'];
            $this->load->helper('string');
            $input['password'] = $this->bcrypt->hash_password($input['password']);
            unset($input['re_password']);
            unset($input['g-recaptcha-response']);
            $input['date_created'] = date("d-m-Y h:i A");
            $input['points'] = 0;
            $input['user_id'] = random_string('numeric', 6);
            $input['role'] = "Member";
        }
        $this->data['title'] = "Metropoint";
        $this->load->view('superadmin/users/add', $this->data);
    }
}