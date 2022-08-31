<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\Usuario;
use App\Models\Rol;
use CodeIgniter\Controller;

class Roles extends BaseController{

	public function __construct(){
        
        helper(['form', 'url']);
    }
}