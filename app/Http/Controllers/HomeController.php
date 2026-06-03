<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students; // <-- Importante en plural

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Jalamos los alumnos de la tabla
        $students = Students::all();

        // Se los pasamos a la vista
        return view('home', compact('students'));
    }
}