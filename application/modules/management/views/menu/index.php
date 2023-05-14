<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

	<div class="row">
		<div class="col-lg-12">
			<?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
			<?= $this->session->flashdata('message'); ?>
			<span id="success_message"></span>
			<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah</a>

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
							<tbody>
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
											<a href="#" data-href="<?= site_url() . '/' . $menu['url'] . '/form_modal/' . $m['menu_id'] ?>" modal-title="Ubah Data" modal-size="lg" class="btn btn-primary btn-circle modal-href" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-primary" title="" data-original-title="Ubah Data"><i class="fas fa-pencil-alt"></i></a>
											<a href="#" data-href="<?= site_url() . '/' . $menu['url'] . '/delete/' . $m['menu_id'] ?>" class="btn btn-danger btn-circle btn-delete" data-toggle="tooltip" data-placement="top" data-custom-class="tooltip-danger" title="Hapus Data"><i class="far fa-trash-alt"></i></a>
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