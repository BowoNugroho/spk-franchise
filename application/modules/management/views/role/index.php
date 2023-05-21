<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <span id="success_message"></span>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahRole"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Role </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Role</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <?php $no = 1;
                                foreach ($main as $m) : ?>
                                    <tr>
                                        <td class="text-center" scope="col"><?= $no++ ?></td>
                                        <td class="text-left" scope="col"><?= @$m['role_nm'] ?></td>
                                        <td class="text-center" scope="col">
                                            <li class="fa <?= ($m['is_active'] == '1' ? 'fa-check-circle text-success' : 'fa-minus-circle text-danger') ?>"></li>
                                        </td>
                                        <td class="text-center" scope="col">
                                            <?php if (@$m['role_id'] == 1) : ?>
                                                <span class="badge badge-danger">not action</span>
                                            <?php else : ?>
                                                <a class="btn btn-primary btn-circle btn-sm btn-edit" data-toggle="modal" data-target="#editRole" data-id="<?= $m['role_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger btn-circle btn-sm btn-delete" data-id="<?= $m['role_id'] ?>"><i class="far fa-trash-alt"></i></a>
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
<div class="modal fade" id="tambahRole" tabindex="-1" aria-labelledby="tambahRoleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahRoleLabel">Menambah Role Baru</h5>
            </div>
            <form method="POST" id="save_role">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="role_id" name="role_id" value="">
                        <input type="text" class="form-control" id="role_nm" name="role_nm" placeholder="Nama Role">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="role_nm_error"></strong>
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
                    <button type="submit" class="btn btn-primary" id="save_role">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit -->
<div class="modal fade" id="editRole" tabindex="-1" aria-labelledby="editRoleModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRoleLabel">Edit Role</h5>
            </div>
            <form method="POST" id="update_role">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="role_id" name="role_id">
                        <input type="text" class="form-control" id="role_nm" name="role_nm" placeholder="Nama Role">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="role_nm_error"></strong>
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
                    <button type="submit" class="btn btn-primary" id="update_role">Ubah</button>
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
        $('#save_role').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/saveRole',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.error) {
                        console.log(data.error);
                        if (data.role_nm_error != '') {
                            $('#role_nm_error').html(data.role_nm_error);
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
                url: '<?= site_url($menu['url']); ?>/getRoleById/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('input[name="role_id"]').val(response.role_id);
                    $('input[name="role_nm"]').val(response.role_nm);
                    $('select[name="is_active"]').val(response.is_active);
                }
            })
        });
        // update data Menu
        $('#update_role').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/updateRole',
                type: 'POST',
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.error) {
                        console.log(data.error);
                        if (data.role_nm_error != '') {
                            $('#role_nm_error').html(data.role_nm_error);
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
                    url: '<?= site_url($menu['url']); ?>/deleteRole/' + id,
                    type: 'GET',
                    success: function(response) {
                        location.reload();
                    }
                })

            });

        });

    });
</script>