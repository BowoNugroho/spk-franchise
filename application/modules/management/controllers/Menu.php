<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends MY_Controller
{
	var $menu_id = '03.01', $menu, $cookie;

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'm_menu'
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
		// //main data
		$data['menu'] = $this->menu;
		// $data['cookie'] = $this->cookie;
		$data['main'] = $this->m_menu->list_data($this->cookie);
		$data['parent'] = $this->m_menu->get_menu();
		// echo  "<pre>";
		// var_dump($data['parent']);
		// die;
		$this->render('menu/index', $data);
	}
	public function saveMenu()
	{
		// $this->form_validation->set_rules('parent_id', 'parent_id', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu Id', 'required');
		$this->form_validation->set_rules('menu_nm', 'Nama Menu', 'required');
		$this->form_validation->set_rules('url', 'Nama Url', 'required');

		if ($this->form_validation->run()) {
			$data = [
				'success' => 1,

			];
			// save data
			$this->m_menu->save_menu();
			// mengembalikan dalam bentuk json
			echo json_encode($data);
		} else {
			// validasi 
			$data = [
				'error' => true,
				// 'parent_id_error' => form_error('parent_id'),
				'menu_id_error' => form_error('menu_id'),
				'menu_nm_error' => form_error('menu_nm'),
				'url_error' => form_error('url'),

			];
			echo json_encode($data);
		}
	}
	public function getMenuById($id)
	{
		$data = $this->m_menu->getMenuById($id);
		echo json_encode($data);
	}
	public function updateMenu()
	{
		// $this->form_validation->set_rules('parent_id', 'parent_id', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu Id', 'required');
		$this->form_validation->set_rules('menu_nm', 'Nama Menu', 'required');
		$this->form_validation->set_rules('url', 'Nama Url', 'required');

		if ($this->form_validation->run()) {
			$data = [
				'success' => 1,

			];
			// save data
			$this->m_menu->update_menu();
			// mengembalikan dalam bentuk json
			echo json_encode($data);
		} else {
			// validasi 
			$data = [
				'error' => true,
				// 'parent_id_error' => form_error('parent_id'),
				'menu_id_error' => form_error('menu_id'),
				'menu_nm_error' => form_error('menu_nm'),
				'url_error' => form_error('url'),

			];
			echo json_encode($data);
		}
	}
	public function deleteMenu($id)
	{
		$data = $this->m_menu->deleteMenuById($id);
		echo json_encode($data);
	}

	public function search($menu_id, $id = '')
	{
		$menu = $this->m_menu->_getMenu($menu_id);
		$data = $this->input->post(null, true);
		if ($data == null) redirect(site_url() . '/message/error_403');
		$cookie = getCookieMenu($menu_id);
		$cookie['search'] = $data;
		setCookieMenu($menu_id, $cookie);
		if (@$id != '') {
			redirect(site_url() . '/' . $menu['url'] . '/index/' . @$id);
		} else {
			redirect(site_url() . '/' . $menu['url']);
		}
	}
	public function reset($menu_id, $id = '')
	{
		$menu = $this->m_menu->_getMenu($menu_id);
		delCookieMenu($menu_id);
		if (@$id != '') {
			redirect(site_url() . '/' . $menu['url'] . '/index/' . @$id);
		} else {
			redirect(site_url() . '/' . $menu['url']);
		}
	}
}
