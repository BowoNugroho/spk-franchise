<?php
class M_dashboard extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function get_jmlkas()
    {
        $sql = "SELECT SUM(jumlah_transaksi) AS jumlah_transaksi
        FROM dat_transaksi_kas";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function get_pemasukan_kas()
    {
        $date_now = date('Y-m-d');
        $sql = "SELECT SUM(jumlah_transaksi) AS jumlah_transaksi
        FROM dat_transaksi_kas 
        WHERE tgl_catat = '$date_now'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function get_pengeluaran_kas()
    {
        $date_now = date('Y-m-d');
        $sql = "SELECT SUM(jml_pengeluaran) AS jml_pengeluaran
        FROM dat_pengeluaran 
        WHERE tgl_catat = '$date_now' AND asal = 'Kas'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function get_pengeluaran_total_kas()
    {
        $sql = "SELECT SUM(jml_pengeluaran) AS jml_pengeluaran
        FROM dat_pengeluaran 
        WHERE  asal = 'Kas'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function get_jmljimpitan()
    {
        $sql = "SELECT SUM(jumlah_transaksi) AS jumlah_transaksi
        FROM dat_transaksi_jimpitan";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function get_pemasukan_jimpitan()
    {
        $date_now = date('Y-m-d');
        $sql = "SELECT SUM(jumlah_transaksi) AS jumlah_transaksi
        FROM dat_transaksi_jimpitan 
        WHERE tgl_catat = '$date_now'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function get_pengeluaran_jimpitn()
    {
        $date_now = date('Y-m-d');
        $sql = "SELECT SUM(jml_pengeluaran) AS jml_pengeluaran
        FROM dat_pengeluaran 
        WHERE tgl_catat = '$date_now' AND asal = 'Jimpitan'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function get_pengeluaran_total_jimpitan()
    {
        $sql = "SELECT SUM(jml_pengeluaran) AS jml_pengeluaran
        FROM dat_pengeluaran 
        WHERE  asal = 'Jimpitan'";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function get_jadwal_ronda($hari = null)
    {
        $sql = "SELECT  a.* , b.anggota_nm
        FROM jadwal_ronda a
        LEFT JOIN mst_anggota b ON a.anggota_id = b.anggota_id
        WHERE  a.hari_ronda = '$hari'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
