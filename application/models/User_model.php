<?php 

class User_model extends MY_Model {

    private $table = 'users';

    public function toggleActive($id)
    {

        $res = $this->db->query("UPDATE " . $this->table . " SET active = !active WHERE id = {$id}");

        return $res;
    }
}