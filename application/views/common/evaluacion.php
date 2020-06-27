<main class="animated fadeIn">
	<div class="container-fluid my-4">

		<div class="row mb-3">
			<div class="col">
				<div class="card mb-4">
					<div class="card-body d-flex justify-content-between">
						<h3><i class="fas fa-tasks mr-2"></i> Preguntas del examen</h3>
						<?= anchor('docente/evaluaciones', '<i class="fas fa-arrow-left"></i>', 'class="btn btn-primary btn-sm"') ?>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-body">

						<div class="row">
							<?php foreach ($evaluacion as $key => $val): ?>

								<div class="col-6 mb-4">
									<div class="card opacity9 hoverable">
										<div class="card-header">
											<h4><b>Pregunta #<?= $key + 1 ?></b></h4>
										</div>
										<div class="card-body">
											<h5 class="mb-3"><?= $val->pregunta ?></h5>
											<ul>
												<li><b>Respuesta:</b> <?= $val->respuesta == 1 ? 'Verdadero' : $val->respuesta  ?></li>
												<li><b>Tipo:</b> <?= $val->tipo ?></li>
												<li><b>Valor:</b> <?= $val->valor ?></li>
												<li><b>Tema:</b> <?= $val->tema ?></li>
											</ul>
										</div>
									</div>
								</div>

							<?php endforeach ?>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</main