<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model', 'general');
        $this->load->helper('functions');
    }

    public function index()
    {
        $base_terminal_id = $_SESSION['user']->base_terminal;
        $this->data['title'] = "Metropoint - Users";
        // get all job tags
        $this->data['users'] = $this->general->get_user_driver_conductor($base_terminal_id);
        $this->load->view('operator/users/index', $this->data);
    }

    public function add(){
        $input = $this->input->post();
        if ($input) {
            //$pass2 = $input['re_password'];
            $this->load->helper('string');
            $input['password'] = $this->bcrypt->hash_password($input['password']);
            $input['datetime'] = date("d-m-Y h:i A");
            if($this->general->add_($input, 'mp_users')){
                redirect(base_url('operator/users/'));
            }
        }
        $base_terminal_id = $_SESSION['user']->base_terminal;
        $get_terminal = array(
            'where' => array(
                'id' => $base_terminal_id,
            ),
            'table' => 'mp_terminals',
            'select' => '*',
        );
        $this->data['terminals'] = $this->general->get_data_with_param($get_terminal);
        $this->data['title'] = "Metropoint";
        $this->load->view('operator/users/add', $this->data);
    }

    public function edit($id=null){
        $input = $this->input->post();
        if ($input) {
            if($input['password'] == ''){
                unset($input['password']);
            }
            if($this->general->update_($input,$id ,'mp_users')){
                redirect(base_url("operator/users/"));
            }
        }
        $get_login_user = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'mp_users',
            'select' => '*',
        );
        $this->data['user_details'] = $this->general->get_data_with_param($get_login_user,FALSE);

        $get_terminal = array(
            'table' => 'mp_terminals',
            'select' => '*',
        );
        $this->data['terminals'] = $this->general->get_data_with_param($get_terminal);

        $this->data['title'] = "Metropoint - Terminal";
        $this->load->view('operator/users/edit', $this->data);
    }

    public function delete_user() {
        $remove_engine = array(
            'where' => array(
                'id' => $_POST['id']
            ),
            'table' => 'mp_users'
        );
        if($this->general->delete_($remove_engine)){
            echo '1';
        }
    }
}