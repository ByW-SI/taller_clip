<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use Illuminate\Support\Facades\Schema;
use App\User;
use Illuminate\Support\Facades\Auth;

class PruebasController extends Controller
{
    public function index()
    {
        return Auth::user()->perfil->modulos;
    }
}
