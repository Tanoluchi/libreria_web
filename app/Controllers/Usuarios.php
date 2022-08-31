<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Usuario;
use App\Models\Rol;
use CodeIgniter\Controller;


class Usuarios extends BaseController{
    protected $usuarios, $roles;
    protected $reglasLogin;
    protected $reglasRegistro;
    protected $reglasModificar;

	public function __construct(){
        $this->usuarios = new Usuario();
        $this->roles = new Rol();
        
        helper(['form', 'url']);

        $this->reglasRegistro = [
            'email' => [
                'rules' => 'required|valid_email|max_length[80]',
                'errors' => [
                    'required' => 'El campo Email es obligatorio.',
                    'valid_email' => 'Ingresa un email válido.',
                    'max_length' => 'El campo Email debe tener máximo 80 caracteres.'
                ]
            ],
            'nombre' => [
                'rules' => 'required|min_length[3]|max_length[60]',
                'errors' => [
                    'required' => 'El campo Nombre es obligatorio.',
                    'min_length' => 'El campo Nombre debe tener al menos 3 caracteres.',
                    'max_length' => 'El campo Nombre debe tener máximo 60 caracteres.'
                ]
            ],
            'apellido' => [
                'rules' => 'required|min_length[3]|max_length[60]',
                'errors' => [
                    'required' => 'El campo Apellido es obligatorio.',
                    'min_length' => 'El campo Apellido debe tener al menos 3 caracteres.',
                    'max_length' => 'El campo Apellido debe tener máximo 60 caracteres.'
                ]
            ],
            'dni' => [
                'rules' => 'required|min_length[8]|max_length[8]',
                'errors' => [
                    'required' => 'El campo DNI es obligatorio.',
                    'min_length' => 'El campo DNI debe tener al menos 8 caracteres.',
                    'max_length' => 'El campo DNI debe tener máximo 8 caracteres.'
                ]
            ],
            'telefono' => [
                'rules' => 'required|min_length[10]|max_length[12]',
                'errors' => [
                    'required' => 'El campo Telefono es obligatorio.',
                    'min_length' => 'El campo Telefono debe tener al menos 10 caracteres.',
                    'max_length' => 'El campo Telefono debe tener máximo 12 caracteres.'
                ]
            ],
            'password1' => [
                'rules' => 'required|min_length[8]|max_length[60]',
                'errors' => [
                    'required' => 'El campo Contraseña es obligatorio.',
                    'min_length' => 'El campo Contraseña debe tener al menos 8 caracteres.',
                    'max_length' => 'El campo Contraseña debe tener máximo 60 caracteres.'
                ]
            ],
            'password2' => [
                'rules' => 'required|min_length[8]|max_length[60]|matches[password1]',
                'errors' => [
                    'required' => 'El campo Confirmar Contraseña es obligatorio.',
                    'min_length' => 'El campo Confirmar Contraseña debe tener al menos 8 caracteres.',
                    'max_length' => 'El campo Confirmar Contraseña debe tener máximo 60 caracteres.',
                    'matches[password1]' => 'Las contraseñas no coinciden.'
                ]
            ],
        ];


        $this->reglasLogin = [
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'El campo Email es obligatorio.',
                    'valid_email' => 'Ingresa un email válido.'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo Contraseña es obligatorio.'
                ]
            ],
        ];

        $this->reglasModificar = [
            'email' => [
                'rules' => 'required|valid_email|max_length[80]',
                'errors' => [
                    'required' => 'El campo Email es obligatorio.',
                    'valid_email' => 'Ingresa un email válido.',
                    'max_length' => 'El campo Email debe tener máximo 80 caracteres.'
                ]
            ],
            'nombre' => [
                'rules' => 'required|min_length[3]|max_length[60]',
                'errors' => [
                    'required' => 'El campo Nombre es obligatorio.',
                    'min_length' => 'El campo Nombre debe tener al menos 3 caracteres.',
                    'max_length' => 'El campo Nombre debe tener máximo 60 caracteres.'
                ]
            ],
            'apellido' => [
                'rules' => 'required|min_length[3]|max_length[60]',
                'errors' => [
                    'required' => 'El campo Apellido es obligatorio.',
                    'min_length' => 'El campo Apellido debe tener al menos 3 caracteres.',
                    'max_length' => 'El campo Apellido debe tener máximo 60 caracteres.'
                ]
            ],
            'dni' => [
                'rules' => 'required|min_length[8]|max_length[8]',
                'errors' => [
                    'required' => 'El campo DNI es obligatorio.',
                    'min_length' => 'El campo DNI debe tener al menos 8 caracteres.',
                    'max_length' => 'El campo DNI debe tener máximo 8 caracteres.'
                ]
            ],
            'telefono' => [
                'rules' => 'required|min_length[10]|max_length[12]',
                'errors' => [
                    'required' => 'El campo Telefono es obligatorio.',
                    'min_length' => 'El campo Telefono debe tener al menos 10 caracteres.',
                    'max_length' => 'El campo Telefono debe tener máximo 12 caracteres.'
                ]
            ],
        ];
	}

    public function listar() {
        $data['titulo'] = 'Usuarios';

        $usuario = new Usuario();
        $data['usuarios'] = $usuario->orderBy('id', 'DESC')->findAll();

        echo view('back/panelAdmin/header', $data);
        echo view('back/usuario/listar', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function activos() {
        $data['titulo'] = 'Usuarios activos';

        $usuario = new Usuario();
        $data['usuarios'] = $usuario->where('activo', 1)->orderBy('id', 'DESC')->findAll();

        echo view('back/panelAdmin/header', $data);
        echo view('back/usuario/listar', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function eliminados(){
        $data['titulo'] = 'Usuarios eliminados';

        $usuario = new Usuario();
        $data['usuarios'] = $usuario->where('activo', 0)->orderBy('id', 'DESC')->findAll();

        echo view('back/panelAdmin/header', $data);
        echo view('back/usuario/listar', $data);//vista del formulario
        echo view('back/panelAdmin/footer');
    }

    public function registrar() {
        $data['titulo'] = 'Crear cuenta';
        echo view('front/header', $data);
        echo view('back/usuario/registrar');//vista del formulario
        echo view('front/footer');
    }

    public function guardar() {
        $usuario = new Usuario();

        if ($this->validate($this->reglasRegistro)) {
            $usuario->save([
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'dni' => $this->request->getVar('dni'),
                'telefono' => $this->request->getVar('telefono'),
                'email' => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password1'), PASSWORD_DEFAULT),
            ]);  

            $session = session();
            $session->setFlashdata('registro','Se ha registrado con exito!');

            return redirect()->to(site_url('usuarios/login'));
        }else {
            $session = session();
            $session->setFlashdata('error','Ha ocurrido un error, revise la informacion ingresada');

            $_POST = isset($_POST) ? $_POST : [];
            $data['titulo'] = 'Crear cuenta';
            echo view('front/header', $data);
            echo view('back/usuario/registrar', $_POST); //vista del formulario
            echo view('front/footer');
        }
    }

    public function eliminar($id=null) {
        $usuario = new Usuario();

        $usuario->where('id', $id)->set(['activo' => 0]);
        $usuario->update();

        return $this->response->redirect(site_url('usuarios/listar'));
    }

    public function activar($id=null) {
        $usuario = new Usuario();

        $usuario->where('id', $id)->set(['activo' => 1]);
        $usuario->update();

        return $this->response->redirect(site_url('usuarios/listar'));
    }

    public function editar($id=null){
        $_SESSION['titulo'] = 'Editar Usuario';
        $usuarios = $this->usuarios->where('id', $id)->first();
        $roles = $this->roles->where('activo', 1)->findAll();

        $data['usuarios'] = $usuarios;
        $data['roles'] = $roles;
        
        echo view('front/header', $_SESSION);
        echo view('back/usuario/editar', $data); //vista del formulario
        echo view('front/footer');        
    }

    public function actualizar(){
        $usuario = new Usuario();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email' => $this->request->getPost('email'),
            'usuario' => $this->request->getPost('usuario'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        //
        
        $id = $this->request->getPost('id');

        if($this->validate($this->reglasModificar)){
            $usuario->update($id, $data);
            $datoUsuario = $this->usuarios->where('email', $data['email'])->first();
            $datosSesion = [
                'id_usuario' => $datoUsuario['id'],
                'nombre' => $datoUsuario['nombre'],
                'apellido' => $datoUsuario['apellido'],
                'email' => $datoUsuario['email'],
                'telefono' => $datoUsuario['telefono'],
                'id_rol' => $datoUsuario['id_rol'],
                'id_direccion' => $datoUsuario['id_direccion'],
            ];
            
            $session = session();
            $session->set($datosSesion);
            $session->setFlashdata('modificar','Se ha modificado los datos con exito!');

            return $this->response->redirect(site_url('/'));
        }else{
            $session = session();
            $session->setFlashdata('error','Ha ocurrido un error, revise la informacion ingresada');

            return redirect()->back()->withInput();
            
            // return $this->response->redirect(site_url('/listar'));
        }
    }

    public function login(){ # Vista de la pagina de inicio de sesion
        $_SESSION['titulo'] = 'Iniciar Sesión';
        echo view('front/header', $_SESSION);
        echo view('back/usuario/login');
        echo view('front/footer');
    }

    public function validar_cuenta(){ # Envio de formulario para iniciar sesion
        if ($this->validate($this->reglasLogin)){
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $datoUsuario = $this->usuarios->where('email', $email)->first();

            if ($datoUsuario != null && $datoUsuario['activo'] != 0){
                if (password_verify($password, $datoUsuario['password'])){
                    $datosSesion = [
                        'id_usuario' => $datoUsuario['id'],
                        'nombre' => $datoUsuario['nombre'],
                        'apellido' => $datoUsuario['apellido'],
                        'email' => $datoUsuario['email'],
                        'telefono' => $datoUsuario['telefono'],
                        'id_rol' => $datoUsuario['id_rol'],
                        'id_direccion' => $datoUsuario['id_direccion'],
                    ];

                    $carrito = [
                        'carrito' => ['productos' => [],],
                        'total' => 0,
                    ];

                    $session = session();
                    $session->setFlashdata('login','Se ha logeado con exito!');
                    $session->set($datosSesion);
                    $session->set($carrito);

                    return redirect()->to(site_url('/'));
                } else {
                    $data['error'] = 'Las contraseñas no coinciden';
                    echo view('front/header');
                    echo view('back/usuario/login', $data);
                    echo view('front/footer');
                }
            } else {
                $data['error'] = 'El email no existe';
                echo view('front/header');
                echo view('back/usuario/login', $data);
                echo view('front/footer');
            }
        } else {
            $_SESSION['titulo'] = 'Iniciar Sesión';
            echo view('front/header', $_SESSION);
            echo view('back/usuario/login');
            echo view('front/footer');
        }
    }

    public function cerrar_sesion(){
        $session = session();
        $session->destroy();

        return redirect()->to(site_url('/'));
    }
}