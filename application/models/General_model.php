<?php

class General_model extends CI_Model {

    public function get_all_with_keys($params = array(),$tablename,$result=TRUE){
        $this->db->select('*');
        $this->db->from($tablename);

        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        $query = $this->db->get();
        if($result){
            return $query->result();
        }else{
            return $query->row();
        }
    }

    public function get_data_with_param($params = array(),$result=TRUE){

        if(array_key_exists("table",$params) && $params['table'] != NULL ){
            $this->db->from($params['table']);
        }else{
            return FALSE;
        }

        if(array_key_exists("select",$params) && $params['select'] != NULL ){
            $this->db->select($params['select']);
        }else{
            $this->db->select('*');
        }

        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }

        if(array_key_exists("or_where", $params)){
            foreach($params['or_where'] as $key => $val){
                $this->db->or_where($key, $val);
            }
        }

        if(array_key_exists("join",$params) && $params['join'] != NULL ){
            $this->db->join($params['join']['table'], $params['join']['statement'],$params['join']['join_as']);
        }

        if(array_key_exists("order",$params)){
            if(isset($params['order']['ordering'])){
                $this->db->order_by($params['order']['order_by'], $params['order']['ordering']);
            }else{
                $this->db->order_by($params['order']['order_by'], "DESC");
            }
        }

        if(array_key_exists("limit", $params)){
            $this->db->limit($params['limit']);
        }
       // $this->db->where('prof_id', $params['where']['prof_id']);
        $query = $this->db->get();
        if($result){
            return $query->result();
        } else{
            return $query->row();
        }
    }

    public function get_row_count($params = array())
    {
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }

        if(array_key_exists("table",$params) && $params['table'] != NULL ){
            $this->db->from($params['table']);
        }else{
            return FALSE;
        }

        $query = $this->db->count_all_results();
        return $query;
    }

    public function get_user_operator_dispatcher($terminalId=null)
    {
        $this->db->from('mp_users');
        $this->db->select('*,mp_users.id as user_id');
        $this->db->join('mp_terminals', 'mp_users.base_terminal = mp_terminals.id','left');
        $this->db->where("(mp_users.user_type=2 OR mp_users.user_type=3) AND mp_users.base_terminal=".$terminalId, NULL, FALSE);
        //$this->db->where("mp_users.base_terminal", $terminalId);
        $this->db->order_by('mp_users.id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_user_driver_conductor($terminalId=null)
    {
        $this->db->from('mp_users');
        $this->db->select('*,mp_users.id as user_id');
        $this->db->join('mp_terminals', 'mp_terminals.id = mp_users.base_terminal','left');
        $this->db->where("(mp_users.user_type=4 OR mp_users.user_type=5)", NULL, FALSE);
        //$this->db->where("mp_users.base_terminal", $terminalId);
        //$this->db->where("mp_users.base_terminal", $terminalId);
        $this->db->order_by('mp_users.id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_($params = array()) {
        if(array_key_exists("where", $params)){
            foreach($params['where'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        // Execute delete.
        if ($this->db->delete($params['table']))
            return true;
        else
            return false;
    }

    public function update_($input, $id,$table)
    {
        //$input['date_modified'] = date('Y-m-d H:i:s');;
        if ($this->db->update($table, $input, array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function update_with_key_field($input, $id,$table,$field)
    {
        //$input['date_modified'] = date('Y-m-d H:i:s');;
        if ($this->db->update($table, $input, array($field => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function add_($input,$table)
    {
        if($this->db->insert($table,$input)){
            return true;
        }else{
            return false;
        }
    }

    public function add_return_id($input,$table)
    {
        if($this->db->insert($table,$input)){
            return $this->db->insert_id();
        }else{
            return false;
        }
    }
}
