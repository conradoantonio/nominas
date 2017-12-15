<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pago;
use App\Empresa;
use App\Empleado;
use App\Asistencia;
use App\UsuarioPago;
use App\EmpresaServicio;
use DB;

class PagosController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		 if (auth()->check()) {
			$title = "Pagos nominas";
			$menu = "Pagos";
			$pagos = Pago::all();

			$check = 0;
			return view('pagos.pagos', ['pagos' => $pagos, 'menu' => $menu, 'title' => $title]);
		} else {
			return redirect()->to('/');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $req)
	{
		$pago = new Pago();
		$pago->fill($req->all());
		$pago->servicio_id = 1;
		if ( $pago->save() ){
			foreach ($req->trabajadores as $value) {
				$usuarioPago = new UsuarioPago();
				$usuarioPago->pago_id = $pago->id;
				$usuarioPago->trabajador_id = $value;
				$usuarioPago->save();
			}

			return redirect()->action('PagosController@index')->with([ 'msg' => 'Pago guardado', 'class' => 'alert-success' ]);
		} else {
			return redirect()->action('PagosController@index')->with([ 'msg' => 'Error al guardar pago', 'class' => 'alert-danger' ]);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$title = "Pagos nominas";
		$menu = "Pagos";
		$pago = Pago::findOrFail($id);

		$startTime = strtotime( $pago->fecha_inicio );
		$endTime = strtotime( $pago->fecha_fin );
		$days_ago = date('d', strtotime('-3 days'));

		// Loop between timestamps, 24 hours at a time
		for ( $i = $startTime; $i <= $endTime; $i = $i + 86400 ) {
			$edit = false;
			$d = date( 'd', $i );
			if ( $d >= $days_ago && $d <= date('d') ){
				$edit = true;
			}
			$days[] = ['dia' => date('w', $i), 'num' => $d, 'edit' => $edit];
		}
		$asistencias = Asistencia::whereIn('usuario_pago_id',$pago->PagoUsuarios->pluck('id'))->get();

		return view('pagos.detalle', ['pago' => $pago, 'dias' => $days, 'menu' => $menu, 'title' => $title, 'asistencias' => $asistencias]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function paid($id)
	{
		$title = "Pagos nominas";
		$menu = "Pagos";
		$pago = Pago::findOrFail($id);

		$asistencias = Asistencia::with(['pago.usuarios', 'pago.pago.servicio'])->whereIn('usuario_pago_id',$pago->PagoUsuarios->pluck('id'))->whereIn('status',['D','X'])->groupBy('usuario_pago_id')->select(DB::raw('usuario_pago_id, COUNT(usuario_pago_id) AS total'))->get();
		#dd($asistencias);
		return view('pagos.pagar', ['pago' => $pago,'menu' => $menu, 'title' => $title, 'asistencias' => $asistencias]);
	}

	public function formulario() {
		$title = "Pagos nominas";
		$menu = "Pagos";
		$empresas = Empresa::where('status',1)->get();
		$trabajadores = Empleado::where('status',1)->get();

		return view('pagos.formulario', ['empresas' => $empresas, 'trabajadores' => $trabajadores, 'menu' => $menu, 'title' => $title]);
	}

	public function save(Request $req) {
		$collection = json_decode($req->collection);

		foreach ($collection as $key => $value) {
			$aux = 0;
			$value = collect($value);

			Asistencia::where('usuario_pago_id', $value['pago_id'])->delete();
			$UsuarioPago = UsuarioPago::find($value['pago_id']);
			$UsuarioPago->notas = $value['notas'];

			$days = $value['days'];

			foreach ($days as $val) {
				$asistencias = collect($val);
				$asistencia = new Asistencia();
				$asistencia->usuario_pago_id = $value['pago_id'];
				$asistencia->dia = $asistencias['dia'];
				$asistencia->status = $asistencias['status'];
				$asistencia->save();
			}

			/*if ( $UsuarioPago->asistencia->where('status','')->count() > 0 && $UsuarioPago->pago->status != 3 ){
				$UsuarioPago->pago->status = 1;
			} else {
				$UsuarioPago->pago->status = 2;
			}*/

			$UsuarioPago->save();

			$aux = 1;
		}

		$asistencia = Asistencia::with('pago')->whereIn('usuario_pago_id', collect($collection[0]->pago_id))->where('status', '')->get();
		$pago = Pago::whereIn('id',collect($collection[0]->pago_id))->first();

		if ( !$asistencia->isEmpty() ){
			$pago->status = 1;
		} else {
			$pago->status = 2;
		}
		$pago->save();

		return [ 'save' => true ];
	}

	/**
     *===============================================================================================================================================================================
     *=                                                           Empiezan las funciones relacionadas a la vista de pagos                                                           =
     *===============================================================================================================================================================================
     */

	/**
	 * Obtiene los servicios de una empresa
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function servicios_empresa(Request $request)
	{
		$servicios = EmpresaServicio::where('empresa_id', $request->empresa_id)->get();
		return $servicios;
	}
}
