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

        </style>
</head>
<body> 
    <center>

      <table border="0" width="100%" height="100%">
          <tr class="space">
            <td colspan="2"><img src="{{asset('frontend/sistema/img/logo2.png')}}" height="65px" width="270px"></td>
            <td colspan="2"><h4>Ticket N° {{$data['numero']}}</h4><h4>Fecha Solicitud: {{date_format(date_create($data['fecha']),"d-m-Y H:i")}}</h4></td>
          </tr>

          <tr class="space">
            <td width="150px"></td>
            <td colspan="2"> <center><h3>Orden de Trabajo</h3></center></td>
            <td></td>
          </tr>

          <tr class="spaceUnder">
            <td width="150px">Nombre Solicitante: </td>
            <td>{{$data['solicitante']}}</td>
            <td>Categoria: </td>
            <td>{{$data['categoria']}}</td>
          </tr>

          <tr class="spaceUnder">
            <td>Nombre a Cargo: </td>
            <td>{{$data['cargo']}}</td>
            <td>Dependencia: </td>
            <td>{{$data['lugar']}}</td>
          </tr>

          <tr><td colspan="4"><hr></td></tr>

          <tr class="spaceUnder">
            <td>Detalle: </td>
            <td colspan="3"></td>
          </tr>
          <tr>
          <td colspan="4" rowspan="2">{{$data['detalle']}}</td>
          </tr>

          <tr>
            
          </tr>

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
