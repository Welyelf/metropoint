<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller
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

        $get_terminal = array(
            'where' => array(
                'id' => $base_terminal_id,
            ),
            'table' => 'mp_terminals',
            'select' => '*',
        );
        $terminal = $this->general->get_data_with_param($get_terminal,FALSE);

        $this->data['title'] = "Metropoint - Admin Dashboard";

        $get_users = array(
            'where' => array(
                'trip_terminal_id' => $base_terminal_id,
                'mp_trips.status' => 0,
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
        $this->data['departures'] = $this->general->get_data_with_param($get_users);


        $get_arrival = array(
            'where' => array(
                'trip_to' => $terminal->name,
                'mp_trips.status' => 2,
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
        $this->data['arrivals'] = $this->general->get_data_with_param($get_arrival);


        $get_bus_count = array(
            'table' => 'mp_bus',
        );
        $this->data['buses'] = $this->general->get_row_count($get_bus_count);

        $get_bus_active = array(
            'where' => array(
                'status' => 0,
            ),
            'table' => 'mp_bus',
        );
        $this->data['bus_active'] = $this->general->get_row_count($get_bus_active);

        $get_bus_inactive = array(
            'where' => array(
                'status' => 1,
            ),
            'table' => 'mp_bus',
        );
        $this->data['bus_inactive'] = $this->general->get_row_count($get_bus_inactive);

        $get_bus_onshop = array(
            'where' => array(
                'status' => 2,
            ),
            'table' => 'mp_bus',
        );
        $this->data['bus_onshop'] = $this->general->get_row_count($get_bus_onshop);

        $get_bus_orental = array(
            'where' => array(
                'status' => 3,
            ),
            'table' => 'mp_bus',
        );
        $this->data['bus_rental'] = $this->general->get_row_count($get_bus_orental);


        $get_bus_driver = array(
            'where' => array(
                'assigned_driver' => 0,
            ),
            'table' => 'mp_bus',
        );
        $this->data['bus_no_driver'] = $this->general->get_row_count($get_bus_driver);

        $get_bus_conductor = array(
            'where' => array(
                'assigned_conductor' => 0,
            ),
            'table' => 'mp_bus',
        );
        $this->data['bus_no_conductor'] = $this->general->get_row_count($get_bus_conductor);


        $this->load->view('admin/dashboard/index', $this->data);
    }
}