<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	var $menu_id = '01.01', $menu, $cookie;

	public function __construct()
	{
		parent::__construct();
		// $this->load->model(array(
		// 	'm_menu'
		// ));

		$this->menu = $this->m_menu->_getMenu($this->menu_id);

		//cookie
		$this->cookie = getCookieMenu($this->menu_id);
		if ($this->cookie['search'] == null) $this->cookie['search'] = array('term' => '', 'nav_nm' => '');
		if ($this->cookie['order'] == null) $this->cookie['order'] = array('field' => 'nav_id', 'type' => 'asc');
		if ($this->cookie['per_page'] == null) $this->cookie['per_page'] = 1000;
		if ($this->cookie['cur_page'] == null) $this->cookie['cur_page'] = 0;
	}
	public function index()
	{
		// $this->authorize($this->nav, '_view');
		//cookie
		// $this->cookie['cur_page'] = $this->uri->segment(4, 0);
		// $this->cookie['total_rows'] = $this->m_nav->all_rows($this->cookie);
		// set_cookie_nav($this->nav_id, $this->cookie);
		// //main data
		$data['menu'] = $this->menu;
		// $data['cookie'] = $this->cookie;
		// $data['main'] = $this->m_nav->list_data($this->cookie);
		// $data['pagination_info'] = pagination_info(count($data['main']), $this->cookie);
		// //set pagination
		// set_pagination($this->nav, $this->cookie);
		// //render
		// create_log('_view', $this->nav_id);
		$this->render('index', $data);
	}
}
