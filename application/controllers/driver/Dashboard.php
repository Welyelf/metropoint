<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
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
        $base_terminal_id = $_SESSION['user']->ter_id;
        if(isset( $_SESSION['user']->dri_id)){
            $id = $_SESSION['user']->dri_id;
        }else{
            $id = $_SESSION['user']->con_id;
        }
        $get_terminal = array(
            'where' => array(
                'ter_id' => $base_terminal_id,
            ),
            'table' => 'ter_details',
            'select' => '*',
        );
        $terminal = $this->general->get_data_with_param($get_terminal,FALSE);
        $this->data['title'] = "Metropoint - Users";

        $this->data['trip'] = $this->general->get_trips_by_driver_or_conductor($id);
        //print_r($this->data['trip']);
        $this->load->view('driver/index', $this->data);
    }

    public function update_trip_coordinates()
    {
        $id = $_POST['id'];
        $input = array();
        $input['trip_latitude'] = $_POST['lat'];
        $input['trip_longitude'] = $_POST['long'];
        if($this->general->update_($input,$id ,'mp_trips')){
            echo '1';
        }else{
            echo 'error';
        }
    }

}