<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\MetodosPago;
use App\Models\FormasEnvio;
use App\Models\Direccion;
use App\Models\DetallesFactura;
use App\Models\Factura;

class Facturas extends BaseController{
    protected $productos, $categorias, $metodosPagos, $formasEnvios, $direccion, $detalles, $facturas, $usuarios;
    protected $reglasConfirmar;

    public function __construct(){
        helper(['form', 'url']);

        $this->productos = new Producto();
        $this->categorias = new Categoria();
        $this->metodosPagos = new MetodosPago();
        $this->formasEnvios = new FormasEnvio();
        $this->direcciones = new Direccion();
        $this->detalles = new DetallesFactura();
        $this->facturas = new Factura();
        $this->usuarios = new Usuario();
    }

    public function guardar(){
        $user_session = session();
        $id = $user_session->id_usuario;
        $factura = new Factura();

        $data = [
            'id_usuario' => $id,
            'id_envio' => $this->request->getPost('id_envio'),
            'id_pago' => $this->request->getPost('id_pago'),
            'importe_total' => $this->request->getPost('total')
            //'fecha' => '2022-06-15 20:30:01'
        ];

        $factura->insert($data);
        $id_factura = $factura->getInsertID();
        $this->crearDetalles($id_factura);

        $session = session();
        $session->setFlashdata('compra','Se ha realizado la compra con exito');

        unset($_SESSION['carrito']['productos']);
        return $this->response->redirect(site_url('carrito/'));
    }
    public function crearDetalles($id_factura){
        $user_session = session();
        $productos = $this->productos->findAll();
        $detallesFactura = new DetallesFactura();
        $carrito = $_SESSION['carrito']['productos'];

        foreach($productos as $producto){
            if (isset($carrito[$producto['id']])){
                $data = [
                    'id_factura' => $id_factura,
                    'id_producto' => $producto['id'],
                    'cantidad' => $carrito[$producto['id']],
                    'subtotal' => $carrito[$producto['id']] * $producto['precio'],
                ];
                
                $detallesFactura->insert($data);
                $restante = $producto['stock'] - $carrito[$producto['id']];
                $this->actualizarStock($producto['id'], $restante);
            }
        }
        return true;
    }

    public function actualizarStock($id=null, $restante=null){
        $producto = $this->productos->where('id', $id)->set(['stock' => $restante]);
        $producto->update();
    }

    public function listarFacturas(){
        $data['titulo'] = 'Facturas';

        $facturas = $this->facturas->findAll();
        $usuario = $this->usuarios->findAll();
        $envio = $this->formasEnvios->findAll();
        $pago = $this->metodosPagos->findAll();

        $data['facturas'] = $facturas;
        $data['usuarios'] = $usuario;
        $data['envios'] = $envio;
        $data['pagos'] = $pago;


        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/factura/listarFacturas', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function detalles($id=null){
        $data['titulo'] = 'Detalles de factura';

        $facturas = $this->facturas->where('id', $id)->first();
        $detallesFactura = $this->detalles->where('id_factura', $id)->findAll();
        $usuario = $this->usuarios->where('id', $facturas['id_usuario'])->first();
        $envio = $this->formasEnvios->where('id', $facturas['id_envio'])->first();
        $pago = $this->metodosPagos->where('id', $facturas['id_pago'])->first();
        $productos = $this->productos->findAll();
        $direccion = $this->direcciones->where('id', $usuario['id_direccion'])->first();

        $data['factura'] = $facturas;
        $data['productos'] = $productos;
        $data['detallesFactura'] = $detallesFactura;
        $data['usuario'] = $usuario;
        $data['direccion'] = $direccion;
        $data['envio'] = $envio;
        $data['pago'] = $pago;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/factura/detallesFactura', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    function mostrarPDF($id=null){
        $data['id_factura'] = $id;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/factura/verPDF', $data);
        echo view('back/panelAdmin/footer');
    }

    function generarFacturaPDF($id=null){
        $response = service('response');
        $facturas = $this->facturas->where('id', $id)->first();
        $detallesFactura = $this->detalles->where('id_factura', $id)->findAll();
        $usuario = $this->usuarios->where('id', $facturas['id_usuario'])->first();
        $envio = $this->formasEnvios->where('id', $facturas['id_envio'])->first();
        $pago = $this->metodosPagos->where('id', $facturas['id_pago'])->first();
        $productos = $this->productos->findAll();
        $direccion = $this->direcciones->where('id', $usuario['id_direccion'])->first();

        $data['factura'] = $facturas;
        $data['productos'] = $productos;
        $data['detallesFactura'] = $detallesFactura;
        $data['usuario'] = $usuario;
        $data['direccion'] = $direccion;
        $data['envio'] = $envio;
        $data['pago'] = $pago;

        $pdf = new \FPDF('P','mm','letter');
        $pdf->AddPage();
        $pdf->SetMargins(10, 10, 10);
        $pdf->SetTitle("Factura");
        $pdf->SetFont('Arial','B', 16);

        $pdf->Cell(195, 5, "Detalles de Factura", 0, 1, 'C');
        $pdf->SetFont('Arial','B', 10);
        $pdf->Ln();

        $pdf->Cell(50, 5, "Mundo Libro S.A.", 0, 1, 'L');
        $pdf->Cell(50, 5, utf8_decode("Dirección: Av. 3 de Abril 3875, Corrientes Capital"), 0, 1, 'L');
        $pdf->Cell(50, 5, "Fecha: ".$facturas['fecha'], 0, 1, 'L');

        $pdf->Ln();

        $pdf->SetFont('Arial','B', 10);
        $pdf->SetFillColor(0, 0, 0);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 5, 'Detalle de productos', 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(20, 5, 'Nro', 1, 0, 'L');
        $pdf->Cell(77, 5, 'Nombre', 1, 0, 'L');
        $pdf->Cell(40, 5, 'Precio', 1, 0, 'L');
        $pdf->Cell(20, 5, 'Cantidad', 1, 0, 'L');
        $pdf->Cell(39, 5, 'Subtotal', 1, 1, 'L');

        $pdf->SetFont('Arial', '', 10);

        $contador = 1;

        foreach ($detallesFactura as $detalle){
            foreach ($productos as $producto){
                if ($detalle['id_producto'] == $producto['id']){
                    $sub = number_format($detalle['subtotal'], 2, '.', ',');
                    $pdf->Cell(20, 5, $contador, 1, 0, 'L');
                    $pdf->Cell(77, 5, utf8_decode($producto['nombre']), 1, 0, 'L');
                    $pdf->Cell(40, 5, '$ ' . $producto['precio'], 1, 0, 'L');
                    $pdf->Cell(20, 5, $detalle['cantidad'], 1, 0, 'L');
                    $pdf->Cell(39, 5, '$ ' . $sub, 1, 1, 'R');
                    $contador++;
                }
            }
        }
        
        $pdf->Cell(20, 5, $contador, 1, 0, 'L');
        $pdf->Cell(77, 5, utf8_decode($envio['nombre']), 1, 0, 'L');
        $pdf->Cell(40, 5, '$ ' . number_format($envio['precio'], 2, '.', ','), 1, 0, 'L');
        $pdf->Cell(20, 5, '1', 1, 0, 'L');
        $pdf->Cell(39, 5, '$ ' . number_format($envio['precio'], 2, '.', ','), 1, 1, 'R');
        

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 10);

        $total = number_format($facturas['importe_total'], 2, '.', ',');

        $pdf->Cell(195, 5, 'Total: $ ' . $total, 0, 1, 'R');

        $response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output("factura_pdf.pdf", "I");
    }
}