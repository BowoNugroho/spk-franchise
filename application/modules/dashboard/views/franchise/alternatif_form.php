<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <span id="success_message"></span>
            <!-- <a href="<?= site_url($menu['url']); ?>/index" class="btn btn-primary mb-3"><i class="fa  fa-arrow-circle-left" aria-hidden="true"></i> Kembali</a>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahPerhitungan"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a> -->


            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Tambah Alternatif </h6>
                </div>
                <div class="card-body">
                    <form role="form" id="save_alternatif" method="POST">
                        <div class="row">
                            <div class="col-12 ml-2">
                                <label class="col-lg-6 col-md-5 col-form-label text-left">Nama Franchise <span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-4">
                                    <input type="hidden" class="form-control" id="alternatif_id" name="alternatif_id" value="">
                                    <input type="hidden" class="form-control" id="perhitungan_id" name="perhitungan_id" value="<?= $id ?>">
                                    <input type="text" class="form-control" id="franchise_nm" name="franchise_nm" value="">
                                </div>
                                <span class="text-danger ">
                                    <strong id="franchise_nm_error"></strong>
                                </span>
                            </div>
                            <div class="col-12 ml-2">
                                <label class="col-lg-6 col-md-5 col-form-label text-left">Keterangan </label>
                                <div class="col-lg-8 col-md-4">
                                    <textarea class="form-control" name="keterangan" id="keterangan" cols="10" rows="3"></textarea>
                                </div>
                            </div>
                            <label class="col-lg-6 col-md-5 col-form-label text-left text-primary mt-3 ">Kriteria </label>
                        </div>
                        <div class="row col-12 mt-2">
                            <div class="alert alert-warning mb-4 " role="alert" id="alert-tindak-lanjut">
                                Cara Pengisian Kriteria <br>
                                <ul>
                                    <li>Untuk Harga dan Kisaran Pendapatan di tulis dengan format nominal harga misal 2000000</li>
                                    <li>Untuk Ukuran booth bisa di tulisakan luas booth dan bsai pakai koma (,)</li>
                                    <li>Untuk Varian Menu cukup di tulis berapa macam varian yang ada</li>
                                    <li>Untuk Fasilitas bisa di tulis kan berapa fasilitas yang di dapat, misal dapat booth dan Buku sop maka cukup di tulis 2 </li>
                                </ul>
                                Macam - macam Fasilitas :<br>
                                <ul>
                                    <li>Booth,Perlengkapan, Software keuangan, Pelatihan Karyawan</li>
                                    <li>Buku SOP, Seragam, Sarana Promosi , dll</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row col-12">
                            <div class="row col-6 ml-2">
                                <label class="col-lg-4 col-md-5 col-form-label text-left">Harga Franchise<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-4">
                                    <input type="number" class="form-control" id="nilai_alternatif_harga" name="nilai_alternatif_harga" value="">
                                </div>
                                <span class="text-danger ">
                                    <strong id="nilai_alternatif_harga_error"></strong>
                                </span>
                            </div>
                            <div class="row col-6 ml-2">
                                <label class="col-lg-4 col-md-5 col-form-label text-left">Fasilitas yg didapat<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-4">
                                    <input type="number" class="form-control" id="nilai_alternatif_fasilitas" name="nilai_alternatif_fasilitas" value="">
                                </div>
                                <span class="text-danger ">
                                    <strong id="nilai_alternatif_fasilitas_error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="row col-12 mt-3">
                            <div class="row col-6 ml-2">
                                <label class="col-lg-4 col-md-5 col-form-label text-left">Ukuran Booth<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-4">
                                    <input type="number" class="form-control" id="nilai_alternatif_booth" name="nilai_alternatif_booth" value="">
                                </div>
                                <span class="text-danger ">
                                    <strong id="nilai_alternatif_booth_error"></strong>
                                </span>
                            </div>
                            <div class="row col-6 ml-2">
                                <label class="col-lg-4 col-md-5 col-form-label text-left">Kisaran Pendapatan<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-4">
                                    <input type="number" class="form-control" id="nilai_alternatif_benefit" name="nilai_alternatif_benefit" value="">
                                </div>
                                <span class="text-danger ">
                                    <strong id="nilai_alternatif_benefit_error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="row col-12 mt-3">
                            <div class="row col-6 ml-2">
                                <label class="col-lg-4 col-md-5 col-form-label text-left">Varian Menu<span class="text-danger">*</span></label>
                                <div class="col-lg-6 col-md-4">
                                    <input type="number" class="form-control" id="nilai_alternatif_varian" name="nilai_alternatif_varian" value="">
                                </div>
                                <span class="text-danger ">
                                    <strong id="nilai_alternatif_varian_error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="row ml-3 mt-3">
                            <div class="col-9"></div>
                            <div class="col-3 text-right">
                                <button type="submit" class="btn btn-primary" id="save_alternatif">Save</button>
                            </div>
                        </div>
                    </form>
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
        // is_between();
        //Save Menu
        $('#save_alternatif').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: '<?= site_url($menu['url']); ?>/saveAlternatif',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.error) {
                        console.log(data.error);
                        if (data.franchise_nm_error != '') {
                            $('#franchise_nm_error').html(data.franchise_nm_error);
                            $('#nilai_alternatif_harga_error').html(data.nilai_alternatif_harga_error);
                            $('#nilai_alternatif_fasilitas_error').html(data.nilai_alternatif_fasilitas_error);
                            $('#nilai_alternatif_booth_error').html(data.nilai_alternatif_booth_error);
                            $('#nilai_alternatif_benefit_error').html(data.nilai_alternatif_benefit_error);
                            $('#nilai_alternatif_varian_error').html(data.nilai_alternatif_varian_error);
                            // $('#is_between_error').html(data.is_between_error);
                        }
                    }
                    if (data.success) {
                        console.log(data.success);
                        window.location.replace('<?= site_url($menu['url']); ?>/form/' + data.perhitungan_id);
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

<!-- <div class="col-12 ml-2">
    <?php foreach (@$kriteria as $row) : ?>
        <label class="col-lg-6 col-md-5 col-form-label  text-primary text-left"><?= $row['kriteria_nm'] ?></label>
        <div class="col-lg-7 col-md-4">
            <?php foreach ($row['rinc'] as $key => $rincian) : ?>
                <div class="form-check ml-4">
                    <input class="form-check-input" type="radio" name="kriteria_<?= $rincian['kriteria_id'] ?>[]" id="kriteria_<?= $rincian['kriteria_id'] ?>" value="<?= $rincian['bobot_id'] ?>">
                    <label class="form-check-label" for="kriteria_<?= $rincian['kriteria_id'] ?>">
                        <?php if (@$rincian['is_between'] == 1) : ?>
                            <?= @$rincian['sub_kriteria1'] ?> - <?= @$rincian['sub_kriteria2'] ?>
                        <?php else : ?>
                            <?= @$rincian['operator'] ?> <?= @$rincian['sub_kriteria1'] ?>
                        <?php endif; ?>
                    </label>
                    <span class="text-danger ">
                        <strong id="kriteria_error_<?= $rincian['kriteria_id'] ?>"></strong>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div> -->