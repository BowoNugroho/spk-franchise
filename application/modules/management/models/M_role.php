<?php
class M_role extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $sql = "SELECT a.* 
        FROM role a ";
        $query = $this->db->query($sql,);
        return $query->result_array();
    }

    public function save_role()
    {
        $data = $this->input->post();
        if ($data['role_id'] == '') {
            $get = $this->db->order_by('role_id', 'DESC')->get('role')->row_array();
            $data['role_id'] = $get['role_id'] + 1;
            $this->db->insert('role', $data);
        } else {
            $this->db->where('role_id', $data['role_id'])->update('role', $data);
        }
    }
    public function getRoleById($id = '')
    {
        $sql = "SELECT a.* 
                FROM role a 
                WHERE a.role_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deleteRoleById($id)
    {
        $this->db->where('role_id', $id);
        $this->db->delete('role');
    }
}
