<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus extends MY_Controller
{
    var $menu_id = '02.01', $menu, $cookie;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'management/m_menu',
            'm_pengurus'
        ));

        $this->menu = $this->m_menu->_getMenu($this->menu_id);

        //cookie
        $this->cookie = getCookieMenu($this->menu_id);
        if ($this->cookie['search'] == null) $this->cookie['search'] = array('term' => '', 'menu_nm' => '');
        if ($this->cookie['order'] == null) $this->cookie['order'] = array('field' => 'menu_id', 'type' => 'asc');
        if ($this->cookie['per_page'] == null) $this->cookie['per_page'] = 1000;
        if ($this->cookie['cur_page'] == null) $this->cookie['cur_page'] = 0;
    }
    public function index()
    {
        //main data
        $data['menu'] = $this->menu;
        $data['main'] = $this->m_pengurus->list_data();
        $data['user'] = $this->m_pengurus->get_user();
        // echo "<pre>";
        // var_dump($data['user']);
        // die;
        $data['anggota'] = $this->m_pengurus->get_anggota();
        $this->render('pengurus/index', $data);
    }
    public function saveAnggota()
    {
        $this->form_validation->set_rules('anggota_nm', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('no_rumah', 'No Rumah', 'required');
        $this->form_validation->set_rules('no_tlp', 'Nomor Telepon', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_pengurus->save_anggota();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'anggota_nm_error' => form_error('anggota_nm'),
                'no_rumah_error' => form_error('no_rumah'),
                'no_tlp_error' => form_error('no_tlp'),

            ];
            echo json_encode($data);
        }
    }
    public function getAnggotaById($id)
    {
        $data = $this->m_pengurus->getAnggotaById($id);
        echo json_encode($data);
    }
    public function updateAnggota()
    {
        $this->form_validation->set_rules('anggota_nm', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('no_rumah', 'No Rumah', 'required');
        $this->form_validation->set_rules('no_tlp', 'Nomor Telepon', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_pengurus->save_anggota();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'anggota_nm_error' => form_error('anggota_nm'),
                'no_rumah_error' => form_error('no_rumah'),
                'no_tlp_error' => form_error('no_tlp'),

            ];
            echo json_encode($data);
        }
    }
    public function deleteAnggota($id)
    {
        $data = $this->m_pengurus->deleteAnggotaById($id);
        echo json_encode($data);
    }
}
