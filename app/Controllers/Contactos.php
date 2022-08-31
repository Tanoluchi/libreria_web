<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Contacto;
use CodeIgniter\Controller;

class Contactos extends BaseController{
    protected $contactos;
    protected $reglasContacto;

	public function __construct(){
        helper(['form', 'url']);

        $this->contactos = new Contacto();

        $this->reglasContacto = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'El campo Email es obligatorio.',
                    'valid_email' => 'Ingresa un email válido.'
                ]
            ],
            'nombre' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Nombre es obligatorio.'
                ]
            ],
            'mensaje' => [
                'rules' => 'required|max_length[400]',
                'errors' => [
                    'required' => 'El campo Mensaje es obligatorio.',
                    'max_length[400]' => 'El mensaje no puede superar los 400 caracteres.',
                ]
            ],
        ];

        
    }

    public function index(){
        $data['titulo'] = 'Contacto';
        echo view('front/header', $data);
        echo view('front/contacto');
        echo view('front/footer');
    }

    public function guardar() {
        $contactos = new Contacto();

        if ($this->validate($this->reglasContacto)){
            $contactos->save([
                'nombre' => $this->request->getPost('nombre'),
                'email' => $this->request->getPost('email'),
                'mensaje' => $this->request->getPost('mensaje'),
            ]);  

            return redirect()->to(site_url('contacto'));
        }else {
            $data['titulo'] = 'Contacto';
            echo view('front/header', $data);
            echo view('front/contacto');
            echo view('front/footer');
        }
    }

    public function resuelto($id=null){
        $contacto = new Contacto();

        $contacto->where('id', $id)->set(['resuelto' => 1]);
        $contacto->update();

        return $this->response->redirect(site_url('panelAdmin/contacto/listar'));
    }

    public function pendiente($id=null){
        $contacto = new Contacto();

        $contacto->where('id', $id)->set(['resuelto' => 0]);
        $contacto->update();

        return $this->response->redirect(site_url('panelAdmin/contacto/listar'));
    }

    public function listarContactos(){
        $data['titulo'] = 'Contactos';

        $contactos = $this->contactos->findAll();
        $data['contactos'] = $contactos;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/contacto/listarContactos', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function listarResueltos(){
        $data['titulo'] = 'Resueltos';

        $contactos = $this->contactos->where('resuelto', 1)->findAll();
        $data['contactos'] = $contactos;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/contacto/listarContactos', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }
    
    public function listarPendientes(){
        $data['titulo'] = 'Pendientes';

        $contactos = $this->contactos->where('resuelto', 0)->findAll();
        $data['contactos'] = $contactos;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/contacto/listarContactos', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }
}