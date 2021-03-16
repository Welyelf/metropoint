<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        // Required Libraries
        $this->load->library('bcrypt');
        $this->load->library('session');

        // Required Configs
        //$this->config->load('auth');
        $this->load->model('General_model', 'general');

    }

    public function login($error = FALSE)
    {
        $input = $this->input->post();
        if($input){
            //if (array_key_exists('success', $responseKeys)) {
            $get_login_user = array(
                'where' => array(
                    'username' => $input['username']
                ),
                'table' => 'mp_users',
                'select' => '*',
            );
            $user = $this->general->get_data_with_param($get_login_user,FALSE);
            //print_r($user);
            if ($user) {
                if ($this->bcrypt->check_password($input['password'], $user->password)) { //if ($input['password']== $user->password)
                    $this->session->set_userdata('user', $user);
                    if ($user->user_type == 0) {
                        redirect(base_url('superadmin/users'));
                    } else if ($user->user_type == 1)  {
                        redirect(base_url('admin/dashboard'));
                    } else if ($user->user_type == 2) {
                        redirect(base_url('operator/dashboard'));
                    }else if ($user->user_type == 3) {
                        redirect(base_url('dispatcher/dashboard'));
                    }else if ($user->user_type == 4 || $user->user_type == 5) {
                        redirect(base_url('driver/dashboard'));
                    }else {
                        $this->data['error'] = "User doesn't have a role.";
                    }
                    exit;
                }else {
                    $this->data['error'] = "Invalid Username and/or Password.";
                }
            }else {
                $this->data['error'] = "Email Address don't exist.";
            }
        }
        $this->data['title'] = "RewardsVine - Login";
        $this->load->view('auth/index', $this->data);
    }


    public function logout()
    {
        // Reset OAuth access token
        //$this->google->revokeToken();

        // Remove token and user data from the session
        //$this->session->unset_userdata('loggedIn');
        //$this->session->unset_userdata('userData');
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }

}
