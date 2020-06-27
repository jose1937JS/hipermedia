<!--Main Layout-->
<main class="animated fadeIn">
	<div class="container-fluid my-3">
		<div class="row">
			<div class="col">

				<!-- Table with panel -->
				<div class="card card-cascade narrower">

					<!--Card image-->
					<div class="card-header grey lighten-5 d-flex justify-content-between align-items-center">
						<div>

						</div>
						<h3 class="ml-5">Estudiantes en la sección</h3>
						<div>
							<button type="button" title="Registrar estudiante" class="btn btn-primary btn-rounded px-3" data-toggle="modal" data-target="#addestudent">
								<i class="fas fa-user-plus mt-0 mr-2"></i> Agregar
							</button>
						</div>

					</div>
					<!--/Card image-->

					<div class="px-4 table-responsive">
						<div class="table-wrapper">
							<table class="table table-hover table-sm table-bordered" id="dtestudiantes">
								<thead class="grey lighten-5">
									<tr>
										<th><a href="#">#<i class="fas fa-sort ml-1"></i></a></th>
										<th class="th-lg"><a href="#">Cédula<i class="fas fa-sort ml-1"></i></a></th>
										<th class="th-lg"><a href="#">Nombre<i class="fas fa-sort ml-1"></i></a></th>
										<th class="th-lg"><a href="#">Apellido<i class="fas fa-sort ml-1"></i></a></th>
										<th class="th-lg"><a href="#">Correo<i class="fas fa-sort ml-1"></i></a></th>
										<th class="th-lg"><a href="#">Teléfono<i class="fas fa-sort ml-1"></i></a></th>
										<th class="th-lg text-center">Acción</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>

				</div>
			<!-- Table with panel -->

			</div>
		</div>

	</div>
</main>
<!--Main Layout-->

<!-- modal de añadir estudiante -->
<!-- Modal -->
<div class="modal fade" id="addestudent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Registro de estudiantes</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="formaddestudiantes">


				<div class="modal-body p-4">

					<div class="alert alert-warning animated tada">
						<div class="row">
							<div class="col-1">
								<i class="fas fa-exclamation-circle fa-2x"></i>
							</div>
							<div class="col">
								<p class="">La contraseña del estudiante será su cédula y se creará automaticamente. Si el estudiante anteriormente tenia una cuenta su usuario se activará con la información que tenía y su contraseña se reestablecerá.</p>
							</div>
						</div>
					</div>

					<div class="form-row">
						<div class="col mb-3">
							<label for="cedulaest">Cédula del estudiante</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-id-card prefix"></i>
									</span>
								</div>
								<input type="text" class="form-control form-control-lg validate cedula" name="cedula" id="cedulaest" maxlength="9" minlength="8" pattern="^[0-9]{8,9}$" required>
								<p class="small red-text cimsg mt-2"></p>
							</div>
						</div>

						<div class="col mb-3">
							<label for="nombreest">Nombre del estudiante</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-user prefix"></i>
									</span>
								</div>
								<input type="text" class="form-control form-control-lg validate" name="nombre" id="nombreest" required pattern="^([a-zA-Z][\s]?)+$">
							</div>
						</div>

						<div class="col">
							<label for="apellidoest">Apellido del estudiante</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-user prefix"></i>
									</span>
								</div>
								<input type="text" class="form-control form-control-lg validate" name="apellido" id="apellidoest" required pattern="^([a-zA-Z][\s]?)+$">
							</div>
						</div>
					</div>

					<div class="form-row mt-3">
						<div class="col">
							<label for="emailest">Correo Electrónico del estudiante</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-envelope prefix"></i>
									</span>
								</div>
								<input type="email" name="email" class="form-control form-control-lg correo validate" id="emailest" required">
							</div>
							<p class="small red-text cemsg mt-2"></p>
						</div>

						<div class="col">
							<label for="phoneest">Teléfono del estudiante</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">
										<i class="fas fa-phone prefix"></i>
									</span>
								</div>
								<input type="text" name="telefono" class="form-control form-control-lg validate" placeholder="0000-000-0000" id="phoneest" pattern="^[0-9]{4}-[0-9]{3}-[0-9]{4}$">
							</div>

						</div>
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-between">
					<button type="button" class="btn btn-md btn-secondary" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cerrar</button>
					<button type="submit" class="btn btn-md btn-primary" id="registerbtn"><i class="fas fa-save mr-2"></i>Añadir</button>
				</div>
			</form>
		</div>
	</div>
</div>




<!-- Modal par aeditar al estudiante -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar estudiante</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="editarForm">

				<input type="hidden" name="idusuario" id="idusuario">
				<input type="hidden" name="idpersona" id="idpersona">

				<div class="modal-body">
					<div class="row form-group">
						<div class="col-5">
							<label for="cedula">Cédula</label>
							<input type="text" name="cedula" id="cedula" class="form-control" maxlength="9" minlength="8" pattern="^[0-9]{8,9}$" required>
						</div>
						<div class="col">
							<label for="nombre">Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control" required>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-5">
							<label for="telefono">Teléfono</label>
							<input type="text" name="telefono" id="telefono" class="form-control" placeholder="0000-000-0000" pattern="^[0-9]{4}-[0-9]{3}-[0-9]{4}$" >
						</div>
						<div class="col">
							<label for="apellido">Apellido</label>
							<input type="text" name="apellido" id="apellido" class="form-control" required>
						</div>
					</div>

					<div class="row form-group">
						<div class="col-6">
							<label for="email">Correo Electrónico</label>
							<input type="email" name="email" id="email" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary btn-md">Guardar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- MODAL PAR ELIMINAR ESTUDIANTE -->
<div class="modal fade" id="elimModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar estudiante</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="eliminarForm">

				<input type="hidden" name="idusuario" id="idusuariodel">
				<input type="hidden" name="idpersona" id="idpersonadel">

				<div class="modal-body">
					<p class="lead text-center">¿Está seguro de querer eliminar al usuario?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Cerrar</button>
					<button type="submit" class="btn btn-primary btn-md">Eliminar</button>
				</div>
			</form>
		</div>
	</div>
</div>