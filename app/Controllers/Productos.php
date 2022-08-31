<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Producto;
use App\Models\Categoria;
use CodeIgniter\Controller;


class Productos extends BaseController{
    protected $productos, $categorias;
    protected $reglasModificar;

    public function __construct(){
        helper(['form', 'url']);

        $this->productos = new Producto();
        $this->categorias = new Categoria();

        $this->reglasModificar = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Nombre es obligatorio.',
                ]
            ],
            'autor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Contraseña es obligatorio.'
                ]
            ],
            'id_categoria' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Se debe de seleccionar una categoria.'
                ]
            ],
            'precio' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'El campo Precio es obligatorio.',
                    'numeric' => 'El campo precio debe ser un numero'
                ]
            ],
            'stock' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'El campo Stock es obligatorio.',
                    'numeric' => 'El campo Stock debe ser un numero'
                ]
            ],
        ];
    }

    public function index(){
        $data['titulo'] = 'Catálogo de productos';

        $productos = new Producto();
        $categorias = new Categoria();

        $array = ['stock >' => 0, 'activo !=' => 0];

        $data['categorias'] = $categorias->findAll();

        $data['productos'] = $productos->orderBy('id', 'ASC')->where($array)->findAll();
        
        echo view('front/header', $data);
        echo view('back/producto/catalogo', $data);//vista del formulario
        echo view('front/footer');
    }

    public function eliminar($id=null){
        $producto = new Producto();
        $producto = $producto->where('id', $id)->set(['activo' => 0]);
        $producto->update();

        return $this->response->redirect(site_url('panelAdmin/producto/listar'));
    }
    
    public function activar($id=null){
        $producto = new Producto();
        $producto = $producto->where('id', $id)->set(['activo' => 1]);
        $producto->update();

        return $this->response->redirect(site_url('panelAdmin/producto/listar'));
    }

    public function destacar($id=null){
        $producto = new Producto();

        $producto->where('id', $id)->set(['destacado' => 1]);
        $producto->update();

        return $this->response->redirect(site_url('panelAdmin/producto/listar'));
    }

    public function quitar($id=null){
        $producto = new Producto();

        $producto->where('id', $id)->set(['destacado' => 0]);
        $producto->update();

        return $this->response->redirect(site_url('panelAdmin/producto/listar'));
    }

    public function modificar($id=null){
        $_SESSION['titulo'] = 'Editar Producto';
        $producto = $this->productos->where('id', $id)->first();
        $categorias = $this->categorias->findAll();

        $data['producto'] = $producto;
        $data['categorias'] = $categorias;
        
        echo view('back/panelAdmin/header', $_SESSION);
        echo view('back/panelAdmin/producto/modificar', $data); //vista del formulario
        echo view('back/panelAdmin/footer');      
    }

    public function actualizar(){
        $productos = new Producto();
        $destacado = $this->request->getPost('destacado');
        $imagen = $this->request->getPost('imagen');
        $id = $this->request->getPost('id');

        if ($destacado == "SI"){
            $destacado = 1;
        }else {
            $destacado = 0;
        }

        if (isset($_FILES['imagen'])) {
            $file = $_FILES['imagen'];
            $fileName = $file['name'];
            if ($fileName != ''){
                $fileTmpName = $file['tmp_name'];
                $fileSize = $file['size'];
                $carpeta = 'public/assets/img/libros/';

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));

                $allowed = array('jpg', 'jpeg', 'png');

                if (in_array($fileActualExt, $allowed)) {
                    if ($fileSize > 3 * 1024 * 1024) {
                        echo 'El archivo es muy grande';
                    }else{
                        $src = $carpeta.$fileName;
                        move_uploaded_file($fileTmpName, $src);
                        $imagen = $carpeta.$fileName;
                    }
                } else {
                    echo "El archivo no es una imagen";
                }
            } else {
                $producto = $this->productos->where('id', $id)->first();
                $imagen = $producto['imagen'];
            }
        } 
        
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'autor' => $this->request->getPost('autor'),
            'id_categoria' => $this->request->getPost('id_categoria'),
            'precio' => $this->request->getPost('precio'),
            'stock' => $this->request->getPost('stock'),
            'imagen' => $imagen,
            'descripcion' => $this->request->getPost('descripcion'),
            'destacado' => $destacado,
        ];
        
        if($this->validate($this->reglasModificar)){
            $productos->update($id, $data);

            return $this->response->redirect(site_url('panelAdmin/producto/listar'));
        }else{
            $session = session();
            $session->setFlashdata('mensaje','Revise la informacion');

            return redirect()->back()->withInput();
        }
    }

    public function buscar(){
        $busqueda = $this->request->getVar('buscar');
        $data['titulo'] = 'Resultados de la busqueda';

        $productos = new Producto();
        $categorias = new Categoria();

        $data['categorias'] = $categorias->findAll();
        $data['productos'] = $productos->like('nombre', $busqueda)->findAll();

        echo view('front/header', $data);
        echo view('back/producto/catalogo', $data);//vista del formulario
        echo view('front/footer');
    }

    public function buscarCategoria($id_categoria=null){
        $data['titulo'] = 'Catalogo de productos';

        $productos = new Producto();
        $categorias = new Categoria();

        $data['categorias'] = $categorias->findAll();
        $array = ['id_categoria' => $id_categoria, 'stock >' => 0, 'activo !=' => 0];
        $data['productos'] = $productos->where($array)->findAll();
        
        echo view('front/header', $data);
        echo view('back/producto/catalogo', $data);//vista del formulario
        echo view('front/footer');
    }

    public function detalles($id=null){
        $producto = $this->productos->where('id', $id)->first();
        $id_categoria = $producto['id_categoria'];

        $categorias = $this->categorias->where('id', $id_categoria)->first();
        $data['titulo'] = $producto['nombre'];
        $data['producto'] = $producto;
        $data['categorias'] = $categorias;
        
        echo view('front/header', $data);
        echo view('back/producto/detalles', $data); //vista del formulario
        echo view('front/footer');      
    }
}