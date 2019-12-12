<?php

include "conexionInfocat.php";

switch ($_POST['tipoReporte']) {
	case '1':
		
		$sql="SELECT i.Idi_Nombre, count(a.Alu_Codigo) as 'cantAlumnos', f.Fac_Detalle 
		FROM `seccion` s
		inner join registroalumno ra on ra.Sec_Codigo = s.Sec_Codigo
		inner join alumno a on a.Alu_Codigo = ra.Alu_Codigo
		inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
		inner join facultad f on f.Fac_Codigo = a.fac_Codigo
		where Mes_Codigo = '{$_POST['periodo']}' and Suc_Codigo='{$_POST['sucursal']}' and Sec_NroCiclo<>0
		GROUP BY s.Niv_Codigo, a.fac_Codigo; ";
		//echo $sql;
		$resultado=$cadena->query($sql);
		$totalAlumnos = 0;
		if($resultado->num_rows >=1){
			?> 
		<h5>Alumnos por facultad en el periodo <?= substr($_POST['periodo'], 0, -4)."-". substr($_POST['periodo'], -4) ?></h5>
		<table class="table table-hover ">
			<thead class="thead-dark">
				<tr>
					<th>Curso</th>
					<th>Carrera</th>
					<th>Cantidad</th>
					<th>Porcentaje</th>
				</tr>
			</thead>
			<tbody>	
		<?php
			while($row=$resultado->fetch_assoc()){ $totalAlumnos += $row['cantAlumnos'];  ?> 
				<tr>
					<td><?= $row['Idi_Nombre']; ?></td>
					<td><?= $row['Fac_Detalle']; ?></td>
					<td><span class="cantAlumno"><?= $row['cantAlumnos']; ?></span> alumnos</td>
					<td class="porcentaje"> - </td>
				</tr>
			<?php } ?> 
			</tbody>
			<tfoot>
				<tr>
					<th class="text-right" colspan="2">Total</th>
					<th><span id="totalAlumnos"><?= $totalAlumnos; ?></span> alumnos</th>
					<th>100%</th>
				</tr>
			</tfoot>
		</table>
		<?php }else{ ?> <p>No se encontraron registros en éste periodo <?= substr($_POST['periodo'], 0, -4)."-". substr($_POST['periodo'], -4) ?> </p> <?php } //Fin de if
	break;
	case '2':
		
		$sql="SELECT i.Idi_Nombre, count(a.Alu_Codigo) as 'cantAlumnos', ifnull(year(a.Alu_FechaNacimiento), '1988') as Alu_FechaNacimiento
		FROM `seccion` s
		inner join registroalumno ra on ra.Sec_Codigo = s.Sec_Codigo
		inner join alumno a on a.Alu_Codigo = ra.Alu_Codigo
		inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
		
		where Mes_Codigo = '{$_POST['periodo']}' and Suc_Codigo='{$_POST['sucursal']}' and Sec_NroCiclo<>0
		GROUP BY a.Alu_FechaNacimiento; ";
		//echo $sql;
		$resultado=$cadena->query($sql);
		$totalAlumnos = 0; $hoy = date('Y');
		if($resultado->num_rows >=1){ 
			?> 
		<h5>Alumnos por facultad en el periodo <?= substr($_POST['periodo'], 0, -4)."-". substr($_POST['periodo'], -4) ?></h5>
		<table class="table table-hover ">
			<thead class="thead-dark">
				<tr>
					<th>Curso</th>
					<th>Edad</th>
					<th>Cantidad</th>
					<th>Porcentaje</th>
				</tr>
			</thead>
			<tbody>	
		<?php
			while($row=$resultado->fetch_assoc()){ $totalAlumnos += $row['cantAlumnos'];  ?> 
				<tr>
					<td><?= $row['Idi_Nombre']; ?></td>
					<td><?= $hoy-$row['Alu_FechaNacimiento'] . " años"; ?></td>
					<td><span class="cantAlumno"><?= $row['cantAlumnos']; ?></span> alumnos</td>
					<td class="porcentaje"> - </td>
				</tr>
			<?php } ?> 
			</tbody>
			<tfoot>
				<tr>
					<th class="text-right" colspan="2">Total</th>
					<th><span id="totalAlumnos"><?= $totalAlumnos; ?></span> alumnos</th>
					<th>100%</th>
				</tr>
			</tfoot>
		</table>
		<?php }else{ ?> <p>No se encontraron registros en éste periodo <?= substr($_POST['periodo'], 0, -4)."-". substr($_POST['periodo'], -4) ?> </p> <?php } //Fin de if
	break;
	case '3':
		
		$sql="SELECT i.Idi_Nombre, count(a.Alu_Codigo) as 'cantAlumnos', a.alu_Sexo
		FROM `seccion` s
		inner join registroalumno ra on ra.Sec_Codigo = s.Sec_Codigo
		inner join alumno a on a.Alu_Codigo = ra.Alu_Codigo
		inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
		
		where Mes_Codigo = '{$_POST['periodo']}' and Suc_Codigo='{$_POST['sucursal']}' and Sec_NroCiclo<>0
		GROUP BY s.Idi_Codigo, a.Alu_FechaNacimiento; ";
		//echo $sql;
		$resultado=$cadena->query($sql);
		$totalAlumnos = 0; $hoy = date('Y');
		if($resultado->num_rows >=1){ 
			?> 
		<h5>Alumnos por facultad en el periodo <?= substr($_POST['periodo'], 0, -4)."-". substr($_POST['periodo'], -4) ?></h5>
		<table class="table table-hover ">
			<thead class="thead-dark">
				<tr>
					<th>Curso</th>
					<th>Edad</th>
					<th>Cantidad</th>
					<th>Porcentaje</th>
				</tr>
			</thead>
			<tbody>	
		<?php
			while($row=$resultado->fetch_assoc()){ $totalAlumnos += $row['cantAlumnos'];  ?> 
				<tr>
					<td><?= $row['Idi_Nombre']; ?></td>
					<td><?php if($row['alu_Sexo']==1){ echo 'Varones'; }else{ echo "Damas"; } ?></td>
					<td><span class="cantAlumno"><?= $row['cantAlumnos']; ?></span> alumnos</td>
					<td class="porcentaje"> - </td>
				</tr>
			<?php } ?> 
			</tbody>
			<tfoot>
				<tr>
					<th class="text-right" colspan="2">Total</th>
					<th><span id="totalAlumnos"><?= $totalAlumnos; ?></span> alumnos</th>
					<th>100%</th>
				</tr>
			</tfoot>
		</table>
		<?php }else{ ?> <p>No se encontraron registros en éste periodo <?= substr($_POST['periodo'], 0, -4)."-". substr($_POST['periodo'], -4) ?> </p> <?php } //Fin de if
	break;
	case '4':
		
		$sql="SELECT i.Idi_Nombre, count(a.Alu_Codigo) as 'cantAlumnos', p.procDescripcion
		FROM `seccion` s
		inner join registroalumno ra on ra.Sec_Codigo = s.Sec_Codigo
		inner join alumno a on a.Alu_Codigo = ra.Alu_Codigo
		inner join procedencia p on p.idProcedencia = a.idProcedencia
		inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
		where Mes_Codigo = '{$_POST['periodo']}' and Suc_Codigo='{$_POST['sucursal']}' and Sec_NroCiclo<>0
		GROUP BY a.idProcedencia, i.Idi_Codigo; ";
		//echo $sql;
		$resultado=$cadena->query($sql);
		$totalAlumnos = 0;
		if($resultado->num_rows >=1){ 
			?> 
		<h5>Alumnos por facultad en el periodo <?= substr($_POST['periodo'], 0, -4)."-". substr($_POST['periodo'], -4) ?></h5>
		<table class="table table-hover ">
			<thead class="thead-dark">
				<tr>
					<th>Curso</th>
					<th>Carrera</th>
					<th>Cantidad</th>
					<th>Porcentaje</th>
				</tr>
			</thead>
			<tbody>	
		<?php
			while($row=$resultado->fetch_assoc()){ $totalAlumnos += $row['cantAlumnos'];  ?> 
				<tr>
					<td><?= $row['Idi_Nombre']; ?></td>
					<td><?= $row['procDescripcion']; ?></td>
					<td><span class="cantAlumno"><?= $row['cantAlumnos']; ?></span> alumnos</td>
					<td class="porcentaje"> - </td>
				</tr>
			<?php } ?> 
			</tbody>
			<tfoot>
				<tr>
					<th class="text-right" colspan="2">Total</th>
					<th><span id="totalAlumnos"><?= $totalAlumnos; ?></span> alumnos</th>
					<th>100%</th>
				</tr>
			</tfoot>
		</table>
		<?php }else{ ?> <p>No se encontraron registros en éste periodo <?= substr($_POST['periodo'], 0, -4)."-". substr($_POST['periodo'], -4) ?> </p> <?php } //Fin de if
	break;
	
	default:
		# code...
		break;
}

?>