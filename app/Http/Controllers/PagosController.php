<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Pago;
use App\Empresa;
use App\Usuario;
use App\UsuarioPago;

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

            /*if ($request->ajax()) {
                return view('pagos.usuariosSistema.table', ['usuarios' => $usuarios]);
            }*/
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

        $limit = explode("/",$pago->intervalo);
        $month = date('m', strtotime($pago->created_at));
        $year = date('Y', strtotime($pago->created_at));
        $days = [];

        if ( $limit[0] == "16" ){
            $limit[1] = date('t', strtotime($pago->created_at));
        }

        for ($i=$limit[0]; $i <= $limit[1]; $i++) {
            $day =$i.'-'.$month.'-'.$year;
            $days[] = ['dia' => date('w', strtotime($day)), 'num' => $i];
        }
        #dd($pago->PagoUsuarios);
        return view('pagos.detalle', ['pago' => $pago, 'dias' => $days, 'menu' => $menu, 'title' => $title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function formulario(){
        $title = "Pagos nominas";
        $menu = "Pagos";
        $empresas = Empresa::where('status',1)->get();
        $trabajadores = Usuario::where('status',1)->get();

        return view('pagos.formulario', ['empresas' => $empresas, 'trabajadores' => $trabajadores, 'menu' => $menu, 'title' => $title]);
    }
}
