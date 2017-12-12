<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicioDetalle extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'servicio_detalles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['servicio_id', 'nombre_producto', 'foto_producto', 'precio', 'cantidad', 'created_at'];

    
}
