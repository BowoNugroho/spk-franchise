<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <span id="success_message"></span>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahAnggota"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Anggota Perumahan Graha Absolut Pereng Wetan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Nama Anggota</th>
                                    <th class="text-center" scope="col">No Rumah</th>
                                    <th class="text-center" scope="col">No Telepon</th>
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
                                        <td class="text-left" scope="col"><?= @$m['no_rumah'] ?></td>
                                        <td class="text-left" scope="col"><?= @$m['no_tlp'] ?></td>
                                        <td class="text-center" scope="col">
                                            <li class="fa <?= ($m['is_active'] == '1' ? 'fa-check-circle text-success' : 'fa-minus-circle text-danger') ?>"></li>
                                        </td>
                                        <td class="text-center" scope="col">
                                            <?php if (@$m['role_id'] == 1) : ?>
                                                <span class="badge badge-danger">not action</span>
                                            <?php else : ?>
                                                <a class="btn btn-primary btn-circle btn-sm btn-edit" data-toggle="modal" data-target="#editAnggota" data-id="<?= @$m['anggota_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-circle btn-sm btn-delete" data-id="<?= @$m['anggota_id'] ?>"><i class="far fa-trash-alt"></i></a>
                                            <?php endif; ?>
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
<div class="modal fade" id="tambahAnggota" tabindex="-1" aria-labelledby="tambahAnggotaModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahAnggotaLabel">Menambah Role Baru</h5>
            </div>
            <form method="POST" id="save_anggota">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="anggota_id" name="anggota_id" value="">
                        <input type="text" class="form-control text-uppercase" id="anggota_nm" name="anggota_nm" placeholder="Nama Anggota">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="anggota_nm_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="no_rumah" name="no_rumah" placeholder="Nomor Rumah">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="no_rumah_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" id="no_tlp" name="no_tlp" placeholder="Nomor Telepon">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="no_tlp_error"></strong>
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
                    <button type="submit" class="btn btn-primary" id="save_anggota">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit -->
<div class="modal fade" id="editAnggota" tabindex="-1" aria-labelledby="editAnggotaModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAnggotaLabel">Edit Role</h5>
            </div>
            <form method="POST" id="update_anggota">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="anggota_id" name="anggota_id" value="">
                        <input type="text" class="form-control text-uppercase" id="anggota_nm" name="anggota_nm" placeholder="Nama Anggota">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="anggota_nm_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="no_rumah" name="no_rumah" placeholder="Nomor Rumah">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="no_rumah_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="number" class="form-control" id="no_tlp" name="no_tlp" placeholder="Nomor Telepon">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="no_tlp_error"></strong>
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
                    <button type="submit" class="btn btn-primary" id="update_anggota">Ubah</button>
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
        $('#save_anggota').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/saveAnggota',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.error) {
                        console.log(data.error);
                        if (data.anggota_nm_error != '') {
                            $('#anggota_nm_error').html(data.anggota_nm_error);
                            $('#no_rumah_error').html(data.no_rumah_error);
                            $('#no_tlp').html(data.no_tlp);
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
                url: '<?= site_url($menu['url']); ?>/getAnggotaById/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('input[name="anggota_id"]').val(response.anggota_id);
                    $('input[name="anggota_nm"]').val(response.anggota_nm);
                    $('input[name="no_rumah"]').val(response.no_rumah);
                    $('input[name="no_tlp"]').val(response.no_tlp);
                    $('select[name="is_active"]').val(response.is_active);
                }
            })
        });
        // update data Menu
        $('#update_anggota').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/updateAnggota',
                type: 'POST',
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.error) {
                        console.log(data.error);
                        if (data.anggota_nm_error != '') {
                            $('#anggota_nm_error').html(data.anggota_nm_error);
                            $('#no_rumah_error').html(data.no_rumah_error);
                            $('#no_tlp').html(data.no_tlp);
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
                    url: '<?= site_url($menu['url']); ?>/deleteAnggota/' + id,
                    type: 'GET',
                    success: function(response) {
                        location.reload();
                    }
                })

            });

        });

    });
</script>