<main class="animated fadeIn">
	<div class='container-fluid my-4'>
		<div class="row">
			<div class="col">

				<div class="card opacity9">
					<div class="card-header grey lighten-5 d-flex justify-content-end">
						<button class="btn btn-md btn-primary" id="editar"><i class="fas fa-edit mr-2"></i>Habilitar edición</button>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-4 col-xs-12 mb-4">

								<div class="card">

									<div class="mx-auto white">
										<div class="view overlay zoom rounded-none">
											<img src='<?= base_url("application/uploads/avatars/").$user[0]->avatar ?>' class="img-fluid" alt="user avatar" id="avatar">
											<div class="mask">
												<?= form_open_multipart('cambiarAvatar', ['id' => 'formAvatar', 'style' => 'opacity:0.7']) ?>
													<div class="d-flex justify-content-between">
														<input type="file" class="btn btn-sm px-2" name="avatar" id="chavatar" accept="image/*" required style="width:150px" />
														<button class="btn btn-primary btn-sm p-2 d-none" id="sendBtn">
															<i class="fas fa-file-image mr-2"></i>cambiar
														</button>
													</div>
												</form>
											</div>
										</div>
									</div>

									<div class="card-body text-center">
										<h4 class="card-title"><?= $user[0]->nombre.' '.$user[0]->apellido ?></h4>
										<span class="lead"><?= $user[0]->tipo ?></span>
									</div>
									<div class="card-footer d-flex justify-content-between">
										<span>Registrado:</span>
										<span><?= $user[0]->created_at ?></span>
									</div>
								</div>
							</div>

							<div class="col-md-8 col-xs-12">

								<form method="post" action="<?= site_url('updateProfile') ?>" id="perfilForm">

									<input type="hidden" name="idusuario" value="<?= $user[0]->idusuario ?>">
									<input type="hidden" name="idpersona" value="<?= $user[0]->idpersona ?>">
									<input type="hidden" name="hiddenEmail" value="<?= $user[0]->correo ?>">

									<div class="form-row">
										<div class="col">
											<h3 class="mb-4 font-weight-light">Información del usuario</h3>
										</div>
									</div>

									<div class="form-row mb-4">
										<div class="col">
											<?php if ( $this->session->flashdata('success') ): ?>
												<div class="m-auto mb-4" style="width: 420px">
													<div class="alert alert-success alert-dismissible fade show" role="alert">
														<i class="fas fa-grin-beam mr-1"></i> <?= $this->session->flashdata('success') ?>
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
												</div>

											<?php elseif( $this->session->flashdata('fail') ): ?>
												<div class="m-auto mb-4" style="width: 520px">
													<div class="alert alert-danger alert-dismissible fade show" role="alert">
														<i class="fas fa-frown-open mr-1"></i> <?= $this->session->flashdata('fail') ?>
														<button type="button" class="close" data-dismiss="alert" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
												</div>
											<?php endif ?>
										</div>
									</div>

									<div class="form-row mb-4">
										<div class="col">
											<label for="">Cédula</label>
											<input type="text"  class="form-control" value="<?= $user[0]->cedula ?>" readonly required>
										</div>
										<div class="col">
											<label for="nombre">Nombre</label>
											<input type="text" class="form-control edt" name="nombre" id="nombre" value="<?= $user[0]->nombre ?>" readonly required>
										</div>
										<div class="col">
											<label for="apellido">Apellido</label>
											<input type="text" class="form-control edt" name="apellido" id="apellido" value="<?= $user[0]->apellido ?>" readonly required>
										</div>
									</div>
									<div class="form-row mb-4">
										<div class="col">
											<label for="correo">Correo</label>
											<input type="email" name="correo" id="correo" class="form-control edt validate" value="<?= $user[0]->correo ?>" readonly required>
										</div>
										<div class="col">
											<label for="telefono">Teléfono</label>
											<input type="text" name="telefono" id="telefono" class="form-control edt validate" value="<?= $user[0]->telefono ?>" readonly pattern="^[0-9]{4}-[0-9]{3}-[0-9]{4}$" placeholder="0000-000-0000">
										</div>
									</div>
									<div class="form-row mb-4">
										<div class="col-1">
											<button type="button" id="editPass" class="mt-4 btn btn-sm btn-danger px-3">Cambiar</button>
										</div>
										<div class="col offset-1">
											<label for="clave">Contraseña</label>
											<input type="password" disabled name="clave" id="clave" class="form-control editPass" required>
										</div>
										<div class="col">
											<label for="claverep">Repita la contraseña</label>
											<input type="password" id="claverep" disabled class="form-control editPass" required>
											<p class="small mt-3 text-danger" id="texto"></p>
										</div>
									</div>

									<div class="d-flex justify-content-end">
										<button type="submit" id="actualizarbtn" class="btn btn-primary btn-md"><i class="fas fa-save mr-2"></i>Actualizar</button>
									</div>
								</form>

							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>