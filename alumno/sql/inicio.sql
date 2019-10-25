-- Sentencias que deberán ser ejecutadas Post-Import de la BD

CREATE TABLE `configuraciones` ( `ultAnio` VARCHAR(100) NOT NULL , `ultMes` VARCHAR(100) NOT NULL COMMENT 'considerar 1=ene,2=feb' , `fechaMaximaUpload` DATE NOT NULL ) ENGINE = InnoDB;
INSERT INTO `configuraciones` (`ultAnio`, `ultMes`, `fechaMaximaUpload`) VALUES ('2019', '9', '2019-10-07');


DELIMITER $$
CREATE PROCEDURE `datosCursoCompleto`(IN `codSeccion` VARCHAR(20))
    NO SQL
SELECT s.Mes_Codigo, i.Idi_Nombre, n.Niv_Detalle, Sec_NroCiclo, Sec_Seccion, hc.Hor_HoraInicio, Hor_HoraSalida, Suc_Direccion FROM `seccion` s
	inner join idioma i on i.Idi_Codigo = s.Idi_Codigo
	inner join nivel n on n.Niv_Codigo = s.Niv_Codigo
	inner join mesacademico ma on ma.Mes_Codigo = s.Mes_Codigo
	inner join horarioclases hc on hc.Hor_Codigo = s.Hor_Codigo
    inner join sucursal su on su.Suc_Codigo = s.Suc_Codigo
	where Sec_Codigo = codSeccion$$
DELIMITER ;


DELIMITER $$
CREATE FUNCTION `proxIdPagos`() RETURNS int(11)
    NO SQL
BEGIN
declare nuevoId int default concat(SUBSTRING(YEAR(CURDATE()), -2),'000001');

SELECT cod_detpag+1 into nuevoId FROM `detallepago`
where Cod_DetPag like concat(SUBSTRING(YEAR(CURDATE()), -2),'%')
order by Cod_DetPag desc
limit 1;



return nuevoId;

END$$
DELIMITER ;


DELIMITER $$
CREATE FUNCTION `returnPensionCurso`(`idioma` VARCHAR(10), `nivel` VARCHAR(10)) RETURNS int(11)
    NO SQL
BEGIN

declare pension int;

select n.nxi_Pension into pension from nivelxidioma n where n.idi_Codigo = idioma and n.Niv_Codigo = nivel;

return pension ;

END$$
DELIMITER ;


DELIMITER $$
CREATE FUNCTION `proxIdAlumno`() RETURNS int(11)
    NO SQL
BEGIN

declare idAlu int;
declare resp int;

SELECT alu_Codigo+1 into idAlu FROM `alumno`
where Alu_Codigo like concat(substr(year(curdate()),-2), '%')
order by Alu_Codigo desc
limit 1;

if idAlu is null then
	set idAlu = concat(substr(year(curdate()),-2), '00001');
end if;

RETURN idAlu;

END$$
DELIMITER ;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `proxSeccion`(`idioma` VARCHAR(10), `nivel` VARCHAR(10), `mes` VARCHAR(10), `anio` VARCHAR(10)) RETURNS varchar(2) CHARSET utf8mb4
    NO SQL
BEGIN

declare secActual varchar(2);
set secActual ='';

SELECT sec_seccion into secActual FROM `seccion` WHERE
Idi_Codigo = idioma and Niv_Codigo = nivel and Mes_Codigo = concat(mes, anio) order by sec_seccion desc
limit 1;

case secActual
when '' then return 'A';
when 'A' then return 'B';
when 'B' then return 'C';
when 'C' then return 'D';
when 'D' then return 'E';
when 'E' then return 'F';
when 'F' then return 'G';
when 'G' then return 'H';
when 'H' then return 'I';
when 'I' then return 'J';
when 'J' then return 'K';
when 'K' then return 'L';
when 'L' then return 'M';
when 'M' then return 'N';
when 'N' then return 'O';
when 'O' then return 'P';
when 'P' then return 'Q';
when 'Q' then return 'R';
when 'R' then return 'S';
when 'S' then return 'T';
when 'T' then return 'U';
when 'U' then return 'V';
when 'V' then return 'W';
when 'W' then return 'X';
when 'X' then return 'Y';
when 'Y' then return 'Z';

else return 'NA';
end case;

END$$
DELIMITER ;




ALTER TABLE `condicionalumno` CHANGE `ValDcto` `ValDcto` FLOAT NULL DEFAULT '0';



DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `calcPagoPension`(`idIdioma` VARCHAR(10), `idNivel` VARCHAR(10), `idDescuento` INT) RETURNS varchar(200) CHARSET utf8mb4
    NO SQL
BEGIN
declare pension float;
declare tipoDescuento varchar(200);
declare valorDescuento float;

SELECT nxi_Pension into pension from nivelxidioma where idi_Codigo =idIdioma and Niv_Codigo= idNivel;

select TipoDcto, ValDcto into tipoDescuento, valorDescuento
from condicionalumno
where idcondicion = idDescuento;

set @pension = pension;

CASE tipoDescuento
	WHEN 'PORCENTAJE' THEN
		SET @pension = @pension - @pension *(valorDescuento/100) ;

	WHEN 'MONTO' THEN
        SET @pension = @pension - valorDescuento ;

	ELSE
        SET @pension = @pension ;
END CASE;

return @pension ;

END$$
DELIMITER ;



CREATE TABLE `situación` ( `idSituacion` INT NOT NULL AUTO_INCREMENT , `sitDescripcion` VARCHAR(250) NOT NULL , PRIMARY KEY (`idSituacion`)) ENGINE = InnoDB;
INSERT INTO `situación` (`idSituacion`, `sitDescripcion`) VALUES
(1, 'En trámite'),
(2, 'Procede'),
(3, 'No procede: Deuda a la fecha'),
(4, 'No procede: Fuera de tiempo ');



ALTER TABLE `usuario` ADD `Suc_Codigo` VARCHAR(6) NOT NULL DEFAULT 'SUC001' AFTER `Rol_Id`;
ALTER TABLE `rol` ADD `rolActivo` INT NOT NULL DEFAULT '0' AFTER `Rol_Descripcion`;

INSERT INTO `rol` (`Rol_Id`, `Rol_Detalle`, `Rol_Descripcion`, `rolActivo`) VALUES ('109', 'Dirección Administrativa', 'Full access', '1'), ('110', 'Sub Dirección Administrativa', 'Semi Access', '1'), ('111', 'Área de registros', 'Sólo permite registrar datos', '1');

ALTER TABLE `usuario` ADD `usuActivo` INT NOT NULL DEFAULT '1' AFTER `Suc_Codigo`;


DELIMITER $$
CREATE FUNCTION `totalAlumnosMes`() RETURNS int(11)
    NO SQL
BEGIN
declare alumnos int default 0;
SELECT count(reg_codigo) into alumnos FROM `seccion` s 
inner join registroalumno ra on ra.Sec_Codigo = s.Sec_Codigo
where Mes_Codigo = date_format( curdate() ,'%m%Y') and ra.reg_codigo like 'SUC%';

return alumnos;

END$$
DELIMITER ;


DELIMITER $$
CREATE FUNCTION `totalCursosMes`() RETURNS int(11)
    NO SQL
BEGIN
declare cursos int default 0;
SELECT count(Sec_Codigo) into cursos  FROM `seccion`
where Mes_Codigo = date_format( curdate() ,'%m%Y') and Sec_Codigo like 'SUC%';

return cursos;

END$$
DELIMITER ;

DELIMITER $$
CREATE FUNCTION `totalReservaMes`() RETURNS int(11)
    NO SQL
BEGIN
declare reservas int default 0;
SELECT count(reg_codigo) into reservas  FROM `seccion` s 
inner join registroalumno ra on ra.Sec_Codigo = s.Sec_Codigo
where Mes_Codigo = date_format( curdate() ,'%m%Y') and ra.reg_codigo like 'RESERVA%';

return reservas;

END$$
DELIMITER ;



DELIMITER $$
CREATE FUNCTION `proxIdDocente`(`apellido` VARCHAR(200), `nombre` VARCHAR(200)) RETURNS varchar(10) CHARSET utf8mb4
    NO SQL
BEGIN
declare codigo varchar(10);
declare temp varchar(10) default 1;


select upper(concat(date_format(curdate(),'%y'), substr(apellido, 1, 1), substr(nombre, 1, 1))) into codigo;

select count(Emp_Codigo)+1 into temp from empleado e where e.Emp_Codigo like concat(codigo,'%');

return concat( codigo ,LPAD(temp, 2, '0')) ;

END$$
DELIMITER ;


ALTER TABLE `configuraciones` ADD `idConfiguraciones` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`idConfiguraciones`);