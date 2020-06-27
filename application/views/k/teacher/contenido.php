<!--Big blue-->
<div id="mdb-preloader" class="flex-center">
	<div class="preloader-wrapper big active">
		<div class="spinner-layer spinner-blue-only">
			<div class="circle-clipper left">
				<div class="circle"></div>
			</div>
			<div class="gap-patch">
				<div class="circle">
				</div>
			</div>
			<div class="circle-clipper right">
				<div class="circle"></div>
			</div>
		</div>
	</div>
</div>

<main class="my-3 animated fadeIn">
	<div class="container-fluid">

		<div class="card">

			<div class="card-header grey lighten-5 d-flex justify-content-between align-items-center">
				<div>
					<button type="button" title="Agregar contenido" class="btn btn-info px-3" data-toggle="modal" data-target="#addcontent">
						<i class="fas fa-plus mt-0 mr-2"></i>Nuevo
					</button>
				</div>
				<h3 class="font-weight-light">Contenido de la materia</h3>
				<div>
				</div>
			</div>

			<div class="card-body">

				<div class="row">

					<?php if ($cant > 0): ?>


						<?php foreach ($temas as $key => $value): ?>

							<div class="col-3 mb-3 content">

								<div class="card">
									<div class="card-header grey lighten-5 ">
										<h4><i class="fas fa-book mr-2"></i><?= $value->lapso ?></h4>
									</div>
									<div class="card-body ">
										<p class="lead text-center"><?= $value->tema ?></p>
										<div class="d-flex justify-content-between">
											
											<button class="btn btn-link p-2 btn-sm waves-effect ver_contenido" data-idtema="<?= $value->idtema ?>" data-toggle="modal" data-target="#contentModal">
												<i class="fas fa-sign-in-alt mr-2"></i>Ver
											</button>
											<button class="btn btn-link waves-effect p-2 btn-sm borrartema" data-idtema="<?= $value->idtema ?>"><i class="fas fa-trash mr-2"></i>Borrar</button>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>

						<!--<div class="col-4 mr-3">

							<div class="row no-gutters">
								<div class="col-6 mr-3">
									<?php foreach ($cant as $lapso): ?>

										<div class="row">
											<div class="col mb-4">
												<div class="card hoverable">
													<div class="card-body">
														<a href='#' class="black-text lapsos" style="display: block">
															<!-<div data-temaid="<?= $lapso->temaid ?>"></div>--
															<div data-seccion="<?= $seccion ?>"></div>

															<h3 class="text-center mb-3 lapso"><?= $lapso ?></h3>
															<!-<p class="text-center lead"><?= $lapso->tema ?></p>--
														</a>
													</div>
												</div>
											</div>
										</div>

									<?php endforeach ?>
								</div>
								<div class="col-5" id="temaContenido"></div>
							</div>

						</div>
						<div class="col-7 ml-5" id="content">
							<div class="mt-5 ml-5">
								<h1><i class="fas fa-hand-point-left mr-2 "></i> Elige primero un lapso</h1>
							</div>
						</div>-->

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
	</div>

</main>


<!-- Modal -->
<div class="modal fade" id="addcontent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Añade el contenido de la materia</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="addContent" enctype="multipart/form-data">
				<div class="modal-body p-4">
					<div class="form-row">
						<div class="col">
							<label for="lapso">Selecciona uno de los temas</label>
							<select class="custom-select custom-select-lg browser-default" name="lapso" id="lapso" required>
								<option>Tema 1</option>
								<option>Tema 2</option>
								<option>Tema 3</option>
							</select>
						</div>
						<div class="col">
							<label for="tema">Descripción del Tema</label>
							<input type="text" id="tema" name="tema" class="form-control form-control-lg" required>
						</div>
					</div>

					<div class="form-row mt-3">
						<div class="col">
							<textarea name="contenido" class="editor"></textarea>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-between mt-3 modal-footer">
					<div id="word-count"></div>
					<button type="submit" class="btn btn-primary btn-md">
						<i class="fas fa-edit mr-2"></i>Crear contenido
					</button>
				</div>
			</form>
		</div>
	</div>
</div>






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