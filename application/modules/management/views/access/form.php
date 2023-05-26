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
                                    <th class="text-center" scope="col">Menu id</th>
                                    <th class="text-center" scope="col">Menu</th>
                                    <th class="text-center" scope="col">Check</th>
                                </tr>
                            </thead>
                            <tbody id="table">
                                <?php $no = 1;
                                foreach ($main as $m) : ?>
                                    <tr>
                                        <td class="text-center" scope="col"><?= $no++ ?></td>
                                        <td class="text-left" scope="col"><?= @$m['menu_id'] ?></td>
                                        <td class="text-left" scope="col">
                                            <?php if ($m['parent_id'] == '') : ?>
                                                <span class="badge badge-primary"><?= @$m['menu_nm'] ?></span>

                                            <?php else : ?>
                                                --|&nbsp;<?= @$m['menu_nm'] ?>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center" scope="col">
                                            <input type="checkbox" class="form-check-input cb_detail_<?= point_to_under($m['menu_id']) ?>" name="cb_view[<?= point_to_under($m['menu_id']) ?>]" onclick="cb_access('<?= $m['menu_id'] ?>')" value="1" <?php if ($m['_view'] == '1') echo 'checked'; ?>>
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