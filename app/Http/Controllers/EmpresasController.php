<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Empresa;
use Image;

class EmpresasController extends Controller
{
    function __construct() {
        date_default_timezone_set('America/Mexico_City');
        $this->actual_datetime = date('Y-m-d H:i:s');
    }

    /**
     * Carga la tabla de productos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->check()) {
            $title = "Empresas";
            $menu = "Empresas";
            $empresas = Empresa::where('status', 1)->get();
            if ($request->ajax()) {
                return view('empresas.tabla', ['empresas' => $empresas]);
            }
            return view('empresas.empresas', ['empresas' => $empresas, 'menu' => $menu, 'title' => $title]);
        } else {
            return redirect()->to('/');
        }
    }

    /**
     * Guarda una empresa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json($msg)
     */
    public function guardar(Request $request)
    {
        $empresa = new Empresa;

        $empresa->nombre = $request->nombre;
        $empresa->direccion = $request->direccion;
        $empresa->telefono = $request->telefono;
        $empresa->numero_ext = $request->numero_ext;
        $empresa->numero_int = $request->numero_int;
        $empresa->codigo_postal = $request->codigo_postal;
        $empresa->status = 1;
        $empresa->created_at = $this->actual_datetime;

        $logo = $request->file('logo');
        if ($logo) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
            $extension_archivo = $logo->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/logo_empresa/'.time().'.'.$extension_archivo;
                Image::make($logo)
                //->resize(460, 460)
                ->save($name);
                $empresa->logo = $name;
            }
        }
   
        $empresa->save();

        return ['msg' => 'saved!'];
    }

    /**
     * Guarda una empresa
     *
     * @param  \Illuminate\Http\Request  $request
     * @return json($msg)
     */
    public function editar(Request $request)
    {
        $empresa = Empresa::find($request->id);

        if ($empresa) {
            $empresa->nombre = $request->nombre;
            $empresa->direccion = $request->direccion;
            $empresa->telefono = $request->telefono;
            $empresa->numero_ext = $request->numero_ext;
            $empresa->numero_int = $request->numero_int;
            $empresa->codigo_postal = $request->codigo_postal;
            $empresa->status = 1;
            $empresa->created_at = $this->actual_datetime;

            $logo = $request->file('logo');
            if ($logo) {
                $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png", "4"=>"gif");
                $extension_archivo = $logo->getClientOriginalExtension();
                if (array_search($extension_archivo, $extensiones_permitidas)) {
                    $name = 'img/logo_empresa/'.time().'.'.$extension_archivo;
                    Image::make($logo)
                    //->resize(460, 460)
                    ->save($name);
                    $empresa->logo = $name;
                }
            }
       
            $empresa->save();

            return ['msg' => 'saved!'];
        }
        return ['msg' => 'The enterprise has an invalid ID'];
    }

    /**
     * Elimina una empresa.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ["success" => true]
     */
    public function dar_baja(Request $request)
    {
        $empresa = Empresa::find($request->id);
        if ($empresa) {
            $empresa->update(['status' => 0]);
            //$empresa->delete();
            return ["msg" => 'Deleted!'];
        } else {
            return ["msg" => 'Unable to delete this record!'];
        }
    }

    /**
     * Elimina múltiples empresas a la vez.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ["success" => true]
     */
    public function dar_baja_multiples_empresas(Request $request)
    {
        try {
            Empresa::whereIn('id', $request->checking)
            ->update(['status' => 0]);
            //->delete();
            return ["msg" => 'All rows selected were deleted!'];
        } catch(\Illuminate\Database\QueryException $ex) {
            return $ex->getMessage();
        }
    }
}
