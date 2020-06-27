<main class="animated fadeIn">
	<div class="container my-4">
		<div class="row">
			<div class="col">

				<div class="card opacity9">
					<div class="card-header grey lighten-5 d-flex justify-content-between">
						<h3>Repositorio de aplicaciones</h3>
					</div>
					<div class="card-body">

						<div class="list-group">

							<?php if (count($herramientas) > 0): ?>

								<?php foreach ($herramientas as $herramienta): ?>

									<a href="<?= $herramienta->enlace ?>" class="list-group-item list-group-item-action flex-column align-items-start" target="_blank">
										<div class="py-4">
											<div class="d-flex w-100 justify-content-between">
												<h5 class="mb-2 h5"><?= $herramienta->nombre ?></h5>
											</div>
											<p class="mb-2"><?= $herramienta->descripcion ?></p>
											<div class="view overlay zoom d-flex justify-content-center">
												<img src='<?= base_url("application/uploads/images/$herramienta->imagen") ?>' alt="Image Website" class="img-fluid img-thumbnail">
											</div>
										</div>
									</a>

								<?php endforeach ?>
							<?php else: ?>

								<h1 class="my-5 text-center font-weight-light">Aún no hay aplicaciones registradas.</h1>

							<?php endif ?>

						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</main>