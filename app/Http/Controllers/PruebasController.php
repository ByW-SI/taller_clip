<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use Illuminate\Support\Facades\Schema;
use App\User;

class PruebasController extends Controller
{
    public function index()
    {
        return User::find(12)->findByText('cas')->get();
    }
}
