<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Excel;

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

    /**
     * Exporta el excel con las deducciones del empleado
     *
     * @return \Illuminate\Http\Response
     */
    public function exportar_excel($id)
    {
        $empleado = Empleado::findOrFail($id);
        $array = array();

        if (count($empleado->deducciones)) {
            foreach ($empleado->deducciones as $deduccion) {
                foreach ($deduccion->detalles as $detalle) {
                    $array[] = [
                        'Nombre completo' => $empleado->nombre.' '.$empleado->apellido_paterno.' '.$empleado->apellido_materno,
                        'Importe ' => number_format($deduccion->importe,2),
                        'Número de días ' => $deduccion->num_dias,
                        'Número de cuenta' => $empleado->num_cuenta,
                        'Número de empleado' => $empleado->num_empleado,
                        'Rango de fechas' => date('d M Y', strtotime($deduccion->fecha_inicio)).' - '.date('d M Y', strtotime($deduccion->fecha_fin)),
                        'Empresa ' => $deduccion->empresa->nombre,
                        'Notas' => $deduccion->comentarios
                    ];
                }
            }
        }

        Excel::create("Deducciones de empleado $empleado->nombre", function($excel) use($array) {
            $excel->sheet('Hoja 1', function($sheet) use($array) {
                $sheet->cells('A:H', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });

                $sheet->cells('A1:H1', function($cells) {
                    $cells->setFontWeight('bold');
                });

                $sheet->fromArray($array);
            });
        })->export('xlsx');

        return ['msg'=>'Excel creado'];
    }
}
