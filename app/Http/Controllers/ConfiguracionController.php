<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Redirect;
use DB;
use App\Faq;
use App\Ayuda;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;

class ConfiguracionController extends Controller
{
    /**
     * Carga la vista para poder cargar un pdf con el aviso de privacidad y/o poder descargar uno existente.
     *
     * @return \Illuminate\Http\Response
     */
    public function preguntas_frecuentes()
    {
        if (Auth::check()) {
            $preguntas = Faq::all();
            $title = 'Preguntas frecuentes';
            $menu = 'Configuraciones';
            return view('configuracion.preguntas_frecuentes', ['preguntas' => $preguntas, 'title' => $title, 'menu' => $menu]);
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Guarda una pregunta frecuente
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar_pregunta(Request $request)
    {
        $name = "img/preguntas/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
        if ($request->file('imagen_pregunta')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $request->file('imagen_pregunta')->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/preguntas/'.time().'.'.$request->file('imagen_pregunta')->getClientOriginalExtension();
                $imagen_pregunta = Image::make($request->file('imagen_pregunta'))
                ->resize(460, 384)
                ->save($name);
            }
        }

        DB::table('preguntas_frecuentes')->insert(
            ['pregunta' => $request->pregunta, 
             'respuesta' => $request->respuesta,
             'imagen' => $name
            ]
        );
        return back();
    }

    /**
     * Edita una pregunta frecuente
     *
     * @return \Illuminate\Http\Response
     */
    public function editar_pregunta(Request $request)
    {
        $name = "img/preguntas/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
        if ($request->file('imagen_pregunta')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $request->file('imagen_pregunta')->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/preguntas/'.time().'.'.$request->file('imagen_pregunta')->getClientOriginalExtension();
                $imagen_pregunta = Image::make($request->file('imagen_pregunta'))
                ->resize(460, 384)
                ->save($name);
            }
        }
             
        $actualizar = ['pregunta' => $request->pregunta, 'respuesta' => $request->respuesta];
        $name != "img/preguntas/default.jpg" ? $actualizar = ['imagen' => $name] : '';
        DB::table('preguntas_frecuentes')
        ->where('id', $request->id)
        ->update($actualizar);
        return back();
    }

    /**
     * Edita una pregunta frecuente
     *
     * @return \Illuminate\Http\Response
     */
    public function eliminar_pregunta(Request $request)
    {
        DB::table('preguntas_frecuentes')
        ->where('id', $request->id)
        ->delete();
        return back();
    }


    /**
     *==========================================================================================================================
     *=                           Empiezan las funciones relacionadas a la información de la empresa                           =
     *==========================================================================================================================
     */

    /**
     * Carga la vista para las preferencias de envío de los pedidos.
     *
     * @return \Illuminate\Http\Response
     */
    public function info_empresa()
    {
        if (Auth::check()) {
            $title = 'Información empresa';
            $menu = 'Configuraciones';
            $datos = DB::table('informacion_empresa')->where('empresa_id', Auth::user()->empresa_id)->first();
            $header = count($datos) > 0 ? 'Editar' : 'Guardar';
            return view('configuracion.info_empresa', ['title' => $title, 'menu' => $menu, 'datos' => $datos, 'header' => $header]);
        } else {
            return Redirect::to('/');
        }
    }

    /**
     * Guarda información de una empresa
     *
     * @return \Illuminate\Http\Response
     */
    public function guardar_info_empresa(Request $request)
    {
        $name = "img/logo_empresa/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
        if ($request->file('logo')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $request->file('logo')->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/logo_empresa/'.time().'.'.$request->file('logo')->getClientOriginalExtension();
                $logo = Image::make($request->file('logo'))
                ->resize(460, 384)
                ->save($name);
            }
        }

        DB::table('informacion_empresa')->insert(
            ['direccion' => $request->direccion, 
             'telefono' => $request->telefono,
             'numeroExt' => $request->numeroExt,
             'numeroInt' => $request->numeroInt,
             'codigo_postal' => $request->codigo_postal,
             'logo' => $name,
             'empresa_id' => Auth::user()->empresa_id]
        );
        return back();
    }

    /**
     * Guarda información de una empresa
     *
     * @return \Illuminate\Http\Response
     */
    public function editar_info_empresa(Request $request)
    {
        $name = "img/logo_empresa/default.jpg";//Solo permanecerá con ese nombre cuando NO se seleccione una imágen como tal.
        if ($request->file('logo')) {
            $extensiones_permitidas = array("1"=>"jpeg", "2"=>"jpg", "3"=>"png");
            $extension_archivo = $request->file('logo')->getClientOriginalExtension();
            if (array_search($extension_archivo, $extensiones_permitidas)) {
                $name = 'img/logo_empresa/'.time().'.'.$request->file('logo')->getClientOriginalExtension();
                $logo = Image::make($request->file('logo'))
                ->resize(460, 384)
                ->save($name);
            }
        }

        $actualizar = [ 'direccion' => $request->direccion, 
                        'telefono' => $request->telefono,
                        'numeroExt' => $request->numeroExt,
                        'numeroInt' => $request->numeroInt,
                        'codigo_postal' => $request->codigo_postal];

        $name != "img/logo_empresa/default.jpg" ? $actualizar = ['logo' => $name] : '';
        
        DB::table('informacion_empresa')
        ->where('empresa_id', Auth::user()->empresa_id)
        ->update($actualizar);
        return back();
    }
}
