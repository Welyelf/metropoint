<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Torno extends MY_Controller
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
        $base_terminal_id = $_SESSION['user']->base_terminal;
        $this->data['title'] = "Metropoint - Users";
        // get all job tags
        $get_users = array(
            'where' => array(
                'trip_terminal_id' => $base_terminal_id,
            ),
            'table' => 'mp_trips',
            'select' => '*,mp_trips.id as trip_id,mp_trips.status as trip_status',
            'join' => array(
                'table' => 'mp_bus',
                'statement' => 'mp_bus.id=mp_trips.trip_bus_id',
                'join_as' => 'left',
            ),
            'order' => array(
                'order_by' => 'mp_trips.id',
                'ordering' => 'DESC',
            ),
        );
        $this->data['trips'] = $this->general->get_data_with_param($get_users);
        $this->load->view('operator/torno/index', $this->data);
    }

    public function add(){
        $input = $this->input->post();
        if ($input) {
            //$pass2 = $input['re_password'];
            $this->load->helper('string');
            $input['status'] = 0;
            $input['trip_terminal_id'] = $_SESSION['user']->base_terminal;
            $input['trip_datetime'] = date("m-d-Y h:i A");
            if($this->general->add_($input, 'mp_trips')){
                $bus_status_update = array(
                    'trip_status' => 1
                );
               $this->general->update_($bus_status_update,$input['trip_bus_id'] ,'mp_bus');
               redirect(base_url('operator/torno/'));
            }
        }
        $base_terminal_id = $_SESSION['user']->base_terminal;
        $this->data['buses'] = $this->bus_model->get_all_bus_available();

        $get_terminal = array(
            'where' => array(
                'id' => $base_terminal_id,
            ),
            'table' => 'mp_terminals',
            'select' => '*',
        );
        $this->data['terminals'] = $this->general->get_data_with_param($get_terminal);

        $get_to_terminal = array(
            'where' => array(
                'id !=' => $base_terminal_id,
            ),
            'table' => 'mp_terminals',
            'select' => '*',
        );
        $this->data['terminals_to'] = $this->general->get_data_with_param($get_to_terminal);

        $this->data['title'] = "Metropoint";
        $this->load->view('operator/torno/add', $this->data);
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

        $base_terminal_id = $_SESSION['user']->base_terminal;
        $get_terminal = array(
            'where' => array(
                'id' => $base_terminal_id,
            ),
            'table' => 'mp_terminals',
            'select' => '*',
        );
        $this->data['terminals'] = $this->general->get_data_with_param($get_terminal);

        $this->data['title'] = "Metropoint - Terminal";
        $this->load->view('operator/users/edit', $this->data);
    }

    public function delete_trip() {
        $remove_trip = array(
            'where' => array(
                'id' => $_POST['id']
            ),
            'table' => 'mp_trips'
        );
        if($this->general->delete_($remove_trip)){
            echo '1';
        }
    }

    public function getBusSelected(){
        $id = $_POST['id'];
        echo json_encode($this->bus_model->get_all_bus_available($id),TRUE);
    }

    public function getUserData(){
        $id = $_POST['id'];
        $get_user_data = array(
            'where' => array(
                'id' => $id,
            ),
            'table' => 'mp_users',
            'select' => '*',
        );
        echo json_encode($this->general->get_data_with_param($get_user_data,FALSE),TRUE);
    }
}