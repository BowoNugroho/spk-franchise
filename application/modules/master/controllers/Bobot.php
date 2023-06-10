<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bobot extends MY_Controller
{
    var $menu_id = '02.03', $menu, $cookie;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'management/m_menu',
            'm_bobot',
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
        $data['main'] = $this->m_bobot->list_data();
        $data['kriteria'] = $this->m_bobot->get_kriteria();
        $this->render('bobot/index', $data);
    }
    public function saveBobot()
    {
        $dt = $this->input->post();
        if ($dt['is_between'] == 1) {
            $this->form_validation->set_rules('kriteria_id', 'Nama Kriteria', 'required');
            $this->form_validation->set_rules('is_between', 'is_between?', 'required');
            // $this->form_validation->set_rules('operator', 'Operator', 'required');
            $this->form_validation->set_rules('sub_kriteria1', 'Sub Kriteria 1', 'required');
            $this->form_validation->set_rules('sub_kriteria2', 'Sub Kriteria 2', 'required');
            $this->form_validation->set_rules('nilai_bobot', 'Nilai Bobot', 'required');
        } else {
            $this->form_validation->set_rules('kriteria_id', 'Nama Kriteria', 'required');
            $this->form_validation->set_rules('is_between', 'is_between?', 'required');
            $this->form_validation->set_rules('operator', 'Operator', 'required');
            $this->form_validation->set_rules('sub_kriteria1', 'Sub Kriteria 1', 'required');
            // $this->form_validation->set_rules('sub_kriteria2', 'Sub Kriteria 2', 'required');
            $this->form_validation->set_rules('nilai_bobot', 'Nilai Bobot', 'required');
        }

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_bobot->save_bobot();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            if ($dt['is_between'] == 1) {
                $data = [
                    'error' => true,
                    'kriteria_id_error' => form_error('kriteria_id'),
                    'is_between_error' => form_error('is_between'),
                    // 'operator_error' => form_error('operator'),
                    'sub_kriteria1_error' => form_error('sub_kriteria1'),
                    'sub_kriteria2_error' => form_error('sub_kriteria2'),
                    'nilai_bobot_error' => form_error('nilai_bobot'),

                ];
            } else {
                $data = [
                    'error' => true,
                    'kriteria_id_error' => form_error('kriteria_id'),
                    'is_between_error' => form_error('is_between'),
                    'operator_error' => form_error('operator'),
                    'sub_kriteria1_error' => form_error('sub_kriteria1'),
                    // 'sub_kriteria2_error' => form_error('sub_kriteria2'),
                    'nilai_bobot_error' => form_error('nilai_bobot'),

                ];
            }
            echo json_encode($data);
        }
    }
    public function getBobotById($id)
    {
        $data = $this->m_bobot->getBobotById($id);
        echo json_encode($data);
    }
    public function updateBobot()
    {
        $dt = $this->input->post();
        if ($dt['is_between'] == 1) {
            $this->form_validation->set_rules('kriteria_id', 'Nama Kriteria', 'required');
            $this->form_validation->set_rules('is_between', 'is_between?', 'required');
            // $this->form_validation->set_rules('operator', 'Operator', 'required');
            $this->form_validation->set_rules('sub_kriteria1', 'Sub Kriteria 1', 'required');
            $this->form_validation->set_rules('sub_kriteria2', 'Sub Kriteria 2', 'required');
            $this->form_validation->set_rules('nilai_bobot', 'Nilai Bobot', 'required');
        } else {
            $this->form_validation->set_rules('kriteria_id', 'Nama Kriteria', 'required');
            $this->form_validation->set_rules('is_between', 'is_between?', 'required');
            $this->form_validation->set_rules('operator', 'Operator', 'required');
            $this->form_validation->set_rules('sub_kriteria1', 'Sub Kriteria 1', 'required');
            // $this->form_validation->set_rules('sub_kriteria2', 'Sub Kriteria 2', 'required');
            $this->form_validation->set_rules('nilai_bobot', 'Nilai Bobot', 'required');
        }


        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_bobot->save_bobot();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            if ($dt['is_between'] == 1) {
                $data = [
                    'error' => true,
                    'kriteria_id_error' => form_error('kriteria_id'),
                    'is_between_error' => form_error('is_between'),
                    // 'operator_error' => form_error('operator'),
                    'sub_kriteria1_error' => form_error('sub_kriteria1'),
                    'sub_kriteria2_error' => form_error('sub_kriteria2'),
                    'nilai_bobot_error' => form_error('nilai_bobot'),

                ];
            } else {
                $data = [
                    'error' => true,
                    'kriteria_id_error' => form_error('kriteria_id'),
                    'is_between_error' => form_error('is_between'),
                    'operator_error' => form_error('operator'),
                    'sub_kriteria1_error' => form_error('sub_kriteria1'),
                    // 'sub_kriteria2_error' => form_error('sub_kriteria2'),
                    'nilai_bobot_error' => form_error('nilai_bobot'),

                ];
            }
            echo json_encode($data);
        }
    }
    public function deleteBobot($id)
    {
        $data = $this->m_bobot->deleteBobotById($id);
        echo json_encode($data);
    }
}
