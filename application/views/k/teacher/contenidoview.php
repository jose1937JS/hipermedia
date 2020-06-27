<main class="animated fadeIn">
	<div class="container my-3 opacity9">

		<div class="card">
			<div class="card-header d-flex justify-content-between">
				<h3><?= $contenido[0]->tema ?></h3>
				<?php if ($userTipo == 'Docente'): ?>
					<?= anchor('docente/contenidos', '<i class="fas fa-arrow-left"></i>', "class='btn btn-md btn-primary'") ?>

				<?php else: ?>
					<?= anchor('estudiante/contenidos', '<i class="fas fa-arrow-left"></i>', "class='btn btn-md btn-primary'") ?>
				<?php endif ?>
			</div>
			<div class="card-body">
				<?= $contenido[0]->contenido ?>
			</div>
		</div>
	</div>
</main>