<?php
class M_jadwal extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $sql = "SELECT a.* , b.anggota_nm
        FROM jadwal_ronda a 
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

    public function save_jadwal()
    {
        $data = $this->input->post();
        $date_now = date('Y-m-d');

        if ($data['jadwal_id'] == '') {
            $get_pengurus = $this->db->where('DATE(created_at)', $date_now)->order_by('jadwal_id', 'DESC')->get('jadwal_ronda')->row_array();
            if ($get_pengurus == null) {
                $data['jadwal_id'] = date('ymd') . '0001';
            } else {
                $data['jadwal_id'] = $get_pengurus['jadwal_id'] + 1;
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata('username');
            $this->db->insert('jadwal_ronda', $data);
        } else {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->session->userdata('username');
            $this->db->where('jadwal_id', $data['jadwal_id'])->update('jadwal_ronda', $data);
        }
    }
    public function getJadwalById($id = '')
    {
        $sql = "SELECT a.* 
                FROM jadwal_ronda a 
                WHERE a.jadwal_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deleteJadwalById($id)
    {
        $this->db->where('jadwal_id', $id);
        $this->db->delete('jadwal_ronda');
    }
}
