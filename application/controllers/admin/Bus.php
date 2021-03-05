<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model', 'general');
        $this->load->model('Bus_model', 'bus_model');
        $this->load->helper('functions');
    }

    public function index()
    {
        $this->data['title'] = "Metropoint - Bus";
        // get all job tags
        $this->data['buses'] = $this->bus_model->get_all_bus();
        $this->load->view('admin/bus/index', $this->data);
    }

    public function add(){
        $input = $this->input->post();
        if ($input) {
            if($this->general->add_($input, 'mp_bus')){
                redirect(base_url("admin/bus/"));
            }
        }
        $get_bus_types = array(
            'table' => 'mp_bus_types',
            'select' => '*',
        );
        $this->data['bus_types'] = $this->general->get_data_with_param($get_bus_types);

        $get_engine_types = array(
            'table' => 'mp_engine_types',
            'select' => '*',
        );
        $this->data['engine_types'] = $this->general->get_data_with_param($get_engine_types);

        $this->data['title'] = "Metropoint - Bus";
        $this->load->view('admin/bus/add', $this->data);
    }

    public function delete_bus() {
        $remove_engine = array(
            'where' => array(
                'id' => $_POST['id']
            ),
            'table' => 'mp_bus'
        );
        if($this->general->delete_($remove_engine)){
            echo '1';
        }
    }
}