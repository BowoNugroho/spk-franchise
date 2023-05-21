<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <span id="success_message"></span>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Access Menu </h6>
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
                                                <a class="btn btn-warning btn-circle btn-sm " href="<?= site_url($menu['url'] . '/form/' . $m['role_id']) ?>"><i class="fas fa-cog"></i></a>
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