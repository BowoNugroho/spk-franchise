<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <span id="success_message"></span>
            <a href="<?= site_url($menu['url']); ?>/index" class="btn btn-primary mb-3"><i class="fa  fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
            <a href="<?= site_url($menu['url']) . '/alternatif_form/' . $id ?>" class="btn btn-primary mb-3"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>


            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Data Alternatif </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Register</th>
                                    <th class="text-center" scope="col">Nama Franchise</th>
                                    <th class="text-center" scope="col">Keterangan</th>
                                    <th class="text-center" scope="col">Harga</th>
                                    <th class="text-center" scope="col">Ukuran Booth</th>
                                    <th class="text-center" scope="col">Varian Menu</th>
                                    <th class="text-center" scope="col">Fasilitan</th>
                                    <th class="text-center" scope="col">Kisaran Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <?php $no = 1;
                                foreach ($main as $m) : ?>
                                    <tr>
                                        <td class="text-center" scope="col"><?= $no++ ?></td>
                                        <td class="text-left" scope="col"><?= @$m['alternatif_id'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['franchise_nm'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['keterangan'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['nilai_alternatif_harga'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['nilai_alternatif_booth'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['nilai_alternatif_varian'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['nilai_alternatif_fasilitas'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['nilai_alternatif_benefit'] ?></td>
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
    function cb_access(id) {
        var menu_id = id;
        var role_id = <?= ($role) ?>;
        // console.log(menu_id);
        // console.log(role_id);
        $.ajax({
            url: '<?= site_url($menu['url']); ?>/changeAccess',
            type: 'post',
            data: {
                menu_id: menu_id,
                role_id: role_id,
            },
            success: function() {
                $.toast({
                    heading: 'Sukses',
                    text: 'Berhasil disimpan.',
                    icon: 'success',
                    position: 'top-right'
                })
                // document.location.href = '<?= site_url($menu['url']); ?>/form/' + role_id;
            }
        })
    }
</script>