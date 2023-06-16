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
}
