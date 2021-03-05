<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    protected $data = array();
    protected $settings = array();

    function __construct()
    {
        parent::__construct();
        $uri = uri_string()==NULL? '/':uri_string();
        define('DS','/');
        define('ASSETS_PATH', base_url() . 'assets' . DS);
        define('DIRECTORY', rtrim($this->router->fetch_directory(),'/'));
        define('CONTROLLER', $this->router->fetch_class());
        define('METHOD', $this->router->fetch_method());
        if(isset($_SESSION['user'])){
//            $this->data['users_data'] = $this->users->get_details($_SESSION['user']->user_id,'user_id');
//            if($_SESSION['user']->role == 'Admin'){
//                $this->data['admin_settings'] = $this->general_model->get_details($_SESSION['user']->id,'fk_user_id','rv_admin_settings');
//            }
            //$data =  $_SESSION['user'];
            //$id = $data->email_address;
        }else{
            redirect(base_url('auth/login'));
        }
    }
}