<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('index.php/auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>assets/jquery-toast/jquery.toast.min.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js" type="text/javascript"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js" type="text/javascript"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js" type="text/javascript"></script>
<!-- Page level plugins -->
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js" defer type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js" defer type="text/javascript"></script>
<script src="<?= base_url('assets/') ?>plugins/jquery-toast/jquery.toast.min.js" defer></script>
<!-- <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script> -->

<!-- Page level custom scripts -->
<script src="<?= base_url('assets/') ?>js/demo/datatables-demo.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- <script type="text/javascript" charset="utf8" src="<?= base_url('assets/') ?>js/jquery.dataTables.js"></script> -->
<!-- <script src="<?= base_url('assets/') ?>js/jquery-3.6.0.min.js"></script> -->

<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });



    // $('.form-check-input').on('click', function() {
    //     const menuId = $(this).data('menu');
    //     const roleId = $(this).data('role');

    //     $.ajax({
    //         url: "<?= base_url('admin/changeaccess') ?>",
    //         type: 'post',
    //         data: {
    //             menuId: menuId,
    //             roleId: roleId,
    //         },
    //         success: function() {
    //             document.location.href = " <?= base_url('admin/roleaccess/'); ?>" + roleId;
    //         }
    //     })
    // });
</script>

</body>

</html>