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

    public function save_anggota()
    {
        $data = $this->input->post();
        $date_now = date('Y-m-d');

        $data['tgl_catat'] =  $date_now;
        $data['anggota_nm'] =  strtoupper($data['anggota_nm']);
        if ($data['anggota_id'] == '') {
            $get_anggota = $this->db->where('tgl_catat', $date_now)->order_by('anggota_id', 'DESC')->get('anggota')->row_array();
            if ($get_anggota == null) {
                $data['anggota_id'] = date('ymd') . '0001';
            } else {
                $data['anggota_id'] = $get_anggota['anggota_id'] + 1;
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata('username');
            $this->db->insert('mst_anggota', $data);
        } else {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->session->userdata('username');
            $this->db->where('anggota_id', $data['anggota_id'])->update('mst_anggota', $data);
        }
    }
    public function getAnggotaById($id = '')
    {
        $sql = "SELECT a.* 
                FROM mst_anggota a 
                WHERE a.anggota_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deleteAnggotaById($id)
    {
        $this->db->where('anggota_id', $id);
        $this->db->delete('mst_anggota');
    }
}
