<?php
class M_kriteria extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $sql = "SELECT a.* 
        FROM kriteria a ";
        $query = $this->db->query($sql,);
        return $query->result_array();
    }
    public function get_role()
    {
        $sql = "SELECT a.* 
        FROM role a ";
        $query = $this->db->query($sql,);
        return $query->result_array();
    }

    public function save_kriteria()
    {
        $data = $this->input->post();
        if ($data['kriteria_id'] == '') {
            $get = $this->db->order_by('kriteria_id', 'DESC')->get('kriteria')->row_array();
            if ($get == null) {
                $data['kriteria_id'] = '0001';
            } else {
                $dt = date('ymd') . $get['kriteria_id'];
                $id =  $dt  + '1';
                $data['kriteria_id'] = substr($id, 6);
            }
            $this->db->insert('kriteria', $data);
        } else {
            $this->db->where('kriteria_id', $data['kriteria_id'])->update('kriteria', $data);
        }
    }
    public function getKriteriaById($id = '')
    {
        $sql = "SELECT a.* 
                FROM kriteria a 
                WHERE a.kriteria_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deleteKriteriaById($id)
    {
        $this->db->where('kriteria_id', $id);
        $this->db->delete('kriteria');
    }
}
