<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{
    var $menu_id = '01.05', $menu, $cookie;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'management/m_menu',
            'm_laporan'
        ));

        $this->menu = $this->m_menu->_getMenu($this->menu_id);

        //cookie
        $this->cookie = getCookieMenu($this->menu_id);
        if ($this->cookie['search'] == null) $this->cookie['search'] = array('term' => '', 'tgl1' => '', 'tgl2' => '', 'tgl3' => '');
        if ($this->cookie['order'] == null) $this->cookie['order'] = array('field' => 'menu_id', 'type' => 'asc');
        if ($this->cookie['per_page'] == null) $this->cookie['per_page'] = 1000;
        if ($this->cookie['cur_page'] == null) $this->cookie['cur_page'] = 0;
    }
    public function index()
    {
        $data['menu'] = $this->menu;
        $data['cookie'] = $this->cookie;
        if ($this->cookie['search']['tgl1'] == '') {
            $data['kas'] = array();
            $data['jimpitan'] = array();
        } else {
            $data['kas'] = $this->m_laporan->list_data($this->cookie);
            $data['jimpitan'] = $this->m_laporan->list_jimpitan($this->cookie);
        }
        $this->render('laporan/index', $data);
    }
    // public function search()
    // {
    //     $data = $this->input->post();
    //     $data['cookie'] = $this->cookie;
    //     $data['tgl1'] = $data['tgl1'];
    //     $data['tgl2'] = $data['tgl2'];
    //     $data['menu'] = $this->menu;
    //     $data['kas'] = $this->m_laporan->list_data($this->cookie);
    //     $data['jimpitan'] = $this->m_laporan->list_jimpitan();
    //     $this->render('laporan/index', $data);
    // }
    public function saveKas()
    {
        $this->form_validation->set_rules('anggota_id', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('jumlah_transaksi', 'Jumlah Transaksi', 'required');
        $this->form_validation->set_rules('petugas_catat_id', 'Petugas Catat', 'required');
        $this->form_validation->set_rules('transaksi_id', 'Transaksi', 'required');
        $this->form_validation->set_rules('tgl_catat', 'Tanggal Catat', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_laporan->save_kas();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'anggota_id_error' => form_error('anggota_id'),
                'jumlah_transaksi_error' => form_error('jumlah_transaksi'),
                'petugas_catat_id_error' => form_error('petugas_catat_id'),
                'transaksi_id_error' => form_error('transaksi_id'),
                'tgl_catat_error' => form_error('tgl_catat'),
                'keterangan_error' => form_error('keterangan'),

            ];
            echo json_encode($data);
        }
    }
    public function cetak()
    {
        $data = $this->input->post();
        var_dump($this->cookie['search']['tgl1']);
        die;
        $tgl1 = $data['tgl1'];
        $tgl2 = $data['tgl2'];
        $kas = $this->m_laporan->list_data();
        $jimpitan = $this->m_laporan->list_jimpitan();
        $this->load->file(APPPATH . 'libraries/PHPExcel.php');
        $master_cetak = BASEPATH . 'master_cetak/laporan.xlsx';
        $PHPExcel = PHPExcel_IOFactory::load($master_cetak);

        // sheet 1
        $PHPExcel->setActiveSheetIndex(0);

        //align center
        $align_center = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '111111'),
                ),
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => 'wrap'
            ),

            'font' => array(
                'size'  => 8,
                'name'  => 'Calibri'
            )
        );
        //align center
        $align_center_judul = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '111111'),
                ),
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => 'wrap'
            ),

            'font' => array(
                'size'  => 9,
                'name'  => 'Calibri',
                'bold'  => 'bold'
            )
        );
        //align left
        $align_left = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            )
        );
        //align right
        $align_right = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
            )
        );
        //font bold
        $font_bold = array(
            'font' => array(
                'bold'  => 'bold'
            )
        );
        //font underline
        $font_underline = array(
            'font' => array(
                'underline'  => 'underline'
            )
        );
        //font size 13
        $font_size_13 = array(
            'font' => array(
                'size'  => 13
            )
        );
        //font size 16
        $font_size_16 = array(
            'font' => array(
                'size'  => 16
            )
        );
        //font size 11
        $font_size_11 = array(
            'font' => array(
                'size'  => 11
            )
        );
        $font_normal = array(
            'font' => array(
                'bold'  => false
            )
        );
        //font size 12
        $font_size_12 = array(
            'font' => array(
                'size'  => 12
            )
        );
        //wrap text
        $wrap_text = array(
            'alignment' => array(
                'wrap' => 'wrap',
            )
        );
        //create border
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => '111111'),
                ),
            ),
            'font' => array(
                'size'  => 11,
                'name'  => 'Times New Roman'
            ),
        );


        $PHPExcel->getActiveSheet()->setCellValue("A4", 'PERIODE TANGGAL ' . $tgl1 . ' s/d ' . $tgl2);
        $no = 1;
        $i = 8;
        foreach ($kas as $row) {
            $PHPExcel->getActiveSheet()->setCellValue("A$i", $no++)->getStyle("A$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->setCellValue("B$i",  $row['per'])->getStyle("B$i")->applyFromArray($align_center);
            $PHPExcel->getActiveSheet()->setCellValue("C$i",  num_id(@$row['jumlah_pemasukan']))->getStyle("C$i")->applyFromArray($align_center);
        }
        $last_cell = "C" . ($i - 1);
        $PHPExcel->getActiveSheet()->getStyle("A8:$last_cell")->applyFromArray($styleArray);


        // Save it as file ------------------------------------------------------------------
        $file_export = 'laporan-transaksi';
        //
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel2007');
        header('Content-Disposition: attachment; filename="' . $file_export . '.xlsx"');
        $objWriter = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel5');
        $objWriter->save('php://output');

        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');

        // $writer = new Xlsx($spreadsheet, 'Excel5');
        // $writer->save('hello world.xlsx');
    }
    public function getKasById($id)
    {
        $data = $this->m_laporan->getKasById($id);
        echo json_encode($data);
    }
    public function updateKas()
    {
        $this->form_validation->set_rules('anggota_id', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('jumlah_transaksi', 'Jumlah Transaksi', 'required');
        $this->form_validation->set_rules('petugas_catat_id', 'Petugas Catat', 'required');
        $this->form_validation->set_rules('transaksi_id', 'Transaksi', 'required');
        $this->form_validation->set_rules('tgl_catat', 'Tanggal Catat', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'success' => 1,

            ];
            // save data
            $this->m_laporan->save_kas();
            // mengembalikan dalam bentuk json
            echo json_encode($data);
        } else {
            // validasi 
            $data = [
                'error' => true,
                'anggota_id_error' => form_error('anggota_id'),
                'jumlah_transaksi_error' => form_error('jumlah_transaksi'),
                'petugas_catat_id_error' => form_error('petugas_catat_id'),
                'transaksi_id_error' => form_error('transaksi_id'),
                'tgl_catat_error' => form_error('tgl_catat'),
                'keterangan_error' => form_error('keterangan'),

            ];
            echo json_encode($data);
        }
    }
    public function deleteKas($id)
    {
        $data = $this->m_laporan->deleteKasById($id);
        echo json_encode($data);
    }
}
