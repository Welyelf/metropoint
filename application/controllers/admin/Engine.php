<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Engine extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model', 'general');
    }

    public function index()
    {
        $this->data['title'] = "Metropoint - Engines";
        // get all job tags
        $get_users = array(
            'table' => 'mp_engine_types',
            'select' => '*',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->data['engines'] = $this->general->get_data_with_param($get_users);
        $this->load->view('admin/engine/index', $this->data);
    }

    public function add(){
        $input = $this->input->post();
        if ($input) {
            if($this->general->add_($input, 'mp_engine_types')){
                redirect(base_url("admin/engine/"));
            }
        }
        $this->data['title'] = "Metropoint - Engines";
        $this->load->view('admin/engine/add', $this->data);
    }

    public function edit($id=null){
        $input = $this->input->post();
        if ($input) {
            if($this->general->update_($input,$id ,'mp_engine_types')){
                redirect(base_url("admin/engine/"));
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
        $this->data['title'] = "Metropoint - Engines";
        $this->load->view('admin/engine/edit', $this->data);
    }

    public function delete_engine() {
        $remove_engine = array(
            'where' => array(
                'id' => $_POST['id']
            ),
            'table' => 'mp_engine_types'
        );
        if($this->general->delete_($remove_engine)){
            echo '1';
        }
    }
}