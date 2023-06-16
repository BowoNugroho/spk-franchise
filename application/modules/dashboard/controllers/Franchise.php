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
	public function form($id)
	{
		$data['menu'] = $this->menu;
		// $data['main'] = $this->m_access->get_data_menu($id);
		$data['main'] = $this->m_franchise->list_alternatif($id);
		$data['id'] = $id;
		$this->render('dashboard/franchise/form', $data);
	}
	public function alternatif_form($id = null, $alternatif_id = null)
	{
		$data['menu'] = $this->menu;
		$data['id'] = $id;
		if ($alternatif_id == null) {
			$data['main'] = array();
		} else {
			$data['main'] = $this->m_franchise->get_alternatif($alternatif_id);
		}
		$this->render('dashboard/franchise/alternatif_form', $data);
	}
	public function saveAlternatif()
	{
		$data = $this->input->post();
		$this->form_validation->set_rules('franchise_nm', 'Nama Franchise', 'required');

		if ($this->form_validation->run()) {
			$data = [
				'success' => 1,
				'perhitungan_id' => $data['perhitungan_id'],

			];
			// save data
			$this->m_franchise->save_alternatif();
			// mengembalikan dalam bentuk json
			echo json_encode($data);
			// return $data;
		} else {
			// validasi 
			$data = [
				'error' => true,
				'franchise_nm_error' => form_error('franchise_nm'),
				// 'tanggal_error' => form_error('tanggal'),

			];
			// return $data;
			echo json_encode($data);
		}
		

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
	public function delete_alternatif($id = null, $alterntaif_id = null)
	{
		$data = $this->m_franchise->delete_alternatif($id, $alterntaif_id);
		echo json_encode($data);
	}

	public function hitung($perhitungan_id)
	{
		$alternatif = $this->m_franchise->get_alternatif($perhitungan_id);
		$harga2 = 0;
		$booth2 = 0;
		$varian2 = 0;
		$fasilitas2 = 0;
		$benefit2 = 0;
		foreach ($alternatif as $row) {
			$harga = $row['nilai_bobot_harga'];
			$booth = $row['nilai_bobot_booth'];
			$varian = $row['nilai_bobot_varian'];
			$fasilitas = $row['nilai_bobot_fasilitas'];
			$benefit = $row['nilai_bobot_benefit'];
			//
			$harga1 = pow($harga, 2);
			$booth1 = pow($booth, 2);
			$varian1 = pow($varian, 2);
			$fasilitas1 = pow($fasilitas, 2);
			$benefit1 = pow($benefit, 2);
			//
			$harga2 += $harga1;
			$booth2 += $booth1;
			$varian2 += $varian1;
			$fasilitas2 += $fasilitas1;
			$benefit2 += $benefit1;
			//
			$hasil_harga = sqrt($harga2);
			$hasil_booth = sqrt($booth2);
			$hasil_varian = sqrt($varian2);
			$hasil_fasilitas = sqrt($fasilitas2);
			$hasil_benefit = sqrt($benefit2);
		}

		// var_dump($harga2);
		var_dump($hasil_harga);
		var_dump($hasil_booth);
		var_dump($hasil_varian);
		var_dump($hasil_fasilitas);
		var_dump($hasil_benefit);
		die;
	}
}
