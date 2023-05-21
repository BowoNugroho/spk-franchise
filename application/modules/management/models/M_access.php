<?php
class M_access extends CI_Model
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
    public function get_data_menu($id = '')
    {
        $sql = "SELECT a.* 
        FROM menu a ";
        $query = $this->db->query($sql,);
        return $query->result_array();
    }
    public function save_role()
    {
        $data = $this->input->post();
        if ($data['role_id'] == '') {
            $data['created_at'] =   date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata('username');
            $this->db->insert('role', $data);
        } else {
            $data['updated_at'] =   date('Y-m-d H:i:s');
            $data['updated_by'] = $this->session->userdata('username');
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
