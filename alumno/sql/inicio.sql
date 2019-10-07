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