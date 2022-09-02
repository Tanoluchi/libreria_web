<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Categoria;
use CodeIgniter\Controller;

class Categorias extends BaseController{
    protected $categorias;
    protected $reglasModificar;

    public function __construct(){
        helper(['form', 'url']);

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
            'descripcion' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'El campo Descripcion es obligatorio.',
                    'min_length' => 'El campo {field} debe tener al menos {param} caracteres',
                    'max_length' => 'El campo {field} debe tener como maximo {param} caracteres'
                ]
            ],
        ];

        $this->reglasModificar = [
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Nombre es obligatorio.',
                ]
            ],
            'descripcion' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Descripcion es obligatorio.'
                ]
            ],
        ];
    }

    public function listar(){
        $_SESSION['titulo'] = 'Categorias';

        $categorias = $this->categorias->where('activo', 1)->orderBy('id', 'DESC')->findAll();

        $data['categorias'] = $categorias;
        
        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/categoria/listarCategorias', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function eliminados(){
        $_SESSION['titulo'] = 'Categorias eliminadas';

        $categorias = $this->categorias->where('activo', 0)->orderBy('id', 'DESC')->findAll();

        $data['categorias'] = $categorias;
        
        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/categoria/listarEliminados', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function modificar($id=null){
        $_SESSION['titulo'] = 'Editar Categoria';
        $categoria = $this->categorias->where('id', $id)->first();

        $data['categoria'] = $categoria;
        
        echo view('back/panelAdmin/header', $_SESSION);
        echo view('back/panelAdmin/categoria/modificar', $data); //vista del formulario
        echo view('back/panelAdmin/footer');      
    }

    public function actualizar(){
        $categoria = new Categoria();
        $id = $this->request->getPost('id');
        
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];
        
        if($this->validate($this->reglasModificar)){
            $categoria->update($id, $data);

            $session = session();
            $session->setFlashdata('success','Se ha modificado la categoria correctamente');

            return $this->response->redirect(site_url('panelAdmin/categoria/listar'));
        }else{
            $session = session();
            $session->setFlashdata('error','Revise la informacion ingresada');

            return redirect()->back()->withInput();
        }
    }

    public function eliminar($id=null){
        $categoria = new Categoria();
        $categoria = $categoria->where('id', $id)->set(['activo' => 0]);
        $categoria->update();

        $session = session();
        $session->setFlashdata('success','Se ha eliminado la categoria correctamente');

        return $this->response->redirect(site_url('panelAdmin/categoria/listar'));
    }

    public function activar($id=null){
        $categoria = new Categoria();
        $categoria = $categoria->where('id', $id)->set(['activo' => 1]);
        $categoria->update();

        $session = session();
        $session->setFlashdata('success','Se ha activado la categoria correctamente');

        return $this->response->redirect(site_url('panelAdmin/categoria/listar'));
    }

    public function agregar(){
        $data['titulo'] = 'Agregar Categoria';

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/categoria/agregar');//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function guardar(){
        $categorias = new Categoria();
        
        if ($this->validate($this->reglasAgregar)) {
            $categorias->save([
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
            ]);  

            $session = session();
            $session->setFlashdata('success','Se ha creado la categoria correctamente');

            return redirect()->to(site_url('panelAdmin/categoria/listar'));
        }else {
            $session = session();
            $session->setFlashdata('error','Revise la informacion ingresada');

            return redirect()->back()->withInput();
        }
    }
}