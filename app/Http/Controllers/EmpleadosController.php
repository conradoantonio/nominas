<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Excel;
use App\Empleado;
use App\Documentacion;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmpleadosController extends Controller
{
    /**
     * Carga la tabla de empleados activos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $menu = "Empleados (Activos)";
        $status = 1;
        $empleados = Empleado::where('status', $status)->get();
        
        if ($request->ajax()) {
            return view('empleados.tabla', ['empleados' => $empleados, 'status' => $status]);
        }
        return view('empleados.empleados', ['empleados' => $empleados, 'status' => $status, 'menu' => $menu, 'title' => $title]);
    }

    /**
     * Carga la tabla de empleados inactivos.
     *
     * @return \Illuminate\Http\Response
     */
    public function inactivos(Request $request)
    {
        $title = $menu = "Empleados (Inactivos)";
        $status = 0;
        $empleados = Empleado::where('status', $status)->get();
        
        if ($request->ajax()) {
            return view('empleados.tabla', ['empleados' => $empleados, 'status' => $status]);
        }
        return view('empleados.empleados', ['empleados' => $empleados, 'status' => $status, 'menu' => $menu, 'title' => $title]);
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
        $editable = 1;
        if ($id) {
            $empleado = Empleado::find($id);
            $empleado->documentacion = $empleado->documentacion;
        }

        return view('empleados.formulario', ['empleado' => $empleado, 'editable' => $editable, 'menu' => $menu, 'title' => $title]);
    }

    /**
     * Carga el formulario de empleados sólo para ver detalles.
     *
     * @return \Illuminate\Http\Response
     */
    public function detalle_empleado($id)
    {
        $title = "Detalle de empleado";
        $menu = "Empleados";
        $empleado = null;
        $editable = 0;
        if ($id) {
            $empleado = Empleado::find($id);
            $empleado->documentacion = $empleado->documentacion;
        } else {
            return view('empleados.formulario', ['empleado' => $empleado, 'editable' => 1, 'menu' => $menu, 'title' => $title]);//Se regresa la vista para dar de alta un formulario
        }

        return view('empleados.formulario', ['empleado' => $empleado, 'editable' => $editable, 'menu' => $menu, 'title' => $title]);
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
        $empleado->apellido_paterno = $request->apellido_paterno;
        $empleado->apellido_materno = $request->apellido_materno;
        $empleado->num_empleado = $request->num_empleado;
        $empleado->num_cuenta = $request->num_cuenta;
        $empleado->domicilio = $request->domicilio;
        $empleado->ciudad = $request->ciudad;
        $empleado->telefono = $request->telefono;
        $empleado->rfc = $request->rfc;
        $empleado->curp = $request->curp;
        $empleado->nss = $request->nss;
        $empleado->telefono_emergencia = $request->telefono_emergencia;
        $empleado->fecha_ingreso = $request->fecha_ingreso;
        $empleado->escolaridad = $request->escolaridad;
        $empleado->infonavit = $request->infonavit;
        $empleado->vacaciones = $request->vacaciones;
        $empleado->pensionado = $request->pensionado;

        $empleado->save();

        $documentacion = New Documentacion;
        $documentacion->empleado_id = $empleado->id;
        $documentacion->comprobante_domicilio = $request->comprobante_domicilio ? 1 : 0;
        $documentacion->identificacion = $request->identificacion ? 1 : 0;
        $documentacion->curp = $request->curp_documento ? 1 : 0;
        $documentacion->rfc = $request->rfc_documento ? 1 : 0;
        $documentacion->hoja_imss = $request->hoja_imss ? 1 : 0;
        $documentacion->carta_no_antecedentes_penales = $request->carta_no_antecedentes_penales ? 1 : 0;
        $documentacion->acta_nacimiento = $request->acta_nacimiento ? 1 : 0;
        $documentacion->comprobante_estudios = $request->comprobante_estudios ? 1 : 0;
        $documentacion->resultado_psicometrias = $request->resultado_psicometrias ? 1 : 0;
        $documentacion->examen_socieconomico = $request->examen_socieconomico ? 1 : 0;
        $documentacion->examen_toxicologico = $request->examen_toxicologico ? 1 : 0;
        $documentacion->solicitud_frente_vuelta = $request->solicitud_frente_vuelta ? 1 : 0;
        $documentacion->deposito_uniforme = $request->deposito_uniforme ? 1 : 0;
        $documentacion->constancia_recepcion_uniforme = $request->constancia_recepcion_uniforme ? 1 : 0;
        $documentacion->comprobante_recepcion_reglamento_interno_trabajo = $request->comprobante_recepcion_reglamento_interno_trabajo ? 1 : 0;
        $documentacion->autorizacion_pago_tarjeta = $request->autorizacion_pago_tarjeta ? 1 : 0;
        $documentacion->carta_aceptacion_cambio_lugar = $request->carta_aceptacion_cambio_lugar ? 1 : 0;
        $documentacion->finiquito = $request->finiquito ? 1 : 0;
        $documentacion->calendario = $request->calendario ? 1 : 0;
        $documentacion->formato_datos_personales = $request->formato_datos_personales ? 1 : 0;
        $documentacion->solicitud_autorizacion_consulta = $request->solicitud_autorizacion_consulta ? 1 : 0;

        $documentacion->save();
        
        return redirect()->to('empleados');
        return response(['msg' => 'Empleado actualizado correctamente', 'status' => 'ok'], 200);
    }

    /**
     * Actualiza los datos de un empleado.
     *
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request)
    {
        $empleado = Empleado::find($request->id);
        $documentacion = Documentacion::find($request->documentacion_id);

        if ($empleado && $documentacion) {
            /*Información del empleado*/
            $empleado->nombre = $request->nombre;
            $empleado->apellido_paterno = $request->apellido_paterno;
            $empleado->apellido_materno = $request->apellido_materno;
            $empleado->num_empleado = $request->num_empleado;
            $empleado->num_cuenta = $request->num_cuenta;
            $empleado->domicilio = $request->domicilio;
            $empleado->ciudad = $request->ciudad;
            $empleado->telefono = $request->telefono;
            $empleado->rfc = $request->rfc;
            $empleado->curp = $request->curp;
            $empleado->nss = $request->nss;
            $empleado->telefono_emergencia = $request->telefono_emergencia;
            $empleado->fecha_ingreso = $request->fecha_ingreso;
            $empleado->escolaridad = $request->escolaridad;
            $empleado->infonavit = $request->infonavit;
            $empleado->vacaciones = $request->vacaciones;
            $empleado->pensionado = $request->pensionado;

            $empleado->save();

            /*Documentación del empleado*/
            $documentacion->comprobante_domicilio = $request->comprobante_domicilio ? 1 : 0;
            $documentacion->identificacion = $request->identificacion ? 1 : 0;
            $documentacion->curp = $request->curp_documento ? 1 : 0;
            $documentacion->rfc = $request->rfc_documento ? 1 : 0;
            $documentacion->hoja_imss = $request->hoja_imss ? 1 : 0;
            $documentacion->carta_no_antecedentes_penales = $request->carta_no_antecedentes_penales ? 1 : 0;
            $documentacion->acta_nacimiento = $request->acta_nacimiento ? 1 : 0;
            $documentacion->comprobante_estudios = $request->comprobante_estudios ? 1 : 0;
            $documentacion->resultado_psicometrias = $request->resultado_psicometrias ? 1 : 0;
            $documentacion->examen_socieconomico = $request->examen_socieconomico ? 1 : 0;
            $documentacion->examen_toxicologico = $request->examen_toxicologico ? 1 : 0;
            $documentacion->solicitud_frente_vuelta = $request->solicitud_frente_vuelta ? 1 : 0;
            $documentacion->deposito_uniforme = $request->deposito_uniforme ? 1 : 0;
            $documentacion->constancia_recepcion_uniforme = $request->constancia_recepcion_uniforme ? 1 : 0;
            $documentacion->comprobante_recepcion_reglamento_interno_trabajo = $request->comprobante_recepcion_reglamento_interno_trabajo ? 1 : 0;
            $documentacion->autorizacion_pago_tarjeta = $request->autorizacion_pago_tarjeta ? 1 : 0;
            $documentacion->carta_aceptacion_cambio_lugar = $request->carta_aceptacion_cambio_lugar ? 1 : 0;
            $documentacion->finiquito = $request->finiquito ? 1 : 0;
            $documentacion->calendario = $request->calendario ? 1 : 0;
            $documentacion->formato_datos_personales = $request->formato_datos_personales ? 1 : 0;
            $documentacion->solicitud_autorizacion_consulta = $request->solicitud_autorizacion_consulta ? 1 : 0;

            $documentacion->save();

            return redirect()->to('empleados');
            return response(['msg' => 'Empleado actualizado correctamente', 'status' => 'ok'], 200);
        }
        return response(['msg' => 'Error al actualizar el cliente', 'status' => 'Bad request'], 400);
    }

    /**
     * Da de baja un empleado.
     *
     * @return response
     */
    public function dar_baja(Request $request)
    {
        $empleado = Empleado::find($request->id);
        if ($empleado) {
            $empleado->update(['status' => $request->status]);
            return response(['msg' => 'Empleado dado de baja correctamente', 'status' => 'ok'], 200);
        } else {
            return response(['msg' => 'No es posible dar de baja este empleado', 'status' => 'error'], 404);
        }
    }

    /**
     * Elimina múltiples empleados al mismo tiempo.
     *
     * @return response
     */
    public function dar_baja_multiple(Request $request)
    {
        try {
            Empleado::whereIn('id', $request->checking)
            ->update(['status' => $request->status]);
            return response(['msg' => 'Los empleados seleccionados fueron dados de baja correctamente', 'status' => 'ok'], 200);
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * Exporta todos los empleados a excel.
     *
     * @return response
     */
    public function exportar_excel($status, $id = false)
    {
        $nombre_excel = 'Empleado Info';
        $empleados = Empleado::select(DB::raw("empleados.*, 
            IF(documentacion.comprobante_domicilio = 0, 'No', 'Si') as 'Comprobante domicilio', 
            IF(documentacion.identificacion = 0, 'No', 'Si') as 'Identificación',
            IF(documentacion.curp = 0, 'No', 'Si') as 'CURP',
            IF(documentacion.rfc = 0, 'No', 'Si') as 'RFC',
            IF(documentacion.hoja_imss = 0, 'No', 'Si') as 'Hoja del IMSS',
            IF(documentacion.carta_no_antecedentes_penales = 0, 'No', 'Si') as 'Carta de no antecedentes penales',
            IF(documentacion.acta_nacimiento = 0, 'No', 'Si') as 'Acta de nacimiento',
            IF(documentacion.comprobante_estudios = 0, 'No', 'Si') as 'Comprobante de estudios',
            IF(documentacion.resultado_psicometrias = 0, 'No', 'Si') as 'Resultado de psicometrías',
            IF(documentacion.examen_socieconomico = 0, 'No', 'Si') as 'Examen socieconómico',
            IF(documentacion.examen_toxicologico = 0, 'No', 'Si') as 'Examen toxicológico',
            IF(documentacion.solicitud_frente_vuelta = 0, 'No', 'Si') as 'Solicitud frente y vuelta',
            IF(documentacion.deposito_uniforme = 0, 'No', 'Si') as 'Depósito de uniforme',
            IF(documentacion.constancia_recepcion_uniforme = 0, 'No', 'Si') as 'Constancia de recepción de uniforme',
            IF(documentacion.comprobante_recepcion_reglamento_interno_trabajo = 0, 'No', 'Si') as 'Comprobante de recepción del reglamento interno de trabajo',
            IF(documentacion.autorizacion_pago_tarjeta = 0, 'No', 'Si') as 'Autorización pago con tarjeta',
            IF(documentacion.carta_aceptacion_cambio_lugar = 0, 'No', 'Si') as 'Carta de aceptación por cambio de lugar',
            IF(documentacion.finiquito = 0, 'No', 'Si') as 'Finiquito',
            IF(documentacion.calendario = 0, 'No', 'Si') as 'Calendario',
            IF(documentacion.formato_datos_personales = 0, 'No', 'Si') as 'Formato de datos personales',
            IF(documentacion.solicitud_autorizacion_consulta = 0, 'No', 'Si') as 'Solicitud de autorización de consulta'"))
        ->leftJoin('documentacion', 'empleados.id', '=', 'documentacion.empleado_id');

        if ($id) {
            $empleados = $empleados->where('empleados.id', $id)->get();
            $nombre_excel = "Empleado ".$empleados[0]->nombre;

        } else {
            $empleados = $empleados->where('empleados.status', $status)->get();
            $nombre_excel = "Empleados";
        }

        Excel::create($nombre_excel, function($excel) use($empleados) {
            $excel->sheet('Hoja 1', function($sheet) use($empleados) {
                $sheet->cells('A:AN', function($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
                
                $sheet->cells('A1:AN1', function($cells) {
                    $cells->setFontWeight('bold');
                });

                $sheet->fromArray($empleados);
            });
        })->export('xlsx');

        return ['msg'=>'Excel creado'];
    }
}
