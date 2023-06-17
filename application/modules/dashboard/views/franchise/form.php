<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <span id="success_message"></span>
            <a href="<?= site_url($menu['url']); ?>/index" class="btn btn-primary mb-3"><i class="fa  fa-arrow-circle-left" aria-hidden="true"></i> Kembali </a>
            <?php if ($check['status'] == 0) : ?>
                <a href="<?= site_url($menu['url']) . '/alternatif_form/' . $id ?>" class="btn btn-primary mb-3"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>
                <button href="" class="btn btn-success mb-3" onclick="hitung(<?= $id ?>)"><i class="fas fa-random" aria-hidden="true"></i> Hitung</button>
            <?php else : ?>
                <a class="btn btn-xs  btn-info mb-3" href="<?= site_url($menu['url']) . '/cetak/' . $id  ?>" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-default" title=""><i class="fa fa-print"> Cetak</i></a>
            <?php endif; ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Alternatif </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Register</th>
                                    <th class="text-center" scope="col">Nama Franchise</th>
                                    <th class="text-center" scope="col">Harga</th>
                                    <th class="text-center" scope="col">Ukuran Booth</th>
                                    <th class="text-center" scope="col">Varian Menu</th>
                                    <th class="text-center" scope="col">Fasilitan</th>
                                    <th class="text-center" scope="col">Kisaran Pendapatan</th>
                                    <th class="text-center" scope="col">Keterangan</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <?php $no = 1;
                                foreach ($main as $m) : ?>
                                    <tr>
                                        <td class="text-center" scope="col"><?= $no++ ?></td>
                                        <td class="text-left" scope="col"><?= @$m['alternatif_id'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['franchise_nm'] ?></td>
                                        <td class="text-left" scope="col">Rp. <?= num_id(@$m['nilai_alternatif_harga']) ?></td>
                                        <td class="text-left" scope="col"><?= @$m['nilai_alternatif_booth'] ?> M2</td>
                                        <td class="text-left" scope="col"><?= @$m['nilai_alternatif_varian'] ?> Macam</td>
                                        <td class="text-left" scope="col"><?= @$m['nilai_alternatif_fasilitas'] ?> Macam</td>
                                        <td class="text-left" scope="col">Rp. <?= num_id(@$m['nilai_alternatif_benefit']) ?></td>
                                        <td class="text-left" scope="col"><?= @$m['keterangan'] ?></td>
                                        <td class="text-center" scope="col">
                                            <?php if ($check['status'] == 0) : ?>
                                                <a href="<?= site_url($menu['url']) . '/alternatif_form/' . $id . '/' . @$m['alternatif_id'] ?>" class="btn btn-primary btn-circle btn-sm btn-edit" data-id="<?= @$m['alternatif_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-circle btn-sm btn-delete" data-id="<?= $id ?>" data-alternatif-id="<?= @$m['alternatif_id'] ?>"><i class="far fa-trash-alt"></i></a>
                                            <?php else : ?>
                                                <span class="badge badge-success">Sudah Terhitung</span>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">HASIL DAN NILAI PREFERENSI SETIAP ALTERNATIF</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Register</th>
                                    <th class="text-center" scope="col">Nama Franchise</th>
                                    <th class="text-center" scope="col">Nilai Preferensi</th>
                                    <th class="text-center" scope="col">Peringkat</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <?php $no = 1;
                                $ranking = 1;
                                foreach ($hasil as $m) : ?>
                                    <?php if (@$m['ranking'] == '1') : ?>
                                        <tr style="background-color: greenyellow;">
                                        <?php else : ?>
                                        <tr>
                                        <?php endif; ?>
                                        </tr>
                                        <td class="text-center" scope="col"><?= $no++ ?></td>
                                        <td class="text-left" scope="col"><?= @$m['alternatif_id'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['franchise_nm'] ?></td>
                                        <td class="text-left" scope="col">
                                            <?php if (@$m['nilai_preferensi'] != null) : ?>
                                                <?= @$m['nilai_preferensi'] ?>
                                            <?php else : ?>
                                                <span class="badge badge-warning">Belum Terhitung</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center" scope="col">
                                            <?php if (@$m['nilai_preferensi'] != null) : ?>
                                                <?= $ranking++ ?>
                                            <?php else : ?>
                                                <span class="badge badge-warning">Belum Teranking</span>
                                            <?php endif; ?>
                                        </td>
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
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
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
                var alternatif_id = $(this).attr('data-alternatif-id');
                console.log(id);
                $.ajax({
                    url: '<?= site_url($menu['url']); ?>/delete_alternatif/' + id + '/' + alternatif_id,
                    type: 'GET',
                    success: function(response) {
                        window.location.replace('<?= site_url($menu['url']); ?>/form/' + id);
                    }
                })

            });

        });
    });

    function hitung(id) {
        $.ajax({
            url: '<?= site_url($menu['url']); ?>/hitung/' + id,
            type: 'GET',
            success: function(response) {
                window.location.replace('<?= site_url($menu['url']); ?>/form/' + id);
            }
        })
    }
</script>