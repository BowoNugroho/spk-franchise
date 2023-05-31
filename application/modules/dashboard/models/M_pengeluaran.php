<?php
class M_pengeluaran extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $sql =
            "SELECT a.* , b.anggota_nm as petugas_nm
            FROM dat_pengeluaran a 
            LEFT JOIN mst_anggota b ON a.petugas_catat_id = b.anggota_id
            ORDER BY a.tgl_catat ASC";
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

    public function save_pengeluaran()
    {
        $data = $this->input->post();
        $date_now = date('Y-m-d');

        if ($data['pengeluaran_id'] == '') {
            $get_pengeluaran = $this->db->where('DATE(created_at)', $date_now)->order_by('pengeluaran_id', 'DESC')->get('dat_pengeluaran')->row_array();
            if ($get_pengeluaran == null) {
                $data['pengeluaran_id'] = date('ymd') . '0001';
            } else {
                $data['pengeluaran_id'] = $get_pengeluaran['pengeluaran_id'] + 1;
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata('username');
            $this->db->insert('dat_pengeluaran', $data);
        } else {
            $data['updated_at'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->session->userdata('username');
            $this->db->where('pengeluaran_id', $data['pengeluaran_id'])->update('dat_pengeluaran', $data);
        }
    }
    public function getPengeluaranById($id = '')
    {
        $sql = "SELECT a.* 
                FROM dat_pengeluaran a 
                WHERE a.pengeluaran_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deletePengeluaranById($id)
    {
        $this->db->where('pengeluaran_id', $id);
        $this->db->delete('dat_pengeluaran');
    }
}
