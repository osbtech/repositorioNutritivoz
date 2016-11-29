<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function t($txt){
	return (iconv('UTF-8', 'ISO-8859-1',$txt));
}

 
/**
 * Description of Reportes_pdf
 *
 * @author Juan Pablo
 */
class Reportes_pdf extends CI_Controller {

    public function __construct() {
        parent::__construct();
         $this->load->model('pedidos_model');
    }
	
    public function pedidos($idPedido = false){

		// Se carga la libreria fpdf
		$this->load->library('pdf');
		$this->pdf = new Pdf();
		$this->pdf->AliasNbPages(); 	// Define el alias (para el número de página que se imprimirá en el pie)
	 
		/* Se define el titulo, márgenes izquierdo, derecho y
		 * el color de relleno predeterminado
		 */
		$this->pdf->SetTitle("Detalle de pedido");
		$this->pdf->SetLeftMargin(20);
		$this->pdf->SetRightMargin(20);	
		
		if ($idPedido) {
			$listaPedidos = array($this->pedidos_model->getPedidos($idPedido));
		} else {
			$listaPedidos = $this->pedidos_model->getPedidosEstado('CONFIRMADO');
		}
		
		foreach ($listaPedidos as $pedido)
		{
			
			$detallesPedido = $this->pedidos_model->getDetallePedidos($pedido['idPedido']);		
                        
			$this->pdf->AddPage();
                        $this->pdf->Image(base_url().'assets/img/logo.png',70,12,80);
                        $this->pdf->Ln(30);
			
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Cell(15,7,'Pedido #'.$pedido['idPedido']);
			$this->pdf->SetX(-20-20);
			$this->pdf->Cell(20,7,t($pedido['zona']),'',0,'R');
			$this->pdf->Ln(5);
			$this->pdf->SetFont('Arial', '', 9);
			$this->pdf->Cell(100,7,t($pedido['nombre']),'',0,'L',0);
			$this->pdf->Ln(5);
			$this->pdf->Cell(100,7,t($pedido['direccion']));
			$this->pdf->Ln(5);
			$this->pdf->Cell(100,7,t($pedido['aclaracion']),'',0,'L',0);
			$this->pdf->Ln(5);	
			if ($pedido['celular'] != 'N/A') {
				$this->pdf->Cell(100,7,$pedido['celular'],'',0,'L',0);
				$this->pdf->Ln(5);	
			}
			$this->pdf->Ln(5);
			$this->pdf->Cell(15,7,t($pedido['nota']),'',0,'L',0);
			$this->pdf->Ln(12);
			// Se define el formato de fuente: Arial, negritas, tamaño 9
			//$this->pdf->SetFont('Arial', 'B', 9);
			/*
			 * TITULOS DE COLUMNAS
			 *
			 * $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
			 */
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->SetFillColor(0,0,0);
			$this->pdf->SetTextColor(255,255,255);
			$w = array(70, 30, 25, 15, 15, 15) ;
			$a = array('L','C','C','R','R','R');
			$this->pdf->Cell($w[0],7,'Producto','',0,$a[0],'1');
			$this->pdf->Cell($w[1],7,'Marca','',0,$a[1],'1');
			$this->pdf->Cell($w[2],7,'Unidad','',0,$a[2],'1');
			$this->pdf->Cell($w[3],7,'Precio','',0,$a[3],'1');
			$this->pdf->Cell($w[4],7,'Cant.','',0,$a[4],'1');
			$this->pdf->Cell($w[5],7,'Total','',0,$a[5],'1');
			$this->pdf->Ln(8);
			
			$this->pdf->SetTextColor(0,0,0);
			$this->pdf->SetFont('Arial', '', 9);
			
			$row = 1;

			foreach ($detallesPedido as $detalle) {
			  if ($row++ % 2)
				  $this->pdf->SetFillColor(255,255,255); 
			  else
				  $this->pdf->SetFillColor(240,240,240);	  
				 
			  $this->pdf->Cell($w[0],5,t($detalle['nombre']),'',0,$a[0],1);
			  $this->pdf->Cell($w[1],5,t($detalle['marca']),'',0,$a[1],1);
			  $this->pdf->Cell($w[2],5,t($detalle['unidad']),'',0,$a[2],1);
			  if ($detalle['cantidad_entregada'] > 0) {
				  $this->pdf->Cell($w[3],5,$detalle['precio']/$detalle['cantidad'],'',0,$a[3],1);
				  $this->pdf->Cell($w[4],5,$detalle['cantidad_entregada'],'',0,$a[4],1);
				  $this->pdf->Cell($w[5],5,$detalle['precio'],'',0,$a[5],1);			  
			  } else {
				  $this->pdf->Cell($w[3]+$w[4]+$w[5],5,'no disponible','',0,'C',1);
			  }
			  $this->pdf->Ln(5);
			}
			
			$this->pdf->Ln(5);
			if ($pedido['costo_envio'] > 0) {
				$this->pdf->Cell($w[0]+$w[1]+$w[2]+$w[3]+$w[4],5,'Subtotal:','',0,'R',0);
				$this->pdf->Cell($w[5],5,round($pedido['subtotal']),'',0,$a[5],0);		
				$this->pdf->Ln(5);

				$this->pdf->Cell($w[0]+$w[1]+$w[2]+$w[3]+$w[4],5,t('Costo de envío:'),'',0,'R',0);
				$this->pdf->Cell($w[5],5,round($pedido['costo_envio']),'',0,$a[5],0);		
				$this->pdf->Ln(5);
			}
			
			$this->pdf->SetFont('Arial', 'B', 9);
			$this->pdf->Cell($w[0]+$w[1]+$w[2]+$w[3]+$w[4],5,'Total:','',0,'R',0);
			$this->pdf->Cell($w[5],5,round($pedido['total']),'',0,$a[5],0);
		}
		
		/*
		 * Se manda el pdf al navegador
		 *
		 * $this->pdf->Output(nombredelarchivo, destino);
		 *
		 * I = Muestra el pdf en el navegador
		 * D = Envia el pdf para descarga
		 *
		 */
		$this->pdf->Output("Lista de pedidos.pdf", 'I');
    }

