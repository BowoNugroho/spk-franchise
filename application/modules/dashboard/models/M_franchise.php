<?php
class M_franchise extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $user_id = $this->session->userdata('user_id');
        $sql = "SELECT a.* 
        FROM perhitungan a 
        WHERE a.user_id = $user_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function save_perhitungan()
    {
        $data = $this->input->post();
        if ($data['perhitungan_id'] == '') {
            $get = $this->db->order_by('perhitungan_id', 'DESC')->get('perhitungan')->row_array();
            if ($get == null) {
                $data['perhitungan_id'] = date('ymd') . '0001';
            } else {
                $tgl = substr($get['perhitungan_id'], 0, 6);
                if ($tgl != date('ymd')) {
                    $data['perhitungan_id'] = date('ymd') . '0001';
                } else {
                    $data['perhitungan_id'] = $get['perhitungan_id'] + 1;
                }
            }
            $this->db->insert('perhitungan', $data);
        } else {
            $this->db->where('perhitungan_id', $data['perhitungan_id'])->update('perhitungan', $data);
        }
    }
    public function getPerhitunganById($id = '')
    {
        $sql = "SELECT a.* 
                FROM perhitungan a 
                WHERE a.perhitungan_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deletePerhitunganById($id)
    {
        $this->db->where('perhitungan_id', $id);
        $this->db->delete('perhitungan');
    }
}
