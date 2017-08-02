<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{

    protected $primaryKey = 'cpv_dependencia_id';

    protected $table = 'cpv_dependencia';
    
    protected $connection = 'pgsql';

    protected $fillable = [
        'cpv_dependencia_id', 'ad_client_id', 'ad_org_id', 'isactive', 'createdby', 'updatedby', 'location', 'fecha_desde', 'fecha_hasta', 'requerimiento', 'detalle', 'status', 'ad_user_id','comentario','responsable_nombre','responsable_cargo'
    ];

    public $timestamps = false;
}
