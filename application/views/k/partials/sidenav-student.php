<!--Double navigation-->
<header>
	<!-- Sidebar navigation -->
	<div id="slide-out" class="side-nav sn-bg-4 fixed">
		<ul class="custom-scrollbar">
			<!-- Logo -->
			<li>
				<div class="logo-wrapper waves-light">
					<a href="#"><p class="flex-center white-text logo">Hipermedia</p></a>
				</div>
			</li>
			<!--/. Logo -->
			<!-- Side navigation links -->
			<li>
				<ul class="collapsible collapsible-accordion">
					<li>
						<?= anchor('estudiante', '<i class="fas fa-home"></i>Inicio', 'class="collapsible-header waves-effect active" id="inicio"') ?>
					</li>
					<li>
						<?= anchor('estudiante/contenidos', '<i class="fas fa-book"></i> Contenido', 'class="collapsible-header waves-effect" id="contenido"') ?>
					</li>
					<li>
						<?= anchor('estudiante/evaluaciones', '<i class="fas fa-tasks"></i> Evaluaciones', 'class="collapsible-header waves-effect" id="examenes"') ?>
					</li>
					<li>
						<?= anchor('estudiante/asignaciones', '<i class="fas fa-calendar-check"></i> Asignaciones', 'class="collapsible-header waves-effect" id="asignaciones"') ?>
					</li>
					<li>
						<?= anchor('estudiante/recursos', '<i class="fas fa-file"></i> Recursos', 'class="collapsible-header waves-effect" id="repositorio"') ?>
					</li>
					<li>
						<?= anchor('estudiante/herramientas', '<i class="fas fa-cubes"></i> Herramientas', 'class="collapsible-header waves-effect" id="herramientas"') ?>
					</li>
					<li>
						<?= anchor('estudiante/simuladores', '<i class="fas fa-code"></i> Simuladores', 'class="collapsible-header waves-effect" id="simulador"') ?>
					</li>
				</ul>
			</li>
			<!--/. Side navigation links -->
		</ul>
		<div class="sidenav-bg mask-strong"></div>
	</div>
	<!--/. Sidebar navigation -->
	<!-- Navbar -->
	<nav class="navbar fixed-top navbar-toggleable-md navbar-expand-lg double-nav">
		<button class="navbar-toggler py-2" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fas fa-bars white-text"></i>
		</button>
		<!-- SideNav slide-out hidden button -->
		<div class="float-left">
			<a href="#" data-activates="slide-out" class="button-collapse"></a>
		</div>

		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
			<ul class="nav navbar-nav nav-flex-icons d-xs-none mr-auto" style="margin-left: 20%">
				<li class="nav-link">
					<b><i class="fas fa-info-circle mr-2"></i>Sección <?= $seccion ?></b>
				</li>
			</ul>
			<ul class="nav navbar-nav nav-flex-icons d-md-none mr-auto">

				<li class="nav-item">
					<?= anchor('estudiante', '<i class="fas fa-home"></i>Inicio', 'class="nav-link"') ?>
				</li>
				<li class="nav-item">
					<?= anchor('estudiante/contenidos', '<i class="fas fa-book"></i> Contenido', 'class="nav-link"') ?>
				</li>
				<li class="nav-item">
					<?= anchor('estudiante/evaluaciones', '<i class="fas fa-tasks"></i> Evaluaciones', 'class="nav-link"') ?>
				</li>
				<li class="nav-item">
					<?= anchor('estudiante/asignaciones', '<i class="fas fa-calendar-check"></i> Asignaciones', 'class="nav-link"') ?>
				</li>
				<li class="nav-item">
					<?= anchor('estudiante/recursos', '<i class="fas fa-archive"></i> Recursos', 'class="nav-link"') ?>
				</li>
				<li class="nav-item">
					<?= anchor('estudiante/herramientas', '<i class="fas fa-wrench"></i> Herramientas', 'class="nav-link"') ?>
				</li>
				<li class="nav-item">
					<?= anchor('estudiante/simuladores', '<i class="fas fa-code"></i> Simuladores', 'class="nav-link"') ?>
				</li>
			</ul>

			<ul class="nav navbar-nav nav-flex-icons ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user mr-2"></i><?= $user[0]->nombre.' '.$user[0]->apellido ?>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<?php if ($cantMsg > 0): ?>

							<?= anchor('chat', "<i class='fas fa-comments mr-1'></i> Chat <span class='badge badge-danger ml-2'>$cantMsg</span>", ['class' => 'dropdown-item']) ?>
						<?php else: ?>

							<?= anchor('chat', "<i class='fas fa-comments mr-1'></i> Chat", ['class' => 'dropdown-item']) ?>
						<?php endif ?>

						<div class="dropdown-divider"></div>
						<?= anchor('perfil', '<i class="fas fa-user mr-1"></i> Perfil', ['class' => 'dropdown-item']) ?>
						<a class="dropdown-item" onclick="document.getElementById('formlogout').submit()" href="#logout">
							<i class="fas fa-power-off mr-1"></i> Salir
						</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
<!-- /.Navbar -->
</header>
<!--/.Double navigation-->
<?= form_open('logout', ['id' => 'formlogout']) ?></form>