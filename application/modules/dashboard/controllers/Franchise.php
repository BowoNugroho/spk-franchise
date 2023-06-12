<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Franchise extends MY_Controller
{
	var $menu_id = '01.01', $menu, $cookie;

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'management/m_menu',
			'm_franchise',
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
		$data['main'] = $this->m_franchise->list_data();
		$this->render('dashboard/franchise/index', $data);
	}
	public function savePerhitungan()
	{
		$this->form_validation->set_rules('perhitungan_nm', 'Nama Perhitungan', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

		if ($this->form_validation->run()) {
			$data = [
				'success' => 1,

			];
			// save data
			$this->m_franchise->save_perhitungan();
			// mengembalikan dalam bentuk json
			echo json_encode($data);
		} else {
			// validasi 
			$data = [
				'error' => true,
				'perhitungan_nm_error' => form_error('perhitungan_nm'),
				'tanggal_error' => form_error('tanggal'),

			];
			echo json_encode($data);
		}
	}
	public function getPerhitunganById($id)
	{
		$data = $this->m_franchise->getPerhitunganById($id);
		echo json_encode($data);
	}
	public function updatePerhitungan()
	{
		$this->form_validation->set_rules('perhitungan_nm', 'Nama Perhitungan', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

		if ($this->form_validation->run()) {
			$data = [
				'success' => 1,

			];
			// save data
			$this->m_franchise->save_perhitungan();
			// mengembalikan dalam bentuk json
			echo json_encode($data);
		} else {
			// validasi 
			$data = [
				'error' => true,
				'perhitungan_nm_error' => form_error('perhitungan_nm'),
				'tanggal_error' => form_error('tanggal'),

			];
			echo json_encode($data);
		}
	}
	public function deletePerhitungan($id)
	{
		$data = $this->m_franchise->deletePerhitunganById($id);
		echo json_encode($data);
	}
}
