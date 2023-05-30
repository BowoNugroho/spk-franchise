<?php
class M_kas extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $sql = "SELECT a.* , b.anggota_nm , c.anggota_nm as petugas_nm, d.tipe_transaksi
        FROM dat_transaksi_kas a 
        LEFT JOIN mst_anggota b ON a.anggota_id = b.anggota_id
        LEFT JOIN mst_anggota c ON a.petugas_catat_id = c.anggota_id
        LEFT JOIN tipe_transaksi d ON a.transaksi_id = d.transaksi_id";
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

    public function save_kas()
    {
        $data = $this->input->post();
        $date_now = date('Y-m-d');

        if ($data['transaksikas_id'] == '') {
            $get_pengurus = $this->db->where('DATE(created_at)', $date_now)->order_by('transaksikas_id', 'DESC')->get('dat_transaksi_kas')->row_array();
            if ($get_pengurus == null) {
                $data['transaksikas_id'] = date('ymd') . '0001';
            } else {
                $data['transaksikas_id'] = $get_pengurus['transaksikas_id'] + 1;
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata('username');
            $this->db->insert('dat_transaksi_kas', $data);
        } else {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->session->userdata('username');
            $this->db->where('transaksikas_id', $data['transaksikas_id'])->update('dat_transaksi_kas', $data);
        }
    }
    public function getKasById($id = '')
    {
        $sql = "SELECT a.* 
                FROM dat_transaksi_kas a 
                WHERE a.transaksikas_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deleteKasById($id)
    {
        $this->db->where('transaksikas_id', $id);
        $this->db->delete('dat_transaksi_kas');
    }
}
