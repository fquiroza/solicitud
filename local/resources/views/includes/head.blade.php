<!DOCTYPE html>
<html lang="en">
<!-- Desarrollo por Franco Quiroz -->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!! Session::token() !!}">

    <title>Colegio Pedro De Valdivia | </title>
      <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('frontend/sistema/css/bootstrap-responsive.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- iCheck -->
    <link href="{{ asset('frontend/sistema/js/iCheck/skins/flat/green.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('frontend/sistema/css/custom.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link href="{{ asset('frontend/datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
      
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/jquery.maxlength.css">

    <style>
      .datetimepicker {
      /* Appended to body, abs-pos off the page */
        position: absolute;
        display: none;
        top: -9999em;
        left: -9999em;
      }
      button.btn {
        height: 100%;
      }
      .modal-header {
        background: green;
      }
      #WindowLoad
      {
          position:fixed;
          top:0px;
          left:0px;
          z-index:3200;
          filter:alpha(opacity=65);
         -moz-opacity:65;
          opacity:0.65;
          background:#999;
      }
    </style>

</head>

<body class="nav-sm">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('home')}}" class="site_title"><i class="fa fa-mortar-board"></i> <span>CPDV!</span></a>
            </div>

            <div class="clearfix"></div>
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="{{url('home')}}"><i class="fa fa-home"></i> Home </a></li>
                </ul>
              </div>
                
              <div class="menu_section">
                <h3>Tickets</h3>
                <ul class="nav side-menu">
                  <li><a href="{{url('crear_tickets')}}"><i class="fa fa-star"></i>Realizar Solicitud</a>
                  </li>
                  <li><a href="{{url('listar_tickets')}}"><i class="fa fa-bar-chart"></i>Solicitudes Activas</a>
                  </li>
                  <li><a href="{{url('historial_tickets')}}"><i class="fa fa-server"></i>Historial de Solicitud</a>
                  </li>
                </ul>
              </div>

              <div class="menu_section">
                <h3>Dependencia</h3>
                <ul class="nav side-menu">
                  <li><a href="{{url('crear_dependencia')}}"><i class="fa fa-star"></i>Realizar Solicitud</a>
                  </li>
                  <li><a href="{{url('listar_dependencia')}}"><i class="fa fa-bar-chart"></i>Solicitudes Activas</a>
                  </li>
                  <li><a href="{{url('historial_dependencia')}}"><i class="fa fa-server"></i>Historial de Solicitud</a>
                  </li>
                </ul>
              </div>

            </div>
          </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  @if (Session::has('admin'))
                    Admin
                  @endif  
                  <i class="fa fa-child"></i>
                  @if (Session::has('name'))
                    {{Session::get('name')}}
                  @endif  
                  <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{url('logout')}}"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        @yield('content')

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <strong>Copyright &copy; 2016-2017 <a href="#">Colegio Pedro De Valdivia</a>.</strong> All rights reserved.
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
  <!-- jQuery -->
    <script src="{{ asset('frontend/sistema/js/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('frontend/sistema/js/bootstrap.min.js') }}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('frontend/sistema/js/custom.min.js') }}"></script>

    <script src="//code.jquery.com/jquery-1.12.4.js"></script>

    <script
        src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
        crossorigin="anonymous"></script>
    
        <!-- jQuery 2.1.4 -->
     <!--<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script> -->
    <!-- AdminLTE App -->
    <script src="{{asset('frontend/sistema/js/app.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('frontend/datetimepicker/js/bootstrap-datetimepicker.js')}}" charset="UTF-8"></script>
    <script type="text/javascript" src="{{asset('frontend/datetimepicker/js/locales/bootstrap-datetimepicker.es.js')}}" charset="UTF-8"></script>

    <script src="{{asset('frontend/sistema/js/carga_datos.js')}}"></script>

    <script type="text/javascript" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend/sistema/js/jquery.plugin.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/sistema/js/jquery.maxlength.js')}}"></script>

    <script type="text/javascript">
      $(".form_datetime").datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:  'es',
        weekStart: 1,
        autoclose: 1
      });
    </script>

    <script type="text/javascript">
      function carga_categoria()
      {
        var option = document.getElementById("tipo").selectedIndex;
        if(option==""){reset();}
        if(option==1){reset();informatica();}
        if(option==2){reset();mantencion();}
      }
      function reset()
      {
        document.getElementById('categoria').innerHTML="";
        opcion0=new Option("Seleccionar","");
        document.forms.formulario.categoria.options[0]=opcion0;
      }
    </script>

    <script type="text/javascript">
      function VerTicket(id){
        window.open('{{URL::to('/')}}/pdf/tickets-' + id + '.pdf', "PDF");
      } 
    </script>

    <script type="text/javascript">
      function DelTicket(id){

        document.getElementById("id_tick").value=id;

      } 
    </script>

    <script type="text/javascript">
      function CerrarTicket(){
        id = document.getElementById("id_tick").value;
        comentario = document.getElementById("mensaje").value;

        if (id!="" && comentario!="") 
        {
          cargando();
          $.ajax({
            url: "{{ asset('DelTicket') }}",
            type: 'post',
            data : {
                    _token : $('meta[name=csrf-token]').attr('content'),
                    'id' : id,
                    'mensaje' : comentario
                  },
            success:function(data){
              location.reload();
            }
        });

        }else
        {
          alert('Por favor rellene el comentario de la terminacion de ticket con los instrumentos que necesito');
        }
      } 
    </script>

        <script type="text/javascript">
      function VerDependencia(id){
        window.open('{{URL::to('/')}}/pdf/tickets-' + id + '.pdf', "PDF");
      } 
    </script>

    <script type="text/javascript">
      function DelDependencia(id){

        document.getElementById("id_dep").value=id;

      } 
    </script>

    <script type="text/javascript">
      function CerrarDependencia(){
        id = document.getElementById("id_dep").value;
        comentario = document.getElementById("comentario").value;

        if (id!="" && comentario!="") 
        {
          cargando();

          $.ajax({
            url: "{{ asset('DelDependencia') }}",
            type: 'post',
            data : {
                    _token : $('meta[name=csrf-token]').attr('content'),
                    'id' : id,
                    'comentario' : comentario
                  },
            success:function(data){
              location.reload();
            }
        });

        }else
        {
          alert('Por favor rellene el comentario de la terminacion de dependencia con los instrumentos que necesito');
        }
      } 
    </script>

  <script type="text/javascript">
    $(document).ready(function() {
        $('#lugar').change(function(){
            $("#lugar option:selected").each(function() {
            var valorCambiado =$('#lugar').val();
                if(valorCambiado == '0'){

                    $('#otro_lugar_div').css('display','block');
                }
                else
                {
                    $('#otro_lugar_div').css('display','none');
                }
            });
        });
    });
  </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#categoria').change(function(){
            $("#categoria option:selected").each(function() {
            var valor =$('#categoria').val();
                if(valor == '0'){

                    $('#otra_categoria_div').css('display','block');
                }
                else
                {
                    $('#otra_categoria_div').css('display','none');
                }
            });
        });
    });
  </script> 

  <script type="text/javascript">
    $( "#new_dependencia" ).click(function() {
      if(document.getElementById("lugar").selectedIndex!="")
      {
        if(document.getElementById("fecha_desde").value!="")
        {
          if(document.getElementById("fecha_hasta").value!="")
          {
            if(document.getElementById("responsable").value!="")
            {
              if(document.getElementById("cargo").value!="")
              {
                  if(document.getElementById("detalle").value!="")
                  {
                    cargando();
                  }
              }
            }
          }
        }
      }

    });
  </script>

  <script type="text/javascript">
    $( "#new_ticket" ).click(function() {
      if(document.getElementById("lugar").selectedIndex!="")
      {
        if(document.getElementById("tipo").selectedIndex!="")
        {
          if(document.getElementById("categoria").selectedIndex!="")
          {
            if(document.getElementById("mensaje").value!="")
            {
                cargando();
            }
          }
        }
      }

    });
  </script>

  <script type="text/javascript">
  function cargando(){
      //si no enviamos mensaje se pondra este por defecto
      mensaje = "Procesando la información<br>Espere por favor";
   
      //centrar imagen gif
      height = 20;//El div del titulo, para que se vea mas arriba (H)
      var ancho = 0;
      var alto = 0;
   
      //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
      if (window.innerWidth == undefined) ancho = window.screen.width;
      else ancho = window.innerWidth;
      if (window.innerHeight == undefined) alto = window.screen.height;
      else alto = window.innerHeight;
   
      //operación necesaria para centrar el div que muestra el mensaje
      var heightdivsito = alto/2 - parseInt(height)/2;//Se utiliza en el margen superior, para centrar
   
     //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
      imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div id='loading' style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div><img  src='{{asset('frontend/sistema/img/loading.gif')}}'></div>";
   
          //creamos el div que bloquea grande------------------------------------------
          div = document.createElement("div");
          div.id = "WindowLoad"
          div.style.width = ancho + "px";
          div.style.height = alto + "px";
          $("body").append(div);
   
          //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
          input = document.createElement("input");
          input.id = "focusInput";
          input.type = "text"
   
          //asignamos el div que bloquea
          $("#WindowLoad").append(input);
   
          //asignamos el foco y ocultamos el input text
          $("#focusInput").focus();
          $("#focusInput").hide();
   
          //centramos el div del texto
          $("#WindowLoad").html(imgCentro);

          setTimeout(function() {document.getElementById('loading').innerHTML = 'Cargando datos a PDF';},10000);
          setTimeout(function() {document.getElementById('loading').innerHTML = 'Cargando Email';},20000);
          setTimeout(function() {document.getElementById('loading').innerHTML = 'Enviando Email';},30000);
  }
  </script> 

  <script type="text/javascript">
    document.getElementById("message_boton").click();
  </script>  

  <script type="text/javascript">
    $(document).ready(function(){
      $('#ticketdata').DataTable({
        "order": [[ 0, "desc" ]],
        "language": {url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json'},
        "processing": true,
        "serverSide": true,
        "ajax": {'url': '{{asset("generade")}}'},
        "columns":[
          {data: 'cpv_tickets_id'},
          {data: 'createdby'},
          {data: 'ad_user_id'},
          {data: 'type'},
          {data: 'category'},
          {data: 'location'},
          {targets: -1,
           data: null,
           render: function(data, type, full, meta){
               if(type === 'display'){data = "<span class='label label-success'>"+data.status+"</span>";}return data;
            }
          },
          {data: 'created'},
          {targets: -1,
           data: null,
           render: function(data, type, full, meta){
            
              switch(data.user) {

                 case data.ad_user : return "<button class='btn btn-info' onclick='VerTicket("+data.cpv_tickets_id+");' ><span class='fa fa-eye'> Ver</span></button><button class='btn btn-danger' onclick='DelTicket("+data.cpv_tickets_id+");' data-toggle='modal' data-target='#ModalCerrar'> <span class='fa fa-window-close'> Cerrar</span></button>"; break;

                 default  : return "<button class='btn btn-info' onclick='VerTicket("+data.cpv_tickets_id+");' ><span class='fa fa-eye'> Ver</span></button>";
              }
            }
          }
        ]
      });
    });
  </script>

    <script type="text/javascript">
    $(document).ready(function(){
      $('#ticket').DataTable({
        "order": [[ 0, "desc" ]]
      });
    });

  </script>



  <script type="text/javascript">
    $('#detalle').maxlength();
    $('#mensaje').maxlength();
    $.maxlength.setDefaults({showFeedback: true});
  </script>


  </body>
</html>
