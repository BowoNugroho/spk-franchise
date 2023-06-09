<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kriteria extends MY_Controller
{
    var $menu_id = '02.02', $menu, $cookie;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'management/m_menu',
            'm_kriteria',
        ));

        $this->menu = $this->m_menu->_getMenu($this->menu_id);

        //cookie
        $this->cookie = getCookieMenu($this->menu_id);
        if ($this->cookie['search'] == null) $this->cookie['search'] = array('term' => '', 'nama add ' => '');
        if ($this->cookie['order'] == null) $this->cookie['order'] = array('field' => 'role_id', 'type' => 'asc');
        if ($this->cookie['per_page'] == null) $this->cookie['per_page'] = 1000;
        if ($this->cookie['cur_page'] == null) $this->cookie['cur_page'] = 0;
    }
    public function index()
    {
        //main data
        $data['menu'] = $this->menu;
        $data['main'] = $this->m_kriteria->list_data();
        $data['role'] = $this->m_kriteria->get_role();
        $this->render('kriteria/index', $data);
    }
    public function saveKriteria()
    {
        $this->form_validation->set_rules('kriteria_nm', 'Nama Kriteria', 'required');
        $this->form_validation->set_rules('kriteria_kode', 'Kode Kriteria', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_kriteria->save_kriteria();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'kriteria_nm_error' => form_error('kriteria_nm'),
                'kriteria_kode_error' => form_error('kriteria_kode'),

            ];
            echo json_encode($data);
        }
    }
    public function getKriteriaById($id)
    {
        $data = $this->m_kriteria->getKriteriaById($id);
        echo json_encode($data);
    }
    public function updateKriteria()
    {
        $this->form_validation->set_rules('kriteria_nm', 'Nama Kriteria', 'required');
        $this->form_validation->set_rules('kriteria_kode', 'Kode Kriteria', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_kriteria->save_kriteria();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'kriteria_nm_error' => form_error('kriteria_nm'),
                'kriteria_kode_error' => form_error('kriteria_kode'),

            ];
            echo json_encode($data);
        }
    }
    public function deleteKriteria($id)
    {
        $data = $this->m_kriteria->deleteKriteriaById($id);
        echo json_encode($data);
    }
}
