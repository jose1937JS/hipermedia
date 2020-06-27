<!--Main Layout-->
<main class="animated fadeIn">
	<div class="container-fluid my-4">

		<?php if ( $this->session->flashdata('success') ): ?>
			<div class="m-auto mb-3" >
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="fas fa-grin-beam mr-1"></i> <?= $this->session->flashdata('success') ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>

		<?php elseif( $this->session->flashdata('fail') ): ?>
			<div class="m-auto mb-3" >
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<i class="fas fa-frown-open mr-1"></i> <?= $this->session->flashdata('fail') ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		<?php endif ?>


		<a style="position:fixed; bottom: 30px; right: 24px;" class="btn-floating yellow darken-1" href="#contenidoInicial" data-toggle="modal">
			<i class="fas fa-plus"></i>
		</a>

		<?php if ($data): ?>

			<?php foreach ($data as $key => $val): ?>
				<div class="card mb-4">
					<div class="card-header d-flex justify-content-end grey lighten-5">
						<button class="btn btn-flat delInitialContent" data-toggle="modal" data-target="#delContenidoInicial" data-idcontenido="<?= $val->id ?>">
							<i class="fas fa-trash mr-2"></i> Eliminar
						</button>
					</div>
					<div class="card-body">

						<div class="view overlay zoom d-flex justify-content-center">
							<img src='<?= base_url("application/uploads/images/$val->image") ?>' alt="banner" class="img-fluid img-thumbnail">
						</div>
						<div class="row">
							<div class="col">
								<h3 class="mt-5"><?= $val->titulo ?></h3>
								<p class="lead my-4 text-justify"><?= $val->contenido ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		<?php else: ?>

			<div class="card">
				<div class="card-body">
					<h2 class="my-5 text-center">Empieza por agregar un contenido inicial presionando el boton amarillo de abajo.</h2>
				</div>
			</div>

		<?php endif ?>

	</div>
	<!--Main Layout-->
</main>

	<!-- Modal -->

<div class="modal fade" id="contenidoInicial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Guardar contenido inicial</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open_multipart('contenidoInicial') ?>
				<div class="modal-body p-4">

					<div class="form-group">
						<label for="titulo">Título</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-book-open"></i></span>
							</div>
							<input type="text" class="form-control form-control-lg" id="titulo" name="titulo" required>
						</div>
					</div>

					<div class="form-group my-4">
						<label for="contenido">Contenido inicial</label>
						<textarea class="form-control" name="contenido" id="contenido" rows="4" required></textarea>
					</div>

					<div class="input-group mt-4">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-upload"></i></span>
						</div>
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="image" name="image" required accept=".gif, .png, .jpeg, .jpg">
							<label class="custom-file-label" for="image">Selecciona una imagen</label>
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


<div class="modal fade" id="delContenidoInicial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar contenido inicial</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?= form_open('delContenidoInicial') ?>

				<input type="hidden" name="idcontenido" id="idcontenidoinicial">

				<div class="modal-body">
					<p class="lead text-center">¿Está seguro de querer eliminar el contenido?</p>
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-md btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary"><i class="fas fa-trash mr-2"></i>Borrar</button>
				</div>
			</form>
		</div>
	</div>
</div>