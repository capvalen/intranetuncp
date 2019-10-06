<?php 
$nomArchivo = basename($_SERVER['PHP_SELF']); ?>
<!-- Sidebar  -->
<nav id="sidebar">
		<div id="dismiss" class="d-flex justify-content-center align-items-center">
				<i class="icofont-simple-left-down"></i>
		</div>

		<div class="sidebar-header">
				<img class="img-fluid" src="images/empresa.png">
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
						<a href="productos.html" class="d-flex align-items-center"><i class="icofont-business-man"></i> Sub dirección Adm.</span></a>
				</li>
				<li>
						<a href="caja.php" class="d-flex align-items-center"><i class="icofont-business-man"></i> Sub dirección Académica</span></a>
				</li>
				<li>
					<a href="#pageSubAcademico" data-toggle="collapse" aria-expanded="false" class="d-flex align-items-center"><i class="icofont-pen-holder"></i> Área de registro </span> <i class="icofont-caret-down ml-auto"></i></a>
					<ul class="collapse list-unstyled" id="pageSubAcademico">
						<li>
							<a href="ciclos.php"><i class="icofont-folder-open"></i> Ciclos</a>
						</li>
						<li>
							<a href="mesacademico.php"><i class="icofont-folder-open"></i> Mes académico</a>
						</li>
						<li>
							<a href="matrícula.php"><i class="icofont-book-mark"></i> Matrícular alumno</a>
						</li>
						<li>
							<a href="tramites.php"><i class="icofont-money"></i> Pagos</a>
						</li>
						<li>
							<a href="tramites.php"><i class="icofont-attachment"></i> Trámite documentario</a>
						</li>
						<li>
								<a href="seguimiento.php"><i class="icofont-attachment"></i> Seguimiento académico</a>
						</li>
					</ul>
				</li>
				<li>
						<a href="reportes.php" class="d-flex align-items-center"><i class="icofont-ui-home"></i> Sede Huancas</span></a>
				</li>
				<li>
						<a href="configuraciones.php" class="d-flex align-items-center"><i class="icofont-ui-home"></i> Sede Tarma</span></a>
				</li>
				<li <?php if($nomArchivo =='docente.php') echo 'class="active"'; ?>>
						<a href="docente.php" class="d-flex align-items-center"><i class="icofont-man-in-glasses"></i> Docente</span></a>
				</li>
				<li <?php if($nomArchivo =='alumnado.php') echo 'class="active"'; ?>>
						<a href="alumnado.php" class="d-flex align-items-center"><i class="icofont-boy"></i> Alumnado</span></a>
				</li>
				<li <?php if($nomArchivo =='configuraciones.php') echo 'class="active"'; ?>>
						<a href="configuraciones.php" class="d-flex align-items-center"><i class="icofont-ui-settings"></i> Configuraciones</span></a>
				</li>
		</ul>
</nav>
<!-- Fin Sidebar  -->
			
<!--Barra de Menú-->
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #a35bb4">
	<div class="container-fluid">
		<button type="button" id="sidebarCollapse" class="btn btn-outline-light tieneMostrar mr-3 px-2" >
				<i class="icofont-navigation-menu"></i>
		</button>
										
		<a class="navbar-brand" href="#!" id="btnBrand">
			<img src="images/ceid_logo.png" width="auto" height="35" class="d-inline-block align-top" alt=""> <!-- -->
			Centro de Idiomas - UNCP
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
						<a class="dropdown-item" href="#">Mi perfil</a>
						<a class="dropdown-item" href="php/desconectar.php">Cerrar sesión</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!--Fin de barra de menú-->