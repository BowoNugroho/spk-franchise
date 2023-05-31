<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	var $menu_id = '01.01', $menu, $cookie;

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'm_dashboard',
		));

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
		$data['menu'] = $this->menu;
		$data['jumlah_kas'] = $this->m_dashboard->get_jmlkas();
		$data['pemasukan_kas'] = $this->m_dashboard->get_pemasukan_kas();
		$data['pengeluaran_kas'] = $this->m_dashboard->get_pengeluaran_kas();
		$data['pengeluarantotal_kas'] = $this->m_dashboard->get_pengeluaran_total_kas();
		$data['kas_sekarang'] = $data['jumlah_kas']['jumlah_transaksi'] - $data['pengeluarantotal_kas']['jml_pengeluaran'];
		// echo "<pre>";
		// var_dump($data);
		// die;
		$this->render('dashboard/dashboard/index', $data);
	}
}
