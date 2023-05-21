<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends MY_Controller
{
    var $menu_id = '03.02', $menu, $cookie;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'management/m_menu',
            'm_role'
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
        $data['main'] = $this->m_role->list_data();
        $this->render('role/index', $data);
    }
    public function saveRole()
    {
        $this->form_validation->set_rules('role_nm', 'Nama Role', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_role->save_role();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'role_nm_error' => form_error('role_nm'),

            ];
            echo json_encode($data);
        }
    }
    public function getRoleById($id)
    {
        $data = $this->m_role->getRoleById($id);
        echo json_encode($data);
    }
    public function updateRole()
    {
        $this->form_validation->set_rules('role_nm', 'Nama Role', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_role->save_role();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'role_nm_error' => form_error('role_nm'),

            ];
            echo json_encode($data);
        }
    }
    public function deleteRole($id)
    {
        $data = $this->m_role->deleteRoleById($id);
        echo json_encode($data);
    }
}
