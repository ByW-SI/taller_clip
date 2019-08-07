<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use Illuminate\Support\Facades\Schema;

class PruebasController extends Controller
{
    public function index()
    {
        return Empleado::findByText('Raul')->get();
    }
}
