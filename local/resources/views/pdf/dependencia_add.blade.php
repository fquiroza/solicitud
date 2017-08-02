<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="{{ asset('frontend/sistema/css/bootstrap.min.css') }}" rel="stylesheet">

        <link href="{{ asset('frontend/sistema/js/iCheck/skins/flat/green.css') }}" rel="stylesheet">

        <style type="text/css">
          td{ padding-left: 25px; text-align: left;}
          tr.spaceUnder>td { padding-bottom: 1em; }
          tr.space>td { padding-bottom: 3em;}
          footer{padding-top: 100px;  }
          hr.style1{ border-top: 1px solid #8c8b8b; width: 100%;}
          li {list-style-type: none;}
          li:before{content: "- "} 
        </style>
</head>
<body> 
    <center>

      <table border="0" width="100%" height="100%">
          <tr>
            <td><img src="{{asset('frontend/sistema/img/logo2.png')}}" height="65px" width="200px"></td>
            <td colspan="2"><h4>Solicitud N° {{$data['numero']}}</h4><h4>Fecha Solicitud: {{date_format(date_create($data['fecha_solicitud']),"d-m-Y/H:i")}}</h4><h4>Fecha Inicio: {{date_format(date_create($data['fecha_desde']),"d-m-Y/H:i")}}</h4><h4>Fecha Finalización: {{date_format(date_create($data['fecha_hasta']),"d-m-Y/H:i")}}</h4></td>
          </tr>
      </table>
      <table  border="0" width="100%" height="100%">
          <tr class="space">
            <td width="200px"></td>
            <td colspan="2"> <center><h3>Solicitud de Dependencias</h3></center></td>
            <td></td>
          </tr>

          <tr class="spaceUnder">
            <td >Nombre Solicitante: </td>
            <td colspan="2">{{$data['solicitante']}}</td>
          </tr>

          <tr class="spaceUnder">
            <td>Requerimiento: </td>
            <td colspan="2">
            <?php 
              $requerimiento = explode(",",$data['requerimiento']);
                foreach ($requerimiento as $r):
                  echo "<li>".$r."</li>";
                endforeach; 
            ?>
            </td>
          </tr>

          <tr class="spaceUnder">
            <td>Nombre Responsable a Cargo: </td>
            <td colspan="2">{{$data['responsable']}}</td>
          </tr>

          <tr class="spaceUnder">
            <td>Cargo que desempeña: </td>
            <td colspan="2">{{$data['cargo']}}</td>
          </tr>

          <tr class="spaceUnder">
            <td>Lugar: </td>
            <td colspan="2">{{$data['lugar']}}</td>
          </tr>

          <tr><td colspan="4"><hr></td></tr>

          <tr class="spaceUnder">
            <td>Detalle: </td>
            <td colspan="3"></td>
          </tr>
          <tr>
          <td colspan="4" rowspan="2">{{$data['detalle']}}</td>
          </tr>

          <tr></tr>

          <footer>
            <table border="0">
              <tr>
                <td style="padding-right: 200px"></td>
                <td style="padding-right: 250px"></td>
                <td style="padding-right: 200px"></td>
              </tr> 
              <tr>
                <td style="padding-left: 0px"><hr class="style1"></td>
                <td></td>
                <td style="padding-left: 0px"> <hr class="style1"> </td>
              </tr>     
              <tr>
                <td style="padding-left: 60px">Firma Receptor</td>
                <td ></td>
                <td style="padding-left: 60px">Firma Conforme</td>
              </tr>            
            </table>
          </footer>

      </table>

    </center>
 
  </body>
</html>
