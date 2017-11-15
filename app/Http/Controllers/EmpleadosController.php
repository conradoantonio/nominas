<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empleado;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmpleadosController extends Controller
{
    /**
     * Carga la tabla de empleados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->check()) {
            $title = $menu = "Empleados";
            $empleados = Empleado::where('status', 1)->get();
            foreach ($empleados as $empleado) { $empleado->documentacion; }
            
            if ($request->ajax()) {
                return view('empleados.tabla', ['empleados' => $empleados]);
            }
            return view('empleados.empleados', ['empleados' => $empleados, 'menu' => $menu, 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }
}
