<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title ?> | <?= $page ?></title>
	<link rel="stylesheet" href="<?= base_url('application/assets/css/mdb-4.8.8.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('application/assets/css/fontawesome/css/all.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('application/assets/css/app.css') ?>">

	<script>
		if (location.hostname != "127.0.0.1") {
			alert('La direccion del servidor no es correcta... Intenta con: 127.0.0.1')
		}
		else if( location.href.search('index.php') == -1 ) {
			alert('La URL no parece ser correcta, intenta con index.php al final.')
		}
	</script>

</head>
<body class="fixed-sn fondo-claro white-skin" style="height: 100%">
