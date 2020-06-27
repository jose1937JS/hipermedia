<!--Main Layout-->
<main class="animated fadeIn">
	<div class="container-fluid my-3">

		<div class="card">
			<div class="card-header grey lighten-5 d-flex justify-content-between align-items-center">
				<h3>Asignaciones</h3>
				<button class="btn btn-md btn-primary px-3" title="Crear nueva asignación" data-toggle="modal" data-target="#addasignacion"><i class="fas fa-plus mr-1"></i>Nueva</button>
			</div>
			<div class="card-body">

				<?php if ( $this->session->flashdata('success') ): ?>
					<div class="m-auto mb-5" style="width: 550px">
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<i class="fas fa-grin-beam mr-1"></i> <?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				<?php endif ?>

				<!-- Classic tabs -->
				<div class="classic-tabs">

					<ul class="nav tabs-cyan d-flex justify-content-center" id="myClassicTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link  waves-light active show" id="profile-tab-classic" data-toggle="tab" href="#profile-classic"
							role="tab" aria-controls="profile-classic" aria-selected="true">
								<i class="fas fa-calendar-check fa-2x pb-2"></i><br>Asignadas
							</a>
						</li>
						<li class="nav-item mr-5">
							<a class="nav-link waves-light" id="follow-tab-classic" data-toggle="tab" href="#follow-classic" role="tab"
							aria-controls="follow-classic" aria-selected="false"><i class="fas fa-book fa-2x pb-2"></i><br>POR CORREGIR</a>
						</li>
					</ul>
					<div class="tab-content border-right border-bottom border-left rounded-bottom" id="myClassicTabContent">
						<div class="tab-pane fade active show" id="profile-classic" role="tabpanel" aria-labelledby="profile-tab-classic">
							<?php if (count($asignadas) > 0): ?>

								<?php foreach ($asignadas as $value): ?>
									<?php foreach ($value as $key => $val): ?>

										<div class="row">
											<div class="col">
												<div class="card mb-4 hoverable">
													<div class="card-body">
														<div class="d-flex justify-content-between align-items-center mb-2">
															<h4 class="card-title"><?= $val['nombre_asignacion'] ?></h4>
															<button data-idasignacion="<?= $val['id'] ?>" data-toggle="modal" data-target="#borrarasignacion" class="btn btn-danger px-3 btn-sm borrarAsig">
																<i class="fas fa-trash mr-1"></i> Eliminar
															</button>
														</div>
														<p class="text-muted">
															<small><i class="fas fa-clock mr-2"></i><?= $val['created_at'] ?></small><br>
															<small>
																<i class="fas fa-user mr-2"></i>
																<?php foreach ($val['estudiantes'] as $estudiante): ?>
																	<?= $estudiante.', ' ?>
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
								<h1 class="text-center my-5">No hay asignaciones entregadas.</h1>

							<?php endif ?>
						</div>
						<div class="tab-pane fade" id="follow-classic" role="tabpanel" aria-labelledby="follow-tab-classic">
							<?php if (count($entregadas) > 0): ?>
								<?php foreach ($entregadas as $key => $values): ?>

									<!--Accordion wrapper-->
									<div class="accordion md-accordion border z-depth-1" id="accordionEx-<?= $key ?>" role="tablist" aria-multiselectable="true">

										<!-- Accordion card -->
										<div class="card">

											<!-- Card header -->
											<div class="card-header" role="tab" id="headingOne1-<?= $key ?>">
												<a data-toggle="collapse" data-parent="#accordionEx-<?= $key ?>" href="#collapse-<?= $key ?>" aria-controls="collapse-<?= $key ?>">
												<h5 class="mb-0">
													<div class="d-flex justify-content-between">
														<h4 class="card-title"><?= $values->nombre_asignacion ?></h4>
														<?php if ($values->nota): ?>
															<?php if ($values->nota > 59): ?>
																<h2 class="text-success"><?= $values->nota ?> puntos</h2>
																<?php else: ?>
																	<h2 class="text-danger"><?= $values->nota ?> puntos</h2>
																<?php endif ?>
																<?php else: ?>

																	<button id="calificar_btn" class="btn btn-md btn-primary px-3" data-toggle="modal" data-target="#calificar" data-id_respuesta_asignacion="<?= $values->id_respuesta_asignacion ?>">
																		<i class="fas fa-edit mr-1"></i>Calificar
																	</button>
																<?php endif ?>
															</div>
															<p class="text-muted">
																<small><i class="fas fa-clock mr-2"></i><?= $values->created_at_asignacion ?></small><br>
															</p>

															<p style="color: #454545"><?= $values->descripcion ?></p>
															<i class="fas fa-angle-down rotate-icon"></i>
														</h5>
													</a>
												</div>
												<hr>
												<!-- Card body -->
												<div id="collapse-<?= $key ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne1-<?= $key ?>" data-parent="#accordionEx-<?= $key ?>">
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
																	<div class="card rounded-pill z-depth-1" style="width: 150px">
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
											<!-- Accordion card -->

										</div>
										<!-- Accordion wrapper -->




									<!--<div class="row">
										<div class="col">
											<div class="card mb-4 hoverable">
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

															<button id="calificar_btn" class="btn btn-md btn-primary px-3" data-toggle="modal" data-target="#calificar" data-id_respuesta_asignacion="<?= $values->id_respuesta_asignacion ?>">
																<i class="fas fa-edit mr-1"></i>Calificar
															</button>
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
									</div>-->

								<?php endforeach ?>

								<?php else: ?>
									<h1 class="text-center my-5">No hay asignaciones entregadas.</h1>

							<?php endif ?>
						</div>
					</div>

				</div>
				<!-- Classic tabs -->

			</div>
		</div>

	</div>
