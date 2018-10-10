<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empleado;
use App\Deduccion;
use App\DeduccionDetalle;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeduccionesController extends Controller
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

        $cantidad = $req->total / $req->num_pagos;

        $row = New Deduccion;

        $row->empleado_id = $req->empleado_id;
        $row->total = $req->total;
        $row->comentarios = $req->comentarios;
        $row->num_pagos = $req->num_pagos;

        $row->save();

        for ($i=0; $i < $req->num_pagos; $i++) { 
            $detail = New DeduccionDetalle;

            $detail->deduccion_id = $row->id;
            $detail->cantidad = $cantidad;
            $detail->status = 0;//Not paid

            $detail->save();
        }

        $url = url($empleado->status == 1 ? 'empleados' : 'empleados/inactivos');

        return response(['msg' => 'Deducción registrada correctamente', 'status' => 'success', 'url' => $url], 200);
    }
}
