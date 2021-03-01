<?php defined('BASEPATH') OR exit('No direct script access allowed');

function routes($is_count=FALSE){
    $name_suffix = array('Davao','Tagum','New Bataan', 'Maragusan', 'Nabunturan','Laak','Monkayo','Compostela');
    if($is_count){
        return count($name_suffix);
    }
    return $name_suffix;
}