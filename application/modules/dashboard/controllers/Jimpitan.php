<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jimpitan extends MY_Controller
{
    var $menu_id = '01.03', $menu, $cookie;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'management/m_menu',
            'm_jimpitan'
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
        $data['main'] = $this->m_jimpitan->list_data();
        // $data['user'] = $this->m_jimpitan->get_user();
        // echo "<pre>";
        // var_dump($data['user']);
        // die;
        $data['anggota'] = $this->m_jimpitan->get_anggota();
        $this->render('jimpitan/index', $data);
    }
    public function saveJimpitan()
    {
        $this->form_validation->set_rules('anggota_id', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('jumlah_transaksi', 'Jumlah Transaksi', 'required');
        $this->form_validation->set_rules('petugas_catat_id', 'Petugas Catat', 'required');
        $this->form_validation->set_rules('transaksi_id', 'Transaksi', 'required');
        $this->form_validation->set_rules('tgl_catat', 'Tanggal Catat', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_jimpitan->save_jimpitan();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'anggota_id_error' => form_error('anggota_id'),
                'jumlah_transaksi_error' => form_error('jumlah_transaksi'),
                'petugas_catat_id_error' => form_error('petugas_catat_id'),
                'transaksi_id_error' => form_error('transaksi_id'),
                'tgl_catat_error' => form_error('tgl_catat'),
                'keterangan_error' => form_error('keterangan'),

            ];
            echo json_encode($data);
        }
    }
    public function getJimpitanById($id)
    {
        $data = $this->m_jimpitan->getJimpitanById($id);
        echo json_encode($data);
    }
    public function updateJimpitan()
    {
        $this->form_validation->set_rules('anggota_id', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('jumlah_transaksi', 'Jumlah Transaksi', 'required');
        $this->form_validation->set_rules('petugas_catat_id', 'Petugas Catat', 'required');
        $this->form_validation->set_rules('transaksi_id', 'Transaksi', 'required');
        $this->form_validation->set_rules('tgl_catat', 'Tanggal Catat', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_jimpitan->save_jimpitan();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'anggota_id_error' => form_error('anggota_id'),
                'jumlah_transaksi_error' => form_error('jumlah_transaksi'),
                'petugas_catat_id_error' => form_error('petugas_catat_id'),
                'transaksi_id_error' => form_error('transaksi_id'),
                'tgl_catat_error' => form_error('tgl_catat'),
                'keterangan_error' => form_error('keterangan'),

            ];
            echo json_encode($data);
        }
    }
    public function deleteJimpitan($id)
    {
        $data = $this->m_jimpitan->deleteJimpitanById($id);
        echo json_encode($data);
    }
}
