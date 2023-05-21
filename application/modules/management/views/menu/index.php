<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-lg-12">
			<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
			<?= $this->session->flashdata('message'); ?>
			<span id="success_message"></span>
			<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahMenu"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>

			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Daftar Menu</h6>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered  table-striped" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th class="text-center" scope="col">#</th>
									<th class="text-center" scope="col">Menu Id</th>
									<th class="text-center" scope="col">Menu</th>
									<th class="text-center" scope="col">Status</th>
									<th class="text-center" scope="col">Action</th>
								</tr>
							</thead>
							<tbody id="table">
								<?php $no = 1;
								foreach ($main as $m) : ?>
									<tr>
										<td class="text-center" scope="col"><?= $no++ ?></td>
										<td class="text-center" scope="col"><?= @$m['menu_id'] ?></td>
										<td class="text-left" scope="col"><?= @$m['menu_nm'] ?></td>
										<td class="text-center" scope="col">
											<li class="fa <?= ($m['is_active'] == '1' ? 'fa-check-circle text-success' : 'fa-minus-circle text-danger') ?>"></li>
										</td>
										<td class="text-center" scope="col">
											<a class="btn btn-primary btn-circle btn-sm btn-edit" data-toggle="modal" data-target="#editMenu" data-id="<?= $m['menu_id'] ?>"><i class="fas fa-pencil-alt"></i></a>
											<a class="btn btn-danger btn-circle btn-sm btn-delete" data-id="<?= $m['menu_id'] ?>"><i class="far fa-trash-alt"></i></a>
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
<div class="modal fade" id="tambahMenu" tabindex="-1" aria-labelledby="tambahMenuModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="tambahMenuLabel">Menambah Menu Baru</h5>
			</div>
			<form method="POST" id="save_menu">
				<div class="modal-body">
					<div class="mb-3">
						<select class="custom-select custom-select-sm form-control" id="parent_id" name="parent_id">
							<option value=''>Pilih</option>
							<?php foreach ($parent as $row) : ?>
								<option value="<?= $row['menu_id'] ?>"><?= $row['menu_id'] ?> -- <?= $row['menu_nm'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<input type="text" class="form-control" id="menu_id" name="menu_id" placeholder="Menu id">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						<span class="text-danger ">
							<strong id="menu_id_error"></strong>
						</span>
					</div>
					<div class="mb-3">
						<input type="text" class="form-control" id="menu_nm" name="menu_nm" placeholder="Nama Menu">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						<span class="text-danger ">
							<strong id="menu_nm_error"></strong>
						</span>
					</div>
					<div class="mb-3">
						<input type="text" class="form-control" id="url" name="url" placeholder="Nama Url">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						<span class="text-danger ">
							<strong id="url_error"></strong>
						</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary" id="save_menu">Tambah</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Edit  -->
<div class="modal fade" id="editMenu" tabindex="-1" aria-labelledby="editMenuModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editMenuLabel">Edit Menu </h5>
			</div>
			<form method="POST" id="update_menu">
				<div class="modal-body">
					<div class="mb-3">
						<select class="custom-select custom-select-sm form-control" id="edit_parent_id" name="parent_id">
							<option value=''>Pilih</option>
							<?php foreach ($parent as $row) : ?>
								<option value="<?= $row['menu_id'] ?>"><?= $row['menu_id'] ?> -- <?= $row['menu_nm'] ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="mb-3">
						<input type="text" class="form-control" id="edit_menu_id" name="menu_id" placeholder="Menu id">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						<span class="text-danger ">
							<strong id="menu_id_error"></strong>
						</span>
					</div>
					<div class="mb-3">
						<input type="text" class="form-control" id="edit_menu_nm" name="menu_nm" placeholder="Nama Menu">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						<span class="text-danger ">
							<strong id="menu_nm_error"></strong>
						</span>
					</div>
					<div class="mb-3">
						<input type="text" class="form-control" id="edit_url" name="url" placeholder="Nama Url">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						<span class="text-danger ">
							<strong id="url_error"></strong>
						</span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary" id="update_menu">Ubah</button>
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
		$('#save_menu').on('submit', function(event) {
			event.preventDefault();
			$.ajax({
				url: '<?= site_url($menu['url']); ?>/saveMenu',
				type: 'POST',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(data) {
					console.log(data);
					if (data.error) {
						console.log(data.error);
						if (data.menu_error != '') {
							// $('#parent_id_error').html(data.parent_id_error);
							$('#menu_id_error').html(data.menu_id_error);
							$('#menu_nm_error').html(data.menu_nm_error);
							$('#url_error').html(data.url_error);
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
				url: '<?= site_url($menu['url']); ?>/getMenuById/' + id,
				type: 'GET',
				dataType: 'json',
				success: function(response) {
					console.log(response);
					// $("#editMenu").modal('show');
					$('select[name="parent_id"]').val(response.parent_id);
					$('input[name="menu_id"]').val(response.menu_id);
					$('input[name="menu_nm"]').val(response.menu_nm);
					$('input[name="url"]').val(response.url);
				}
			})
		});
		// update data Menu
		$('#update_menu').on('submit', function(event) {
			event.preventDefault();
			$.ajax({
				url: '<?= site_url($menu['url']); ?>/updateMenu',
				type: 'POST',
				data: $(this).serialize(),
				dataType: "JSON",
				success: function(data) {
					if (data.error) {
						console.log(data.error);
						if (data.menu_edit_error != '') {
							// $('#parent_id_error').html(data.parent_id_error);
							$('#menu_id_error').html(data.menu_id_error);
							$('#menu_nm_error').html(data.menu_nm_error);
							$('#url_error').html(data.url_error);
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
					url: '<?= site_url($menu['url']); ?>/deleteMenu/' + id,
					type: 'GET',
					success: function(response) {
						location.reload();
					}
				})

			});

		});

	});
</script>