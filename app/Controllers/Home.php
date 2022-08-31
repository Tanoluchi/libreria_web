<?php

namespace App\Controllers;
use App\Models\Producto;

class Home extends BaseController
{
    public function inicio()
    {
        $productos = new Producto();

        $data['titulo'] = 'Inicio';
        $data['destacados'] = $productos->where('destacado', 1)->findAll();
        echo view('front/header', $data);
        echo view('front/principal');
        echo view('front/footer');
    }

    public function quienesSomos()
    {
        $data['titulo'] = 'Quienes Somos';
        echo view('front/header', $data);
        echo view('front/quienesSomos');
        echo view('front/footer');
    }

    public function comercializacion(){
        $data['titulo'] = 'Comercialización';
        echo view('front/header', $data);
        echo view('front/comercializacion');
        echo view('front/footer');
    }

    public function terminos(){
        $data['titulo'] = 'Terminos y Condiciones';
        echo view('front/header', $data);
        echo view('front/terminos');
        echo view('front/footer');
    }
}
