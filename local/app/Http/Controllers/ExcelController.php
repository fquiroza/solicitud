<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Middleware;
use Illuminate\Http\Request;
use DB;
use Excel;
use App\Tickets;
use App\Dependencia;

class ExcelController extends Controller
{   

    public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        return View('excel.excel');
    }
    
    public function ReportGenerade(Request $request)
    {
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $radio = $request->input('radio');

        if($radio==1)
        {
            if($fecha_inicio!="" and $fecha_fin!="")
            {
            
                $tickets = Tickets::where('created','>=',$fecha_inicio." 00:00:00")
                                    ->where('updated','<=',$fecha_fin." 23:59:59")
                                    ->get();

            }else
            {
                $tickets = Tickets::orderby('cpv_tickets_id')->get();
            }

                if (isset($tickets[0])) 
                {
                    Excel::create('Informe-Tickets', function($excel) use($tickets) {
                    $excel->sheet('Informe', function($sheet) use($tickets) {

                    $ad_user = $this->ad_user();
                    //Header A1
                    $sheet->row(1, ['', '','','','','','Informe de Tickets']);

                    $sheet->row(3, ['ID', 'Usuario Creo','Usuario Recibio','Tipo','Categoria','Lugar','Detalle','Estado','Hora Creación','Hora Cierre','Detalle Cierre']);

                    $sum=3;
                    foreach ($tickets as $t){

                    $sum++;
                    $sheet->setCellValue('A'.$sum, $t['cpv_tickets_id']);

                    foreach ($ad_user as $ad){
                        if($t['createdby']==$ad->id){
                            $sheet->setCellValue('B'.$sum, $ad->name);
                        }
                    }

                    foreach ($ad_user as $ad){
                        if($t['ad_user_id']==$ad->id){
                            $sheet->setCellValue('C'.$sum, $ad->name);
                        }
                    }
                    
                    $sheet->setCellValue('D'.$sum, $t['type']);
                    $sheet->setCellValue('E'.$sum, $t['category']);
                    $sheet->setCellValue('F'.$sum, $t['location']);
                    $sheet->setCellValue('G'.$sum, $t['description']);
                    $sheet->setCellValue('H'.$sum, $t['status']);
                    $sheet->setCellValue('I'.$sum, $t['created']);

                    if($t['status']=='CERRADO'){
                        $sheet->setCellValue('J'.$sum, $t['updated']); 
                    }

                    $sheet->setCellValue('K'.$sum, $t['material']);

                    }

                    });
                        
                        })->export('xlsx');
                }else{

                    echo '<script type="text/javascript">alert("Su Busqueda no a arrojado resultados");window.history.back();</script>';
                }
                

            }else
            {

                if($fecha_inicio!="" and $fecha_fin!="")
            {
            
                $dependencia = Dependencia::where('created','>=',$fecha_inicio." 00:00:00")
                                    ->where('updated','<=',$fecha_fin." 23:59:59")
                                    ->get();

            }else
            {
                $dependencia = Dependencia::orderby('cpv_dependencia_id')->get();
            }

                if (isset($dependencia[0])) 
                {
                    Excel::create('Informe-Dependencia', function($excel) use($dependencia) {
                    $excel->sheet('Informe', function($sheet) use($dependencia) {

                    $ad_user = $this->ad_user();
                    //Header A1
                    $sheet->row(1, ['', '','','','','','Informe de Dependencia']);

                    $sheet->row(3, ['ID', 'Usuario Creo','Usuario Recibio','Responsable','Cargo','Hora Creación','Requerimiento','Lugar','Detalle','Estado','Fecha Inicio','Fecha Fin','Comentario']);

                    $sum=3;
                    foreach ($dependencia as $d){

                    $sum++;
                    $sheet->setCellValue('A'.$sum, $d['cpv_dependencia_id']);

                    foreach ($ad_user as $ad){
                        if($d['createdby']==$ad->id){
                            $sheet->setCellValue('B'.$sum, $ad->name);
                        }
                    }
                    
                    foreach ($ad_user as $ad){
                        if($d['ad_user_id']==$ad->id){
                            $sheet->setCellValue('C'.$sum, $ad->name);
                        }
                    }

                    $sheet->setCellValue('D'.$sum, $d['responsable_nombre']);
                    $sheet->setCellValue('E'.$sum, $d['responsable_cargo']);
                    $sheet->setCellValue('F'.$sum, $d['created']);
                    $sheet->setCellValue('G'.$sum, $d['requerimiento']);
                    $sheet->setCellValue('H'.$sum, $d['location']);
                    $sheet->setCellValue('I'.$sum, $d['detalle']);
                    $sheet->setCellValue('J'.$sum, $d['status']);
                    $sheet->setCellValue('K'.$sum, $d['fecha_desde']);
                    $sheet->setCellValue('L'.$sum, $d['fecha_hasta']);
                    $sheet->setCellValue('M'.$sum, $d['comentario']);

                    }

                    });
                        
                        })->export('xlsx');
                }else{

                    echo '<script type="text/javascript">alert("Su Busqueda no a arrojado resultados");window.history.back();</script>';
                }

            }
        
        



    }


}
