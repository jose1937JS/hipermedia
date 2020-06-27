<!--Main Layout-->
<main class="animated fadeIn">
	<div class="container-fluid my-3">
		<div class="row">
			<div class="col">

				<div class="card card-cascade narrower">

					<!--Card image-->
					<div class="card-header grey lighten-5 d-flex justify-content-between align-items-center">
						<div>
							<button type="button" class="btn btn-primary btn-rounded px-3" data-toggle="modal" data-target="#addExamen" title="Agregar evaluación">
								<i class="fas fa-user-plus mt-0 mr-2"></i>Agregar
							</button>
						</div>
						<div>
							<h3 class="">Evaluaciones</a>
						</div>
						<div>
							<?= anchor('reporte', '<i class="fas fa-file-pdf mr-2"></i>Reporte', 'class="btn btn-primary btn-rounded" data-toggle="tooltip" data-title="Desargar reporte de rendimiento"') ?>
						</div>

					</div>
					<!--/Card image-->

					<div class="card-body">

						<?php if ($evaluaciones): ?>
							<div class="row">
								<?php foreach ($evaluaciones as $eval): ?>

									<div class="col-sm-4">

										<div class="card mb-4 hoverable">
											<div class="card-header grey lighten-5">
												<h4><i class="fas fa-book mr-2"></i><?= $eval->tema ?></h4>
											</div>
											<div class="card-body pb-0">
												<p><i class="fas fa-calendar mr-2"></i><b>Fecha Límite:</b> <?= $eval->fechaPretty ?></p>
												<p><i class="fas fa-clock mr-2"></i><b>Tiempo Límite:</b> <?= $eval->duracion ?> H</p>
												<p><i class="fas fa-certificate mr-2"></i><b>Valor:</b> <?= $eval->valor_total ?> puntos</p>
												<p><i class="fas fa-tasks mr-2"></i><b>Sección:</b> <?= $eval->seccion ?> </p>

												<p class="text-center">
													<a href='<?= site_url("docente/evaluacion/$eval->idexamen") ?>' class="btn-md waves-effect btn btn-link"><i class="fas fa-sign-in-alt mr-2"></i>Entrar</a>
												</p>
											</div>
											<div class="card-footer">
												<div class="d-flex justify-content-around">
													<span><i class="fas fa-eye mr-1"></i> <?= $eval->vistas ?></span>
													<span><i class="fas fa-check mr-1 text-success"></i> <?= $eval->aprobados ?></span>
													<span><i class="fas fa-times mr-1 text-danger"></i> <?= $eval->reprobados ?></span>
												</div>
											</div>
										</div>
									</div>

								<?php endforeach ?>
							</div>
						<?php else: ?>

							<p class="lead text-center">Aún no hay una evaluación registrada.</p>
						<?php endif ?>

					</div>

				</div>

			</div>
		</div>
	</div>
</main>
<!--Main Layout-->

<!-- Modal -->
<div class="modal fade" id="addExamen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Crear Evaluación</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="questionForm" method="post" action="<?= site_url('questionForm') ?>">

				<div class="modal-body">

					<div class="form-row">
						<div class="col-sm-6 col-md-3">
							<label for="tema">Selecciona un tema</label>
							<select class="browser-default custom-select campo" name="tema" id="tema" required>
								<option disabled selected>Tema</option>
								<?php foreach ($temas as $tema): ?>
									<option value="<?= $tema->id ?>"><?= $tema->tema.' | '.$tema->lapso ?></option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="col-sm-6 col-md-2">
							<label for="puntuacion">Valor del examen</label>
							<input type="number" id="puntuacion" name="puntuacion" value="100" class="form-control campo" max="100" min="1" required>
						</div>
						<div class="col-sm-6 col-md-2">
							<label for="date-picker-example">Fecha límite</label>
							<input placeholder="Selected date" type="text" id="fecha" name="fecha" required class="form-control datepicker campo">
						</div>
						<div class="col-sm-6 col-md-2">
							<label for="temporizador">Duración</label>
							<input placeholder="Selected time" name="duracion" required type="text" id="temporizador" class="form-control timepicker campo">
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="text-right">
								<p class="mb-0">Añadir una pregunta más o eliminar la última.</p>
								<button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Eliminar" type="button" id="delPregunta"><i class="fas fa-times"></i></button>
								<button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Añadir" type="button" id="addPregunta"><i class="fas fa-plus"></i></button>
							</div>
						</div>
					</div>

					<div class="card my-4">
						<div class="card-header py-2 grey lighten-3">
							<h4>Pregunta #1</h4>
						</div>
						<div class="card-body contenedor">
							<div class="form-row mt-4">
								<div class="col-sm-6 col-md-3">
									<label for="">Tipo de pregunta</label>
									<select name="tipo_pregunta-1" class="tipo_pregunta campo browser-default custom-select">
										<option value="Verdadero_o_Falso">Verdadero o Falso</option>
										<option value="Seleccion_Simple">Selección simple</option>
									</select>
								</div>
								<div class="col-sm-6 col-md-3">
									<label for="">Pregunta</label>
									<input type="text" class="form-control campo" name="preg-1" required>
								</div>
								<div class="col-sm-6 col-md-3">
									<div class="resp">
										<label for="">Respuesta</label>
										<select class="browser-default custom-select campo" required name="resp-1">
											<option value="verdadero">Verdadero</option>
											<option valu	e="falso">Falso</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6 col-md-3">
									<label for="">Valor pregunta</label>
									<input type="number" name="valor-1" class="valor form-control campo" max="100" min="1" required>
								</div>
							</div>
							<div class="respinco"></div>
						</div>
					</div>

					<div id="preguntasAdicionales"></div>

				</div>


				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-md btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cerrar</button>
					<button type="submit" id="btnSubmit" class="btn btn-md btn-primary"><i class="fas fa-save mr-2"></i>Crear</button>
				</div>
			</form>
		</div>
	</div>
</div>