 <p> <span class="header-text-1">Envíos a Montevideo y Ciudad de la Costa</span><BR/>
         <span class="header-text-2">Gratis para compras mayores a $ 1000</span>
                        <BR/><BR/>
                        <?php
                        if (isset($_SESSION['zona'])) {
                            $zonaActual = ObtenerZonaAndHorarios($_SESSION['zona']);
                            ?>
                            <span class="header-text-3">Zona</span><BR/>
                            <span class="header-text-2"><?php echo $zonaActual['nombre'] ?></span><BR/>
                            <span class="header-text-3">Precios vigentes hasta el</span><BR/>
                            <span class="header-text-2"><?php echo $zonaActual['fechaProxEntrega'] ?></span><BR/>
                            <span class="header-text-3">Fecha de entrega</span><BR/>
                            <span class="header-text-2"> <?php echo $zonaActual['fechaCierrePedidos'] ?></span>
                            <?php } ?>
                            
                             
                             
							<BR/>