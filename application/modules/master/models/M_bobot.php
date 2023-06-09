<?php
class M_bobot extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $sql = "SELECT a.* ,b.kriteria_nm
        FROM bobot a 
        LEFT JOIN kriteria b ON a.kriteria_id = b.kriteria_id";
        $query = $this->db->query($sql,);
        return $query->result_array();
    }
    public function get_kriteria()
    {
        $sql = "SELECT a.* 
        FROM kriteria a ";
        $query = $this->db->query($sql,);
        return $query->result_array();
    }

    public function save_bobot()
    {
        $data = $this->input->post();
        if ($data['bobot_id'] == '') {
            $get = $this->db->where('kriteria_id', $data['kriteria_id'])->order_by('bobot_id', 'DESC')->get('bobot')->row_array();
            if ($get == null) {
                $data['bobot_id'] = $data['kriteria_id']  . '.' .  '.0001';
            } else {
                $explode = explode('.', $get['bobot_id']);
                $plus = date('ymd') . $explode[1];
                $id =   $plus + '1';
                $replace = substr($id, 6);
                $data['bobot_id'] = $data['kriteria_id'] . '.' .  $replace;
            }
            
            $this->db->insert('bobot', $data);
        } else {
            $this->db->where('bobot_id', $data['bobot_id'])->update('bobot', $data);
        }
    }
    public function getBobotById($id = '')
    {
        $sql = "SELECT a.* ,b.kriteria_nm
                FROM bobot a 
                LEFT JOIN kriteria b ON a.kriteria_id = b.kriteria_id
                WHERE a.bobot_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deleteBobotById($id)
    {
        $this->db->where('bobot_id', $id);
        $this->db->delete('bobot');
    }
}
