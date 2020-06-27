<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style>
		* {
			-webkit-box-sizing:border-box;
			-moz-box-sizing:border-box;
			box-sizing:border-box
		}
		html {
			font-family:sans-serif;
			-ms-text-size-adjust:100%;
			-webkit-text-size-adjust:100%
		}
		body {
			font-family:"Helvetica Neue",Helvetica,Arial,sans-serif;
			font-size:14px;
			line-height:1.42857143;
			color:#333;
			background-color:#fff;
			margin:0
		}

		table {
			background-color:transparent
		}
		table col[class*=col-] {
			position:static;
			display:table-column;
			float:none
		}
		table td[class*=col-],
		table th[class*=col-] {
			position:static;
			display:table-cell;
			float:none
		}
		caption {
			padding-top:8px;
			padding-bottom:8px;
			color:#777;
			text-align:left
		}
		th {
			text-align:left
		}
		.table {
			width:100%;
			max-width:100%;
			margin-bottom:20px
		}
		.table>tbody>tr>td,
		.table>tbody>tr>th,
		.table>tfoot>tr>td,
		.table>tfoot>tr>th,
		.table>thead>tr>td,
		.table>thead>tr>th {
			padding:8px;
			line-height:1.42857143;
			vertical-align:top;
			border-top:1px solid #ddd
		}
		.table>thead>tr>th {
			vertical-align:bottom;
			border-bottom:2px solid #ddd
		}
		.table>caption+thead>tr:first-child>td,
		.table>caption+thead>tr:first-child>th,
		.table>colgroup+thead>tr:first-child>td,
		.table>colgroup+thead>tr:first-child>th,
		.table>thead:first-child>tr:first-child>td,
		.table>thead:first-child>tr:first-child>th {
			border-top:0
		}
		.table>tbody+tbody {
			border-top:2px solid #ddd
		}
		.table .table {
			background-color:#fff
		}
		.table-bordered {
			border:1px solid #ddd
		}
		.table-bordered>tbody>tr>td,
		.table-bordered>tbody>tr>th,
		.table-bordered>tfoot>tr>td,
		.table-bordered>tfoot>tr>th,
		.table-bordered>thead>tr>td,
		.table-bordered>thead>tr>th {
			border:1px solid #ddd
		}
		.table-bordered>thead>tr>td,
		.table-bordered>thead>tr>th {
			border-bottom-width:2px
		}
		.table-striped>tbody>tr:nth-of-type(odd) mt-5 {
			background-color:#f9f9f9
		}
		.text-center {
			text-align: center !important;
		}
		.mb-5 {
			margin-bottom: 3rem !important
		}
		.mt-5 {
			margin-top: 3rem !important
		}
		.my-5 {
			margin-top: 3rem !important;
			margin-bottom: 3rem !important;
		}
		.container {
			padding-right:15px;
			padding-left:15px;
			margin-right:auto;
			margin-left:auto
		}
		@media (min-width:768px) {
			.container {
				width:750px
			}
		}
		@media (min-width:992px) {
			.container {
				width:970px
			}
		}
		@media (min-width:1200px) {
			.container {
				width:1170px
			}
		}
		.container-fluid {
			padding-right:15px;
			padding-left:15px;
			margin-right:auto;
			margin-left:auto
		}
		.row {
			margin-right:-15px;
			margin-left:-15px
		}
		.row-no-gutters {
			margin-right:0;
			margin-left:0
		}
		.row-no-gutters [class*=col-] {
			padding-right:0;
			padding-left:0
		}
		.col-lg-1,
		.col-lg-10,
		.col-lg-11,
		.col-lg-12,
		.col-lg-2,
		.col-lg-3,
		.col-lg-4,
		.col-lg-5,
		.col-lg-6,
		.col-lg-7,
		.col-lg-8,
		.col-lg-9,
		.col-md-1,
		.col-md-10,
		.col-md-11,
		.col-md-12,
		.col-md-2,
		.col-md-3,
		.col-md-4,
		.col-md-5,
		.col-md-6,
		.col-md-7,
		.col-md-8,
		.col-md-9,
		.col-sm-1,
		.col-sm-10,
		.col-sm-11,
		.col-sm-12,
		.col-sm-2,
		.col-sm-3,
		.col-sm-4,
		.col-sm-5,
		.col-sm-6,
		.col-sm-7,
		.col-sm-8,
		.col-sm-9,
		.col-xs-1,
		.col-xs-10,
		.col-xs-11,
		.col-xs-12,
		.col-xs-2,
		.col-xs-3,
		.col-xs-4,
		.col-xs-5,
		.col-xs-6,
		.col-xs-7,
		.col-xs-8,
		.col-xs-9 {
			position:relative;
			min-height:1px;
			padding-right:15px;
			padding-left:15px
		}
		.col-xs-1,
		.col-xs-10,
		.col-xs-11,
		.col-xs-12,
		.col-xs-2,
		.col-xs-3,
		.col-xs-4,
		.col-xs-5,
		.col-xs-6,
		.col-xs-7,
		.col-xs-8,
		.col-xs-9 {
			float:left
		}
		.col-xs-12 {
			width:100%
		}
		.col-xs-11 {
			width:91.66666667%
		}
		.col-xs-10 {
			width:83.33333333%
		}
		.col-xs-9 {
			width:75%
		}
		.col-xs-8 {
			width:66.66666667%
		}
		.col-xs-7 {
			width:58.33333333%
		}
		.col-xs-6 {
			width:50%
		}
		.col-xs-5 {
			width:41.66666667%
		}
		.col-xs-4 {
			width:33.33333333%
		}
		.col-xs-3 {
			width:25%
		}
		.col-xs-2 {
			width:16.66666667%
		}
		.col-xs-1 {
			width:8.33333333%
		}
		.col-xs-pull-12 {
			right:100%
		}
		.col-xs-pull-11 {
			right:91.66666667%
		}
		.col-xs-pull-10 {
			right:83.33333333%
		}
		.col-xs-pull-9 {
			right:75%
		}
		.col-xs-pull-8 {
			right:66.66666667%
		}
		.col-xs-pull-7 {
			right:58.33333333%
		}
		.col-xs-pull-6 {
			right:50%
		}
		.col-xs-pull-5 {
			right:41.66666667%
		}
		.col-xs-pull-4 {
			right:33.33333333%
		}
		.col-xs-pull-3 {
			right:25%
		}
		.col-xs-pull-2 {
			right:16.66666667%
		}
		.col-xs-pull-1 {
			right:8.33333333%
		}
		.col-xs-pull-0 {
			right:auto
		}
		.col-xs-push-12 {
			left:100%
		}
		.col-xs-push-11 {
			left:91.66666667%
		}
		.col-xs-push-10 {
			left:83.33333333%
		}
		.col-xs-push-9 {
			left:75%
		}
		.col-xs-push-8 {
			left:66.66666667%
		}
		.col-xs-push-7 {
			left:58.33333333%
		}
		.col-xs-push-6 {
			left:50%
		}
		.col-xs-push-5 {
			left:41.66666667%
		}
		.col-xs-push-4 {
			left:33.33333333%
		}
		.col-xs-push-3 {
			left:25%
		}
		.col-xs-push-2 {
			left:16.66666667%
		}
		.col-xs-push-1 {
			left:8.33333333%
		}
		.col-xs-push-0 {
			left:auto
		}
		.col-xs-offset-12 {
			margin-left:100%
		}
		.col-xs-offset-11 {
			margin-left:91.66666667%
		}
		.col-xs-offset-10 {
			margin-left:83.33333333%
		}
		.col-xs-offset-9 {
			margin-left:75%
		}
		.col-xs-offset-8 {
			margin-left:66.66666667%
		}
		.col-xs-offset-7 {
			margin-left:58.33333333%
		}
		.col-xs-offset-6 {
			margin-left:50%
		}
		.col-xs-offset-5 {
			margin-left:41.66666667%
		}
		.col-xs-offset-4 {
			margin-left:33.33333333%
		}
		.col-xs-offset-3 {
			margin-left:25%
		}
		.col-xs-offset-2 {
			margin-left:16.66666667%
		}
		.col-xs-offset-1 {
			margin-left:8.33333333%
		}
		.col-xs-offset-0 {
			margin-left:0
		}
		@media (min-width:768px) {
			.col-sm-1,
			.col-sm-10,
			.col-sm-11,
			.col-sm-12,
			.col-sm-2,
			.col-sm-3,
			.col-sm-4,
			.col-sm-5,
			.col-sm-6,
			.col-sm-7,
			.col-sm-8,
			.col-sm-9 {
				float:left
			}
			.col-sm-12 {
				width:100%
			}
			.col-sm-11 {
				width:91.66666667%
			}
			.col-sm-10 {
				width:83.33333333%
			}
			.col-sm-9 {
				width:75%
			}
			.col-sm-8 {
				width:66.66666667%
			}
			.col-sm-7 {
				width:58.33333333%
			}
			.col-sm-6 {
				width:50%
			}
			.col-sm-5 {
				width:41.66666667%
			}
			.col-sm-4 {
				width:33.33333333%
			}
			.col-sm-3 {
				width:25%
			}
			.col-sm-2 {
				width:16.66666667%
			}
			.col-sm-1 {
				width:8.33333333%
			}
			.col-sm-pull-12 {
				right:100%
			}
			.col-sm-pull-11 {
				right:91.66666667%
			}
			.col-sm-pull-10 {
				right:83.33333333%
			}
			.col-sm-pull-9 {
				right:75%
			}
			.col-sm-pull-8 {
				right:66.66666667%
			}
			.col-sm-pull-7 {
				right:58.33333333%
			}
			.col-sm-pull-6 {
				right:50%
			}
			.col-sm-pull-5 {
				right:41.66666667%
			}
			.col-sm-pull-4 {
				right:33.33333333%
			}
			.col-sm-pull-3 {
				right:25%
			}
			.col-sm-pull-2 {
				right:16.66666667%
			}
			.col-sm-pull-1 {
				right:8.33333333%
			}
			.col-sm-pull-0 {
				right:auto
			}
			.col-sm-push-12 {
				left:100%
			}
			.col-sm-push-11 {
				left:91.66666667%
			}
			.col-sm-push-10 {
				left:83.33333333%
			}
			.col-sm-push-9 {
				left:75%
			}
			.col-sm-push-8 {
				left:66.66666667%
			}
			.col-sm-push-7 {
				left:58.33333333%
			}
			.col-sm-push-6 {
				left:50%
			}
			.col-sm-push-5 {
				left:41.66666667%
			}
			.col-sm-push-4 {
				left:33.33333333%
			}
			.col-sm-push-3 {
				left:25%
			}
			.col-sm-push-2 {
				left:16.66666667%
			}
			.col-sm-push-1 {
				left:8.33333333%
			}
			.col-sm-push-0 {
				left:auto
			}
			.col-sm-offset-12 {
				margin-left:100%
			}
			.col-sm-offset-11 {
				margin-left:91.66666667%
			}
			.col-sm-offset-10 {
				margin-left:83.33333333%
			}
			.col-sm-offset-9 {
				margin-left:75%
			}
			.col-sm-offset-8 {
				margin-left:66.66666667%
			}
			.col-sm-offset-7 {
				margin-left:58.33333333%
			}
			.col-sm-offset-6 {
				margin-left:50%
			}
			.col-sm-offset-5 {
				margin-left:41.66666667%
			}
			.col-sm-offset-4 {
				margin-left:33.33333333%
			}
			.col-sm-offset-3 {
				margin-left:25%
			}
			.col-sm-offset-2 {
				margin-left:16.66666667%
			}
			.col-sm-offset-1 {
				margin-left:8.33333333%
			}
			.col-sm-offset-0 {
				margin-left:0
			}
		}
		@media (min-width:992px) {
			.col-md-1,
			.col-md-10,
			.col-md-11,
			.col-md-12,
			.col-md-2,
			.col-md-3,
			.col-md-4,
			.col-md-5,
			.col-md-6,
			.col-md-7,
			.col-md-8,
			.col-md-9 {
				float:left
			}
			.col-md-12 {
				width:100%
			}
			.col-md-11 {
				width:91.66666667%
			}
			.col-md-10 {
				width:83.33333333%
			}
			.col-md-9 {
				width:75%
			}
			.col-md-8 {
				width:66.66666667%
			}
			.col-md-7 {
				width:58.33333333%
			}
			.col-md-6 {
				width:50%
			}
			.col-md-5 {
				width:41.66666667%
			}
			.col-md-4 {
				width:33.33333333%
			}
			.col-md-3 {
				width:25%
			}
			.col-md-2 {
				width:16.66666667%
			}
			.col-md-1 {
				width:8.33333333%
			}
			.col-md-pull-12 {
				right:100%
			}
			.col-md-pull-11 {
				right:91.66666667%
			}
			.col-md-pull-10 {
				right:83.33333333%
			}
			.col-md-pull-9 {
				right:75%
			}
			.col-md-pull-8 {
				right:66.66666667%
			}
			.col-md-pull-7 {
				right:58.33333333%
			}
			.col-md-pull-6 {
				right:50%
			}
			.col-md-pull-5 {
				right:41.66666667%
			}
			.col-md-pull-4 {
				right:33.33333333%
			}
			.col-md-pull-3 {
				right:25%
			}
			.col-md-pull-2 {
				right:16.66666667%
			}
			.col-md-pull-1 {
				right:8.33333333%
			}
			.col-md-pull-0 {
				right:auto
			}
			.col-md-push-12 {
				left:100%
			}
			.col-md-push-11 {
				left:91.66666667%
			}
			.col-md-push-10 {
				left:83.33333333%
			}
			.col-md-push-9 {
				left:75%
			}
			.col-md-push-8 {
				left:66.66666667%
			}
			.col-md-push-7 {
				left:58.33333333%
			}
			.col-md-push-6 {
				left:50%
			}
			.col-md-push-5 {
				left:41.66666667%
			}
			.col-md-push-4 {
				left:33.33333333%
			}
			.col-md-push-3 {
				left:25%
			}
			.col-md-push-2 {
				left:16.66666667%
			}
			.col-md-push-1 {
				left:8.33333333%
			}
			.col-md-push-0 {
				left:auto
			}
			.col-md-offset-12 {
				margin-left:100%
			}
			.col-md-offset-11 {
				margin-left:91.66666667%
			}
			.col-md-offset-10 {
				margin-left:83.33333333%
			}
			.col-md-offset-9 {
				margin-left:75%
			}
			.col-md-offset-8 {
				margin-left:66.66666667%
			}
			.col-md-offset-7 {
				margin-left:58.33333333%
			}
			.col-md-offset-6 {
				margin-left:50%
			}
			.col-md-offset-5 {
				margin-left:41.66666667%
			}
			.col-md-offset-4 {
				margin-left:33.33333333%
			}
			.col-md-offset-3 {
				margin-left:25%
			}
			.col-md-offset-2 {
				margin-left:16.66666667%
			}
			.col-md-offset-1 {
				margin-left:8.33333333%
			}
			.col-md-offset-0 {
				margin-left:0
			}
		}
		@media (min-width:1200px) {
			.col-lg-1,
			.col-lg-10,
			.col-lg-11,
			.col-lg-12,
			.col-lg-2,
			.col-lg-3,
			.col-lg-4,
			.col-lg-5,
			.col-lg-6,
			.col-lg-7,
			.col-lg-8,
			.col-lg-9 {
				float:left
			}
			.col-lg-12 {
				width:100%
			}
			.col-lg-11 {
				width:91.66666667%
			}
			.col-lg-10 {
				width:83.33333333%
			}
			.col-lg-9 {
				width:75%
			}
			.col-lg-8 {
				width:66.66666667%
			}
			.col-lg-7 {
				width:58.33333333%
			}
			.col-lg-6 {
				width:50%
			}
			.col-lg-5 {
				width:41.66666667%
			}
			.col-lg-4 {
				width:33.33333333%
			}
			.col-lg-3 {
				width:25%
			}
			.col-lg-2 {
				width:16.66666667%
			}
			.col-lg-1 {
				width:8.33333333%
			}
			.col-lg-pull-12 {
				right:100%
			}
			.col-lg-pull-11 {
				right:91.66666667%
			}
			.col-lg-pull-10 {
				right:83.33333333%
			}
			.col-lg-pull-9 {
				right:75%
			}
			.col-lg-pull-8 {
				right:66.66666667%
			}
			.col-lg-pull-7 {
				right:58.33333333%
			}
			.col-lg-pull-6 {
				right:50%
			}
			.col-lg-pull-5 {
				right:41.66666667%
			}
			.col-lg-pull-4 {
				right:33.33333333%
			}
			.col-lg-pull-3 {
				right:25%
			}
			.col-lg-pull-2 {
				right:16.66666667%
			}
			.col-lg-pull-1 {
				right:8.33333333%
			}
			.col-lg-pull-0 {
				right:auto
			}
			.col-lg-push-12 {
				left:100%
			}
			.col-lg-push-11 {
				left:91.66666667%
			}
			.col-lg-push-10 {
				left:83.33333333%
			}
			.col-lg-push-9 {
				left:75%
			}
			.col-lg-push-8 {
				left:66.66666667%
			}
			.col-lg-push-7 {
				left:58.33333333%
			}
			.col-lg-push-6 {
				left:50%
			}
			.col-lg-push-5 {
				left:41.66666667%
			}
			.col-lg-push-4 {
				left:33.33333333%
			}
			.col-lg-push-3 {
				left:25%
			}
			.col-lg-push-2 {
				left:16.66666667%
			}
			.col-lg-push-1 {
				left:8.33333333%
			}
			.col-lg-push-0 {
				left:auto
			}
			.col-lg-offset-12 {
				margin-left:100%
			}
			.col-lg-offset-11 {
				margin-left:91.66666667%
			}
			.col-lg-offset-10 {
				margin-left:83.33333333%
			}
			.col-lg-offset-9 {
				margin-left:75%
			}
			.col-lg-offset-8 {
				margin-left:66.66666667%
			}
			.col-lg-offset-7 {
				margin-left:58.33333333%
			}
			.col-lg-offset-6 {
				margin-left:50%
			}
			.col-lg-offset-5 {
				margin-left:41.66666667%
			}
			.col-lg-offset-4 {
				margin-left:33.33333333%
			}
			.col-lg-offset-3 {
				margin-left:25%
			}
			.col-lg-offset-2 {
				margin-left:16.66666667%
			}
			.col-lg-offset-1 {
				margin-left:8.33333333%
			}
			.col-lg-offset-0 {
				margin-left:0
			}
		}
		img,
		tr {
			page-break-inside:avoid
		}
		img {
			max-width:100%!important;
			vertical-align: middle;
		}


		.img {
			max-width: 100%;
			height: auto;
		}
	</style>
