alter table `nutrutivozosb`.`nut_pedidos` 
   change `estado` `estado` enum('INICIADO','CONFIRMADO','PROCESANDO','ENTREGADO','CANCELADO') character set latin1 collate latin1_spanish_ci default 'INICIADO' NULL , 
   change `hash` `hash` varchar(255) character set latin1 collate latin1_spanish_ci NULL 
   
   
   alter table `nutrutivozosb`.`nut_pedidos` 
   add column `esquina1` varchar(255) NULL after `hash`, 
   add column `esquina2` varchar(255) NULL after `esquina1`