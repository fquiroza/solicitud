@extends('includes.header')
@section('content')
<?php $count=1;?>
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
                        <table align="right" >
                          <tbody>
                            <tr>
                              <td style="padding: 15px;"> <button class="btn btn-info" onclick="location.reload();"><span class="fa fa-refresh"> Recargar</span></button> </td>
                              <td style="padding-right: 100px;">
                              <td style="padding: 15px; width: 200px">{{ $dependencia->links() }}</td>
                            </tr>
                          </tbody>
                        </table>

                          <div class="box-header with-border">
                            <table width="100%" height="100%">
                              <thead>
                                <tr>
                                  <td>#</td>
                                  <td>Usuario</td>
                                  <td>Asignado</td>
                                  <td>F. Solicitud</td>
                                  <td>Requerimiento</td>
                                  <td>Lugar</td>
                                  <td>Hora Inicio</td>
                                  <td>Hora Fin</td>
                                  <td>Estado</td>
                                  <td>Acción</td>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($dependencia as $d)
                                <tr class="tbody">
                                  <td><?php echo $count++; ?></td>

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
                                  <td>{{$d->fecha_desde}}</td>
                                  <td>{{$d->fecha_hasta}}</td>
                                  <td>
                                  @if ($d->status=='ABIERTO')
                                    <span class="label label-success">ABIERTO</span>
                                  @else
                                    <span class="label label-danger">CERRADO</span>
                                  @endif
                                  </td>
                                  <td> 
                                  <button class="btn btn-info" onclick="VerDependencia('{{URL::to('/')}}/pdf/dependencia-','<?php echo $d->cpv_dependencia_id; ?>');" > <span class="fa fa-eye"> Ver</span>
                                  </button>
                                  </td>
                                </tr>
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