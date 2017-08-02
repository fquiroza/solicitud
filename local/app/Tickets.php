<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{

    protected $primaryKey = 'cpv_tickets_id';

    protected $table = 'cpv_tickets';
    
    protected $connection = 'pgsql';

    protected $fillable = [
        'cpv_tickets_id', 'ad_client_id', 'ad_org_id', 'createdby', 'updatedby', 'type', 'location', 'category', 'description', 'status', 'ad_user_id', 'material'
    ];

    public $timestamps = false;
}
