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
}