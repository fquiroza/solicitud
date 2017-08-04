<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware;
use App\Tickets;
use Redirect;
use DB;
use PHPMailerAutoload; 
use PHPMailer;
use PDF;

class TicketsController extends Controller
{   

	public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        return View('home');
    }

    public function listar(Request $request)
    {
        $user = $request->session()->get('id');
        
        if($request->session()->get('admin')==TRUE)
        {

            $ticket = Tickets::where('status','=','ABIERTO')->get();

        }else{

            $ticket = Tickets::where(function ($query) use ($user) {
                                $query->where('createdby', '=', $user)
                                    ->orWhere('ad_user_id', $user);
                            })
                            ->where('status','=','ABIERTO')->get();
        }
        
        $eo_grade = $this->eo_grade();
        $ad_user = $this->ad_user();

        $message = $request->session()->get('message');
        
     return View('tickets.solicitud_activa', compact('ticket','eo_grade','ad_user','message','user'));
    }

    public function crear(Request $request)
    {
    	$tipo = $request->input('tipo');
    	$categoria = $request->input('categoria');
    	$otra_categoria = $request->input('otra_categoria');
    	$lugar = $request->input('lugar');
    	$otro_lugar = $request->input('otro_lugar');
    	$mensaje = $request->input('mensaje');

        if($lugar==0)
        {
            if($otro_lugar=="")
            {
                $lugar="";
            }
        }

        if($categoria==0)
        {
            if($otra_categoria=="")
            {
                $categoria="";
            }
        }

    	if($tipo!="" AND $categoria!="" AND $lugar!="" AND $mensaje!="")
    	{

    		$type = $this->tipo_solicitud($tipo);

            if($tipo==1)
            {
                $email_ad_user=$this->user_email(1017256);
                $user_ad_id=1017256;

            }elseif($tipo==2)
            {
                $email_ad_user=$this->user_email(1017258);
                $user_ad_id=1017258;
            }

    		if($categoria==0)
    		{
    			$category=$otra_categoria;
    		}else{
    			$category = $this->categoria_solicitud($tipo,$categoria);
    		}

    		if($lugar==0)
    		{
    			$location=$otro_lugar;

    		}else{

    			$lugar = $this->lugar($lugar);

    			foreach ($lugar as $ky) {
    				$location = $ky->name;
    			}
    		}

    		$email = $request->session()->get('email');
    		$id = Tickets::count()+1;

    		$solicitante = $this->user_name($request->session()->get('id'));
    		foreach ($solicitante as $key) {
    			$solicitante = $key->name;
    		}

            $cargo = $this->user_name($user_ad_id);
            foreach ($cargo as $key) {
                $cargo = $key->name;
            }

    		$data = array(
    				'numero' => $id,
    				'fecha' => date('d-m-Y H:i'),
    				'solicitante' => $solicitante,
    				'cargo' => $cargo,
    				'detalle' => $mensaje,
    				'categoria' => $category,
    				'lugar' => $location
    			);
    		
	 		Tickets::create([
	            'cpv_tickets_id' => $id,
	            'ad_client_id' => 1000000,
	            'ad_org_id' => $request->session()->get('org'), 
	            'createdby' => $request->session()->get('id'), 
	            'updatedby' => $request->session()->get('id'),
	            'type' => $type,
	            'location' => $location, 
	            'category'  => $category,
	            'description'  => $mensaje,
	            'status'  => 'ABIERTO',
	            'ad_user_id'  => $user_ad_id]);
			
				$mail = new PHPMailer();
		        $mail->IsSMTP();
		        $mail->SMTPAuth   = true; 
		        $mail->SMTPSecure = "ssl";
		        $mail->Host       = "smtp.gmail.com";
		        $mail->Port       = 465;
		        $mail->Username   = "sistema_correo@cpdv.cl";// user email
		        $mail->Password   = "sistema1234";            // password in GMail
		        $mail->SetFrom($email, 'SISTEMA TICKETS');//Quien envia
		        $mail->Subject    = "Nuevo Mensaje Sistema de Tickets";//Titulo
		        //Mensaje
		        $mail->MsgHTML("La siguiente persona te a enviado un nuevo mensaje a sistema de tickets
		        				<br><br>
		        				Correo: ".$email."<br><br>
		        				Mensaje: "
		        				.$mensaje."<br><br>
		                		Mensaje creado desde sistema de tickets<br>
		                		<b>Colegio Pedro de Valdivia</b><br/>");
		        
		        //$email_info = $this->info_model->email($);

		        $pdf = PDF::loadView('pdf/ticket_add', compact('data'));
				$pdf->setWarnings(false)->save('pdf/tickets-'.$id.'.pdf');


				$mail->addAttachment('pdf/tickets-'.$id.'.pdf');
		        $mail->AddAddress($email_ad_user[0]->email, " ");
		       	$mail->AddAddress($email," ");
		        $mail->IsHTML(true);
	    
		        if(!$mail->Send()) {
		            $message = "Error: " . $mail->ErrorInfo;
		        } else {
		            $message = "Creado y Enviado Correctamente!";
		        }
		        $request->session()->flash('message', $message);

	        return redirect()->route('listar_tickets');   

    	}else{

	    	$eo_grade = $this->eo_grade();

	        return View('tickets.nuevo_ticket', compact('eo_grade'));
    	}
    }

    public function DelTicket(Request $request)
    {
    	Tickets::where('cpv_tickets_id','=', $request->input('id'))->update(['status' => 'CERRADO','updated'=>date('Y-m-d H:i:s'),'updatedby' => $request->session()->get('id'),'material' => $request->input('mensaje')]);

    	$ticket = Tickets::where('cpv_tickets_id','=',$request->input('id'))->get();

    	$email = $request->session()->get('email');


    	foreach ($ticket as $t):

        $email_ad_user = $this->user_email($t->createdby);
    		
    	$solicitante = $this->user_name($t->createdby);
    		foreach ($solicitante as $k) {
    			$solicitante = $k->name;
    		}

    	$cargo = $this->user_name($t->ad_user_id);
    		foreach ($cargo as $e) {
    			$cargo = $e->name;
    		}

    	  	$data = array(
    			'numero' => $request->input('id'),
    			'fecha' => $t->created,
                'fecha_cierre' => $t->updated,
    			'solicitante' => $solicitante,
    			'cargo' => $cargo,
                'lugar' => $t->location,
    			'categoria' => $t->category,
                'detalle' => $t->description,
                'material' => $request->input('mensaje')
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
		        $mail->SetFrom($email, 'SISTEMA TICKETS');//Quien envia
		        $mail->Subject    = "Nuevo Mensaje Sistema de Tickets";//Titulo
		        //Mensaje
		        $mail->MsgHTML("Se ha CERRADO el ticket Numero ".$request->input('id')."
		        				<br><br>
		                		Mensaje creado desde sistema de tickets<br>
		                		<b>Colegio Pedro de Valdivia</b><br/>");

		        $pdf = PDF::loadView('pdf/ticket_end', compact('data'));
				$pdf->setWarnings(false)->save('pdf/tickets-'.$request->input('id').'.pdf');


				$mail->addAttachment('pdf/tickets-'.$request->input('id').'.pdf');

		        $mail->AddAddress($email_ad_user[0]->email, " ");
		       	$mail->AddAddress($email," ");
		        $mail->IsHTML(true);
	    
		        if(!$mail->Send()) {
		            $message = "Error: " . $mail->ErrorInfo;
		        } else {
		            $message = "Enviado y Ticket Cerrado Correctamente!";
		        }
		        $request->session()->flash('message', $message);
    }

    public function historial(Request $request)
    {
        $user = $request->session()->get('id');

        if($request->session()->get('admin')==TRUE)
        {

            $ticket = Tickets::where('status','=','CERRADO')->get();

        }else{

            $ticket = Tickets::where(function ($query) use ($user) {
                        $query->where('createdby', '=', $user)
                            ->orWhere('ad_user_id', $user);
                        })
                        ->where('status','=','CERRADO')->get();
        }
        
        $eo_grade = $this->eo_grade();
        $ad_user = $this->ad_user();
        $user = $request->session()->get('id');

        $message = $request->session()->get('message');
        
     return View('tickets.historial_solicitud', compact('ticket','eo_grade','ad_user','message','user'));
    }

    /*public function pdf1()
    {
    	//return View('pdf/dependencia_add');

        $data = array('requerimiento' => 'Audio,PC,Data,Amplificación');

        $pdf = PDF::loadView('pdf/pdf1',compact('data'));
        return $pdf->stream('temp.pdf');
    }*/

}
