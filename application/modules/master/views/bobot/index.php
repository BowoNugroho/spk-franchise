<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <span id="success_message"></span>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahBobot"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Bobot</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Nama Kriteria</th>
                                    <th class="text-center" scope="col">Sub Kriteria</th>
                                    <th class="text-center" scope="col">Nilai</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <?php $no = 1;
                                foreach ($main as $m) : ?>
                                    <tr>
                                        <td class="text-center" scope="col"><?= $no++ ?></td>
                                        <td class="text-center" scope="col"><?= @$m['kriteria_nm'] ?></td>
                                        <?php if ($m['is_between'] == 1) : ?>
                                            <td class="text-left" scope="col"><?= @$m['sub_kriteria1'] ?> - <?= @$m['sub_kriteria2'] ?></td>
                                        <?php else : ?>
                                            <td class="text-left" scope="col"><?= @$m['operator'] ?> <?= @$m['sub_kriteria1'] ?></td>
                                        <?php endif; ?>
                                        <td class="text-center" scope="col"><?= @$m['nilai_bobot'] ?></td>
                                        <td class="text-center" scope="col">
                                            <a class="btn btn-primary btn-circle btn-sm btn-edit" data-toggle="modal" data-target="#editBobot" data-id="<?= @$m['bobot_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="btn btn-danger btn-circle btn-sm btn-delete" data-id="<?= @$m['bobot_id'] ?>"><i class="far fa-trash-alt"></i></a>
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
<div class="modal fade" id="tambahBobot" tabindex="-1" aria-labelledby="tambahBobotModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahBobotLabel">Menambah Bobot Baru</h5>
            </div>
            <form method="POST" id="save_bobot">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="bobot_id" name="bobot_id" value="">
                        <select class="custom-select custom-select-sm form-control" id="kriteria_id" name="kriteria_id">
                            <option value=''>- Pilih Kriteria -</option>
                            <?php foreach ($kriteria as $row) : ?>
                                <option value="<?= $row['kriteria_id'] ?>"> <?= $row['kriteria_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger ">
                            <strong id="kriteria_id_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <select class="custom-select custom-select-sm form-control" id="is_between" name="is_between">
                            <option value=''>- is_between? -</option>
                            <option value="1"> Ya</option>
                            <option value="0"> Tidak</option>
                        </select>
                        <span class="text-danger ">
                            <strong id="is_between_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3 d-none" id="box-operator">
                        <input type="text" class="form-control" id="operator" name="operator" placeholder="Operator">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="operator_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3 d-none" id="sub-kriteria1">
                        <input type="text" class="form-control" id="sub_kriteria1" name="sub_kriteria1" placeholder="Sub Kriteria 1">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="sub_kriteria1_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3 d-none" id="sub-kriteria2">
                        <input type="text" class="form-control" id="sub_kriteria2" name="sub_kriteria2" placeholder="Sub Kriteria 2">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="sub_kriteria2_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="nilai_bobot" name="nilai_bobot" placeholder="Nilai Bobot">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="nilai_bobot_error"></strong>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="save_bobot">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Edit  -->
<div class="modal fade" id="editBobot" tabindex="-1" aria-labelledby="editBobotModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBobotLabel">Edit Bobot </h5>
            </div>
            <form method="POST" id="update_bobot">
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="bobot_id" name="bobot_id" value="">
                        <select class="custom-select custom-select-sm form-control" id="kriteria_id" name="kriteria_id">
                            <option value=''>- Pilih Kriteria -</option>
                            <?php foreach ($kriteria as $row) : ?>
                                <option value="<?= $row['kriteria_id'] ?>"> <?= $row['kriteria_nm'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger ">
                            <strong id="kriteria_id_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <select class="custom-select custom-select-sm form-control" id="is_between" name="is_between">
                            <option value=''>- is_between? -</option>
                            <option value="1"> Ya</option>
                            <option value="0"> Tidak</option>
                        </select>
                        <span class="text-danger ">
                            <strong id="is_between_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3 d-none" id="box-operator-edit">
                        <input type="text" class="form-control" id="operator" name="operator" placeholder="Operator">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="operator_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3 d-none" id="sub-kriteria1-edit">
                        <input type="text" class="form-control" id="sub_kriteria1" name="sub_kriteria1" placeholder="Sub Kriteria 1">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="sub_kriteria1_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3 d-none" id="sub-kriteria2-edit">
                        <input type="text" class="form-control" id="sub_kriteria2" name="sub_kriteria2" placeholder="Sub Kriteria 2">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="sub_kriteria2_error"></strong>
                        </span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="nilai_bobot" name="nilai_bobot" placeholder="Nilai Bobot">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        <span class="text-danger ">
                            <strong id="nilai_bobot_error"></strong>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="update_bobot">Ubah</button>
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
        // is_between();
        //Save Menu
        $('#save_bobot').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/saveBobot',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.error) {
                        console.log(data.error);
                        if (data.kriteria_id_error != '') {
                            $('#kriteria_id_error').html(data.kriteria_id_error);
                            $('#is_between_error').html(data.is_between_error);
                            $('#operator_error').html(data.operator_error);
                            $('#sub_kriteria1_error').html(data.sub_kriteria1_error);
                            $('#sub_kriteria2_error').html(data.sub_kriteria2_error);
                            $('#nilai_bobot_error').html(data.nilai_bobot_error);
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
                url: '<?= site_url($menu['url']); ?>/getBobotById/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    is_between(response.is_between);
                    $('input[name="bobot_id"]').val(response.bobot_id);
                    $('select[name="kriteria_id"]').val(response.kriteria_id);
                    $('select[name="is_between"]').val(response.is_between);
                    $('input[name="operator"]').val(response.operator);
                    $('input[name="sub_kriteria1"]').val(response.sub_kriteria1);
                    $('input[name="sub_kriteria2"]').val(response.sub_kriteria2);
                    $('input[name="nilai_bobot"]').val(response.nilai_bobot);

                }
            })
        });
        // update data user
        $('#update_bobot').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/updateBobot',
                type: 'POST',
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.error) {
                        console.log(data.error);
                        if (data.kriteria_id_error != '') {
                            $('#kriteria_id_error').html(data.kriteria_id_error);
                            $('#is_between_error').html(data.is_between_error);
                            $('#operator_error').html(data.operator_error);
                            $('#sub_kriteria1_error').html(data.sub_kriteria1_error);
                            $('#sub_kriteria2_error').html(data.sub_kriteria2_error);
                            $('#nilai_bobot_error').html(data.nilai_bobot_error);
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
                    url: '<?= site_url($menu['url']); ?>/deleteBobot/' + id,
                    type: 'GET',
                    success: function(response) {
                        location.reload();
                    }
                })

            });

        });
        $('#is_between').bind('change', function(event) {
            var val = $(this).val();
            console.log('va');
            console.log(val);

            if (val == 1) {
                $('#box-operator').addClass('d-none');
                $('#sub-kriteria1').removeClass('d-none');
                $('#sub-kriteria2').removeClass('d-none');
            } else {
                $('#box-operator').removeClass('d-none');
                $('#sub-kriteria1').removeClass('d-none');
                $('#sub-kriteria2').addClass('d-none');
            }

        });

    });

    function is_between(data) {
        console.log('va');
        console.log(data);

        if (data == 1) {
            $('#box-operator-edit').addClass('d-none');
            $('#sub-kriteria1-edit').removeClass('d-none');
            $('#sub-kriteria2-edit').removeClass('d-none');
        } else {
            $('#box-operator-edit').removeClass('d-none');
            $('#sub-kriteria1-edit').removeClass('d-none');
            $('#sub-kriteria2-edit').addClass('d-none');
        }
    }
</script>