</head>
<body>
	<div class="">

		<div class="row">
			<div class="col-xs-2">
				<img src="<?= $_SERVER['DOCUMENT_ROOT'] ?>/hipermedia/application/assets/img/mdb-transparent.png" class="img">
				<!--<img src="<?= base_url('application/assets/img/mdb-transparent.png') ?>" class="img-responsive">-->
			</div>
			<div class="col-xs-7">
				<p class="text-center">
					<span>REPUBLICA BOLIVARIANA DE VENEZUELA</span><br>
					<span>UNIVERSIDAD NACIONAL EXPERIMENTAL ROMULO GALLEGOS</span><br>
					<span>AREA DE INGENIERIA EN SISTEMAS</span><br>
					<span>HIPERMEDIA</span><br>
					<span>REPORTE DE RENDIMIENTO ESTUDIANTIL</span><br>
				</p>
			</div>
			<div class="col-xs-2">
				<img src="<?= $_SERVER['DOCUMENT_ROOT'] ?>/hipermedia/application/assets/img/mdb-transparent.png" class="img">
				<!--<img src="<?= base_url('application/assets/img/mdb-transparent.png') ?>" class="img-responsive">-->
			</div>
		</div>

		<br><br><br><br><br>

		<?php if ($data): ?>

			<div class="row">
				<div class="col-sm-12">
					<p class="mt-5">La siguiente tabla muestra un resumen de notas de las evaluaciones presentadas por los estudiantes de la sección <b><?= $data[0]->seccion ?></b>.</p>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Examen</th>
								<th>Valor</th>
								<th>Lapso</th>
								<th>Tema</th>
								<th>Cédula</th>
								<th>Nombre Completo</th>
								<th>Nota</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data as $key => $value): ?>

								<tr>
									<td><?= $value->idexamen ?></td>
									<td><?= $value->valor_total ?></td>
									<td><?= $value->lapso ?></td>
									<td><?= $value->tema ?></td>
									<td><?= $value->cedula ?></td>
									<td><?= $value->nombre.' '.$value->apellido ?></td>
									<td><?= $value->puntuacion ?></td>
								</tr>

							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>

		<?php else: ?>
			<div class="row mt-5">
				<div class="col-sm-12">

					<h2 class="mt-5 text-center">No hay información disponible</h2>
				</div>
			</div>
		<?php endif ?>
	</div>

</body>
</html>