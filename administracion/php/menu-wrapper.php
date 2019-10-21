<?php 
$nomArchivo = basename($_SERVER['PHP_SELF']); ?>
<!-- Sidebar  -->
<nav id="sidebar">
		<div id="dismiss" class="d-flex justify-content-center align-items-center">
				<i class="icofont-simple-left-down"></i>
		</div>

		<div class="sidebar-header">
				<img class="img-fluid" src="images/empresa.png?v=1.1">
		</div>

		<ul class="list-unstyled components">
				<p class="text-center"><small>Versión 1.0</small></p>
				<li>
					<a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="d-flex align-items-center"><i class="icofont-support"></i> <span class="liText">Secretaría</span> <i class="icofont-caret-down ml-auto"></i></a>
					<ul class="collapse list-unstyled" id="pageSubmenu">
						<li>
								<a href="tramites.php"><i class="icofont-attachment"></i> Trámite documentario</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#pageSubAcademicoAdm" data-toggle="collapse" aria-expanded="false" class="d-flex align-items-center"><i class="icofont-business-man"></i> Sub Dirección Adm. </span> <i class="icofont-caret-down ml-auto"></i></a>
					<ul class="collapse list-unstyled" id="pageSubAcademicoAdm">
						<li>
							<a href="ciclos.php"><i class="icofont-folder-open"></i> Ciclos</a>
						</li>
						<li>
							<a href="mesacademico.php"><i class="icofont-folder-open"></i> Mes académico</a>
						</li>
						<li>
							<a href="matricula.php"><i class="icofont-book-mark"></i> Matrícular alumno</a>
						</li>
						<li>
							<a href="pagos.php"><i class="icofont-money"></i> Pagos</a>
						</li>
						<li>
								<a href="reservas.php"><i class="icofont-contacts"></i> Reserva de matrícula</a>
						</li>
						<li>
								<a href="seguimiento.php"><i class="icofont-attachment"></i> Seguimiento académico</a>
						</li>
						<li>
							<a href="tramites.php"><i class="icofont-attachment"></i> Trámite documentario</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#pageSubAcademico" data-toggle="collapse" aria-expanded="false" class="d-flex align-items-center"><i class="icofont-business-man"></i> Sub Dirección Académica </span> <i class="icofont-caret-down ml-auto"></i></a>
					<ul class="collapse list-unstyled" id="pageSubAcademico">
						<li>
							<a href="ciclos.php"><i class="icofont-folder-open"></i> Ciclos</a>
						</li>
						<li>
							<a href="mesacademico.php"><i class="icofont-folder-open"></i> Mes académico</a>
						</li>
						<li>
							<a href="matricula.php"><i class="icofont-book-mark"></i> Matrícular alumno</a>
						</li>
						<li>
							<a href="pagos.php"><i class="icofont-money"></i> Pagos</a>
						</li>
						<li>
								<a href="reservas.php"><i class="icofont-contacts"></i> Reserva de matrícula</a>
						</li>
						<li>
								<a href="seguimiento.php"><i class="icofont-attachment"></i> Seguimiento académico</a>
						</li>
						<li>
							<a href="tramites.php"><i class="icofont-attachment"></i> Trámite documentario</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#pageRegistros" data-toggle="collapse" aria-expanded="false" class="d-flex align-items-center"><i class="icofont-pen-holder"></i> Área de registro </span> <i class="icofont-caret-down ml-auto"></i></a>
					<ul class="collapse list-unstyled" id="pageRegistros">
						<li>
							<a href="ciclos.php"><i class="icofont-folder-open"></i> Ciclos</a>
						</li>
						<li>
							<a href="mesacademico.php"><i class="icofont-folder-open"></i> Mes académico</a>
						</li>
						<li>
							<a href="matricula.php"><i class="icofont-book-mark"></i> Matrícular alumno</a>
						</li>
						<li>
							<a href="pagos.php"><i class="icofont-money"></i> Pagos</a>
						</li>
						<li>
								<a href="reservas.php"><i class="icofont-contacts"></i> Reserva de matrícula</a>
						</li>
						<li>
								<a href="seguimiento.php"><i class="icofont-attachment"></i> Seguimiento académico</a>
						</li>
						<li>
							<a href="tramites.php"><i class="icofont-attachment"></i> Trámite documentario</a>
						</li>
					</ul>
				</li>
				<li>
						<a href="#pageHuancas" data-toggle="collapse" aria-expanded="false" class="d-flex align-items-center"><i class="icofont-ui-home"></i> Sede Huancas</span> <i class="icofont-caret-down ml-auto"></i></a>
					<ul class="collapse list-unstyled" id="pageHuancas">
						<li>
							<a href="ciclos.php"><i class="icofont-folder-open"></i> Ciclos</a>
						</li>
						<li>
							<a href="mesacademico.php"><i class="icofont-folder-open"></i> Mes académico</a>
						</li>
						<li>
							<a href="matricula.php"><i class="icofont-book-mark"></i> Matrícular alumno</a>
						</li>
						<li>
							<a href="pagos.php"><i class="icofont-money"></i> Pagos</a>
						</li>
						<li>
								<a href="seguimiento.php"><i class="icofont-attachment"></i> Seguimiento académico</a>
						</li>
						<li>
							<a href="tramites.php"><i class="icofont-attachment"></i> Trámite documentario</a>
						</li>
					</ul>
				</li>
				<li>
						<a href="#" class="d-flex align-items-center"><i class="icofont-ui-home"></i> Sede Tarma</span></a>
				</li>
				<li <?php if($nomArchivo =='configuraciones.php') echo 'class="active"'; ?>>
						<a href="configuraciones.php" class="d-flex align-items-center"><i class="icofont-ui-settings"></i> Configuraciones</span></a>
				</li>
		</ul>
</nav>
<!-- Fin Sidebar  -->
			
<!--Barra de Menú-->
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #0a121b">
	<div class="container-fluid">
		<button type="button" id="sidebarCollapse" class="btn btn-outline-light tieneMostrar mr-3 px-2" >
				<i class="icofont-navigation-menu"></i>
		</button>
										
		<a class="navbar-brand" href="#!" id="btnBrand">
			<img src="images/logoceid2.png?v=1.1" width="auto" height="45" class="d-inline-block align-top" alt=""> <!-- -->
			<span class="d-none">Centro de Idiomas - UNCP</span>
		</a>
		<button class="btn btn-outline-light d-inline-block d-lg-none ml-auto px-2" id="btnSubNavegacion" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<i class="icofont-caret-down"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="nav navbar-nav ml-auto">
					<li class="nav-item d-none">
							<a class="nav-link" href="#"> Mi perfil</a>
					</li>
				
				<li class="nav-item dropdown ">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><ion-icon name="settings"></ion-icon> Opciones</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown07">
						<a class="dropdown-item" href="#"><i class="icofont-id"></i> Mi perfil</a>
						<a class="dropdown-item" href="php/desconectar.php"><i class="icofont-exit"></i> Cerrar sesión</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!--Fin de barra de menú-->