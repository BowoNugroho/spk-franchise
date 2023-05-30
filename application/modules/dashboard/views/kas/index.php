<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <span id="success_message"></span>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahKas"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi KAS</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Nama Penyetor</th>
                                    <th class="text-center" scope="col">Jumlah Transaksi</th>
                                    <th class="text-center" scope="col">Nama Pencatat</th>
                                    <th class="text-center" scope="col">Tangal Catat</th>
                                    <th class="text-center" scope="col">Tipe Transaksi</th>
                                    <th class="text-center" scope="col">Keterangan</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <?php $no = 1;
                                foreach ($main as $m) : ?>
                                    <tr>
                                        <td class="text-center" scope="col"><?= $no++ ?></td>
                                        <td class="text-left" scope="col"><?= @$m['anggota_nm'] ?></td>
                                        <td class="text-left" scope="col"><?= num_id(@$m['jumlah_transaksi']) ?></td>
                                        <td class="text-left" scope="col"><?= @$m['petugas_nm'] ?></td>
                                        <td class="text-left" scope="col"><?= to_date(@$m['tgl_catat'], '', 'date') ?></td>
                                        <td class="text-left" scope="col"><?= @$m['tipe_transaksi'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['keterangan'] ?></td>
                                        <td class="text-center" scope="col">
                                            <li class="fa <?= ($m['is_active'] == '1' ? 'fa-check-circle text-success' : 'fa-minus-circle text-danger') ?>"></li>
                                        </td>
                                        <td class="text-center" scope="col">
                                            <a class="btn btn-primary btn-circle btn-sm btn-edit" data-toggle="modal" data-target="#editKas" data-id="<?= @$m['transaksikas_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger btn-circle btn-sm btn-delete" data-id="<?= @$m['transaksikas_id'] ?>"><i class="far fa-trash-alt"></i></a>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<!-- Tambah -->
<div class="modal fade" id="tambahKas" tabindex="-1" aria-labelledby="tambahKasModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKasLabel">Menambah Transaksi Kas Baru</h5>
            </div>
            <form method="POST" id="save_kas">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="transaksikas_id" name="transaksikas_id" value="">
                        <select class="custom-select custom-select-sm form-control" id="anggota_id" name="anggota_id">
                            <option value=''>- Pilih Anggota -</option>
                            <?php foreach ($anggota as $a) : ?>
                                <option value='<?= @$a['anggota_id'] ?>'><?= @$a['anggota_id'] ?> --- <?= @$a['anggota_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger ">
                            <strong id="anggota_id_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" id="jumlah_transaksi" name="jumlah_transaksi" placeholder="Jumlah Transaksi">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="jumlah_transaksi_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <select class="custom-select custom-select-sm form-control" id="petugas_catat_id" name="petugas_catat_id">
                            <option value=''>- Pilih Petugas -</option>
                            <?php foreach ($anggota as $a) : ?>
                                <option value='<?= @$a['anggota_id'] ?>'><?= @$a['anggota_id'] ?> --- <?= @$a['anggota_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger ">
                            <strong id="petugas_catat_id_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <select class="custom-select custom-select-sm form-control" id="transaksi_id" name="transaksi_id"> <!-- tipe transaksi -->
                            <option value=''>- Pilih Tipe Transaksi-</option>
                            <option value='001'>Pemasukan</option>
                            <option value='002'>Pengeluaran</option>
                        </select>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="transaksi_id_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="date" class="form-control" id="tgl_catat" name="tgl_catat" placeholder="Tanggal">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="tgl_catat_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="keterangan_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <select class="custom-select custom-select-sm form-control" id="is_active" name="is_active">
                            <option value='1'>Aktif</option>
                            <option value='0'>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="save_kas">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit -->
<div class="modal fade" id="editKas" tabindex="-1" aria-labelledby="editKasModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKasLabel">Edit Role</h5>
            </div>
            <form method="POST" id="update_kas">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="transaksikas_id" name="transaksikas_id" value="">
                        <select class="custom-select custom-select-sm form-control" id="anggota_id" name="anggota_id">
                            <option value=''>- Pilih Anggota -</option>
                            <?php foreach ($anggota as $a) : ?>
                                <option value='<?= @$a['anggota_id'] ?>'><?= @$a['anggota_id'] ?> --- <?= @$a['anggota_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger ">
                            <strong id="anggota_id_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" id="jumlah_transaksi" name="jumlah_transaksi" placeholder="Jumlah Transaksi">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="jumlah_transaksi_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <select class="custom-select custom-select-sm form-control" id="petugas_catat_id" name="petugas_catat_id">
                            <option value=''>- Pilih Petugas -</option>
                            <?php foreach ($anggota as $a) : ?>
                                <option value='<?= @$a['anggota_id'] ?>'><?= @$a['anggota_id'] ?> --- <?= @$a['anggota_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger ">
                            <strong id="petugas_catat_id_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <select class="custom-select custom-select-sm form-control" id="transaksi_id" name="transaksi_id"> <!-- tipe transaksi -->
                            <option value=''>- Pilih Tipe Transaksi-</option>
                            <option value='001'>Pemasukan</option>
                            <option value='002'>Pengeluaran</option>
                        </select>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="transaksi_id_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="date" class="form-control" id="tgl_catat" name="tgl_catat" placeholder="Tanggal">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="tgl_catat_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="keterangan_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <select class="custom-select custom-select-sm form-control" id="is_active" name="is_active">
                            <option value='1'>Aktif</option>
                            <option value='0'>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="update_kas">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //Save Role
        $('#save_kas').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/saveKas',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.error) {
                        console.log(data.error);
                        if (data.anggota_id_error != '') {
                            $('#anggota_id_error').html(data.anggota_id_error);
                            $('#jumlah_transaksi_error').html(data.jumlah_transaksi_error);
                            $('#petugas_catat_id_error').html(data.petugas_catat_id_error);
                            $('#transaksi_id_error').html(data.transaksi_id_error);
                            $('#tgl_catat_error').html(data.tgl_catat_error);
                            $('#keterangan_error').html(data.keterangan_error);
                        }
                    }
                    if (data.success) {
                        console.log(data.success);
                        location.reload();
                    }
                }
            });
            return false;
        });
        // get data Menu
        $('.btn-edit').bind('click', function() {
            var id = $(this).attr('data-id');
            console.log(id);
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/getKasById/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('select[name="transaksikas_id"]').val(response.transaksikas_id);
                    $('select[name="anggota_id"]').val(response.anggota_id);
                    $('select[name="petugas_catat_id"]').val(response.petugas_catat_id);
                    $('select[name="transaksi_id"]').val(response.transaksi_id);
                    $('input[name="jumlah_transaksi"]').val(response.jumlah_transaksi);
                    $('input[name="tgl_catat"]').val(response.tgl_catat);
                    $('input[name="keterangan"]').val(response.keterangan);
                }
            })
        });
        // update data Menu
        $('#update_kas').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/updateKas',
                type: 'POST',
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.error) {
                        console.log(data.error);
                        if (data.anggota_id_error != '') {
                            $('#anggota_id_error').html(data.anggota_id_error);
                            $('#jumlah_transaksi_error').html(data.jumlah_transaksi_error);
                            $('#petugas_catat_id_error').html(data.petugas_catat_id_error);
                            $('#transaksi_id_error').html(data.transaksi_id_error);
                            $('#tgl_catat_error').html(data.tgl_catat_error);
                            $('#keterangan_error').html(data.keterangan_error);
                        }
                    }
                    if (data.success) {
                        console.log(data.success);
                        location.reload();
                    }
                }
            });
            return false;
        });
        // delete data Menu
        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Setelah dihapus tidak bisa di kembalikan lagi",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#eb3b5a',
                cancelButtonColor: '#b2bec3',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                customClass: 'swal-wide'
            }).then((result) => {
                var id = $(this).attr('data-id');
                console.log(id);
                $.ajax({
                    url: '<?= site_url($menu['url']); ?>/deleteKas/' + id,
                    type: 'GET',
                    success: function(response) {
                        location.reload();
                    }
                })

            });

        });

    });
</script>