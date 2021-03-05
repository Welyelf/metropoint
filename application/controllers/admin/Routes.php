<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('General_model', 'general');
        $this->load->helper('functions');
    }

    public function index()
    {
        $this->data['title'] = "Metropoint - Routes";
        // get all job tags
        $get_routes = array(
            'table' => 'mp_routes',
            'select' => '*',
            'order' => array(
                'order_by' => 'id',
                'ordering' => 'DESC',
            ),
        );
        $this->data['routes'] = $this->general->get_data_with_param($get_routes);
        $this->load->view('admin/routes/index', $this->data);
    }

    public function add(){
        $input = $this->input->post();
        if ($input) {
            unset($input['hour']);
            unset($input['minute']);
            unset($input['meridian']);
            if($this->general->add_($input, 'mp_routes')){
                redirect(base_url("admin/routes/"));
            }
        }
        $this->data['title'] = "Metropoint - Routes";
        $this->load->view('admin/routes/add', $this->data);
    }

    public function edit($id=null){
        $input = $this->input->post();
        if ($input) {
            if($this->general->update_($input,$id ,'mp_routes')){
                redirect(base_url("admin/routes/"));
            }
        }
        $get_login_user = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'mp_routes',
            'select' => '*',
        );
        $this->data['route_details'] = $this->general->get_data_with_param($get_login_user,FALSE);
        $this->data['title'] = "Metropoint - Routes";
        $this->load->view('admin/routes/edit', $this->data);
    }

    public function delete_route() {
        $remove_engine = array(
            'where' => array(
                'id' => $_POST['id']
            ),
            'table' => 'mp_routes'
        );
        if($this->general->delete_($remove_engine)){
            echo '1';
        }
    }
}