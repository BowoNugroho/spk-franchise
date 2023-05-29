<?php
class M_pengurus extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $sql = "SELECT a.* , b.anggota_nm
        FROM dat_pengurus a 
        LEFT JOIN mst_anggota b ON a.anggota_id = b.anggota_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function get_user()
    {
        $sql = "SELECT a.* 
        FROM user a ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function get_anggota()
    {
        $sql = "SELECT a.* 
        FROM mst_anggota a ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function save_pengurus()
    {
        $data = $this->input->post();
        $date_now = date('Y-m-d');

        if ($data['pengurus_id'] == '') {
            $get_pengurus = $this->db->where('DATE(created_at)', $date_now)->order_by('pengurus_id', 'DESC')->get('dat_pengurus')->row_array();
            if ($get_pengurus == null) {
                $data['pengurus_id'] = date('ymd') . '0001';
            } else {
                $data['pengurus_id'] = $get_pengurus['pengurus_id'] + 1;
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata('username');
            $this->db->insert('dat_pengurus', $data);
        } else {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->session->userdata('username');
            $this->db->where('pengurus_id', $data['pengurus_id'])->update('dat_pengurus', $data);
        }
    }
    public function getPengurusById($id = '')
    {
        $sql = "SELECT a.* 
                FROM dat_pengurus a 
                WHERE a.pengurus_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deletePengurusById($id)
    {
        $this->db->where('pengurus_id', $id);
        $this->db->delete('dat_pengurus');
    }
}
