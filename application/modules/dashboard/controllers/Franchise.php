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
		$data['check'] = $this->m_franchise->check($id);
		$data['main'] = $this->m_franchise->list_alternatif($id);
		$data['hasil'] = $this->m_franchise->get_hasil($id);
		$data['kriteria'] = $this->m_franchise->get_kriteria2();
		$data['ternormalisasi'] = $this->m_franchise->ternormalisasi($id);
		$data['ternormalisasi_terbobot'] = $this->m_franchise->ternormalisasi_terbobot($id);
		$data['solusi_idea'] = $this->m_franchise->solusi_idea($id);
		$data['nilaid'] = $this->m_franchise->nilaid($id);
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
			$data['main'] = $this->m_franchise->get_nilai_alternatif($alternatif_id);
		}
		// echo "<pre>";
		// var_dump($data['main']);
		// die;
		$this->render('dashboard/franchise/alternatif_form', $data);
	}
	public function saveAlternatif()
	{
		$data = $this->input->post();
		$this->form_validation->set_rules('franchise_nm', 'Nama Franchise', 'required');
		$this->form_validation->set_rules('nilai_alternatif_harga', 'Harga Franchise', 'required');
		$this->form_validation->set_rules('nilai_alternatif_booth', 'Booth Franchise', 'required');
		$this->form_validation->set_rules('nilai_alternatif_varian', 'Varian Menu', 'required');
		$this->form_validation->set_rules('nilai_alternatif_fasilitas', 'Fasilitas ', 'required');
		$this->form_validation->set_rules('nilai_alternatif_benefit', ' Kisaran Pendapatan', 'required');

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
				'nilai_alternatif_harga_error' => form_error('nilai_alternatif_harga'),
				'nilai_alternatif_fasilitas_error' => form_error('nilai_alternatif_fasilitas'),
				'nilai_alternatif_booth_error' => form_error('nilai_alternatif_booth'),
				'nilai_alternatif_benefit_error' => form_error('nilai_alternatif_benefit'),
				'nilai_alternatif_varian_error' => form_error('nilai_alternatif_varian'),
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

		// bobot setiap kriteria dalam bentuk presentasi yang di konversi ke desimal
		$bobot_harga = 0.3;
		$bobot_booth = 0.2;
		$bobot_varian = 0.15;
		$bobot_fasilitas = 0.15;
		$bobot_benefit = 0.2;
		// Mencari Pembagi untuk tahab Matrik keputusan yang Ternormalisasi
		$harga2 = 0;
		$booth2 = 0;
		$varian2 = 0;
		$fasilitas2 = 0;
		$benefit2 = 0;
		foreach ($alternatif as $row) {
			$harga = $row['nilai_bobot_harga'];
			$booth = str_replace(',', '.', $row['nilai_bobot_booth']);
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
			$pembagi_harga = sqrt($harga2);
			$pembagi_booth = sqrt($booth2);
			$pembagi_varian = sqrt($varian2);
			$pembagi_fasilitas = sqrt($fasilitas2);
			$pembagi_benefit = sqrt($benefit2);
		}


		foreach ($alternatif as $row) {
			$harga = $row['nilai_bobot_harga'];
			$booth = str_replace(',', '.', $row['nilai_bobot_booth']);
			$varian = $row['nilai_bobot_varian'];
			$fasilitas = $row['nilai_bobot_fasilitas'];
			$benefit = $row['nilai_bobot_benefit'];

			//  Membuat Matrik keputusan yang Ternormalisasi -> T1
			$t1_harga = $harga / $pembagi_harga;
			$t1_booth = $booth / $pembagi_booth;
			$t1_varian = $varian / $pembagi_varian;
			$t1_fasilitas = $fasilitas / $pembagi_fasilitas;
			$t1_benefit = $benefit / $pembagi_benefit;

			// Membuat Matrik keputusan yang ternormalisasi terbobot -> T2

			$t2_harga  = $t1_harga * $bobot_harga;
			$t2_booth  = $t1_booth * $bobot_booth;
			$t2_varian  = $t1_varian * $bobot_varian;
			$t2_fasilitas = $t1_fasilitas * $bobot_fasilitas;
			$t2_benefit = $t1_benefit * $bobot_benefit;

			// Menentukan matrik solusi idea positif A+ dan idea negatif A- -> T3 , T4 , T5

			$t3_harga[] = $t2_harga;
			$t3_booth[] = $t2_booth;
			$t3_varian[] = $t2_varian;
			$t3_fasilitas[] = $t2_fasilitas;
			$t3_benefit[] = $t2_benefit;

			$t4_harga = array(
				"harga" => $t3_harga,
				"atribut" => 'Cost',
			);
			$t4_booth = array(
				"booth" => $t3_booth,
				"atribut" => 'Benefit',
			);
			$t4_varian = array(
				"varian" => $t3_varian,
				"atribut" => 'Benefit',
			);
			$t4_fasilitas = array(
				"fasilitas" => $t3_fasilitas,
				"atribut" => 'Benefit',
			);
			$t4_benefit = array(
				"benefit" => $t3_benefit,
				"atribut" => 'Benefit',
			);
		}

		// Menentukan matrik solusi idea positif A+
		if ($t4_harga['atribut'] == 'Benefit') {
			$t5_harga = max($t4_harga['harga']);
		} else {
			$t5_harga = min($t4_harga['harga']);
		}
		//
		if ($t4_booth['atribut'] == 'Benefit') {
			$t5_booth = max($t4_booth['booth']);
		} else {
			$t5_booth = min($t4_booth['booth']);
		}
		//
		if ($t4_varian['atribut'] == 'Benefit') {
			$t5_varian = max($t4_varian['varian']);
		} else {
			$t5_varian = min($t4_varian['varian']);
		}
		//
		if ($t4_fasilitas['atribut'] == 'Benefit') {
			$t5_fasilitas = max($t4_fasilitas['fasilitas']);
		} else {
			$t5_fasilitas = min($t4_fasilitas['fasilitas']);
		}
		//
		if ($t4_benefit['atribut'] == 'Benefit') {
			$t5_benefit = max($t4_benefit['benefit']);
		} else {
			$t5_benefit = min($t4_benefit['benefit']);
		}



		// Menentukan matrik solusi idea positif A-
		if ($t4_harga['atribut'] == 'Benefit') {
			$t6_harga = min($t4_harga['harga']);
		} else {
			$t6_harga = max($t4_harga['harga']);
		}
		//
		if ($t4_booth['atribut'] == 'Benefit') {
			$t6_booth = min($t4_booth['booth']);
		} else {
			$t6_booth = max($t4_booth['booth']);
		}
		//
		if ($t4_varian['atribut'] == 'Benefit') {
			$t6_varian = min($t4_varian['varian']);
		} else {
			$t6_varian = max($t4_varian['varian']);
		}
		//
		if ($t4_fasilitas['atribut'] == 'Benefit') {
			$t6_fasilitas = min($t4_fasilitas['fasilitas']);
		} else {
			$t6_fasilitas = max($t4_fasilitas['fasilitas']);
		}
		//
		if ($t4_benefit['atribut'] == 'Benefit') {
			$t6_benefit = min($t4_benefit['benefit']);
		} else {
			$t6_benefit = max($t4_benefit['benefit']);
		}


		// Menentukan D+ dan D- Setiap Alternatif
		foreach ($alternatif as $row) {
			$harga = $row['nilai_bobot_harga'];
			$booth = str_replace(',', '.', $row['nilai_bobot_booth']);
			$varian = $row['nilai_bobot_varian'];
			$fasilitas = $row['nilai_bobot_fasilitas'];
			$benefit = $row['nilai_bobot_benefit'];

			//  Membuat Matrik keputusan yang Ternormalisasi -> T1.2
			$t1_harga2 = $harga / $pembagi_harga;
			$t1_booth2 = $booth / $pembagi_booth;
			$t1_varian2 = $varian / $pembagi_varian;
			$t1_fasilitas2 = $fasilitas / $pembagi_fasilitas;
			$t1_benefit2 = $benefit / $pembagi_benefit;

			// Membuat Matrik keputusan yang ternormalisasi terbobot -> T2.2

			$t2_harga2  = $t1_harga2 * $bobot_harga;
			$t2_booth2  = $t1_booth2 * $bobot_booth;
			$t2_varian2  = $t1_varian2 * $bobot_varian;
			$t2_fasilitas2 = $t1_fasilitas2 * $bobot_fasilitas;
			$t2_benefit2 = $t1_benefit2 * $bobot_benefit;

			// Menentukan D+
			$t7_dplus = sqrt(pow(($t5_harga - $t2_harga2), 2) + pow(($t5_booth - $t2_booth2), 2) + pow(($t5_varian - $t2_varian2), 2) + pow(($t5_fasilitas - $t2_fasilitas2), 2) + pow(($t5_benefit - $t2_benefit2), 2));
			// Menentukan D-
			$t7_dmines = sqrt(pow(($t6_harga - $t2_harga2), 2) + pow(($t6_booth - $t2_booth2), 2) + pow(($t6_varian - $t2_varian2), 2) + pow(($t6_fasilitas - $t2_fasilitas2), 2) + pow(($t6_benefit - $t2_benefit2), 2));


			// Nilai preferensi untuk setiap alternatif -> T8
			$t8_preferensi = $t7_dmines / ($t7_dmines + $t7_dplus);

			$finis = array(
				"nilai_preferensi" => ((string) $t8_preferensi),
				"alternatif_id" => $row['alternatif_id'],
			);
			// save nilai preferensi
			$this->m_franchise->save_preferensi($finis);
			$this->m_franchise->update($perhitungan_id);
		}
	}

	public function cetak($id)
	{
		ini_set("memory_limit", "-1");
		$data['main'] = $this->m_franchise->list_alternatif($id);
		$data['hasil'] = $this->m_franchise->get_hasil($id);
		// UI ========================
		$pdfFilePath = 'Cetak.pdf';
		$this->load->file(APPPATH . 'libraries/mpdf/mpdf.php');
		// $pdf = new mPDF("en-GB-x", array(210, 165), "", "", 10, 10, 10, 10, 10, 10, "P");
		$pdf = new mPDF("en-GB-x", array(210, 297), "", "", 10, 10, 10, 10, 10, 10, "P"); //A4
		$pdf->cacheTables = true;
		$pdf->simpleTables = true;
		$pdf->packTableData = true;
		$html = $this->load->view('dashboard/franchise/cetak', $data, true);
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "I");
		// /.UI ======================
	}
}