</main>
<!--Main Layout-->

<!-- modal de Calificar asignación -->
<!-- Modal -->
<div class="modal fade" id="calificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Calificar asignación</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('calificar_asignacion') ?>

				<input type="hidden" name="id_respuesta_asignacion" id="id_respuesta_asignacion">

				<div class="modal-body">
					<label for="calificacion">Calificación</label>
					<input type="text" class="form-control form-control-lg validate" name="nota" id="calificacion" required pattern="[0-9]{1,3}">
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-md btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary"><i class="fas fa-edit mr-2"></i>Calificar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal BORRAR ASIGNACION -->
<div class="modal fade" id="borrarasignacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('borrar_asignacion') ?>

				<input type="hidden" name="idasignacion" id="idasignacion">

				<div class="modal-body">
					<h3 class="my-5">¿Está seguro de borrar?</h3>
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-md btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>No</button>
					<button type="submit" class="btn btn-md btn-primary"><i class="fas fa-check mr-2"></i>Sí</button>
				</div>
			</form>
		</div>
	</div>
</div>


<!-- MODAL AÑADIR ASIGNACIO -->
<div class="modal fade" id="addasignacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Añadir asignación</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('anadir_asignacion') ?>

				<div class="modal-body">

					<div class="row">
						<div class="col">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control form-control-lg" name="nombre" id="nombre" required>
						</div>
						<div class="col">
							<label for="nombre">Descripción</label>
							<input type="text" class="form-control form-control-lg" name="descripcion" id="nombre" required>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col">
							<select class="mdb-select md-form rounded-pill" multiple searchable="Busca a alguien" name="usuarios[]" id="usuario" required>
								<?php foreach ($estudiantes as $value): ?>
									<option value="<?= $value->idusuario ?>"><?= $value->nombre.' '.$value->apellido ?></option>
								<?php endforeach ?>
							</select>
							<label class="mdb-main-label">¿A quién va dirigida la asignación?</label>
							<button type="button" class="btn-save btn btn-primary btn-md mt-4">Seleccionar</button>
						</div>
					</div>

				</div>
				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-md btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary"><i class="fas fa-save mr-2"></i>Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>