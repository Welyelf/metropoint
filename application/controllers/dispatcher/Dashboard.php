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
        $get_terminal = array(
            'where' => array(
                'ter_id' => $base_terminal_id,
            ),
            'table' => 'ter_details',
            'select' => '*',
        );
        $terminal = $this->general->get_data_with_param($get_terminal,FALSE);
        $this->data['terminal_data'] = $terminal;

        $this->data['title'] = "Metropoint - Users";
        $get_waiting_count = array(
            'where' => array(
                'que_stat_id' => 0,
                'from_ter' => $terminal->descrip,
            ),
            'table' => 'que_details',
        );
        $this->data['waiting'] = $this->general->get_row_count($get_waiting_count);

        $get_torno_count = array(
            'where' => array(
                'que_stat_id' => 1,
                'from_ter' => $terminal->descrip,
            ),
            'table' => 'que_details',
        );
        $this->data['torno'] = $this->general->get_row_count($get_torno_count);

        $get_road_count = array(
            'where' => array(
                'que_stat_id' => 1,
                'to_ter' => $terminal->descrip,
            ),
            'table' => 'que_details',
        );
        $this->data['on_road'] = $this->general->get_row_count($get_road_count);

        $get_arrived_count = array(
            'where' => array(
                'que_stat_id' => 3,
                'from_ter' => $terminal->descrip,
            ),
            'table' => 'que_details',
        );
        $this->data['arrived'] = $this->general->get_row_count($get_arrived_count);

        $get_incoming = array(
            'where' => array(
                'que_stat_id' => 3,
                'to_ter' => $terminal->descrip,
            ),
            'table' => 'que_details',
        );
        $this->data['incoming'] = $this->general->get_row_count($get_incoming);

//        $get_trips = array(
//            'where' => array(
//                'trip_terminal_id' => $base_terminal_id,
//            ),
//            'table' => 'mp_trips',
//            'select' => '*,mp_trips.id as trip_id,mp_trips.status as trip_status',
//            'join' => array(
//                'table' => 'mp_bus',
//                'statement' => 'mp_bus.id=mp_trips.trip_bus_id',
//                'join_as' => 'left',
//            ),
//            'order' => array(
//                'order_by' => 'mp_trips.id',
//                'ordering' => 'DESC',
//            ),
//        );
//        $this->data['trips'] = $this->general->get_data_with_param($get_trips);

        $this->load->view('dispatcher/index', $this->data);
    }

    public function view($status=null)
    {
        if($status == null){
            redirect(base_url('dispatcher/dashboard/'));
        }
        $base_terminal_id = $_SESSION['user']->base_terminal;

        $get_terminal = array(
            'where' => array(
                'id' => $base_terminal_id,
            ),
            'table' => 'mp_terminals',
            'select' => '*',
        );
        $terminal = $this->general->get_data_with_param($get_terminal,FALSE);
        //echo $terminal->name;

        $this->data['title'] = "Metropoint - Users";

        $get_trips = array(
            'where' => array(
                'mp_trips.status' => $status,
                //'trip_to' => $terminal->name,
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
        $this->data['trips'] = $this->general->get_data_with_param($get_trips);
        $this->load->view('dispatcher/view', $this->data);
    }

    public function incoming()
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
        //echo $terminal->name;

        $this->data['title'] = "Metropoint - Users";

        $get_trips = array(
            'where' => array(
                'mp_trips.status' => 2,
                'trip_to' => $terminal->name,
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
        $this->data['trips'] = $this->general->get_data_with_param($get_trips);


        $this->load->view('dispatcher/incoming', $this->data);
    }


   public function change_status(){
        $id = $_POST['id'];
        $bus_status_update = array(
            'status' => $_POST['status']
        );
        if($this->general->update_($bus_status_update,$id,'mp_trips')){
            echo '1';
        }
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
}