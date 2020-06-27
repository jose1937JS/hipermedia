<main class="animated fadeIn">
	<div class="container-fluid my-4">

		<div class="row mb-4">
			<div class="col">
				<div class="card mb-4">
					<div class="card-body d-flex justify-content-between">
						<h3><i class="fas fa-clock mr-2"></i> <span id="temp"><?= $tiempoTotal ?></span></h3>
						<?= anchor('estudiante/evaluaciones', '<i class="fas fa-arrow-left"></i>', 'class="btn btn-primary btn-sm"') ?>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">

				<?php if ($validacion): ?>

					<div class="card">
						<div class="card-body text-center">
							<p class="lead">Esta evaluación ya la presentaste, tu resultado fué</p>
							<h1 class="mt-3"><?= $validacion[0]->puntuacion ?> puntos</h1>
						</div>
					</div>

				<?php elseif ($fechalimite): ?>

					<div class="card">
						<div class="card-body text-center">
							<p class="lead">No puedes presentar la evaluación porque ya se alcanzó la fecha límite</p>
							<h2 class="mt-3"><?= $fechaPretty ?> </h2>
						</div>
					</div>

				<?php else: ?>

					<form action="<?= site_url('sendtest') ?>" method="post" id="formtest">

						<input type="hidden" name="idusuario" value="<?= $user[0]->idusuario ?>">
						<input type="hidden" name="idexamen" id="idexamen" value="<?= $preguntas[0]->idexamen ?>">

						<?php foreach ($preguntas as $key => $pregunta): ?>

							<div class="card hoverable mb-4">
								<div class="card-header grey lighten-5 d-flex justify-content-between">
									<h3>Pregunta #<?= $key + 1 ?></h3>
									<h3><?= $pregunta->valor ?> puntos</h3>
								</div>
								<div class="card-body">
									<h4><?= $pregunta->pregunta ?></h4>
									<small>Selecciona la respuesta que creas correcta.</small>

									<div class="mt-3">
										<?php if ($pregunta->tipo == 'Verdadero o Falso'): ?>
											<input type="hidden" name="pregunta-<?= $key + 1 ?>" value="<?= $pregunta->pregunta ?>">

											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="vof_v-<?= $key + 1 ?>" value="verdadero" name="respuesta-<?= $key + 1 ?>">
												<label class="custom-control-label" for="vof_v-<?= $key + 1 ?>">Verdadero</label>
											</div>

											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="vof_f-<?= $key + 1 ?>" value="falso" name="respuesta-<?= $key + 1 ?>">
												<label class="custom-control-label" for="vof_f-<?= $key + 1 ?>">Falso</label>
											</div>

										<?php else: ?>

											<?php foreach (respuestas($pregunta->id) as $indice => $respuesta): ?>

												<input type="hidden" name="pregunta-<?= $key + 1 ?>" value="<?= $pregunta->pregunta ?>">

												<div class="custom-control custom-radio mt-2">
													<input type="radio" class="custom-control-input" id="radio-<?= ($key + 1).'_'.($indice + 1) ?>" value="<?= $respuesta ?>" name="respuesta-<?= $key + 1 ?>">
													<label class="custom-control-label" for="radio-<?= ($key + 1).'_'.($indice + 1) ?>"><?= $respuesta ?></label>
												</div>

											<?php endforeach ?>

										<?php endif ?>
									</div>

								</div>
							</div>

						<?php endforeach ?>

						<div class="mt-4 d-flex justify-content-center">
							<button type="submit" id="terminar" class="btn btn-primary"><i class="fas fa-calendar-times mr-2"></i>Terminar examen</button>
							<!-- Button trigger modal -->
							<button type="button" class="btn btn-secondary d-none" id="puntuacion" data-toggle="modal" data-target="#puntuacionModal">
								<i class="fas fa-clipboard-list mr-2"></i>Mostrar Puntuación
							</button>
						</div>

					</form>

				<?php endif ?>
			</div>

		</div>
	</div>
</main>


<!-- Modal -->
<div class="modal fade" id="puntuacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body px-4">
				<div class="text-center">
					<p class="h1">Nota Obtenida</p>
					<h1 id="calif"></h1>
				</div>

				<hr class="my-4">

				<p class="h3 mb-3 text-center">Respuestas Correctas</p>
				<div id="respuestas"></div>
			</div>
			<div class="modal-footer d-flex justify-content-between">
				<?= anchor('estudiante/evaluaciones', '<i class="fas fa-times mr-2"></i> Salir', 'class="btn btn-danger btn-md"') ?>
				<button type="button" class="btn btn-primary btn-md" data-dismiss="modal"><i class="fas fa-window-minimize mr-2"></i>Minimizar</button>
			</div>
		</div>
	</div>
</div>