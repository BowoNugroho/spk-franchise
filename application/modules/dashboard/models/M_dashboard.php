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
}
