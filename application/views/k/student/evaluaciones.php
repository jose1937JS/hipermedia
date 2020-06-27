<!--Main Layout-->
<main class="animated fadeIn">
	<div class="container-fluid my-3">
		<div class="row">
			<div class="col">

				<div class="card ">

					<!--Card image-->
					<div class="card-header grey lighten-5 text-center">
						<h3 class="font-weight-light">Evaluaciones</h3>
					</div>
					<!--/Card image-->

					<div class="card-body">

						<?php if ($evaluaciones): ?>
							<div class="row">
								<?php foreach ($evaluaciones as $eval): ?>

									<div class="col-4">
										<a href='#modal' data-toggle="modal" data-ideval="<?= $eval->idexamen ?>" class="black-text triggerGoToTest">
											<div class="card mb-4 hoverable cardeval">
												<div class="card-header grey lighten-5">
													<h5 class="font-weight-light"><?= $eval->tema ?></h5>
												</div>
												<div class="card-body">
													<p><i class="fas fa-calendar mr-2"></i>Fecha Límite: <span class="font-weight-light"><?= $eval->fechaPretty ?></span></p>
													<p><i class="fas fa-clock mr-2"></i>Tiempo Límite: <span class="time font-weight-light"><?= $eval->duracion ?></span></p>
													<p><i class="fas fa-certificate mr-2"></i>Valor: <span class="font-weight-light"><?= $eval->valor_total ?> puntos</span></p>
													<p><i class="fas fa-tasks mr-2"></i>Sección: <span class="font-weight-light"><?= $eval->seccion ?></span></p>
												</div>
											</div>
										</a>
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Estás por entrar en una evaluación</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p class="lead text-center">Tendrás <b id="tiempo"></b> para completar el examen, si el tiempo se acaba y no lo has culminado serás calificado automaticamente.</p>
			</div>
			<div class="modal-footer d-flex justify-content-between">
				<button type="button" class="btn btn-md btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cerrar</button>
				<a class="btn btn-md btn-primary" href="#" id="examid">
					<i class="fas fa-sign-in-alt mr-2"></i>Ir al examen
				</a>
			</div>
		</div>
	</div>
</div>