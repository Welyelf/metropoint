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