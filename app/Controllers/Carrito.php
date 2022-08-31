<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\MetodosPago;
use App\Models\FormasEnvio;
use App\Models\Direccion;
use CodeIgniter\Controller;


class Carrito extends BaseController{
    protected $productos, $categorias, $metodosPagos, $formasEnvios, $direccion;
    protected $reglasConfirmar;

    public function __construct(){
        helper(['form', 'url']);

        $this->productos = new Producto();
        $this->categorias = new Categoria();
        $this->metodosPagos = new MetodosPago();
        $this->formasEnvios = new FormasEnvio();
        $this->direcciones = new Direccion();

        $this->reglasConfirmar = [
            'localidad' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Localidad es obligatorio.',
                ]
            ],
            'provincia' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Provincia es obligatorio.'
                ]
            ],
            'calle' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo calle es obligatorio.'
                ]
            ],
            'nrocalle' => [
                'rules' => 'max_length[4]|numeric',
                'errors' => [
                    'max_length' => 'La longitud maxima del campo Nro. Calle es de 4 caracteres.',
                    'numeric' => 'El campo Nro. Calle debe ser numerico.'
                ]
            ],
            'codigo' => [
                'rules' => 'required|max_length[5]|numeric',
                'errors' => [
                    'required' => 'El campo Codigo postal es obligatorio.',
                    'max_length' => 'La longitud maxima del campo Codigo postal es de 5 caracteres.',
                    'numeric' => 'El campo Codigo postal debe ser numerico.'
                ]
            ],
            'id_pago' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Metodo de pago es obligatorio.'
                ]
            ],
            'id_envio' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Metodo de envio es obligatorio.'
                ]
            ],
        ];
    }

    public function index(){
        session();
        $data['titulo'] = 'Carrito';
        $data['productos'] = $this->productos->findAll();

        if(isset($_SESSION['carrito']['productos'])){
            $data['carrito'] = $_SESSION['carrito']['productos'];
        }else{
            $data['carrito'] = null;
        }

        echo view('front/header', $data);
        echo view('back/carrito/carrito', $data);
        echo view('front/footer');
    }
    

    public function agregar(){
        $carrito = session();
        if (isset($_POST['id'])){
            $id = $_POST['id'];
            $cantidad = $_POST['cantidad'];
            if (isset($_SESSION['carrito']['productos'][$id])){
                $_SESSION['carrito']['productos'][$id] += $cantidad;
            }else{
                $_SESSION['carrito']['productos'][$id] = $cantidad;
            }
        
            $datos['numero'] = count($_SESSION['carrito']['productos']);
            $datos['ok'] = true;
            
        }else{
            $datos['ok'] = false;
        }
        
        echo json_encode($datos);
    }

    public function actualizar(){
        $carrito = session();
        if (isset($_POST['action'])){
            $action = $_POST['action'];
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            if ($action == 'agregar'){
                $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 0;
                $respuesta = $this->cargar($id, $cantidad);
                if ($respuesta > 0){
                    $datos['ok'] = true;
                }else{  
                    $datos['ok'] = false;
                }
                $datos['sub'] = '$' . number_format($respuesta, 2, '.', ',');
            }else if($action == 'eliminar'){
                $datos['ok'] = $this->eliminar($id);
            }else if($action == 'vaciar'){
                $datos['ok'] = $this->vaciar();
            }else{
                $datos['ok'] = false;
            }
        }else{
            $datos['ok'] = false;
        }

        echo json_encode($datos);
    }

    public function cargar($id, $cantidad){
        $carrito = session();
        $res = $cantidad;
        if($id > 0 && $cantidad > 0){
            // Si existe la id en el carrito
            if(isset($_SESSION['carrito']['productos'][$id])){  
                // Se busca el producto en la base de datos
                $producto = $this->productos->where('id', $id)->first();

                // Se actualiza la cantidad en el carrito
                $_SESSION['carrito']['productos'][$id] = $cantidad;

                $res = $cantidad * $producto['precio'];

                return $res;
            }
        } else{
            return $res;
        }
    }

    public function eliminar($id){
        $carrito = session();
        if ($id > 0){
            if(isset($_SESSION['carrito']['productos'][$id])){  
                unset($_SESSION['carrito']['productos'][$id]);
                return true;
            }
        }else{
            return false;
        }
    }

    public function vaciar(){
        $carrito = session();
        if(isset($_SESSION['carrito']['productos'])){
            unset($_SESSION['carrito']['productos']);
            return true;
        }else{
            return false;
        }
    }

    public function datos(){
        $user_session = session();
        $id = $user_session->id_direccion;
        $data['titulo'] = 'Datos de Envio y Pago';
        $data['productos'] = $this->productos->where('activo', 1)->findAll();
        $data['metodospago'] = $this->metodosPagos->where('activo', 1)->findAll();
        $data['formasenvio'] = $this->formasEnvios->where('activo', 1)->findAll();
        $data['direccion'] = $this->direcciones->where('id', $id)->first();

        echo view('front/header', $data);
        echo view('back/carrito/confirmar', $data);
        echo view('front/footer');
    }

    public function confirmar(){
        // Funcion que va a asignar id_direccion a la sesion del usuario, se va a guardar la información de metodo de pago y de envio. Para posteriormente mostrarla en la vista de finalizar.
        //Si no posee una direccion se crea una nueva. Si ya posee una, se actualiza.
        $user_session = session();
        $id = $user_session->id_direccion;
        $direccion = new Direccion();

        $datos['titulo'] = 'Confirmar compra';
        $datos['productos'] = $this->productos->where('activo', 1)->findAll();
        $datos['carrito'] = $_SESSION['carrito']['productos'];
        $datos['pago'] = $this->metodosPagos->where('id', $this->request->getPost('id_pago'))->first();
        $datos['envio'] = $this->formasEnvios->where('id', $this->request->getPost('id_envio'))->first();

        if ($this->validate($this->reglasConfirmar)){
            $validacion = isset($_SESSION['id_direccion']);
            if (!$validacion){
                $data = [
                    'calle' => $this->request->getPost('calle'),
                    'numero' => $this->request->getPost('nrocalle'),
                    'codigoPostal' => isset($_POST['codigo']) ? $this->request->getPost('codigo') : null,
                    'localidad' => $this->request->getPost('localidad'),
                    'provincia' => $this->request->getPost('provincia'),
                ];

                $direccion->insert($data);
                $id_direccion = $direccion->getInsertID();
                $this->guardarDireccion($id_direccion);

                $datos['direccion'] = $direccion->where('id', $id_direccion)->first();
            }else{
                $datoDireccion = $direccion->where('id', $id)->first();
                if($datoDireccion != null){
                    $datosDireccion = [
                        'calle' => $this->request->getPost('calle'),
                        'numero' => $this->request->getPost('nrocalle'),
                        'codigoPostal' => isset($_POST['codigo']) ? $this->request->getPost('codigo') : null,
                        'localidad' => $this->request->getPost('localidad'),
                        'provincia' => $this->request->getPost('provincia'),
                    ];

                    $direccion->update($id, $datosDireccion);
                    $datos['direccion'] = $direccion->where('id', $id)->first();
                }
            }
            echo view('front/header', $datos);
            echo view('back/carrito/finalizar', $datos);
            echo view('front/footer');
        }else{
            $user_session = session();
            $id = $user_session->id_direccion;
            $data['titulo'] = 'Datos de Envio y Pago';
            $data['productos'] = $this->productos->where('activo', 1)->findAll();
            $data['metodospago'] = $this->metodosPagos->where('activo', 1)->findAll();
            $data['formasenvio'] = $this->formasEnvios->where('activo', 1)->findAll();
            $data['direccion'] = $this->direcciones->where('id', $id)->first();

            echo view('front/header', $data);
            echo view('back/carrito/confirmar', $data);
            echo view('front/footer');
        }
    }

    public function guardarDireccion($id_direccion){
        $user_session = session();
        $_SESSION['id_direccion'] = $id_direccion;
        $id_usuario = $user_session->id_usuario;
        $usuario = new Usuario();

        $dataUsuario = [
            'id_direccion' => $id_direccion,
        ];  

        $usuario->update($id_usuario, $dataUsuario);

        return true;
    }
}