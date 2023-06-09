<?php
class M_user extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $sql = "SELECT a.* , b.role_nm
        FROM user a 
        LEFT JOIN role b ON a.role_id = b.role_id";
        $query = $this->db->query($sql,);
        return $query->result_array();
    }
    public function get_role()
    {
        $sql = "SELECT a.* 
        FROM role a ";
        $query = $this->db->query($sql,);
        return $query->result_array();
    }

    public function save_user()
    {
        $data = $this->input->post();
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['is_active'] = '1';
        $data['image'] = 'default.jpg';
        if ($data['user_id'] == '') {
            $get = $this->db->order_by('user_id', 'DESC')->get('user')->row_array();
            $data['user_id'] = $get['user_id'] + 1;
            $this->db->insert('user', $data);
        } else {
            $this->db->where('user_id', $data['user_id'])->update('user', $data);
        }
    }
    public function getUserById($id = '')
    {
        $sql = "SELECT a.* 
                FROM user a 
                WHERE a.user_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deleteUserById($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }
}
