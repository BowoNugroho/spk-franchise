<?php include('_header.php') ?>


<table width="100%">
  <tr>
    <td class="center">
      <table>
        <tr>
          <td class="center" style="font-size: 15;">REKOMENDASI FRANCHISE</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="left">
      <table>
        <tr>
          <td class="center" style="font-size: 15;">A. DATA ALTERNATIF</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="left">
      <table>
        <thead>
          <tr style="font-size: 10;">
            <th class="border-all" style="font-size: 10;" width="30px">No</th>
            <th class="border-all" style="font-size: 10;" width="100px">Register</th>
            <th class="border-all" style="font-size: 10;" width="150px">Nama Franchise</th>
            <th class="border-all" style="font-size: 10;" width="100px">Harga</th>
            <th class="border-all" style="font-size: 10;" width="60px">Ukuran Booth</th>
            <th class="border-all" style="font-size: 10;" width="60px">Varian Menu</th>
            <th class="border-all" style="font-size: 10;" width="60px">Fasilitas</th>
            <th class="border-all" style="font-size: 10;" width="100px">Kisaran Pendapatan</th>
            <th class="border-all" style="font-size: 10;" width="100px">Keterangan</th>
          </tr>
        </thead>
        <?php if (@$main == null) : ?>
          <tbody>
            <tr>
              <td class="border-all  center" colspan="9"><i>Tidak Ada Data...</i></td>
            </tr>
          </tbody>
        <?php else : ?>
          <tbody>
            <?php $no = 1;
            $ranking = 1;
            foreach ($main as $row) : ?>
              <tr>
                <td class="border-all center" style="font-size: 10;" width="30px"><?= $no++ ?></td>
                <td class="border-all center" style="font-size: 10;" width="100px"><?= @$row['alternatif_id'] ?></td>
                <td class="border-all" style="font-size: 10;" width="150px"><?= @$row['franchise_nm'] ?></td>
                <td class="border-all" style="font-size: 10;" width="100px">Rp. <?= num_id(@$row['nilai_alternatif_harga']) ?></td>
                <td class="border-all" style="font-size: 10;" width="60px"><?= @$row['nilai_alternatif_booth'] ?> M2</td>
                <td class="border-all" style="font-size: 10;" width="60px"><?= @$row['nilai_alternatif_varian'] ?> Macam</td>
                <td class="border-all" style="font-size: 10;" width="60px"><?= @$row['nilai_alternatif_fasilitas'] ?> Macam</td>
                <td class="border-all" style="font-size: 10;" width="100px">Rp. <?= num_id(@$row['nilai_alternatif_benefit']) ?></td>
                <td class="border-all" style="font-size: 10;" width="100px"><?= @$row['keterangan'] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        <?php endif; ?>
      </table>
    </td>
  </tr>
  <tr>
    <td class="left">
      <table>
        <tr>
          <td class="center" style="font-size: 15;">B. HASIL REKOMENDASI </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td class="left">
      <table>
        <thead>
          <tr style="font-size: 10;">
            <th class="border-all" style="font-size: 10;" width="30px">No</th>
            <th class="border-all" style="font-size: 10;" width="100px">Register</th>
            <th class="border-all" style="font-size: 10;" width="150px">Nama Franchise</th>
            <th class="border-all" style="font-size: 10;" width="100px">Nilai Preferensi</th>
            <th class="border-all" style="font-size: 10;" width="100px">Peringkat</th>
          </tr>
        </thead>
        <?php if (@$hasil == null) : ?>
          <tbody>
            <tr>
              <td class="border-all  center" colspan="9"><i>Tidak Ada Data...</i></td>
            </tr>
          </tbody>
        <?php else : ?>
          <tbody>
            <?php $no = 1;
            $ranking = 1;
            foreach ($hasil as $row) : ?>
              <tr>
                <td class="border-all center" style="font-size: 10;" width="30px"><?= $no++ ?></td>
                <td class="border-all center" style="font-size: 10;" width="100px"><?= @$row['alternatif_id'] ?></td>
                <td class="border-all" style="font-size: 10;" width="150px"><?= @$row['franchise_nm'] ?></td>
                <td class="border-all" style="font-size: 10;" width="100px"><?= @$row['nilai_preferensi'] ?></td>
                <td class="border-all" style="font-size: 10;" width="100px"><?= $ranking++ ?> </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        <?php endif; ?>
      </table>
    </td>
  </tr>
  <tr>
    <td class="left">
      <table>
        <tr>
          <td class="center" style="font-size: 15;">Untuk Hasil Rekomendasi Franchise Yaitu : <b><?= $hasil[0]['franchise_nm'] ?></b> dengan nilai <b><?= $hasil[0]['nilai_preferensi'] ?></b></td>
        </tr>
      </table>
    </td>
  </tr>
</table>