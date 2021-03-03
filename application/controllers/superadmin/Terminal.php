<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terminal extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model', 'general');
    }

    public function index()
    {
        $this->data['title'] = "Metropoint - Terminal";
        $get_terminal = array(
            'table' => 'mp_terminals',
            'select' => '*',
        );
        $this->data['terminals'] = $this->general->get_data_with_param($get_terminal);
        $this->load->view('superadmin/terminal/index', $this->data);
    }

    public function add(){
        $input = $this->input->post();
        if ($input) {
            $input['datetime'] =  date('Y-m-d H:i:s');
            if($this->general->add_($input, 'mp_terminals')){
                redirect(base_url("superadmin/terminal/"));
            }
        }
        $this->data['title'] = "Metropoint - Terminal";
        $this->load->view('superadmin/terminal/add', $this->data);
    }

    public function edit($id=null){
        $input = $this->input->post();
        if ($input) {
            if($this->general->update_($input,$id ,'mp_terminals')){
                redirect(base_url("superadmin/terminal/"));
            }
        }
        $get_login_user = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'mp_engine_types',
            'select' => '*',
        );
        $this->data['engine_details'] = $this->general->get_data_with_param($get_login_user,FALSE);
        $this->data['title'] = "Metropoint - Terminal";
        $this->load->view('superadmin/terminal/edit', $this->data);
    }

    public function delete_terminal() {
        $remove_engine = array(
            'where' => array(
                'id' => $_POST['id']
            ),
            'table' => 'mp_terminals'
        );
        if($this->general->delete_($remove_engine)){
            echo '1';
        }
    }
}