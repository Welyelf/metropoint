<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Types extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model', 'general');
    }

    public function index()
    {
        $this->data['title'] = "Metropoint - Bus Types";
        // get all job tags
        $get_users = array(
            'table' => 'mp_bus_types',
            'select' => '*',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->data['engines'] = $this->general->get_data_with_param($get_users);
        $this->load->view('superadmin/types/index', $this->data);
    }

    public function add(){
        $input = $this->input->post();
        if ($input) {
            if($this->general->add_($input, 'mp_bus_types')){
                redirect(base_url("superadmin/types/"));
            }
        }
        $this->data['title'] = "Metropoint - Bus Types";
        $this->load->view('superadmin/types/add', $this->data);
    }

    public function edit($id=null){
        $input = $this->input->post();
        if ($input) {
            if($this->general->update_($input,$id ,'mp_bus_types')){
                redirect(base_url("superadmin/types/"));
            }
        }
        $get_login_user = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'mp_bus_types',
            'select' => '*',
        );
        $this->data['engine_details'] = $this->general->get_data_with_param($get_login_user,FALSE);
        $this->data['title'] = "Metropoint - Bus Types";
        $this->load->view('superadmin/types/edit', $this->data);
    }

    public function delete_bus_type() {
        $remove_engine = array(
            'where' => array(
                'id' => $_POST['id']
            ),
            'table' => 'mp_bus_types'
        );
        if($this->general->delete_($remove_engine)){
            echo '1';
        }
    }
}