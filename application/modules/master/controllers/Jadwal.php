<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends MY_Controller
{
    var $menu_id = '02.03', $menu, $cookie;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'management/m_menu',
            'm_jadwal'
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
        $data['main'] = $this->m_jadwal->list_data();
        // $data['user'] = $this->m_jadwal->get_user();
        // echo "<pre>";
        // var_dump($data['user']);
        // die;
        $data['anggota'] = $this->m_jadwal->get_anggota();
        $this->render('jadwal/index', $data);
    }
    public function saveJadwal()
    {
        $this->form_validation->set_rules('anggota_id', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('hari_ronda', 'Hari Ronda', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_jadwal->save_jadwal();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'anggota_id_error' => form_error('anggota_id'),
                'hari_ronda_error' => form_error('hari_ronda'),
                'keterangan_error' => form_error('keterangan'),

            ];
            echo json_encode($data);
        }
    }
    public function getJadwalById($id)
    {
        $data = $this->m_jadwal->getJadwalById($id);
        echo json_encode($data);
    }
    public function updatePengurus()
    {
        $this->form_validation->set_rules('anggota_id', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('hari_ronda', 'Hari Ronda', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_jadwal->save_jadwal();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'anggota_id_error' => form_error('anggota_id'),
                'hari_ronda_error' => form_error('hari_ronda'),
                'keterangan_error' => form_error('keterangan'),

            ];
            echo json_encode($data);
        }
    }
    public function deleteJadwak($id)
    {
        $data = $this->m_jadwal->deleteJadwalById($id);
        echo json_encode($data);
    }
}
