<main class="animated fadeIn">
	<div class="container my-4">
		<div class="row">
			<div class="col">
				<div class="card opacity9">
					<div class="card-header grey lighten-5 d-flex justify-content-between align-items-center">
						<h4>Archivos subidos</h4>

						<?php if ($tipoUser == 'Docente'): ?>
							<button class="btn btn-rounded btn-primary" title="Subir archivo" data-toggle="modal" data-target="#uploadFile">
								<i class="fas fa-file-upload mr-2"></i>Subir archivo
							</button>
						<?php endif ?>

					</div>
					<div class="card-body">

						<?php if ($tipoUser == 'Docente'): ?>

							<?php if ( $this->session->flashdata('archivos') ): ?>
								<div class="m-auto mb-3" style="width: 420px">
									<div class="alert alert-success alert-dismissible fade show" role="alert">
										<i class="fas fa-grin-beam mr-1"></i> <?= $this->session->flashdata('archivos') ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								</div>

							<?php elseif( $this->session->flashdata('error') ): ?>
								<div class="m-auto mb-3" style="width: 520px">
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<i class="fas fa-frown-open mr-1"></i> <?= $this->session->flashdata('error') ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								</div>
							<?php endif ?>

						<?php endif ?>

						<div class="row">
							<?php if ($files): ?>

								<?php foreach ($files as $file): ?>
									<div class="col-md-2 col-sm-4">
										<div class="card hoverable text-center small mb-4"
											data-toggle="popover-hover" title="Descripción"
											data-content="<?= $file->descripcion ?>">
											<div class="card-body py-3">
												<i class="fas fa-<?= $file->icon ?> fa-4x"></i><br><br>
												<span><?= $file->nombre ?></span>
											</div>
											<div class="card-footer d-flex justify-content-between">
												<div class="d-flex justify-content-start">

													<?php if ( $tipoUser == 'Docente' ): ?>

														<?= form_open("deleteResource/$file->idarchivo", ['class' => 'mr-3']) ?>
															<button type="submit" class="btn m-0 p-0 btn-link"><i class="fas fa-times text-danger"></i></button>
														</form>
														<a target="_blank" href='<?= base_url("application/uploads/files/$file->nombre") ?>'><i class="fas fa-download"></i></a>

													<?php else: ?>

														<a target="_blank" href='<?= base_url("application/uploads/files/$file->nombre") ?>'><i class="fas fa-download"></i></a>
													<?php endif ?>

												</div>
												<span><?= $file->tamano ?> MB</span>
											</div>
										</div>
									</div>
								<?php endforeach ?>
							<?php else: ?>
								<div class="col">
									<h3 class="text-center my-5">No hay ningún archivo.</h3>
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>

<?php if ($tipoUser == 'Docente'): ?>

	<!-- Modal -->
	<div class="modal fade" id="uploadFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Subir archivo</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?= form_open_multipart('uploadResource') ?>
					<input type="hidden" class="length" name="cantidad">

					<div class="modal-body px-4">

						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupFileAddon01">Buscar archivos</span>
							</div>
							<div class="custom-file">
								<input type="file" required class="custom-file-input" name="archivos[]" id="archivo" multiple accept=".pdf, .doc, .docx, .ppt, .pptx, .odf, .odt, .mp4, .mpeg, .avi, .mkv, .flv, .png, .jpg, .jpeg, .gif">
								<label class="custom-file-label" for="inputGroupFile01">Selecciona un archivo para la clase</label>
							</div>
						</div>

						<div class="mt-4">
							<label for="descripcion">Descripción</label>
							<input type="text" name="descripcion" id="descripcion" class="form-control form-control-lg">
						</div>
					</div>
					<div class="modal-footer d-flex justify-content-between">
						<button type="button" class="btn btn-md btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cerrar</button>
						<button type="submit" class="btn btn-md btn-primary"><i class="fas fa-file-upload mr-2"></i>Subir</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<?php endif ?>