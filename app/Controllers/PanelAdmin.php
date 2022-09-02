<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Categoria;
use App\Models\Producto;
use CodeIgniter\Controller;


class PanelAdmin extends BaseController{
    protected $productos, $categorias;
    protected $reglasAgregar;
    protected $reglasRegistro;
    protected $reglasModificar;
    

    public function __construct(){
        helper(['form', 'url']);
        
        $this->productos = new Producto();
        $this->categorias = new Categoria();

        $this->reglasAgregar = [
            'nombre' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
                    'max_length' => 'El campo {field} debe tener como maximo {param} caracteres'
                ]
            ],
            'autor' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
                    'max_length' => 'El campo {field} debe tener como maximo {param} caracteres'
                ]
            ],
            'id_categoria' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio'
                ]
            ],
            'precio' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'numeric' => 'El campo {field} debe ser un numero'
                ]
            ],
            'stock' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio',
                    'numeric' => 'El campo {field} debe ser un numero'
                ]
            ],
        ];
    }

    public function index(){
        $data['titulo'] = "Panel de Administracion";

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/footer');
    }

    public function listarProductos(){
        $data['titulo'] = 'Productos';

        $productos = $this->productos->where('activo', 1)->orderBy('id', 'DESC')->findAll();
        $categorias = $this->categorias->findAll();
        $data['productos'] = $productos;
        $data['categorias'] = $categorias;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/producto/listarProductos', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function listarDestacados(){
        $data['titulo'] = 'Productos destacados';

        $productos = $this->productos->where('destacado', 1)->orderBy('id', 'DESC')->findAll();
        $categorias = $this->categorias->findAll();
        $data['productos'] = $productos;
        $data['categorias'] = $categorias;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/producto/listarDestacados', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function listarEliminados(){
        $data['titulo'] = 'Productos eliminados';

        $productos = $this->productos->where('activo', 0)->orderBy('id', 'DESC')->findAll();
        $categorias = $this->categorias->findAll();
        $data['productos'] = $productos;
        $data['categorias'] = $categorias;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/producto/listarEliminados', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function agregar(){
        $data['titulo'] = 'Agregar Producto';

        $categorias = $this->categorias->where('activo', 1)->findAll();
        $data['categorias'] = $categorias;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/producto/agregar', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function guardar(){
        $productos = new Producto();
        $imagen = '';

        if (isset($_FILES['imagen'])) {
            $file = $_FILES['imagen'];
            $fileName = $file['name'];
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
        }
        
        if ($this->validate($this->reglasAgregar)) {
            $productos->save([
                'id_categoria' => $this->request->getPost('id_categoria'),
                'nombre' => $this->request->getPost('nombre'),
                'autor' => $this->request->getPost('autor'),
                'descripcion' => $this->request->getPost('descripcion'),
                'precio' => $this->request->getPost('precio'),
                'stock' => $this->request->getPost('stock'),
                'imagen' => $imagen
            ]);

            $session = session();
            $session->setFlashdata('success','Se ha agregado el producto correctamente');

            return redirect()->to(site_url('panelAdmin/producto/listar'));
        }else {
            $session = session();
            $session->setFlashdata('error','Revise la informacion ingresada');

            return redirect()->back()->withInput();
        }
    }
}