<main class="animated fadeIn">
	<div class="container my-4">
		<div class="row">
			<div class="col">
				<div class="card opacity9">
					<div class="card-header grey lighten-5 d-flex justify-content-between">
						<h3>Simuladores en línea</h3>

						<?php if ($tipoUser == 'Docente'): ?>
							<button class="btn btn-md btn-primary px-3" data-toggle="modal" data-target="#modal">
								<i class="fas fa-plus mr-2"></i>Agregar
							</button>
						<?php endif ?>
					</div>
					<div class="card-body">

						<?php if ( $this->session->flashdata('success') ): ?>
							<div class="m-auto my-4" style="width: 420px">
								<div class="alert alert-success alert-dismissible fade show" role="alert">
									<i class="fas fa-grin-beam mr-1"></i> <?= $this->session->flashdata('success') ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>

						<?php elseif( $this->session->flashdata('fail') ): ?>
							<div class="m-auto my-4" style="width: 520px">
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<i class="fas fa-frown-open mr-1"></i> <?= $this->session->flashdata('fail') ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							</div>
						<?php endif ?>

						<?php if (count($simuladores) > 0): ?>

							<div class="card-columns">

								<?php foreach ($simuladores as $simulador): ?>

									<div class="card mt-2 mb-3">
										<img class="card-image-top img-fluid" src='<?= base_url("application/uploads/images/$simulador->image") ?>' alt="image">
										<div class="card-body">
											<h5 class="card-title"><?= $simulador->nombre ?></h5>
											<p class="card-text"><?= $simulador->descripcion ?></p>
											<div class="d-flex justify-content-center mt-4">
												<?php if ($tipoUser == 'Docente'): ?>
													<?= form_open('eliminar_simulador') ?>
														<input type="hidden" name="idsimulador" value="<?= $simulador->idsimulador ?>">
														<button type="submit" class="btn btn-md px-2 btn-danger"><i class="fas fa-times mr-2"></i>borrar</button>
													</form>
												<?php endif ?>
												<a target="_blank" href="<?= $simulador->enlace ?>" class="btn btn-md btn-primary"><i class="fas fa-link mr-2"></i>Ir a la página</a>
											</div>
										</div>
									</div>

								<?php endforeach ?>

							</div>
						<?php else: ?>

							<h1 class="text-center my-5 font-weight-light">Aún no hay simuladores disponibles.</h1>

						<?php endif ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</main>


<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Registrar un nuevo simulador</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open_multipart('registrar_simulador') ?>

				<input type="hidden" name="seccionid" value="<?= $seccionid ?>">

				<div class="modal-body">

					<div class="row mb-3">
						<div class="col">
							<label for="nombre">Nombre</label>
							<input type="text" id="nombre" name="nombre" class="form-control form-control-lg" required>
						</div>
						<div class="col">
							<label for="descripcion">Descripción</label>
							<input type="text" name="descripcion" class="form-control form-control-lg" required>
						</div>
					</div>

					<div class="row mb-4">
						<div class="col">
							<label for="descripcion">Enlace</label>
							<input type="text" name="enlace" class="form-control form-control-lg" required>
						</div>
					</div>

					<div class="row">
						<div class="col">

							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="inputGroupFileAddon01">Escoge el archivo</span>
								</div>
								<div class="custom-file">
									<input type="file" id="archivo" required name="archivo" accept=".png, .jpg, .gif, .jpeg">
									<label class="custom-file-label" for="archivo">Vista previa de la página o herramienta</label>
								</div>
							</div>

						</div>
					</div>

				</div>
				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-secondary btn-md" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cerrar</button>
					<button type="submit" class="btn btn-primary btn-md"><i class="fas fa-save mr-2"></i>Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>