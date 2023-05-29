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
        // $data['user'] = $this->m_pengurus->get_user();
        // echo "<pre>";
        // var_dump($data['user']);
        // die;
        $data['anggota'] = $this->m_pengurus->get_anggota();
        $this->render('pengurus/index', $data);
    }
    public function savePengurus()
    {
        $this->form_validation->set_rules('anggota_id', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('masa_jabatan', 'Masa Jabatan', 'required');
        $this->form_validation->set_rules('tgl_awal_jabatan', 'Tanggal Awal Jabatan', 'required');
        $this->form_validation->set_rules('tgl_akhir_jabatan', 'Tanggal Akhir Jabatan', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_pengurus->save_pengurus();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'anggota_id_error' => form_error('anggota_id'),
                'jabatan_error' => form_error('jabatan'),
                'masa_jabatan_error' => form_error('masa_jabatan'),
                'tgl_awal_jabatan_error' => form_error('tgl_awal_jabatan'),
                'tgl_akhir_jabatan_error' => form_error('tgl_akhir_jabatan'),

            ];
            echo json_encode($data);
        }
    }
    public function getPengurusById($id)
    {
        $data = $this->m_pengurus->getPengurusById($id);
        echo json_encode($data);
    }
    public function updatePengurus()
    {
        $this->form_validation->set_rules('anggota_id', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('masa_jabatan', 'Masa Jabatan', 'required');
        $this->form_validation->set_rules('tgl_awal_jabatan', 'Tanggal Awal Jabatan', 'required');
        $this->form_validation->set_rules('tgl_akhir_jabatan', 'Tanggal Akhir Jabatan', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_pengurus->save_pengurus();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'anggota_id_error' => form_error('anggota_id'),
                'jabatan_error' => form_error('jabatan'),
                'masa_jabatan_error' => form_error('masa_jabatan'),
                'tgl_awal_jabatan_error' => form_error('tgl_awal_jabatan'),
                'tgl_akhir_jabatan_error' => form_error('tgl_akhir_jabatan'),

            ];
            echo json_encode($data);
        }
    }
    public function deletePengurus($id)
    {
        $data = $this->m_pengurus->deletePengurusById($id);
        echo json_encode($data);
    }
}
