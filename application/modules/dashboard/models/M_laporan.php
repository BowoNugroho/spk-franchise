<?php
class M_laporan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $data = $this->input->post();
        $tgl1 = $data['tgl1'];
        $tgl2 = $data['tgl2'];
        $sql =
            "SELECT a.created_at  ,a.transaksikas_id, a.tgl_catat, sum(a.jumlah_transaksi) as jumlah_pemasukan
            FROM dat_transaksi_kas a 
            WHERE a.tgl_catat BETWEEN  '$tgl1'  AND '$tgl2'
            GROUP BY a.tgl_catat
            ORDER BY a.created_at  asc";
        $query = $this->db->query($sql);
        $row1 = $query->result_array();
        $sql =
            "SELECT a.created_at  ,a.pengeluaran_id , a.tgl_catat , sum(a.jml_pengeluaran) as jumlah_pengeluaran
            FROM dat_pengeluaran a 
            WHERE a.asal = 'Kas' AND  a.tgl_catat BETWEEN  '$tgl1'  AND '$tgl2'
            GROUP BY a.tgl_catat
            ORDER BY a.created_at  asc";
        $query = $this->db->query($sql);
        $row2 = $query->result_array();

        $hasil = array_merge($row1, $row2);
        return  $hasil;
    }
    public function list_jimpitan()
    {
        $data = $this->input->post();
        $tgl1 = $data['tgl1'];
        $tgl2 = $data['tgl2'];
        $sql =
            "SELECT a.created_at  ,a.transaksijimpitan_id, a.tgl_catat, sum(a.jumlah_transaksi) as jumlah_pemasukan
            FROM dat_transaksi_jimpitan a 
            WHERE a.tgl_catat BETWEEN  '$tgl1'  AND '$tgl2'
            GROUP BY a.tgl_catat
            ORDER BY a.created_at  asc";
        $query = $this->db->query($sql);
        $row1 = $query->result_array();
        $sql =
            "SELECT a.created_at  ,a.pengeluaran_id , a.tgl_catat , sum(a.jml_pengeluaran) as jumlah_pengeluaran
            FROM dat_pengeluaran a 
            WHERE a.asal = 'Jimpitan' AND  a.tgl_catat BETWEEN  '$tgl1'  AND '$tgl2'
            GROUP BY a.tgl_catat
            ORDER BY a.created_at  asc";
        $query = $this->db->query($sql);
        $row2 = $query->result_array();

        $hasil = array_merge($row1, $row2);
        return  $hasil;
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
