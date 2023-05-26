<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
    var $menu_id = '03.04', $menu, $cookie;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'management/m_menu',
            'm_user',
            'm_user'
        ));

        $this->menu = $this->m_menu->_getMenu($this->menu_id);

        //cookie
        $this->cookie = getCookieMenu($this->menu_id);
        if ($this->cookie['search'] == null) $this->cookie['search'] = array('term' => '', 'user_nm' => '');
        if ($this->cookie['order'] == null) $this->cookie['order'] = array('field' => 'role_id', 'type' => 'asc');
        if ($this->cookie['per_page'] == null) $this->cookie['per_page'] = 1000;
        if ($this->cookie['cur_page'] == null) $this->cookie['cur_page'] = 0;
    }
    public function index()
    {
        //main data
        $data['menu'] = $this->menu;
        $data['main'] = $this->m_user->list_data();
        $data['role'] = $this->m_user->get_role();
        $this->render('user/index', $data);
    }
    public function saveUser()
    {
        $this->form_validation->set_rules('role_id', 'Role Id', 'required');
        $this->form_validation->set_rules('user_nm', 'Nama User', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_user->save_user();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'role_id_error' => form_error('role_id'),
                'user_nm_error' => form_error('user_nm'),
                'username_error' => form_error('username'),
                'password_error' => form_error('password'),

            ];
            echo json_encode($data);
        }
    }
    public function getUserById($id)
    {
        $data = $this->m_user->getUserById($id);
        echo json_encode($data);
    }
    public function updateUser()
    {
        $this->form_validation->set_rules('role_id', 'Role Id', 'required');
        $this->form_validation->set_rules('user_nm', 'Nama User', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_user->save_user();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'role_id_error' => form_error('role_id'),
                'user_nm_error' => form_error('user_nm'),
                'username_error' => form_error('username'),
                'password_error' => form_error('password'),

            ];
            echo json_encode($data);
        }
    }
    public function deleteUser($id)
    {
        $data = $this->m_user->deleteUserById($id);
        echo json_encode($data);
    }
}
