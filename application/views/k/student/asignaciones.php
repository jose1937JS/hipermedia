<!--Main Layout-->
<main class="animated fadeIn">
	<div class="container-fluid my-3">

		<div class="card">
			<div class="card-header grey lighten-5 d-flex justify-content-between">
				<h3>Asignaciones</h3>
			</div>
			<div class="card-body">

				<?php if ( $this->session->flashdata('archivos') ): ?>
					<div class="m-auto mb-4" style="width: 420px">
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<i class="fas fa-grin-beam mr-1"></i> <?= $this->session->flashdata('archivos') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>

				<?php elseif( $this->session->flashdata('error') ): ?>
					<div class="m-auto mb-4" style="width: 550px">
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<i class="fas fa-frown-open mr-1"></i> <?= $this->session->flashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				<?php endif ?>

				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="fas fa-clipboard-list mr-1"></i> Nuevas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="fas fa-calendar-check mr-1"></i> Entregadas</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

						<?php if (count($nuevas) > 0): ?>

							<?php foreach ($nuevas as $value): ?>
								<?php foreach ($value as $key => $val): ?>

									<div id="asig_user_id" data-asignacion_usuario="<?= $val['asignacionUsuarioId'] ?>"></div>
									<div id="asignacion_id" data-asignacion_id="<?= $val['asignacionid'] ?>"></div>

									<div class="row">
										<div class="col">
											<div class="card mb-4 hoverable">
												<div class="card-body">
													<div class="d-flex justify-content-between">
														<h4 class="card-title"><?= $val['nombre_asignacion'] ?></h4>
														<button id="asigUserIdBtn" class="btn btn-sm btn-primary px-3" data-toggle="modal" data-target="#responder">
															<i class="fas fa-pen mr-2"></i>Responder
														</button>
													</div>
													<p class="text-muted">
														<small><i class="fas fa-clock mr-2"></i><?= $val['created_at'] ?></small><br>
														<small>
															<i class="fas fa-user mr-2"></i>
															<?php foreach ($val['estudiantes'] as $estudiante): ?>
																<?= $estudiante ?>
															<?php endforeach ?>
														</small>
													</p>

													<p style="color: #454545"><?= $val['descripcion'] ?></p>
												</div>
											</div>
										</div>
									</div>
								<?php endforeach ?>

							<?php endforeach ?>

						<?php else: ?>
							<h1 class="text-center my-5">No hay asignaciones nuevas.</h1>

						<?php endif ?>

					</div>
					<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

						<?php if (count($entregadas) > 0): ?>
							<?php foreach ($entregadas as $key => $values): ?>

								<div class="row">
									<div class="col">
										<div class="card mb-4 ">
											<div class="card-body pb-1">
												<div class="d-flex justify-content-between">
													<h4 class="card-title"><?= $values->nombre_asignacion ?></h4>
													<?php if ($values->nota): ?>
														<?php if ($values->nota > 59): ?>
															<h2 class="text-success"><?= $values->nota ?> puntos</h2>
														<?php else: ?>
															<h2 class="text-danger"><?= $values->nota ?> puntos</h2>
														<?php endif ?>
													<?php else: ?>

														<h4 class="">Sin evaluar</h4>
													<?php endif ?>
												</div>
												<p class="text-muted">
													<small><i class="fas fa-clock mr-2"></i><?= $values->created_at_asignacion ?></small><br>
												</p>

												<p style="color: #454545"><?= $values->descripcion ?></p>
											</div>
											<hr>
											<div class="card-body">
												<div class="row">
													<div class="col-2">
														<img src='<?= base_url("application/uploads/avatars/$values->avatar") ?>' class="img-fluid rounded" alt="image thumbnail">
													</div>
													<div class="col">
														<div class="d-flex justify-content-between align-items-start">
															<p>
																<span>
																	<i class="fas fa-user-circle mr-2"></i><?= $values->nombre.' '.$values->apellido ?>
																</span><br>
																<small class="text-muted">
																	<i class="fas fa-clock mr-2"></i><?= $values->created_at_respuesta ?>
																</small>
															</p>
														</div>
														<p><?= $values->respuesta ?></p>

														<div class="d-flex justify-content-start">
															<div class="card " style="width: 150px">
																<a target="_blank" href='<?= base_url("application/uploads/assingments/$values->archivo") ?>'>
																	<div class="card-body p-2 text-center">
																		<p><i class="fas fa-<?= $values->icon ?> fa-2x"></i></p>
																		<p style="font-size: 10px;line-height: 12px">
																			<?= $values->archivo ?>
																		</p>
																	</div>
																</a>
															</div>
														</div>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

							<?php endforeach ?>

						<?php else: ?>
								<h1 class="text-center my-5">No hay asignaciones entregadas.</h1>

						<?php endif ?>

					</div>
				</div>

			</div>
		</div>

	</div>
</main>
<!--Main Layout-->

<!-- modal de responder asignacion -->
<!-- Modal -->
<div class="modal fade" id="responder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Responder asignación</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open_multipart('responder_asignacion') ?>

				<div class="modal-body">

					<input type="hidden" name="cantidad" class="length">
					<input type="hidden" name="asignacion_usuario_id" id="asignacion_usuario_id">
					<input type="hidden" name="asignacionid" id="asignacionid">

					<div class="mb-4">
						<label for="respuesta">Respuesta</label>
						<textarea id="respuesta" name="respuesta" class="md-textarea form-control"></textarea>
					</div>


					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">Seleccionar</span>
						</div>
						<div class="custom-file">
							<input type="file" id="archivo" name="archivo" required accept=".pdf, .doc, .docx, .png, .jpeg, .jpg, .odt, .odf">
							<label class="custom-file-label" for="archivo">Escoge un archivo</label>
						</div>
					</div>

				</div>
				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-md btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary"><i class="fas fa-paper-plane mr-2"></i>Enviar</button>
				</div>
			</form>
		</div>
	</div>
</div>