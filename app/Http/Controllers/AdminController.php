<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra el Dashboard del administrador.
     */
    public function index()
    {
        return view('backend.admin.dashboard');
    }
}