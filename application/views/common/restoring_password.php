<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<style>
		.card {
			background: linear-gradient(#7e75c2, #a1e4ff);
			width: 475px;
			padding: 20px;
			border: 1px solid #868484;
			margin: auto;
			height: 255px;
			border-radius: 40px 10px;
			color: #262626;
			font-size: 15px;
		}
		.btn {
			display: inline-block;
			font-weight: 400;
			margin-top: 12px;
			/*color: #212529;*/
			text-align: center;
			vertical-align: middle;
			padding: 0.45rem 0.75rem;
			font-size: .875rem;
			line-height: 1.5;
			border-radius: 0.2rem;
		}
		.btn-primary {
			background-color: #007bff;
			border-color: #007bff;
		}
		.btn-primary:hover {
			color: #fff;
			background-color: #0069d9;
			border-color: #0062cc;
		}
		.text-center { text-align: center; }
		a {
			color: #e1e1e2;
			text-decoration: none;
		}
		.w-30 { width: 40%; }
	</style>
</head>
<body>
	<div class="card">
		<div class="text-center">
			<p><img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" class="w-30" alt="logo"></p>
			<p>Este mensaje se envió el <b><?= $created_at ?></b> y tendrá una validez de una hora hasta el <b><?= $expire_date ?></b> para que puedas restablecer tu contraseña.</p>
			<p><?= anchor("recuperar/$token?correo=$email", 'Restaurar contraseña', ['class' => 'btn btn-primary']) ?></p>
		</div>
	</div>
</body>
</html>