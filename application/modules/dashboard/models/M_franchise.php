<?php

use PhpOffice\PhpSpreadsheet\Writer\Xlsx\FunctionPrefix;

class M_franchise extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    var $sess;
    public function list_data()
    {
        $user_id = $this->session->userdata('user_id');
        $sql = "SELECT a.* 
        FROM perhitungan a 
        WHERE a.user_id = $user_id";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function save_perhitungan()
    {
        $data = $this->input->post();
        if ($data['perhitungan_id'] == '') {
            $get = $this->db->order_by('perhitungan_id', 'DESC')->get('perhitungan')->row_array();
            if ($get == null) {
                $data['perhitungan_id'] = date('ymd') . '0001';
            } else {
                $tgl = substr($get['perhitungan_id'], 0, 6);
                if ($tgl != date('ymd')) {
                    $data['perhitungan_id'] = date('ymd') . '0001';
                } else {
                    $data['perhitungan_id'] = $get['perhitungan_id'] + 1;
                }
            }
            $this->db->insert('perhitungan', $data);
        } else {
            $this->db->where('perhitungan_id', $data['perhitungan_id'])->update('perhitungan', $data);
        }
    }
    public function get_kriteria2()
    {
        $sql = "SELECT a.* 
        FROM kriteria a  ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function ternormalisasi($perhitungan_id = null)
    {
        $alternatif = $this->m_franchise->get_alternatif($perhitungan_id);
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


            $hasil[] = array(
                "harga" => $t1_harga,
                "booth" => $t1_booth,
                "varian" => $t1_varian,
                "fasilitas" => $t1_fasilitas,
                "benefit" => $t1_benefit,
            );
        }
        return $hasil;
    }
    public function ternormalisasi_terbobot($perhitungan_id = null)
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

            $hasil[] = array(
                "harga" => $t2_harga,
                "booth" => $t2_booth,
                "varian" => $t2_varian,
                "fasilitas" => $t2_fasilitas,
                "benefit" => $t2_benefit,
            );
        }
        return $hasil;
    }
    public function solusi_idea($perhitungan_id =  null)
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

        $hasil['a+'] = array(
            "harga" => $t5_harga,
            "booth" => $t5_booth,
            "varian" => $t5_varian,
            "fasilitas" => $t5_fasilitas,
            "benefit" => $t5_benefit,
        );
        $hasil['a-'] = array(
            "harga" => $t6_harga,
            "booth" => $t6_booth,
            "varian" => $t6_varian,
            "fasilitas" => $t6_fasilitas,
            "benefit" => $t6_benefit,
        );
        return $hasil;
    }
    public function nilaid($perhitungan_id = null)
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

            $hasil[] = array(
                "dplus" => $t7_dplus,
                "dmines" => $t7_dmines,
            );
        }
        return $hasil;
    }
    public function getPerhitunganById($id = '')
    {
        $sql = "SELECT a.* 
                FROM perhitungan a 
                WHERE a.perhitungan_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function deletePerhitunganById($id)
    {
        $this->db->where('perhitungan_id', $id);
        $this->db->delete('perhitungan');
    }
    public function check($id)
    {
        $sql = "SELECT a.* 
                FROM perhitungan a 
                WHERE a.perhitungan_id = $id ";
        $query = $this->db->query($sql);
        return $query->row_array();
    }
    public function list_alternatif($id)
    {
        $sql =
            "SELECT a.* 
                FROM alternatif a 
                WHERE a.perhitungan_id = $id";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        foreach ($res as $key => $row) {
            $harga = $this->db->query(
                "SELECT a.*
                    FROM alternatif_rinc a
                    WHERE a.alternatif_id = '" . $row['alternatif_id'] . "' AND a.kriteria_nm = 'Harga'"
            )->row_array();
            if ($harga == null) {
                $res[$key]['nilai_alternatif_harga'] = null;
                $res[$key]['nilai_bobot_harga'] = null;
            } else {
                $res[$key]['nilai_alternatif_harga'] = $harga['nilai_alternatif'];
                $res[$key]['nilai_bobot_harga'] = $harga['nilai_bobot'];
            }
        }
        foreach ($res as $key => $row) {
            $booth = $this->db->query(
                "SELECT a.*
                    FROM alternatif_rinc a
                    WHERE a.alternatif_id = '" . $row['alternatif_id'] . "' AND a.kriteria_nm = 'Ukuran Booth'"
            )->row_array();
            if ($booth == null) {
                $res[$key]['nilai_alternatif_booth'] = null;
                $res[$key]['nilai_bobot_booth'] = null;
            } else {
                $res[$key]['nilai_alternatif_booth'] = $booth['nilai_alternatif'];
                $res[$key]['nilai_bobot_booth'] = $booth['nilai_bobot'];
            }
        }
        foreach ($res as $key => $row) {
            $varian = $this->db->query(
                "SELECT a.*
                    FROM alternatif_rinc a
                    WHERE a.alternatif_id = '" . $row['alternatif_id'] . "' AND a.kriteria_nm = 'Varian Menu'"
            )->row_array();
            if ($varian == null) {
                $res[$key]['nilai_alternatif_varian'] = null;
                $res[$key]['nilai_bobot_varian'] = null;
            } else {
                $res[$key]['nilai_alternatif_varian'] = $varian['nilai_alternatif'];
                $res[$key]['nilai_bobot_varian'] = $varian['nilai_bobot'];
            }
        }
        foreach ($res as $key => $row) {
            $fasilitas = $this->db->query(
                "SELECT a.*
                    FROM alternatif_rinc a
                    WHERE a.alternatif_id = '" . $row['alternatif_id'] . "' AND a.kriteria_nm = 'Fasilitas'"
            )->row_array();
            if ($fasilitas == null) {
                $res[$key]['nilai_alternatif_fasilitas'] = null;
                $res[$key]['nilai_bobot_fasilitas'] = null;
            } else {
                $res[$key]['nilai_alternatif_fasilitas'] = $fasilitas['nilai_alternatif'];
                $res[$key]['nilai_bobot_fasilitas'] = $fasilitas['nilai_bobot'];
            }
        }
        foreach ($res as $key => $row) {
            $benefit = $this->db->query(
                "SELECT a.*
                    FROM alternatif_rinc a
                    WHERE a.alternatif_id = '" . $row['alternatif_id'] . "' AND a.kriteria_nm = 'Kisaran Pendapatan'"
            )->row_array();
            if ($benefit == null) {
                $res[$key]['nilai_alternatif_benefit'] = null;
                $res[$key]['nilai_bobot_benefit'] = null;
            } else {
                $res[$key]['nilai_alternatif_benefit'] = $benefit['nilai_alternatif'];
                $res[$key]['nilai_bobot_benefit'] = $benefit['nilai_bobot'];
            }
        }
        return $res;
    }

    public function get_kriteria()
    {
        $list = $this->db->query(
            "SELECT a.* 
            FROM kriteria a"
        )->result_array();

        foreach ($list as $k => $v) {
            $list[$k]['rinc'] = $this->db->query(
                "SELECT a.* 
               FROM bobot a 
               WHERE a.kriteria_id = '" . $v['kriteria_id'] . "' "
            )->result_array();
        }
        // echo "<pre>";
        // var_dump($list);
        // die;

        return $list;
    }
    public function get_harga()
    {
        $list = $this->db->query(
            "SELECT a.* , b.*
            FROM bobot a
            LEFT JOIN kriteria b ON a.kriteria_id = b.kriteria_id
            WHERE b.kriteria_kode = 'C1'"
        )->result_array();

        return $list;
    }
    public function get_booth()
    {
        $list = $this->db->query(
            "SELECT a.* , b.*
            FROM bobot a
            LEFT JOIN kriteria b ON a.kriteria_id = b.kriteria_id
            WHERE b.kriteria_kode = 'C2'"
        )->result_array();

        return $list;
    }
    public function get_varian()
    {
        $list = $this->db->query(
            "SELECT a.* , b.*
            FROM bobot a
            LEFT JOIN kriteria b ON a.kriteria_id = b.kriteria_id
            WHERE b.kriteria_kode = 'C3'"
        )->result_array();

        return $list;
    }
    public function get_fasilitas()
    {
        $list = $this->db->query(
            "SELECT a.* , b.*
            FROM bobot a
            LEFT JOIN kriteria b ON a.kriteria_id = b.kriteria_id
            WHERE b.kriteria_kode = 'C4'"
        )->result_array();

        return $list;
    }
    public function get_benefit()
    {
        $list = $this->db->query(
            "SELECT a.* , b.*
            FROM bobot a
            LEFT JOIN kriteria b ON a.kriteria_id = b.kriteria_id
            WHERE b.kriteria_kode = 'C5'"
        )->result_array();

        return $list;
    }
    public function get_nilai_alternatif($alternatif_id = '')
    {
        $sql = "SELECT a.* 
        FROM alternatif a  
        WHERE a.alternatif_id = $alternatif_id";
        $query = $this->db->query($sql);
        $res = $query->row_array();
        $harga = $this->db->query(
            "SELECT a.*
            FROM alternatif_rinc a
            WHERE a.alternatif_id = '" . $res['alternatif_id'] . "' AND a.kriteria_nm = 'Harga'"
        )->row_array();
        if ($harga == null) {
            $res['nilai_alternatif_harga'] = null;
            $res['nilai_bobot_harga'] = null;
            $res['alternatifrinc_id_harga'] = null;
        } else {
            $res['nilai_alternatif_harga'] = $harga['nilai_alternatif'];
            $res['nilai_bobot_harga'] = $harga['nilai_bobot'];
            $res['alternatifrinc_id_harga'] = $harga['alternatifrinc_id'];
        }
        $booth = $this->db->query(
            "SELECT a.*
            FROM alternatif_rinc a
            WHERE a.alternatif_id = '" . $res['alternatif_id'] . "' AND a.kriteria_nm = 'Ukuran Booth'"
        )->row_array();
        if ($booth == null) {
            $res['nilai_alternatif_booth'] = null;
            $res['nilai_bobot_booth'] = null;
            $res['alternatifrinc_id_booth'] = null;
        } else {
            $res['nilai_alternatif_booth'] = $booth['nilai_alternatif'];
            $res['nilai_bobot_booth'] = $booth['nilai_bobot'];
            $res['alternatifrinc_id_booth'] = $booth['alternatifrinc_id'];
        }
        $varian = $this->db->query(
            "SELECT a.*
            FROM alternatif_rinc a
            WHERE a.alternatif_id = '" . $res['alternatif_id'] . "' AND a.kriteria_nm = 'Varian Menu'"
        )->row_array();
        if ($varian == null) {
            $res['nilai_alternatif_varian'] = null;
            $res['nilai_bobot_varian'] = null;
            $res['alternatifrinc_id_varian'] = null;
        } else {
            $res['nilai_alternatif_varian'] = $varian['nilai_alternatif'];
            $res['nilai_bobot_varian'] = $varian['nilai_bobot'];
            $res['alternatifrinc_id_varian'] = $varian['alternatifrinc_id'];
        }
        $fasilitas = $this->db->query(
            "SELECT a.*
            FROM alternatif_rinc a
            WHERE a.alternatif_id = '" . $res['alternatif_id'] . "' AND a.kriteria_nm = 'Fasilitas'"
        )->row_array();
        if ($fasilitas == null) {
            $res['nilai_alternatif_fasilitas'] = null;
            $res['nilai_bobot_fasilitas'] = null;
            $res['alternatifrinc_id_fasilitas'] = null;
        } else {
            $res['nilai_alternatif_fasilitas'] = $fasilitas['nilai_alternatif'];
            $res['nilai_bobot_fasilitas'] = $fasilitas['nilai_bobot'];
            $res['alternatifrinc_id_fasilitas'] = $fasilitas['alternatifrinc_id'];
        }
        $benefit = $this->db->query(
            "SELECT a.*
            FROM alternatif_rinc a
            WHERE a.alternatif_id = '" . $res['alternatif_id'] . "' AND a.kriteria_nm = 'Kisaran Pendapatan'"
        )->row_array();
        if ($benefit == null) {
            $res['nilai_alternatif_benefit'] = null;
            $res['nilai_bobot_benefit'] = null;
            $res['alternatifrinc_id_benefit'] = null;
        } else {
            $res['nilai_alternatif_benefit'] = $benefit['nilai_alternatif'];
            $res['nilai_bobot_benefit'] = $benefit['nilai_bobot'];
            $res['alternatifrinc_id_benefit'] = $benefit['alternatifrinc_id'];
        }
        return $res;
    }
    public function save_alternatif()
    {
        $data = $this->input->post();
        $harga = $data['nilai_alternatif_harga'];
        $booth = $data['nilai_alternatif_booth'];
        $varian = $data['nilai_alternatif_varian'];
        $fasilitas = $data['nilai_alternatif_fasilitas'];
        $benefit = $data['nilai_alternatif_benefit'];
        $harga_id = $data['alternatifrinc_id_harga'];
        $booth_id = $data['alternatifrinc_id_booth'];
        $varian_id = $data['alternatifrinc_id_varian'];
        $fasilitas_id = $data['alternatifrinc_id_fasilitas'];
        $benefit_id = $data['alternatifrinc_id_benefit'];
        unset(
            $data['nilai_alternatif_harga'],
            $data['nilai_alternatif_booth'],
            $data['nilai_alternatif_varian'],
            $data['nilai_alternatif_fasilitas'],
            $data['nilai_alternatif_benefit'],
            $data['alternatifrinc_id_harga'],
            $data['alternatifrinc_id_booth'],
            $data['alternatifrinc_id_varian'],
            $data['alternatifrinc_id_fasilitas'],
            $data['alternatifrinc_id_benefit']
        );

        if ($data['alternatif_id'] == '') {
            $get = $this->db->order_by('alternatif_id', 'DESC')->get('alternatif')->row_array();
            if ($get == null) {
                $dt['alternatif_id'] = date('ymd') . '0001';
            } else {
                $tgl = substr($get['alternatif_id'], 0, 6);
                if ($tgl != date('ymd')) {
                    $dt['alternatif_id'] = date('ymd') . '0001';
                } else {
                    $dt['alternatif_id'] = $get['alternatif_id'] + 1;
                }
            }
            $data['perhitungan_id'] =  $data['perhitungan_id'];
            $data['alternatif_id'] = $dt['alternatif_id'];
            $this->db->insert('alternatif', $data);

            $final_harga = $this->get_final_harga($harga);
            $get_bobot_harga = $this->get_bobot($final_harga);
            $get_id_harga = $this->get_id();
            $dt_harga['alternatifrinc_id'] = $get_id_harga;
            $dt_harga['alternatif_id']  = $dt['alternatif_id'];
            $dt_harga['bobot_id']  = $final_harga;
            $dt_harga['kriteria_nm']  = $get_bobot_harga['kriteria_nm'];
            $dt_harga['nilai_bobot']  = $get_bobot_harga['nilai_bobot'];
            $dt_harga['nilai_alternatif']  = $harga;
            $this->db->insert('alternatif_rinc', $dt_harga);

            $final_booth = $this->get_final_booth($booth);
            $get_bobot_booth = $this->get_bobot($final_booth);
            $get_id_booth = $this->get_id();
            $dt_booth['alternatifrinc_id'] = $get_id_booth;
            $dt_booth['alternatif_id']  = $dt['alternatif_id'];
            $dt_booth['bobot_id']  = $final_booth;
            $dt_booth['kriteria_nm']  = $get_bobot_booth['kriteria_nm'];
            $dt_booth['nilai_bobot']  = $get_bobot_booth['nilai_bobot'];
            $dt_booth['nilai_alternatif']  = $booth;
            $this->db->insert('alternatif_rinc', $dt_booth);

            $final_varian = $this->get_final_varian($varian);
            $get_bobot_varian = $this->get_bobot($final_varian);
            $get_id_varian = $this->get_id();
            $dt_varian['alternatifrinc_id'] = $get_id_varian;
            $dt_varian['alternatif_id']  = $dt['alternatif_id'];
            $dt_varian['bobot_id']  = $final_varian;
            $dt_varian['kriteria_nm']  = $get_bobot_varian['kriteria_nm'];
            $dt_varian['nilai_bobot']  = $get_bobot_varian['nilai_bobot'];
            $dt_varian['nilai_alternatif']  = $varian;
            $this->db->insert('alternatif_rinc', $dt_varian);

            $final_fasilitas = $this->get_final_fasilitas($fasilitas);
            $get_bobot_fasilitas = $this->get_bobot($final_fasilitas);
            $get_id_fasilitas = $this->get_id();
            $dt_fasilitas['alternatifrinc_id'] = $get_id_fasilitas;
            $dt_fasilitas['alternatif_id']  = $dt['alternatif_id'];
            $dt_fasilitas['bobot_id']  = $final_fasilitas;
            $dt_fasilitas['kriteria_nm']  = $get_bobot_fasilitas['kriteria_nm'];
            $dt_fasilitas['nilai_bobot']  = $get_bobot_fasilitas['nilai_bobot'];
            $dt_fasilitas['nilai_alternatif']  = $fasilitas;
            $this->db->insert('alternatif_rinc', $dt_fasilitas);

            $final_benefit = $this->get_final_benefit($benefit);
            $get_bobot_benefit = $this->get_bobot($final_benefit);
            $get_id_benefit = $this->get_id();
            $dt_benefit['alternatifrinc_id'] = $get_id_benefit;
            $dt_benefit['alternatif_id']  = $dt['alternatif_id'];
            $dt_benefit['bobot_id']  = $final_benefit;
            $dt_benefit['kriteria_nm']  = $get_bobot_benefit['kriteria_nm'];
            $dt_benefit['nilai_bobot']  = $get_bobot_benefit['nilai_bobot'];
            $dt_benefit['nilai_alternatif']  = $benefit;
            $this->db->insert('alternatif_rinc', $dt_benefit);
        } else {

            $data['perhitungan_id'] =  $data['perhitungan_id'];
            $this->db->where('alternatif_id', $data['alternatif_id'])->update('alternatif', $data);

            $final_harga = $this->get_final_harga($harga);
            $get_bobot_harga = $this->get_bobot($final_harga);
            $dt_harga['alternatif_id']  = $data['alternatif_id'];
            $dt_harga['bobot_id']  = $final_harga;
            $dt_harga['kriteria_nm']  = $get_bobot_harga['kriteria_nm'];
            $dt_harga['nilai_bobot']  = $get_bobot_harga['nilai_bobot'];
            $dt_harga['nilai_alternatif']  = $harga;
            $this->db->where('alternatifrinc_id', $harga_id)->update('alternatif_rinc', $dt_harga);

            $final_booth = $this->get_final_booth($booth);
            $get_bobot_booth = $this->get_bobot($final_booth);
            $dt_booth['alternatif_id']  = $data['alternatif_id'];
            $dt_booth['bobot_id']  = $final_booth;
            $dt_booth['kriteria_nm']  = $get_bobot_booth['kriteria_nm'];
            $dt_booth['nilai_bobot']  = $get_bobot_booth['nilai_bobot'];
            $dt_booth['nilai_alternatif']  = $booth;
            $this->db->where('alternatifrinc_id', $booth_id)->update('alternatif_rinc', $dt_booth);

            $final_varian = $this->get_final_varian($varian);
            $get_bobot_varian = $this->get_bobot($final_varian);
            $dt_varian['alternatif_id']  = $data['alternatif_id'];
            $dt_varian['bobot_id']  = $final_varian;
            $dt_varian['kriteria_nm']  = $get_bobot_varian['kriteria_nm'];
            $dt_varian['nilai_bobot']  = $get_bobot_varian['nilai_bobot'];
            $dt_varian['nilai_alternatif']  = $varian;
            $this->db->where('alternatifrinc_id', $varian_id)->update('alternatif_rinc', $dt_varian);

            $final_fasilitas = $this->get_final_fasilitas($fasilitas);
            $get_bobot_fasilitas = $this->get_bobot($final_fasilitas);
            $dt_fasilitas['alternatif_id']  = $data['alternatif_id'];
            $dt_fasilitas['bobot_id']  = $final_fasilitas;
            $dt_fasilitas['kriteria_nm']  = $get_bobot_fasilitas['kriteria_nm'];
            $dt_fasilitas['nilai_bobot']  = $get_bobot_fasilitas['nilai_bobot'];
            $dt_fasilitas['nilai_alternatif']  = $fasilitas;
            $this->db->where('alternatifrinc_id', $fasilitas_id)->update('alternatif_rinc', $dt_fasilitas);

            $final_benefit = $this->get_final_benefit($benefit);
            $get_bobot_benefit = $this->get_bobot($final_benefit);
            $dt_benefit['alternatif_id']  = $data['alternatif_id'];
            $dt_benefit['bobot_id']  = $final_benefit;
            $dt_benefit['kriteria_nm']  = $get_bobot_benefit['kriteria_nm'];
            $dt_benefit['nilai_bobot']  = $get_bobot_benefit['nilai_bobot'];
            $dt_benefit['nilai_alternatif']  = $benefit;
            $this->db->where('alternatifrinc_id', $benefit_id)->update('alternatif_rinc', $dt_benefit);
        }
        return $data;
    }

    public function get_final_harga($harga)
    {
        if (intval($harga) > 35000000) {
            $res = '0001.0001';
        } elseif (intval($harga) > 25000000) {
            $res = '0001.0002';
        } elseif (intval($harga) > 15000000) {
            $res = '0001.0003';
        } elseif (intval($harga) > 5000000) {
            $res = '0001.0004';
        } elseif (intval($harga) <= 5000000) {
            $res = '0001.0005';
        }
        return  $res;
    }

    public function get_final_booth($booth)
    {
        $boothh = str_replace(',', '.', $booth);
        if ($boothh > 3.5) {
            $res = '0002.0005';
        } elseif ($boothh > 2.5) {
            $res = '0002.0004';
        } elseif ($boothh > 1.5) {
            $res = '0002.0003';
        } elseif ($boothh > 0.5) {
            $res = '0002.0002';
        } elseif ($boothh <= 0.5) {
            $res = '0002.0001';
        }

        return  $res;
    }

    public function get_final_varian($varian)
    {
        if ($varian > 12) {
            $res = '0003.0005';
        } elseif ($varian > 9) {
            $res = '0003.0004';
        } elseif ($varian > 6) {
            $res = '0003.0003';
        } elseif ($varian > 3) {
            $res = '0003.0002';
        } elseif ($varian <= 3) {
            $res = '0003.0001';
        }
        return  $res;
    }
    public function get_final_fasilitas($fasilitas)
    {
        if ($fasilitas >= 5) {
            $res = '0004.0004';
        } elseif ($fasilitas == 4) {
            $res = '0004.0003';
        } elseif ($fasilitas == 3) {
            $res = '0004.0002';
        } elseif ($fasilitas <= 2) {
            $res = '0004.0001';
        }
        return  $res;
    }

    public function get_final_benefit($benefit)
    {
        if (intval($benefit) > 11000000) {
            $res = '0005.0005';
        } elseif (intval($benefit) > 8000000) {
            $res = '0005.0004';
        } elseif (intval($benefit) > 5000000) {
            $res = '0005.0003';
        } elseif (intval($benefit) > 2000000) {
            $res = '0005.0002';
        } elseif (intval($benefit) <= 2000000) {
            $res = '0005.0001';
        }
        return  $res;
    }


    public function get_bobot($id)
    {
        $list = $this->db->query(
            "SELECT a.* ,b.*
            FROM bobot a
            LEFT JOIN kriteria b ON a.kriteria_id = b.kriteria_id
            WHERE a.bobot_id = '$id'"
        )->row_array();

        return $list;
    }
    public function get_id()
    {
        $get = $this->db->order_by('alternatifrinc_id', 'DESC')->get('alternatif_rinc')->row_array();
        if ($get == null) {
            $dt['alternatifrinc_id'] = date('ymd') . '0001';
        } else {
            $tgl = substr($get['alternatifrinc_id'], 0, 6);
            if ($tgl != date('ymd')) {
                $dt['alternatifrinc_id'] = date('ymd') . '0001';
            } else {
                $dt['alternatifrinc_id'] = $get['alternatifrinc_id'] + 1;
            }
        }

        $id = $dt['alternatifrinc_id'];
        return $id;
    }

    public function delete_alternatif($id = '', $alternatif_id = '')
    { {
            $this->db->where('alternatif_id', $alternatif_id);
            $this->db->where('perhitungan_id', $id);
            $this->db->delete('alternatif');

            $this->db->where('alternatif_id', $alternatif_id);
            $this->db->delete('alternatif_rinc');
        }
    }

    // Perhitungan metode topsis
    public function get_alternatif($perhitungan_id)
    {
        $sql = "SELECT a.* 
                FROM alternatif a  
                WHERE a.perhitungan_id = $perhitungan_id ";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        foreach ($res as $key => $row) {
            $harga = $this->db->query(
                "SELECT a.*
                    FROM alternatif_rinc a
                    WHERE a.alternatif_id = '" . $row['alternatif_id'] . "' AND a.kriteria_nm = 'Harga'"
            )->row_array();
            if ($harga == null) {
                $res[$key]['nilai_alternatif_harga'] = null;
                $res[$key]['nilai_bobot_harga'] = null;
                $res[$key]['alternatifrinc_id_harga'] = null;
            } else {
                $res[$key]['nilai_alternatif_harga'] = $harga['nilai_alternatif'];
                $res[$key]['nilai_bobot_harga'] = $harga['nilai_bobot'];
                $res[$key]['alternatifrinc_id_harga'] = $harga['alternatifrinc_id'];
            }
        }
        foreach ($res as $key => $row) {
            $booth = $this->db->query(
                "SELECT a.*
                    FROM alternatif_rinc a
                    WHERE a.alternatif_id = '" . $row['alternatif_id'] . "' AND a.kriteria_nm = 'Ukuran Booth'"
            )->row_array();
            if ($booth == null) {
                $res[$key]['nilai_alternatif_booth'] = null;
                $res[$key]['nilai_bobot_booth'] = null;
                $res[$key]['alternatifrinc_id_booth'] = null;
            } else {
                $res[$key]['nilai_alternatif_booth'] = $booth['nilai_alternatif'];
                $res[$key]['nilai_bobot_booth'] = $booth['nilai_bobot'];
                $res[$key]['alternatifrinc_id_booth'] = $booth['alternatifrinc_id'];
            }
        }
        foreach ($res as $key => $row) {
            $varian = $this->db->query(
                "SELECT a.*
                    FROM alternatif_rinc a
                    WHERE a.alternatif_id = '" . $row['alternatif_id'] . "' AND a.kriteria_nm = 'Varian Menu'"
            )->row_array();
            if ($varian == null) {
                $res[$key]['nilai_alternatif_varian'] = null;
                $res[$key]['nilai_bobot_varian'] = null;
                $res[$key]['alternatifrinc_id_varian'] = null;
            } else {
                $res[$key]['nilai_alternatif_varian'] = $varian['nilai_alternatif'];
                $res[$key]['nilai_bobot_varian'] = $varian['nilai_bobot'];
                $res[$key]['alternatifrinc_id_varian'] = $varian['alternatifrinc_id'];
            }
        }
        foreach ($res as $key => $row) {
            $fasilitas = $this->db->query(
                "SELECT a.*
                    FROM alternatif_rinc a
                    WHERE a.alternatif_id = '" . $row['alternatif_id'] . "' AND a.kriteria_nm = 'Fasilitas'"
            )->row_array();
            if ($fasilitas == null) {
                $res[$key]['nilai_alternatif_fasilitas'] = null;
                $res[$key]['nilai_bobot_fasilitas'] = null;
                $res[$key]['alternatifrinc_id_fasilitas'] = null;
            } else {
                $res[$key]['nilai_alternatif_fasilitas'] = $fasilitas['nilai_alternatif'];
                $res[$key]['nilai_bobot_fasilitas'] = $fasilitas['nilai_bobot'];
                $res[$key]['alternatifrinc_id_fasilitas'] = $fasilitas['alternatifrinc_id'];
            }
        }
        foreach ($res as $key => $row) {
            $benefit = $this->db->query(
                "SELECT a.*
                    FROM alternatif_rinc a
                    WHERE a.alternatif_id = '" . $row['alternatif_id'] . "' AND a.kriteria_nm = 'Kisaran Pendapatan'"
            )->row_array();
            if ($benefit == null) {
                $res[$key]['nilai_alternatif_benefit'] = null;
                $res[$key]['nilai_bobot_benefit'] = null;
                $res[$key]['alternatifrinc_id_benefit'] = null;
            } else {
                $res[$key]['nilai_alternatif_benefit'] = $benefit['nilai_alternatif'];
                $res[$key]['nilai_bobot_benefit'] = $benefit['nilai_bobot'];
                $res[$key]['alternatifrinc_id_benefit'] = $benefit['alternatifrinc_id'];
            }
        }
        return $res;
    }

    public function save_preferensi($data)
    {
        $data['nilai_preferensi'] = round(@$data['nilai_preferensi'], 10);
        $this->db->where('alternatif_id', $data['alternatif_id'])->update('alternatif', $data);
    }

    public function update($perhitungan_id = '')
    {
        $data['status'] = '1';
        $this->db->where('perhitungan_id', $perhitungan_id)->update('perhitungan', $data);
    }

    public function get_hasil($id)
    {
        // $sql = "SELECT *, FIND_IN_SET( nilai_preferensi, ( 
        //     SELECT GROUP_CONCAT( nilai_preferensi
        //     ORDER BY nilai_preferensi DESC )
        //     FROM alternatif )
        //     ) AS ranking
        // FROM alternatif  
        // WHERE perhitungan_id = $id";
        $sql = "SELECT *
        FROM alternatif  
        WHERE perhitungan_id = $id ORDER BY nilai_preferensi DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
