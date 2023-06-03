<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 text-uppercase "><?= $title; ?></h1>

    <h3 class="h5 mb-4 text-Primary text-uppercase "><span class="badge badge-primary">Informasi Keuangan Desa </span> </h3>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                KAS Saat ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= num_id($kas_sekarang) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pemasukan Kas Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= num_id($pemasukan_kas['jumlah_transaksi']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Pengeluaran Kas Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= num_id($pengeluaran_kas['jml_pengeluaran']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                JIMPITAN Saat ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= num_id($jimpitan_sekarang) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pemasukan Jimpitan Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= num_id($pemasukan_jimpitan['jumlah_transaksi']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Pengeluaran Jimpitan Hari Ini</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?= num_id($pengeluaran_jimpitan['jml_pengeluaran']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3 class="h5 mb-4 text-Primary text-uppercase "><span class="badge badge-warning">Jadwal Ronda</span> </h3>
    <div class="row">
        <div class=" col-lg-3">
            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Senin</h6>
                    <i class="fas fa-home fa-2x text-success"></i>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <ul class="text-info">
                        <?php foreach ($senin as $row) : ?>
                            <li><?= $row['anggota_nm'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class=" col-md-3 ">
            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Selasa</h6>
                    <i class="fas fa-home fa-2x text-success"></i>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <ul class="text-info">
                        <?php foreach ($selasa as $row) : ?>
                            <li><?= $row['anggota_nm'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class=" col-md-3 ">
            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rabu</h6>
                    <i class="fas fa-home fa-2x text-success"></i>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <ul class="text-info">
                        <?php foreach ($rabu as $row) : ?>
                            <li><?= $row['anggota_nm'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class=" col-md-3 ">
            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Kamis</h6>
                    <i class="fas fa-home fa-2x text-success"></i>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <ul class="text-info">
                        <?php foreach ($kamis as $row) : ?>
                            <li><?= $row['anggota_nm'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class=" col-md-3 ">
            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Jumat</h6>
                    <i class="fas fa-home fa-2x text-success"></i>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <ul class="text-info">
                        <?php foreach ($jumat as $row) : ?>
                            <li><?= $row['anggota_nm'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class=" col-md-3 ">
            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sabtu</h6>
                    <i class="fas fa-home fa-2x text-success"></i>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <ul class="text-info">
                        <?php foreach ($sabtu as $row) : ?>
                            <li><?= $row['anggota_nm'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class=" col-md-3 ">
            <!-- Dropdown Card Example -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Minggu </h6>
                    <i class="fas fa-home fa-2x text-success"></i>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <ul class="text-info">
                        <?php foreach ($minggu as $row) : ?>
                            <li><?= $row['anggota_nm'] ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->