    public function armadoPedidos($idProveedor){
		// Se obtienen los alumnos de la base de datos
		$pedidos = $this->pedidos_model->getDetallesPorProveedorCanasta($idProveedor);
		
		if (empty($pedidos)) {
			printf('No hay pedidos');
			return;
		}
		// echo '<pre>';
		// print_r($pedidos);
	
		// Se carga la libreria fpdf
		$this->load->library('pdf');
		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
	 
		$this->pdf->SetTitle("Detalle de pedidos ". $pedidos[0]['proveedor']);
		$this->pdf->SetLeftMargin(20);
		$this->pdf->SetRightMargin(20);

		$tit=array('Producto', 'Marca', 'Unidad', 'Cantidad' );
		$w = array(70, 30, 25, 25) ;
		$a = array('L','C','C','C');		
		$idPedido = 0;
		
		foreach ($pedidos as $p) {
			
			// If we have to start a new order
			if ($idPedido != $p['idPedido']) {

				$idPedido = $p['idPedido'];
				
				$this->pdf->Ln(12);				
				$this->pdf->SetFont('Arial', 'B', 9);
				$this->pdf->Cell(15,7,'Pedido #'.$idPedido);
				$this->pdf->Ln(6);				


				// Order title
				$this->pdf->SetFillColor(0,0,0);
				$this->pdf->SetTextColor(255,255,255);
				for ($i=0; $i<count($tit); $i++) {
					$this->pdf->Cell($w[$i],7,$tit[$i],'',0,$a[$i],'1');
				}

				$this->pdf->Ln(8);				
				$this->pdf->SetFont('Arial', '', 9);
				$this->pdf->SetTextColor(0,0,0);
				
				$row = 1;
			}

			if ($row++ % 2)
				$this->pdf->SetFillColor(255,255,255); 
			else
				$this->pdf->SetFillColor(240,240,240);	  

			$this->pdf->Cell($w[0],5,t($p['nombre']),'',0,$a[0],1);
			$this->pdf->Cell($w[1],5,t($p['marca']),'',0,$a[1],1);
			$this->pdf->Cell($w[2],5,t($p['unidad']),'',0,$a[2],1);
			$this->pdf->Cell($w[3],5,($p['cantidad'] == $c2=round($p['cantidad'])) ? $c2:$p['cantidad'],'',0,$a[3],1);
			
			
			$this->pdf->Ln(5);
			
		}
		
		$this->pdf->Output("Lista de pedidos.pdf", 'I');
    }	
	
	
	public function proveedor($idProveedor){
		// Se obtienen los alumnos de la base de datos
		$pedidos = $this->pedidos_model->getDetallesPorProveedor($idProveedor);
		
		if (empty($pedidos)) {
			printf('No hay pedidos');
			return;
		}
		// echo '<pre>';
		// print_r($pedidos);
	
		// Se carga la libreria fpdf
		$this->load->library('pdf');
		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
	 
		$this->pdf->SetTitle("Pedido a ". $pedidos[0]['proveedor']);
		$this->pdf->SetLeftMargin(20);
		$this->pdf->SetRightMargin(20);

		$tit=array('Producto', 'Marca', 'Unidad', 'Cantidad', 'Importe' );
		$w = array(70, 30, 25, 25, 25) ;
		$a = array('L','C','C','C','R');		

		// Order title
		$this->pdf->SetFont('Arial', 'B', 9);
		$this->pdf->SetFillColor(0,0,0);
		$this->pdf->SetTextColor(255,255,255);
		for ($i=0; $i<count($tit); $i++) {
			$this->pdf->Cell($w[$i],7,$tit[$i],'',0,$a[$i],'1');
		}

		$this->pdf->Ln(8);				
		$this->pdf->SetFont('Arial', '', 9);
		$this->pdf->SetTextColor(0,0,0);
		
		$tot = 0;
		$row = 1;
		
		foreach ($pedidos as $p) {

			if ($row++ % 2)
				$this->pdf->SetFillColor(255,255,255); 
			else
				$this->pdf->SetFillColor(240,240,240);	  

			$this->pdf->Cell($w[0],5,t($p['nombre']),'',0,$a[0],1);
			$this->pdf->Cell($w[1],5,t($p['marca']),'',0,$a[1],1);
			$this->pdf->Cell($w[2],5,t($p['unidad']),'',0,$a[2],1);
			$this->pdf->Cell($w[3],5,($p['cantidadTotal'] == $c2=round($p['cantidadTotal'])) ? $c2:$p['cantidadTotal'],'',0,$a[3],1);
			$this->pdf->Cell($w[4],5,round($p['precio']),'',0,$a[4],1);
			
			$tot += $p['precio'];
			$this->pdf->Ln(5);
			
		}

		// Totalize
		$this->pdf->Ln(5);
		$this->pdf->Cell($w[0]+$w[1]+$w[2]+$w[3],5,'Total:','',0,'R',0);
		$this->pdf->Cell($w[4],5,round($tot),'',0,$a[4],0);		
		$this->pdf->Ln(5);
		
		$this->pdf->Output("Pedido a ". $pedidos[0]['proveedor'].".pdf", 'I');
    
	}
	
	
}
