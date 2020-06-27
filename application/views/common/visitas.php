<main class="animated fadeIn">
	<div class='container-fluid my-4'>
		<div class="row">
			<div class="col">

				<div class="card opacity9">
					<div class="card-header grey lighten-5 d-flex justify-content-between">
						<h2>Visitas</h2>
					</div>
					<div class="card-body">

						<?php if (count($visitas) > 0): ?>

							<table class="table table-hover table-bordered" id="dtVisitas">
								<thead class="grey lighten-5">
									<tr>
										<th>id</th>
										<th>usuario</th>
										<th>tipo</th>
										<th>Fecha</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($visitas as $key => $v): ?>
										<tr>
											<td><?= $v->id ?></td>
											<td><?= $v->usuario ?></td>
											<td><?= $v->tipo ?></td>
											<td><?= $v->created_at ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>

						<?php else: ?>

							<h1 class="text-center my-5">No hay visitas registradas.</h1>

						<?php endif ?>



					</div>
				</div>

			</div>
		</div>
	</div>
</div>