<!--Big blue-->

<main class="mb-3 container animated fadeIn">

	<div class="card">

		<!--Card image-->
		<div class="text-center card-header grey lighten-5">
			<h3>Contenido de la materia</h3>
		</div>
		<!--/Card image-->
		<div class="card-body">
			<div class="row">

				<?php if ($cant > 0): ?>

					<?php foreach ($temas as $key => $value): ?>

							<div class="col-3 mb-3">

								<div class="card">
									<div class="card-header grey lighten-5">
										<h4><i class="fas fa-book mr-2"></i><?= $value->lapso ?></h4>
									</div>
									<div class="card-body text-center">
										<p class="lead"><?= $value->tema ?></p>
										<button class="btn btn-link waves-effect btn-block ver_contenido" data-idtema="<?= $value->idtema ?>" data-toggle="modal" data-target="#contentModal">
											<i class="fas fa-sign-in-alt mr-2"></i>Ver contenido
										</button>
									</div>
								</div>
							</div>
						<?php endforeach ?>

				<?php else: ?>
					<div class="col my-5">
						<h2 class="text-center">
							<p>Aún no hay un contenido registrado.</p>
							<i class="fas fa-times-circle fa-3x"></i>
						</h2>
					</div>

				<?php endif; ?>
			</div>
		</div>

	</div>

</main>



<!-- Modal -->
<div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Contenido del lapso seleccionado</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body p-4">


				<div id="content"></div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">
					<i class="fas fa-times mr-2"></i> Cerrar
				</button>
			</div>
		</div>
	</div>
</div>