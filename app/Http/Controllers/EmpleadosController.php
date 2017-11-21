<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empleado;
use App\Documentacion;
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
        $title = $menu = "Empleados";
        $empleados = Empleado::where('status', 1)->get();
        foreach ($empleados as $empleado) { $empleado->documentacion; }
        
        if ($request->ajax()) {
            return view('empleados.tabla', ['empleados' => $empleados]);
        }
        return view('empleados.empleados', ['empleados' => $empleados, 'menu' => $menu, 'title' => $title]);
    }

    /**
     * Carga el formulario de empleados.
     *
     * @return \Illuminate\Http\Response
     */
    public function cargar_formulario($id = 0)
    {
        $title = "Formulario de empleados";
        $menu = "Empleados";
        $empleado = null;
        if ($id) {
            $empleado = Empleado::find($id);
            $empleado->documentacion = $empleado->documentacion;
        }

        return view('empleados.formulario', ['empleado' => $empleado, 'menu' => $menu, 'title' => $title]);
    }

    /**
     * Guarda los datos de un empleado.
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $request)
    {
        $empleado = New Empleado;

        $empleado->nombre = $request->nombre;
        $empleado->apellido = $request->apellido;
        $empleado->num_empleado = $request->num_empleado;
        $empleado->domicilio = $request->domicilio;
        $empleado->ciudad = $request->ciudad;
        $empleado->telefono = $request->telefono;
        $empleado->rfc = $request->rfc;
        $empleado->curp = $request->curp;
        $empleado->nss = $request->nss;
        $empleado->telefono_emergencia = $request->telefono_emergencia;

        $empleado->save();

        $documentacion = New Documentacion;
        
        //return response(['msg' => 'Empleado actualizado correctamente', 'status' => 'ok'], 200);
        return response(['msg' => 'Error al actualizar el cliente', 'status' => 'Bad request'], 400);
    }

    /**
     * Actualiza los datos de un empleado.
     *
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request)
    {
        $empleado = Empleado::find($request->id);

        if ($empleado) {
            $empleado->nombre = $request->nombre;
            $empleado->apellido = $request->apellido;
            $empleado->num_empleado = $request->num_empleado;
            $empleado->domicilio = $request->domicilio;
            $empleado->ciudad = $request->ciudad;
            $empleado->telefono = $request->telefono;
            $empleado->rfc = $request->rfc;
            $empleado->curp = $request->curp;
            $empleado->nss = $request->nss;
            $empleado->telefono_emergencia = $request->telefono_emergencia;

            $empleado->save();

            return response(['msg' => 'Empleado actualizado correctamente', 'status' => 'ok'], 200);
        }
        return response(['msg' => 'Error al actualizar el cliente', 'status' => 'Bad request'], 400);
    }
}
