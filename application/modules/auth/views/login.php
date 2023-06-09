<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-9">
			<div class="card o-hidden border-0 shadow-lg my-5">
				<div class="card-body p-0">
					<div class="row">
						<div class="col-lg-6">
							<div class="p-5 ml-4">
								<table width="100%">
									<tr>
										<td class="text-center mt-3 ">
											SPK PEMILIHAN FRANCHISE
										</td>
									</tr>
									<tr>
										<td class="text-center mt-3 " height="10px"></td>
									</tr>
									<tr>
										<td class="text-center">
											<img class="img-profile" src=" <?= base_url('assets/img/shop.svg') ?>" width="300px">
										</td>
									</tr>
								</table>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Login</h1>
								</div>
								<?= $this->session->flashdata('message'); ?>
								<form class="user" method="post" <?= base_url('auth/login'); ?>>
									<div class="form-group">
										<input type="text" class="form-control form-control-user" id="username" name="username" placeholder="masukan username..." value="<?= set_value('username'); ?>">
										<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<input type="password" class="form-control form-control-user" id="password" name="password" placeholder="masukan password...">
										<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<button type="submit" class="btn btn-primary btn-user btn-block">
										Login
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>