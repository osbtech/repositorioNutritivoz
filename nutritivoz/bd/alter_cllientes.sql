/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Juan Pablo
 * Created: Dec 1, 2016
 */

alter table `nut_clientes` 
   add column `idZona` bigint(20) NULL after `fbId`, 
   add column `idLocalidad` bigint(20) NULL after `idZona`, 
   add column `direccion` varchar(100) NULL after `idLocalidad`, 
   add column `direccion_aclaracion` varchar(500) NULL after `direccion`, 
   add column `esquina1` varchar(250) NULL after `direccion_aclaracion`, 
   add column `esquina2` varchar(250) NULL after `esquina1`