<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <span id="success_message"></span>
            <form id="form-search" action="<?= site_url() .  '/management/menu/search/' . $menu['menu_id']  ?>" method="post" autocomplete="off">
                <div class="col-lg-3 col-md-3 mb-2">
                    <input type="date" class="form-control " name="tgl1" id="tgl1" value="<?= @$cookie['search']['tgl1'] ?>">
                </div>
                <div class="col-lg-3 col-md-3 mb-2">
                    <input type="date" class="form-control " name="tgl2" id="tgl2" value="<?= @$cookie['search']['tgl2'] ?>">
                </div>
                <div class="col-md-6 pl-2 mb-2">
                    <button type="submit" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-primary" title="" data-original-title="Tampilkan Data"><i class="fas fa-search"></i> Tampilkan</button>
                    <a class="btn btn-xs  btn-warning" href="<?= site_url() . '/management/menu/reset/' . $menu['menu_id']  ?>" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-default" title="" data-original-title="Reset"><i class="fa fa-sync-alt"></i></a>
                    <a class="btn btn-xs  btn-info" href="<?= site_url() . '/dashboard/laporan/cetak' ?>" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-default" title=""><i class="fa fa-print"> Cetak</i></a>
                </div>
            </form>
            <!-- <input type="text" class="form-control " name="tgl3" id="tgl3" value="<?= @$cookie['search']['tgl3'] ?>"> -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi KAS</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Tanggal</th>
                                    <th class="text-center" scope="col">Pemasukan</th>
                                    <th class="text-center" scope="col">Pengeluaran</th>
                                </tr>
                            </thead>
                            <?php if ($kas == null) : ?>
                                <tbody id="table">
                                    <tr>
                                        <td class="text-center" scope="col" colspan="99">Tidak Ada Data!</td>
                                    </tr>
                                </tbody>
                            <?php else : ?>
                                <tbody id="table">
                                    <?php $no = 1;
                                    $total_pemasukankas = 0;
                                    $total_pengeluarankas = 0;
                                    $kas_saatini = 0;
                                    asort($kas);
                                    foreach ($kas as $m) :
                                        @$total_pemasukankas += @$m['jumlah_pemasukan'];
                                        @$total_pengeluarankas += @$m['jumlah_pengeluaran'];
                                        @$kas_saatini = @$total_pemasukankas - @$total_pengeluarankas;
                                    ?>
                                        <tr>
                                            <td class="text-center" scope="col"><?= $no++ ?></td>
                                            <td class="text-left" scope="col"><?= @$m['tgl_catat'] ?></td>
                                            <td class="text-left" scope="col">Rp. <?= num_id(@$m['jumlah_pemasukan'])  ?></td>
                                            <td class="text-left" scope="col">Rp. <?= num_id(@$m['jumlah_pengeluaran']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td class="text-right" scope="col" colspan="2">Sub Total</td>
                                        <td class="text-left" scope="col">Rp. <?= num_id(@$total_pemasukankas) ?></td>
                                        <td class="text-left" scope="col">Rp. <?= num_id(@$total_pengeluarankas) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" scope="col" colspan="2">Jumlah Bersih Kas</td>
                                        <td class="text-left" scope="col" colspan="2">Rp. <?= num_id(@$kas_saatini) ?></td>
                                    </tr>
                                </tbody>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi Jimpitan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered  table-striped" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">#</th>
                                    <th class="text-center" scope="col">Tanggal</th>
                                    <th class="text-center" scope="col">Pemasukan</th>
                                    <th class="text-center" scope="col">Pengeluaran</th>
                                </tr>
                            </thead>
                            <?php if ($jimpitan == null) : ?>
                                <tbody id="table">
                                    <tr>
                                        <td class="text-center" scope="col" colspan="99">Tidak Ada Data!</td>
                                    </tr>
                                </tbody>
                            <?php else : ?>
                                <tbody id="table">
                                    <?php $no = 1;
                                    $total_pemasukanjimpitan = 0;
                                    $total_pengeluaranjimpitan = 0;
                                    $jimpitan_saatini = 0;
                                    asort($jimpitan);
                                    foreach ($jimpitan as $m) :
                                        @$total_pemasukanjimpitan += @$m['jumlah_pemasukan'];
                                        @$total_pengeluaranjimpitan += @$m['jumlah_pengeluaran'];
                                        @$jimpitan_saatini = @$total_pemasukanjimpitan - @$total_pengeluaranjimpitan;
                                    ?>
                                        <tr>
                                            <td class="text-center" scope="col"><?= $no++ ?></td>
                                            <td class="text-left" scope="col"><?= @$m['tgl_catat'] ?></td>
                                            <td class="text-left" scope="col"><?= num_id(@$m['jumlah_pemasukan'])  ?></td>
                                            <td class="text-left" scope="col"><?= num_id(@$m['jumlah_pengeluaran']) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td class="text-right" scope="col" colspan="2">Sub Total</td>
                                        <td class="text-left" scope="col">Rp. <?= num_id(@$total_pemasukanjimpitan) ?></td>
                                        <td class="text-left" scope="col">Rp. <?= num_id(@$total_pengeluaranjimpitan) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" scope="col" colspan="2">Jumlah Bersih Jimpitan</td>
                                        <td class="text-left" scope="col" colspan="2">Rp. <?= num_id(@$jimpitan_saatini) ?></td>
                                    </tr>
                                </tbody>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>


<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>