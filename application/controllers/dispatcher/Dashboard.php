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

        //echo $terminal->descrip;
        $this->data['torno'] = $this->general->get_row_count_upgraded($terminal->descrip);

        $get_road_count = array(
            'where' => array(
                'que_stat_arr_id' => 2,
                'to_ter' => $terminal->descrip,
            ),
            'table' => 'que_details',
        );
        $this->data['on_road'] = $this->general->get_row_count($get_road_count);

        $get_arrived_count = array(
            'where' => array(
                'que_stat_arr_id' => 1,
                'from_ter' => $terminal->descrip,
            ),
            'table' => 'que_details',
        );
        $this->data['arrived'] = $this->general->get_row_count($get_arrived_count);


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
        $base_terminal_id = $_SESSION['user']->ter_id;

        $get_terminal = array(
            'where' => array(
                'ter_id' => $base_terminal_id,
            ),
            'table' => 'ter_details',
            'select' => '*',
        );
        $terminal = $this->general->get_data_with_param($get_terminal,FALSE);
        //echo $terminal->name;

        $this->data['title'] = "Metropoint - Users";

        $get_trips = array(
            'where' => array(
                'que_details.que_stat_id' => $status,
                'que_details.from_ter' => $terminal->descrip,
            ),
            'table' => 'que_details',
            'select' => '*,que_details.que_id as trip_id,que_details.que_stat_id as trip_status',
            'order' => array(
                'order_by' => 'que_details.que_id',
                'ordering' => 'DESC',
            ),
        );
        $this->data['trips'] = $this->general->get_data_with_param($get_trips);
        $this->load->view('dispatcher/view', $this->data);
    }

    public function arrived($status=null)
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
        //echo $terminal->name;

        $this->data['title'] = "Metropoint - Users";

        $get_trips = array(
            'where' => array(
                'que_details.que_stat_arr_id' => 1,
                'que_details.from_ter' => $terminal->descrip,
            ),
            'table' => 'que_details',
            'select' => '*,que_details.que_id as trip_id,que_details.que_stat_id as trip_status',
            'order' => array(
                'order_by' => 'que_details.que_id',
                'ordering' => 'DESC',
            ),
        );
        $this->data['trips'] = $this->general->get_data_with_param($get_trips);
        $this->load->view('dispatcher/view', $this->data);
    }

    public function incoming()
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
        //echo $terminal->name;

        $this->data['title'] = "Metropoint - Users";

        $get_trips = array(
            'where' => array(
                'que_details.que_stat_arr_id' => 2,
                'que_details.to_ter' => $terminal->descrip,
            ),
            'table' => 'que_details',
            'select' => '*,que_details.que_id as trip_id,que_details.que_stat_id as trip_status',
            'order' => array(
                'order_by' => 'que_details.que_id',
                'ordering' => 'DESC',
            ),
        );
        $this->data['trips'] = $this->general->get_data_with_param($get_trips);

        $this->load->view('dispatcher/view', $this->data);
    }


   public function change_status(){
        $id = $_POST['id'];
        $bus_no = $_POST['busNo'];
        $bus_status_update = array(
            'que_stat_arr_id' => 1,
            'arr_date' => date('Y-m-d'),
            'arr_time' =>  date('H:i:s'),
        );
        if($this->general->update_que($bus_status_update,$id,'que_details')){
            echo '1';
        }

       $bus_status_ = array(
           'trip_stat_id' => 0,
       );
       $this->general->update_bus_stat($bus_status_,$bus_no,'bus_details');

       $dri_status = array(
           'trip_stat_id' => 0,
       );
       $this->general->update_driv_con_stat($dri_status,$_POST['driId'],'user_dri','dri_id');

       $con_status = array(
           'trip_stat_id' => 0,
       );
       $this->general->update_driv_con_stat($con_status,$_POST['conId'],'user_con','con_id');

   }

    public function change_status_depart(){
        $id = $_POST['id'];
        $bus_status_update = array(
            'que_stat_id' => 1,
            'que_stat_arr_id' => 2,
            'dep_date' => date('Y-m-d'),
            'dep_time' =>  date('H:i:s'),
        );
        if($this->general->update_que($bus_status_update,$id,'que_details')){
            echo '1';
        }
    }

    public function delete_trip() {
        $remove_trip = array(
            'where' => array(
                'id' => $_POST['id']
            ),
            'table' => 'que_details'
        );
        if($this->general->delete_($remove_trip)){
            echo '1';
        }
    }
}