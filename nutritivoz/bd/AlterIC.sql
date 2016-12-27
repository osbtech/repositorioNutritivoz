/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Ignacio
 * Created: 29/11/2016
 */

ALTER TABLE `nutrutivozosb`.`nut_pedidos`   
  ADD COLUMN `idZona` BIGINT(20) NOT NULL AFTER `esquina2`;

UPDATE nut_pedidos SET idZona='1' WHERE TRUE;

ALTER TABLE `nutrutivozosb`.`nut_zona`   
  ADD COLUMN `include` VARCHAR(50) NOT NULL AFTER `fechaCierrePedidos`;
