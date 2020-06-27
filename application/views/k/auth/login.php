<div class="bglogin view animated fadeIn">

	<div class="mask flex-center rgba-stylish-strong py-5">
		<div class="card" style="width: 400px; opacity: .8">
			<div class="card-body px-4">

				<form id="loginform" class="text-center p-5">

					<h2 class="mb-4 font-weight-light">Iniciar sesión</h2>

					<!-- Email -->
					<input type="email" placeholder="Correo Electrónico" name="correo" class="form-control form-control-lg mb-4" id="email" required autofocus>

					<!-- Password -->
					<input type="password" placeholder="Contraseña" name="clave" class="form-control form-control-lg" id="password" required>

					<p class="text-right mt-3">
						<!-- Forgot password -->
						<a href="#modalEnviarCorreo" data-toggle="modal">Olvidé mi contraseña.</a>
					</p>

					<!-- Sign in button -->
					<button class="btn btn-outline-info btn-lg btn-block my-4" type="submit"><i class="fas fa-sign-in-alt mr-2"></i>Entrar</button>

					<!-- Register -->
					<p>¿No eres miembro?
						<a href="#registro" data-toggle="modal">Regístrate</a>
					</p>
				</form>
			</div>
		</div>
	</div>

</div>



<!-- Modal de registro -->

<!-- Central Modal Small -->
<div class="modal fade" id="registro" >

	<div class="modal-dialog modal-lg" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100">Registro del profesor</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="registerform">

				<div class="modal-body p-4">

					<div class="row">
						<div class="col">

							<div class="form-row mb-4">
								<div class="col-2 text-right">
									<label for="cedula" >Cédula</label>
								</div>
								<div class="col">
									<input type="text" id="cedula" name="cedula" class="cedula form-control-lg form-control" required minlength="8" maxlength="9" pattern="^[0-9]{8,9}$">
									<p class="small red-text cimsg"></p>
								</div>
							</div>

							<div class="form-row mb-4">
								<div class="col-2 text-right">
									<label for="nombre">Nombre</label>
								</div>
								<div class="col">
									<input type="text" id="nombre" name="nombre" class="form-control form-control-lg validate" required pattern="^([a-zA-Z][\s]?)+$">
								</div>
							</div>

							<div class="form-row mb-4">
								<div class="col-2 text-right">
									<label for="apellido">Apellido</label>
								</div>
								<div class="col">
									<input type="text" id="apellido" name="apellido" class="form-control form-control-lg" required pattern="^([a-zA-Z][\s]?)+$">
								</div>
							</div>
						</div>
						<div class="col">
							<div class="form-row mb-4">

								<div class="col-2">
									<label for="correo">E-mail</label>
								</div>
								<div class="col">
									<input type="email" id="correo" name="correo" class="correo form-control form-control-lg validate" required>
									<p class="small red-text cemsg"></p>
								</div>
							</div>

							<div class="form-row mb-4">

								<div class="col-2">
									<label for="telefono">Teléfono</label>
								</div>
								<div class="col">
									<input type="text" id="telefono" name="telefono" class="form-control form-control-lg validate" placeholder="xxxx-xxx-xxxx" pattern="^[0-9]{4}-[0-9]{3}-[0-9]{4}$">
								</div>
							</div>

							<div class="form-row mb-4">

								<div class="col-2">
									<label for="seccion">Sección</label>
								</div>
								<div class="col">
									<input type="number" id="seccion" name="seccion" class="form-control form-control-lg">
								</div>
							</div>

						</div>
					</div>

					<div class="form-row">
						<div class="col">
							<label for="clave">Contraseña</label>
							<input type="password" id="clave" name="clave" class="form-control form-control-lg" required>
						</div>

						<div class="col">
							<label for="clave">Confirma contraseña</label>
							<input type="password" id="clave" class="form-control form-control-lg" required>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" id="registerbtn" class="btn-md btn btn-primary"><i class="fas fa-save mr-2"></i>Registrarme</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Central Modal Small -->


<div class="modal fade" id="modalEnviarCorreo" >

	<div class="modal-dialog modal-sm" role="document">

		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title w-100">Recuperar contraseña</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="recuperar_contrasena">

				<div class="modal-body">

					<div class="form-row">
						<div class="col">
							<label for="sendCorreo">Correo Electrónico</label>
							<input type="email" id="sendCorreo" name="correo" class="form-control validate" required>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-md"><i class="fas fa-paper-plane mr-2"></i>Enviar</button>
				</div>
			</form>
		</div>
	</div>
</div>