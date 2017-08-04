@extends('includes.header')
@section('content')
<!-- page content -->
        <div class="right_col" role="main" style="min-height: 771px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Listado de Dependencia</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">

                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                   <div class="x_content">
                      <div class="row">
                        <!-- Your Page Content Here -->
                          <div class="box-header with-border">
                            <table width="100%" height="100%" id="dependencia">
                              <thead>
                                <tr>
                                  <td>ID</td>
                                  <td>Usuario</td>
                                  <td>Asignado</td>
                                  <td>F. Solicitud</td>
                                  <td>Requerimiento</td>
                                  <td>Lugar</td>
                                  <td>Fecha Inicio</td>
                                  <td>Fecha Fin</td>
                                  <td>Estado</td>
                                  <td>Acción</td>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($dependencia as $d)
                                      <tr>
                                        <td>{{$d->cpv_dependencia_id}}</td>

                                        <td>
                                        @foreach ($ad_user as $ad)
                                          @if($d->createdby==$ad->id)
                                            {{$ad->name}}
                                          @endif
                                        @endforeach
                                        </td>

                                        <td>
                                        @foreach ($ad_user as $ad)
                                          @if($d->ad_user_id==$ad->id)
                                            {{$ad->name}}
                                          @endif
                                        @endforeach
                                        </td>

                                        <td>{{date_format(date_create($d->created),"d-m-Y H:i")}}</td>
                                        <td>{{$d->requerimiento}}</td>
                                        <td>{{$d->location}}</td>
                                        <td>{{date_format(date_create($d->fecha_desde),"d-m-Y H:i")}}</td>
                                        <td>{{date_format(date_create($d->fecha_hasta),"d-m-Y H:i")}}</td>
                                        <td>
                                        @if ($d->status=='ABIERTO')
                                          <span class="label label-success">ABIERTO</span>
                                        @else
                                          <span class="label label-danger">CERRADO</span>
                                        @endif
                                        </td>
                                        <td> 
                                        <button class="btn btn-info" onclick="VerDependencia('<?php echo $d->cpv_dependencia_id; ?>');" > <span class="fa fa-eye"> Ver</span>
                                        </button>
                                        @if($user==$d->ad_user_id)
                                        <button class="btn btn-danger" onclick="DelDependencia('<?php echo $d->cpv_dependencia_id; ?>');" data-toggle="modal" data-target="#ModalCerrar"> <span class="fa fa-window-close"> Cerrar</span></button> 
                                        @endif
                                        </td>
                                      </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div><!-- /.box-header -->

                          @if($message!=null)
                              <button class="btn btn-info" id="message_boton" data-toggle="modal" data-target="#ModalAlert" style="display: none;"></button>
                          @endif

                          <div class="modal fade" id="ModalAlert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h3 class="modal-title" style="color: white;">ALERTA</h3>
                                </div>
                                <div class="modal-body">

                                <h3>Email {{$message}}</h3>

                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="modal fade" id="ModalCerrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h3 class="modal-title" style="color: white;">Cierre de Dependencias</h3>
                                </div>
                                <div class="modal-body">
                                <div class="span5"><h2>Detalle de lo utilizado para dar conclusión a la dependencia</h2></div>
                                
                                <div class="row show-grid">
                                  <div class="span4"> <h3>Comentario</h3></div>
                                  <div class="span5"> 
                                    <textarea class="form-control" name="comentario" id="comentario" rows="10" maxlength="500" required="required"></textarea>
                                  </div>
                                </div><br>

                                <input type="hidden" name="id_dep" id="id_dep" value="">

                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger" id="load" data-dismiss="modal" onclick="CerrarDependencia();">Cerrar Dependencia</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                                </div>
                              </div>
                            </div>
                          </div>

                        <div class="box-body">
                          <div class="auto_box">
                                
                          </div><!-- /.box -->  
                        </div>
                        <div class="box-footer clearfix">
                        </div>
                      </div>
                  </div>
                  <br><br>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@endsection