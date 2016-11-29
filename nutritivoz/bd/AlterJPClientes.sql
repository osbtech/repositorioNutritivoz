/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Juan Pablo
 * Created: Nov 29, 2016
 */

alter table `nutrutivozosb`.`nut_clientes` 
   add column `password` varchar(200) NULL after `celular`, 
   add column `fbId` varchar(200) NULL after `password`