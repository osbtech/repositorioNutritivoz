/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Ignacio
 * Created: 29/11/2016
 */

ALTER TABLE `nutritivozosb`.`nut_pedidos`   
  ADD COLUMN `idZona` BIGINT(20) NOT NULL AFTER `esquina2`;
<<<<<<< HEAD

UPDATE nut_pedidos SET idZona='1' WHERE TRUE;

ALTER TABLE `nutrutivozosb`.`nut_zona`   
=======
ALTER TABLE `nutritivozosb`.`nut_zona`   
>>>>>>> 9f850145e4f7f0694250a32919a61abb6e3e75f7
  ADD COLUMN `include` VARCHAR(50) NOT NULL AFTER `fechaCierrePedidos`;
ALTER TABLE `nutritivozosb`.`nut_pedidos`   
  ADD COLUMN `idLocalidad` BIGINT(20) NOT NULL AFTER `idZona`;
ALTER TABLE `nutritivozosb`.`nut_pedidos` DROP COLUMN zona;

