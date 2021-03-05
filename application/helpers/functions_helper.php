<?php defined('BASEPATH') OR exit('No direct script access allowed');

function routes($is_count=FALSE){
    $name_suffix = array('Davao','Tagum','New Bataan', 'Maragusan', 'Nabunturan','Laak','Monkayo','Compostela');
    if($is_count){
        return count($name_suffix);
    }
    return $name_suffix;
}

function employment_status($index=0){
    $status = array('Regular','Casual','Terminated','Suspended');
    if($index<0 || $index>=count($status)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $status[$index];
}

function user_types($index=0){
    $types = array('SuperAdmin','Admin','Operator','Dispatcher','Driver','Conductor');
    if($index<0 || $index>=count($types)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $types[$index];
}

function bus_status($index=0){
    $types = array('Active','InActive','OnShop','Rental');
    if($index<0 || $index>=count($types)){
        $index=0;
    }else if(!is_int($index)){
        $index=0;
    }
    return $types[$index];
}

if (!function_exists('get_user_data')){
    function get_user_data($id=null){
        $CI = &get_instance();
        $CI->load->model('General_model', 'general');
        $get_employee = array(
            'where' => array(
                'id' => $id
            ),
            'table' => 'mp_users',
            'select' => 'id,firstname,lastname',
        );
        //$this->page_data['employees'] = $this->general->get_data_with_param($get_employee);
        return $CI->general->get_data_with_param($get_employee,FALSE);
    }
}