@extends('includes.header')
@section('content')
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Historial de Dependencia</h3>
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

                                  @if($admin==TRUE)

                                    @if($d->status=='CERRADO')

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
                                        </td>
                                      </tr>

                                    @endif

                                  @elseif($d->createdby==$user || $d->ad_user_id==$user)

                                    @if($d->status=='CERRADO')

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
                                        </td>
                                      </tr>

                                    @endif

                                  @endif

                                @endforeach
                              </tbody>
                            </table>
                          </div><!-- /.box-header -->
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