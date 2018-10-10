<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empleado;
use App\Retencion;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RetencionesController extends Controller
{
    /**
     * Guarda los registros de deducciones
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar(Request $req)
    {
        $empleado = Empleado::find($req->empleado_id);
        if ( !$empleado ) { return response(['msg' => 'ID de empleado inválido, trate nuevamente', 'status' => 'error'], 404); }

        $row = New Retencion;

        $row->empleado_id = $req->empleado_id;
        $row->empresa_id = $req->empresa_id;
        $row->importe = $req->importe;
        $row->empresa_id = $req->empresa_id;
        $row->fecha_inicio = $req->fecha_inicio;
        $row->fecha_fin = $req->fecha_fin;
        $row->num_dias = $req->num_dias;
        $row->comentarios = $req->comentarios;

        $row->save();

        $url = url($empleado->status == 1 ? 'empleados' : 'empleados/inactivos');

        return response(['msg' => 'Deducción registrada correctamente', 'status' => 'success', 'url' => $url], 200);
    }
}
