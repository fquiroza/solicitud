<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function eo_grade()
    {
        $result = DB::table('eo_grade')
                            ->select('name','eo_grade_id AS id')
                            ->get();
        return $result;
    }

    public function lugar($id)
	{
		$result = DB::table('eo_grade')
	    					->select('name','eo_grade_id AS id')
	    					->where('eo_grade_id',$id)
	        				->get();
	    return $result;
	}

    public function lugar_dependencia($id)
    {
            if($id=='1')
            {
                $location='Auditorio';

            }elseif ($id=='2') {

                $location='Sala';

            }elseif ($id=='3') {

                $location='Bliblioteca';

            }elseif ($id=='4') {

                $location='Cancha';

            }elseif ($id=='5') {

                $location='Patio';

            }elseif ($id=='6') {

                $location='Cuadrante';
            }

            return $location;
    }


    public function ad_user()
	{
		$result = DB::table('ad_user')
	    					->select('title AS name','ad_user_id AS id')
	        				->orderBy('title', 'asc')
	        				->get();
	    return $result;
	}

	public function user_name($id)
	{
		$result = DB::table('ad_user')
	    					->select('title AS name')
	    					->where('ad_user_id',$id)
	        				->get();
	    return $result;
	}

    public function user_email($id)
    {
        $result = DB::table('ad_user')
                            ->select('email')
                            ->where('ad_user_id',$id)
                            ->get();
        return $result;
    }

	public function tipo_solicitud($tipo)
    {
    	    if($tipo=='1')
    		{
    			$type='Informática';

    		}elseif ($tipo=='2') {

    			$type='Mantención';
    		}

    		return $type;
    }

	public function categoria_solicitud($tipo,$categoria)
    {
    	$category='';
    	    if($tipo=='1')
    		{
    			if($categoria==1)
    			{
    				$category='Audio';
    			}elseif($categoria==2)
    			{
    				$category='PC';
    			}elseif($categoria==3)
    			{
    				$category='Data';
    			}elseif($categoria==4)
    			{
    				$category='Cables';
    			}elseif($categoria==5)
    			{
    				$category='Teclado o Mouse';
    			}

    		}elseif ($tipo=='2') {

    			if($categoria==1)
    			{
    				$category='Pared';
    			}elseif($categoria==2)
    			{
    				$category='Ventana';
    			}elseif($categoria==3)
    			{
    				$category='Iluminación';
    			}elseif($categoria==4)
    			{
    				$category='Puerta';
    			}elseif($categoria==5)
    			{
    				$category='Pizarra';
    			}elseif($categoria==6)
    			{
    				$category='Red Electrica';
    			}elseif($categoria==7)
    			{
    				$category='Mobiliario';
    			}elseif($categoria==8)
    			{
    				$category='Mesa';
    			}elseif($categoria==9)
    			{
    				$category='Silla';
    			}elseif($categoria==10)
    			{
    				$category='Loft';
    			}

    		}

    		return $category;
    }



}
