ALTER TABLE `r05_seleccion_previa_aretes`
	ADD COLUMN `r02_arete_azul` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Arete Azul' AFTER `r02_id`;
ALTER TABLE `r02_aretes`
	ADD COLUMN `r02_arete_azul` VARCHAR(50) NULL DEFAULT NULL COMMENT 'Arete Azul' AFTER `r02_fechaPendiente`;