<!--Main Layout-->
<main class="animated fadeIn">
	<div class="container-fluid my-4">

		<?php if ($data): ?>

			<?php foreach ($data as $key => $val): ?>
				<div class="card mb-4">
					<div class="card-body">

						<div class="view overlay zoom d-flex justify-content-center">
							<img src='<?= base_url("application/uploads/images/$val->image") ?>' alt="banner" class="img-fluid img-thumbnail">
						</div>
						<div class="row">
							<div class="col">
								<h3 class="text-center mt-5"><?= $val->titulo ?></h3>
								<p class="lead my-4 text-justify"><?= $val->contenido ?></p>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		<?php else: ?>

			<div class="card">
				<div class="card-body">
					<h2 class="my-5 text-center">Aún no hay un contenido principal registrado.</h2>
				</div>
			</div>

		<?php endif ?>

	</div>
	<!--Main Layout-->
</main>
