<?php
class Bus_model extends CI_Model {

    public $table = 'mp_bus';

    public function get_all_bus()
    {
        $this->db->from($this->table);
        $this->db->select('mp_bus.*,mp_bus_types.name as bus_type,mp_engine_types.name as engine_type');
        $this->db->join('mp_bus_types', 'mp_bus_types.id = mp_bus.bus_type_id','left');
        $this->db->join('mp_engine_types', 'mp_engine_types.id = mp_bus.engine_type_id','left');
        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_all_bus_available($id=null)
    {
        $this->db->from($this->table);
        $this->db->select('mp_bus.*,mp_bus_types.name as bus_type,mp_engine_types.name as engine_type,mp_bus_types.name_alias as bus_type_alias');
        $this->db->join('mp_bus_types', 'mp_bus_types.id = mp_bus.bus_type_id','left');
        $this->db->join('mp_engine_types', 'mp_engine_types.id = mp_bus.engine_type_id','left');
        $this->db->order_by('id', "DESC");
        $this->db->where("mp_bus.trip_status", 0);
        $this->db->where("mp_bus.status", 0);
        $this->db->where("mp_bus.assigned_driver !=", 0);
        $this->db->where("mp_bus.assigned_conductor !=", 0);
        if($id != null){
            $this->db->where("mp_bus.id", $id);
        }
        $query = $this->db->get();
        if($id != null){
            return $query->row();
        }
        return $query->result();
    }
}