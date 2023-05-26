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
        $sql = "SELECT  a.*,
                        b.role_id as set_role_id,
                        b.menu_id as set_menu_id,
                        b._view,
                        b._add,
                        b._update,
                        b._delete,
                        (b._view+b._add+b._update+b._delete) as count_rules
                FROM menu a
                LEFT JOIN access_menu b ON a.menu_id=b.menu_id AND b.role_id = $id
                ORDER BY a.menu_id ASC ";
        $query = $this->db->query($sql,);
        $result =  $query->result_array();
        $no = 1;
        foreach ($result as $key => $val) {
            $result[$key]['no'] = $no;
            $result[$key]['cb_all'] = ($result[$key]['count_rules'] == '4' ? 'yes' : 'no');
            $no++;
        }
        return $result;
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

    public function save_change_access()
    {
        $data =  $this->input->post();

        $get_access = $this->db->order_by('access_id', 'DESC')->get('access_menu')->row_array();
        $check = $this->db->where('menu_id', $data['menu_id'])->where('role_id', $data['role_id'])->get('access_menu')->row_array();

        if ($check == null) {
            $data['access_id'] = $get_access['access_id'] + 1;
            $data['menu_id'] = $data['menu_id'];
            $data['role_id'] = $data['role_id'];
            $data['_view'] = '1';
            $data['_add'] = '1';
            $data['_update'] = '1';
            $data['_delete'] = '1';
            $data['created_at'] =   date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata('username');
            $this->db->insert('access_menu', $data);
        } else {
            $this->db->where('menu_id', $data['menu_id'])->where('role_id', $data['role_id'])->delete('access_menu');
        }
    }
}
