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
            $get_dispatcher_user = array(
                'where' => array(
                    'u_name' => $input['username'],
                    'pass' => md5($input['password']),
                ),
                'table' => 'user_dispt',
                'select' => '*',
            );
            $user = $this->general->get_data_with_param($get_dispatcher_user,FALSE);

            $get_driver_user = array(
                'where' => array(
                    'u_name' => $input['username'],
                    'pass' => md5($input['password']),
                ),
                'table' => 'user_dri',
                'select' => '*',
            );
            $get_conductor_user = array(
                'where' => array(
                    'u_name' => $input['username'],
                    'pass' => md5($input['password']),
                ),
                'table' => 'user_con',
                'select' => '*',
            );
            $user_driver = $this->general->get_data_with_param($get_driver_user,FALSE);
            $user_conductor = $this->general->get_data_with_param($get_conductor_user,FALSE);



            //print_r($user);
            if ($user) {
                $this->session->set_userdata('user', $user);
                redirect(base_url('dispatcher/dashboard'));
//                    if ($user->user_type == 0) {
//                        redirect(base_url('superadmin/users'));
//                    } else if ($user->user_type == 1)  {
//                        redirect(base_url('admin/dashboard'));
//                    } else if ($user->user_type == 2) {
//                        redirect(base_url('operator/dashboard'));
//                    }else if ($user->user_type == 3) {
//                        redirect(base_url('dispatcher/dashboard'));
//                    }else if ($user->user_type == 4 || $user->user_type == 5) {
//                        redirect(base_url('driver/dashboard'));
//                    }else {
//                        $this->data['error'] = "User doesn't have a role.";
//                    }


            }else if ( $user_driver || $user_conductor) {
                if($user_driver){
                    $this->session->set_userdata('user', $user_driver);
                }else{
                    $this->session->set_userdata('user', $user_conductor);
                }
                redirect(base_url('driver/dashboard'));
            }else{
                $this->data['error'] = "Invalid Login.";
            }
            exit;
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
