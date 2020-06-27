<main class="animated fadeIn">
	<div class="container-fluid my-4">

		<div class="card opacity9">
			<div class="card-header grey lighten-5">
				<h3>Conversación en grupo</h3>
			</div>
			<div class="card-body grey lighten-5" id="chat"></div>



			<div class="card-footer py-0">
				<form id="chatForm">

					<input type="hidden" id="usuarioid" value="<?= $usuarioid ?>">
					<input type="hidden" id="seccionid" value="<?= $seccionid ?>">
					<input type="hidden" id="seccion" value="<?= $seccion ?>">

					<div class="form-row py-3">
						<div class="col">
							<input type="text" class="form-control form-control-lg" id="comentario" required placeholder="Haz tu comentario">
						</div>
						<div class="col-1 d-flex align-items-center">
							<button type="submit" class="btn btn-primary btn-md px-3"><i class="fas fa-paper-plane"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</main>