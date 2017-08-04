<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware;
use App\Dependencia;
use Redirect;
use DB;
use PHPMailerAutoload; 
use PHPMailer;
use PDF;
use Datatables;

class DependenciaController extends Controller
{   

	public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        return View('home');
    }

    public function listar_dependencia(Request $request)
    {
        $message = $request->session()->get('message');
        return View('dependencia.listado_activo', compact('message'));
    }

    public function dependencia_list(Request $request)
    {
        $user = $request->session()->get('id');

        if($request->session()->get('admin')==TRUE)
        {
                    return Datatables::of(
                            DB::connection('pgsql')
                            ->table('cpv_dependencia AS d')
                            ->select(
                            'd.cpv_dependencia_id',
                            DB::raw("(select title from ad_user where ad_user_id=d.createdby) as createdby"),
                            DB::raw("(select title from ad_user a where a.ad_user_id=d.ad_user_id) as ad_user_id"),
                            DB::raw("TO_CHAR(d.created,'YYYY-MM-DD HH24:MI') as created"),
                            'd.requerimiento',
                            'd.location',
                            DB::raw("TO_CHAR(d.fecha_desde,'YYYY-MM-DD HH24:MI') as fecha_inicio"),
                            DB::raw("TO_CHAR(d.fecha_hasta,'YYYY-MM-DD HH24:MI') as fecha_fin"),
                            'd.status',
                            DB::raw($user." AS user"),
                            DB::raw("d.ad_user_id AS ad_user"))
                            ->where('d.status','=','ABIERTO')
                            ->get()
                            )->make(true);

        }else{

                    return Datatables::of(
                            DB::connection('pgsql')
                            ->table('cpv_dependencia AS d')
                            ->select(
                            'd.cpv_dependencia_id',
                            DB::raw("(select title from ad_user where ad_user_id=d.createdby) as createdby"),
                            DB::raw("(select title from ad_user a where a.ad_user_id=d.ad_user_id) as ad_user_id"),
                            DB::raw("TO_CHAR(d.created,'YYYY-MM-DD HH24:MI') as created"),
                            'd.requerimiento',
                            'd.location',
                            DB::raw("TO_CHAR(d.fecha_desde,'YYYY-MM-DD HH24:MI') as fecha_inicio"),
                            DB::raw("TO_CHAR(d.fecha_hasta,'YYYY-MM-DD HH24:MI') as fecha_fin"),
                            'd.status',
                            DB::raw($user." AS user"),
                            DB::raw("d.ad_user_id AS ad_user"))
                            ->where('d.status','=','ABIERTO')
                            ->where(function ($query) use ($user) {
                                    $query->where('d.createdby', '=', $user)
                                          ->orWhere('d.ad_user_id','=', $user);
                                    })
                            ->get()
                            )->make(true);
        }
    }

    public function crear_dependencia(Request $request)
    {
        $lugar = $request->input('lugar');
        $otro_lugar = $request->input('otro_lugar');
        $fecha_desde = $request->input('fecha_desde');
        $fecha_hasta = $request->input('fecha_hasta');
        $cuentas = $request->input('cuentas');
        $detalle = $request->input('detalle');
        $responsable = $request->input('responsable');
        $cargo = $request->input('cargo');

        if($fecha_desde!="" && $fecha_hasta!="" && $detalle!="" && $responsable!="" && $cargo!="")
        {
            if($lugar==0)
            {
                $location=$otro_lugar;

            }else{

                $location = $this->lugar_dependencia($lugar);
            }

            if($cuentas!="")
            {

                $i = 0;
                foreach ($cuentas as $key => $value) {
        
                if($value==1)
                {
                    $value='Audio';
                }elseif($value==2)
                {
                    $value='PC';
                }elseif($value==3)
                {
                    $value='Data';
                }elseif($value==4)
                {
                    $value='Amplificación';
                }

                $items[$i] = $value;
                $i++;
                }

                $requerimiento = implode(',',$items);

            }else
            {
                $requerimiento = 'Sala';
            }
        
            $email = $request->session()->get('email');
            $email_ad_user = $this->user_email(1017257);
            $id = Dependencia::count()+1;

            $solicitante = $this->user_name($request->session()->get('id'));
            foreach ($solicitante as $key) {
                $solicitante = $key->name;
            }

            $data = array(
                    'numero' => $id,
                    'solicitante' => $solicitante,
                    'fecha_desde' => $fecha_desde,
                    'fecha_hasta' => $fecha_hasta,
                    'requerimiento' => $requerimiento,
                    'detalle' => $detalle,
                    'lugar' => $location,
                    'responsable' => $responsable,
                    'cargo' => $cargo,
                    'fecha_solicitud' => date('d-m-Y H:i'),
                );
            
            Dependencia::create([
                'cpv_dependencia_id' => $id,
                'ad_client_id' => 1000000,
                'ad_org_id' => $request->session()->get('org'), 
                'createdby' => $request->session()->get('id'), 
                'updatedby' => $request->session()->get('id'),
                'location' => $location, 
                'fecha_desde'  => $fecha_desde,
                'fecha_hasta'  => $fecha_hasta,
                'requerimiento'  => $requerimiento,
                'detalle'  => $detalle,
                'status'  => 'ABIERTO',
                'ad_user_id'  => 1017257,
                'responsable_nombre'  => $responsable,
                'responsable_cargo'  => $cargo
                ]);
            
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPAuth   = true; 
                $mail->SMTPSecure = "ssl";
                $mail->Host       = "smtp.gmail.com";
                $mail->Port       = 465;
                $mail->Username   = "sistema_correo@cpdv.cl";// user email
                $mail->Password   = "sistema1234";             // password in GMail
                $mail->SetFrom($email, 'SISTEMA DEPENDENCIA');//Quien envia
                $mail->Subject    = "Mensaje Sistema de Dependencia";//Titulo
                //Mensaje
                $mail->MsgHTML("La siguiente persona te a enviado un nuevo mensaje a sistema de dependencia
                                <br><br>
                                Correo: ".$email."<br><br>
                                Mensaje: "
                                .$detalle."<br><br>
                                Mensaje creado desde sistema de dependencia<br>
                                <b>Colegio Pedro de Valdivia</b><br/>");

                $pdf = PDF::loadView('pdf/dependencia_add', compact('data'));
                $pdf->setWarnings(false)->save('pdf/dependencia-'.$id.'.pdf');


                $mail->addAttachment('pdf/dependencia-'.$id.'.pdf');
                $mail->AddAddress($email_ad_user[0]->email, " ");
                $mail->AddAddress($email," ");
                $mail->IsHTML(true);
        
                if(!$mail->Send()) {
                    $message = "Error: " . $mail->ErrorInfo;
                } else {
                    $message = "Creado y Enviado Correctamente!";
                }
                $request->session()->flash('message', $message);

            return redirect()->route('listar_dependencia');   

        }else{

            $eo_grade = $this->eo_grade();

            return View('dependencia.nueva_dependencia', compact('eo_grade'));
        }
    }

    public function DelDependencia(Request $request)
    {
    	Dependencia::where('cpv_dependencia_id','=', $request->input('id'))->update(['status' => 'CERRADO','updated'=>date('Y-m-d H:i:s'),'updatedby' => $request->session()->get('id'),'comentario' => $request->input('comentario')]);

    	$dependencia = Dependencia::where('cpv_dependencia_id','=',$request->input('id'))->get();

    	$email = $request->session()->get('email');
        $comentario = $request->input('comentario');

    	foreach ($dependencia as $d):

    	$email_ad_user = $this->user_email($d->createdby);

    	$solicitante = $this->user_name($d->createdby);
    		foreach ($solicitante as $k) {
    			$solicitante = $k->name;
    		}

    	  	$data = array(
    			'numero' => $request->input('id'),
    			'fecha_desde' => $d->fecha_desde,
    			'fecha_hasta' => $d->fecha_hasta,
    			'solicitante' => $solicitante,
    			'requerimiento' => $d->requerimiento,
    			'detalle' => $d->detalle,
    			'lugar' => $d->location,
                'comentario' => $comentario,
                'responsable' => $d->responsable_nombre,
                'cargo' => $d->responsable_cargo,
                'fecha_solicitud' => $d->created,
    		);

    	endforeach;


    			$mail = new PHPMailer();
		        $mail->IsSMTP();
		        $mail->SMTPAuth   = true; 
		        $mail->SMTPSecure = "ssl";
		        $mail->Host       = "smtp.gmail.com";
		        $mail->Port       = 465;
                $mail->Username   = "sistema_correo@cpdv.cl";// user email
                $mail->Password   = "sistema1234";            // password in GMail
		        $mail->SetFrom($email, 'SISTEMA DEPENDENCIA');//Quien envia
		        $mail->Subject    = "Nuevo Mensaje Sistema de Dependencia";//Titulo
		        //Mensaje
		        $mail->MsgHTML("Se ha CERRADO la Dependencia Numero ".$request->input('id')."
		        				<br><br>
		                		Mensaje creado desde sistema de Dependencia<br>
		                		<b>Colegio Pedro de Valdivia</b><br/>");

		        $pdf = PDF::loadView('pdf/dependencia_end', compact('data'));
				$pdf->setWarnings(false)->save('pdf/dependencia-'.$request->input('id').'.pdf');


				$mail->addAttachment('pdf/dependencia-'.$request->input('id').'.pdf');

		        $mail->AddAddress($email_ad_user[0]->email, " ");
		       	$mail->AddAddress($email," ");
		        $mail->IsHTML(true);
	    
		        if(!$mail->Send()) {
		            $message = "Error: " . $mail->ErrorInfo;
		        } else {
		            $message = "Enviado y Dependencia Cerrada Correctamente!";
		        }
		        $request->session()->flash('message', $message);
    }

    public function historial(Request $request)
    {
        $message = $request->session()->get('message');
        return View('dependencia.historial_solicitud', compact('message'));
    }

    public function dependencia_historial(Request $request)
    {
        $user = $request->session()->get('id');

        if($request->session()->get('admin')==TRUE)
        {
                    return Datatables::of(
                            DB::connection('pgsql')
                            ->table('cpv_dependencia AS d')
                            ->select(
                            'd.cpv_dependencia_id',
                            DB::raw("(select title from ad_user where ad_user_id=d.createdby) as createdby"),
                            DB::raw("(select title from ad_user a where a.ad_user_id=d.ad_user_id) as ad_user_id"),
                            DB::raw("TO_CHAR(d.created,'YYYY-MM-DD HH24:MI') as created"),
                            'd.requerimiento',
                            'd.location',
                            DB::raw("TO_CHAR(d.fecha_desde,'YYYY-MM-DD HH24:MI') as fecha_inicio"),
                            DB::raw("TO_CHAR(d.fecha_hasta,'YYYY-MM-DD HH24:MI') as fecha_fin"),
                            'd.status',
                            DB::raw($user." AS user"),
                            DB::raw("d.ad_user_id AS ad_user"))
                            ->where('d.status','=','CERRADO')
                            ->get()
                            )->make(true);

        }else{

                    return Datatables::of(
                            DB::connection('pgsql')
                            ->table('cpv_dependencia AS d')
                            ->select(
                            'd.cpv_dependencia_id',
                            DB::raw("(select title from ad_user where ad_user_id=d.createdby) as createdby"),
                            DB::raw("(select title from ad_user a where a.ad_user_id=d.ad_user_id) as ad_user_id"),
                            DB::raw("TO_CHAR(d.created,'YYYY-MM-DD HH24:MI') as created"),
                            'd.requerimiento',
                            'd.location',
                            DB::raw("TO_CHAR(d.fecha_desde,'YYYY-MM-DD HH24:MI') as fecha_inicio"),
                            DB::raw("TO_CHAR(d.fecha_hasta,'YYYY-MM-DD HH24:MI') as fecha_fin"),
                            'd.status',
                            DB::raw($user." AS user"),
                            DB::raw("d.ad_user_id AS ad_user"))
                            ->where('d.status','=','CERRADO')
                            ->where(function ($query) use ($user) {
                                    $query->where('d.createdby', '=', $user)
                                          ->orWhere('d.ad_user_id','=', $user);
                                    })
                            ->get()
                            )->make(true);
        }
    }


}
