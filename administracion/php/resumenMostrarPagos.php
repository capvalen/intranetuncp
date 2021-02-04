<table class="table table-hover">
		<thead>
			<tr>
				<th>Tipo de pago</th>
				<th class="d-none">Cuota</th>
				<th>Característica</th>
				<th>Paga</th>
				<th>Recibo</th>
				<th>Fecha</th>
				<th>Usuario</th>
				<th>Obs. Extra</th>
				<th class="d-none">Estado</th>
			</tr>
		</thead>
		<tbody>
<?php
include 'conexionInfocat.php';

$sql="SELECT `nxi_Pension`, `nxi_Matricula` FROM `nivelxidioma` WHERE `idi_Codigo`='{$_POST['idioma']}' and Niv_Codigo='{$_POST['nivel']}';";
//echo $sql;
$resultado=$cadena->query($sql);
$row=$resultado->fetch_assoc();
	?> 
	<tr>
		<td>
			<div class="checkbox checkbox-primary">
				<input id="chkMatricula" class="styled" type="checkbox" >
				<label for="chkMatricula">
						<strong>1. </strong> Matrícula
				</label>
			</div>
		</td>
		<td class="d-none" id="tdMatricula" data-costo="<?= $row['nxi_Matricula']; ?>">S/ <?= $row['nxi_Matricula']; ?></td>
		<td class="tdSecundario">
			<select name="" id="" class="form-control sltTipoMatriculaDebe">
				<?php include 'OPT_tipoMatricula.php'; ?>
			</select>
		</td>
		<td class="tdSecundario"><input type="number" class="form-control esMoneda txtCantidadPagaDebe" value="0.00"></td>
		<td class="tdSecundario"><input type="text" class="form-control txtReciboDebe text-capitalize text-capitalize" value="" autocomplete="nope"></td>
		<td class="tdSecundario"><input type="date" class="form-control txtFechaDebe" value="<?= date('Y-m-d');?>"></td>
		<td class="tdSecundario" class="tdUser"></td>
		<td class="tdSecundario"><input type="text" class="form-control txtObservacion" value="" autocomlete="nope"></td>
		<td class="tdDebe d-none"></td>
	</tr>
	<tr>
		<td>
			<div class="checkbox checkbox-primary">
				<input id="chkPension" class="styled" type="checkbox" >
				<label for="chkPension"><strong>2. </strong> Pensión</label>
			</div>
		</td>
		<td class="d-none" id="tdPension" data-costo="<?= $row['nxi_Pension']; ?>">S/ <?= $row['nxi_Pension']; ?></td>
		<td class="tdSecundario">
			<select name="" id="" class="form-control sltTipoMatriculaDebe">
				<?php include 'OPT_tipoMatricula.php'; ?>
			</select>
		</td>
		<td class="tdSecundario"><input type="number" class="form-control esMoneda txtCantidadPagaDebe" value="0.00"></td>
		<td class="tdSecundario"><input type="text" class="form-control txtReciboDebe text-capitalize text-capitalize" value="" autocomplete="nope"></td>
		<td class="tdSecundario"><input type="date" class="form-control txtFechaDebe" value="<?= date('Y-m-d');?>"></td>
		<td class="tdSecundario tdUser"></td>
		<td class="tdSecundario"><input type="text" class="form-control txtObservacion" value="" autocomlete="nope"></td>
		<td class="tdDebe d-none"></td>
	</tr>
	<tr>
		<td>
			<div class="checkbox checkbox-primary">
				<input id="chkOtros" class="styled" type="checkbox" >
				<label for="chkOtros"><strong>3. </strong> Extra</label>
			</div>
		</td>
		<td class="d-none" id="tdPension" data-costo="<?= $row['nxi_Pension']; ?>">S/ <?= $row['nxi_Pension']; ?></td>
		<td class="tdSecundario">
			<select name="" id="sltPagoOtro" class="form-control sltTipoMatriculaDebe">
				<option value="1">Ubicación</option>
				<option value="2">Reubicación</option>
				<option value="3">Otro</option>
			</select>
		</td>
		<td class="tdSecundario"><input type="number" class="form-control esMoneda txtCantidadPagaDebe" value="0.00"></td>
		<td class="tdSecundario"><input type="text" class="form-control txtReciboDebe text-capitalize text-capitalize" value="" autocomplete="nope"></td>
		<td class="tdSecundario"><input type="date" class="form-control txtFechaDebe" value="<?= date('Y-m-d');?>"></td>
		<td class="tdSecundario tdUser"></td>
		<td class="tdSecundario"><input type="text" class="form-control txtObservacion" value="" autocomlete="nope"></td>
		<td class="tdDebe d-none"></td>
	</tr>
	<?php

?>
	</tbody>
	</table>
