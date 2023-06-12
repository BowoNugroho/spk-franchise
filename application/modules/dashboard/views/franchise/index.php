<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <span id="success_message"></span>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPerhitungan"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Perhitungan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">No Register</th>
                                    <th class="text-center" scope="col">Nama Perhitungan</th>
                                    <th class="text-center" scope="col">Tanggal</th>
                                    <th class="text-center" scope="col">Keterangan</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <?php $no = 1;
                                foreach (@$main as $m) : ?>
                                    <tr>
                                        <td class="text-center" scope="col"><?= $no++ ?></td>
                                        <td class="text-center" scope="col"><?= @$m['perhitungan_id'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['perhitungan_nm'] ?></td>
                                        <td class="text-left" scope="col"><?= to_date(@$m['tanggal'], '', 'date') ?></td>
                                        <td class="text-left" scope="col"><?= @$m['keterangan'] ?></td>
                                        <td class="text-center" scope="col">
                                            <a class="btn btn-primary btn-circle btn-sm btn-edit" data-toggle="modal" data-target="#editPerhitungan" data-id="<?= @$m['perhitungan_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger btn-circle btn-sm btn-delete" data-id="<?= @$m['perhitungan_id'] ?>"><i class="far fa-trash-alt"></i></a>
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
<div class="modal fade" id="tambahPerhitungan" tabindex="-1" aria-labelledby="tambahPerhitunganModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPerhitunganLabel">Menambah Perhitungan Baru</h5>
            </div>
            <form method="POST" id="save_perhitungan">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="perhitungan_id" name="perhitungan_id" value="">
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $this->session->userdata('user_id') ?>">
                        <input type="text" class="form-control" id="perhitungan_nm" name="perhitungan_nm" placeholder="Nama Perhitungan">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="perhitungan_nm_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="tanggal_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="keterangan" id="" cols="5" rows="2"></textarea>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="save_perhitungan">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit  -->
<div class="modal fade" id="editPerhitungan" tabindex="-1" aria-labelledby="editPerhitunganModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPerhitunganLabel">Edit Menu </h5>
            </div>
            <form method="POST" id="update_perhitungan">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="perhitungan_id" name="perhitungan_id" value="">
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $this->session->userdata('user_id') ?>">
                        <input type="text" class="form-control" id="perhitungan_nm" name="perhitungan_nm" placeholder="Nama Perhitungan">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="perhitungan_nm_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="tanggal_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" name="keterangan" id="" cols="5" rows="2"></textarea>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="update_perhitungan">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="<?= base_url('assets/') ?>js/jquery-3.6.0.min.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        //Save Menu
        $('#save_perhitungan').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/savePerhitungan',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.error) {
                        console.log(data.error);
                        if (data.perhitungan_nm_error != '') {
                            $('#perhitungan_nm_error').html(data.perhitungan_nm_error);
                            $('#tanggal_error').html(data.tanggal_error);
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
                url: '<?= site_url($menu['url']); ?>/getPerhitunganById/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('input[name="perhitungan_id"]').val(response.perhitungan_id);
                    $('input[name="perhitungan_nm"]').val(response.perhitungan_nm);
                    $('input[name="tanggal"]').val(response.tanggal);
                    $('input[name="keterangan"]').val(response.keterangan);
                }
            })
        });
        // update data user
        $('#update_perhitungan').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/updatePerhitungan',
                type: 'POST',
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.error) {
                        console.log(data.error);
                        if (data.perhitungan_nm_error != '') {
                            $('#perhitungan_nm_error').html(data.perhitungan_nm_error);
                            $('#tanggal_error').html(data.tanggal_error);
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
                    url: '<?= site_url($menu['url']); ?>/deletePerhitungan/' + id,
                    type: 'GET',
                    success: function(response) {
                        location.reload();
                    }
                })

            });

        });

    });
</script><!-- Begin Page Content -->