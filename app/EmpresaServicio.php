<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpresaServicio extends Model
{
    /**
     * Define el nombre de la tabla del modelo.
     */
    protected $table = 'empresa_servicio';

    /**
     * Define el nombre de los campos que podrán ser alterados de la tabla del modelo.
     */
    protected $fillable = [
    	'empresa_id', 'servicio', 'horario', 'sueldo', 'sueldo_diario_guardia', 'created_at'
    ];
}
