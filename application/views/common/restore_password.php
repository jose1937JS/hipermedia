<div class="flex-center animated fadeIn">
	<div class="card opacity9" style="width: 300px">
		<div class="card-header">
			<h4>Nueva contraseña</h4>
		</div>
		<div class="card-body">

			<form id="restore_password">
				<label for="pass">Introduce tu nueva contraseña</label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">
							<i class="fas fa-lock"></i>
						</span>
					</div>
					<input type="password" id="pass" name="clave" class="form-control" required>
				</div>
				<div class="d-flex justify-content-end align-items-center">
					<?= anchor('/', 'Login', ['class' => 'mr-3']) ?>
					<button type="submit" class="btn btn-md btn-primary">Enviar</button>
				</div>
			</form>

		</div>
	</div>
</div>