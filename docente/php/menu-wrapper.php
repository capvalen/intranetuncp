<?php 
$nomArchivo = basename($_SERVER['PHP_SELF']); ?>

			
<!--Barra de Menú-->
<nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #332435">
	<div class="container-fluid">
										
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
						<a class="dropdown-item" href="miperfil.php">Mi perfil</a>
						<a class="dropdown-item" href="php/desconectar.php">Cerrar sesión</a>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!--Fin de barra de menú-->