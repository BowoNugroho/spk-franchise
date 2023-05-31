<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengeluaran extends MY_Controller
{
    var $menu_id = '01.04', $menu, $cookie;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'management/m_menu',
            'm_pengeluaran'
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
        $data['main'] = $this->m_pengeluaran->list_data();
        // $data['user'] = $this->m_pengeluaran->get_user();
        // echo "<pre>";
        // var_dump($data['user']);
        // die;
        $data['anggota'] = $this->m_pengeluaran->get_anggota();
        $this->render('pengeluaran/index', $data);
    }
    public function savePengeluaran()
    {
        // $this->form_validation->set_rules('petugas_catat_id', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('jml_pengeluaran', 'Jumlah Transaksi', 'required');
        $this->form_validation->set_rules('petugas_catat_id', 'Petugas Catat', 'required');
        $this->form_validation->set_rules('asal', 'Asal', 'required');
        $this->form_validation->set_rules('tgl_catat', 'Tanggal Catat', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_pengeluaran->save_pengeluaran();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                // 'petugas_catat_id_error' => form_error('petugas_catat_id'),
                'jml_pengeluaran_error' => form_error('jml_pengeluaran'),
                'petugas_catat_id_error' => form_error('petugas_catat_id'),
                'asal_error' => form_error('asal'),
                'tgl_catat_error' => form_error('tgl_catat'),
                'keterangan_error' => form_error('keterangan'),

            ];
            echo json_encode($data);
        }
    }
    public function getPengeluaranById($id)
    {
        $data = $this->m_pengeluaran->getPengeluaranById($id);
        echo json_encode($data);
    }
    public function updatePengeluaran()
    {
        // $this->form_validation->set_rules('petugas_catat_id', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('jml_pengeluaran', 'Jumlah Transaksi', 'required');
        $this->form_validation->set_rules('petugas_catat_id', 'Petugas Catat', 'required');
        $this->form_validation->set_rules('asal', 'Asal', 'required');
        $this->form_validation->set_rules('tgl_catat', 'Tanggal Catat', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_pengeluaran->save_pengeluaran();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                // 'petugas_catat_id_error' => form_error('petugas_catat_id'),
                'jml_pengeluaran_error' => form_error('jml_pengeluaran'),
                'petugas_catat_id_error' => form_error('petugas_catat_id'),
                'asal_error' => form_error('asal'),
                'tgl_catat_error' => form_error('tgl_catat'),
                'keterangan_error' => form_error('keterangan'),

            ];
            echo json_encode($data);
        }
    }
    public function deletePengeluaran($id)
    {
        $data = $this->m_pengeluaran->deletePengeluaranById($id);
        echo json_encode($data);
    }
}
