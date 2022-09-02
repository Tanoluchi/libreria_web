<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Consulta;
use CodeIgniter\Controller;

class Consultas extends BaseController{
    protected $consultas;
    protected $reglasConsulta;

    public function __construct(){
        helper(['form', 'url']);

        $this->consultas = new Consulta(); 

        $this->reglasConsulta = [
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
        $data['titulo'] = 'Consultas';

        $data['consultas'] = $this->consultas->findAll();

        echo view('front/header', $data);
        echo view('back/consulta/consulta', $data);
        echo view('front/footer');
    }

    public function guardar(){
        $consulta = new Consulta();

        if ($this->validate($this->reglasConsulta)){
            $consulta->save([
                'nombre' => $this->request->getPost('nombre'),
                'email' => $this->request->getPost('email'),
                'mensaje' => $this->request->getPost('mensaje'),
            ]);  

            $session = session();
            $session->setFlashdata('success','Se ha enviado el mensaje correctamente.');

            return redirect()->to(site_url('consulta/'));
        }else {
            $session = session();
            $session->setFlashdata('error','Revise la informacion ingresada');

            return redirect()->back()->withInput();
        }
    }

    public function resuelto($id=null){
        $consulta = new Consulta();

        $consulta->where('id', $id)->set(['resuelto' => 1]);
        $consulta->update();

        return $this->response->redirect(site_url('panelAdmin/consulta/listar'));
    }

    public function pendiente($id=null){
        $consulta = new Consulta();

        $consulta->where('id', $id)->set(['resuelto' => 0]);
        $consulta->update();

        return $this->response->redirect(site_url('panelAdmin/consulta/listar'));
    }

    public function listarConsultas(){
        $data['titulo'] = 'Consultas';

        $consultas = $this->consultas->findAll();
        $data['consultas'] = $consultas;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/consulta/listarConsultas', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function listarResueltos(){
        $data['titulo'] = 'Resueltos';

        $consultas = $this->consultas->where('resuelto', 1)->findAll();
        $data['consultas'] = $consultas;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/consulta/listarConsultas', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }
    
    public function listarPendientes(){
        $data['titulo'] = 'Pendientes';

        $consultas = $this->consultas->where('resuelto', 0)->findAll();
        $data['consultas'] = $consultas;

        echo view('back/panelAdmin/header', $data);
        echo view('back/panelAdmin/consulta/listarConsultas', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }
}