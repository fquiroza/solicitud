@extends('includes.header')
@section('content')
<!-- page content -->
        <div class="right_col" role="main" style="min-height: 771px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Historial de Tickets</h3>
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
                            <table width="100%" height="100%" id="ticket">
                              <thead>
                                <tr>
                                  <td>ID</td>
                                  <td>Usuario</td>
                                  <td>Asignado</td>
                                  <td>Tipo</td>
                                  <td>Categoria</td>
                                  <td>Lugar</td>
                                  <td>Estado</td>
                                  <td>Hora Creación</td>
                                  <td>Hora Cierre</td>
                                  <td>Acción</td>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($ticket as $t)

                                @if($admin==TRUE)

                                  @if($t->status=='CERRADO')
                                    <tr class="tbody">
                                      <td>{{$t->cpv_tickets_id}}</td>

                                      <td>
                                      @foreach ($ad_user as $ad)
                                        @if($t->createdby==$ad->id)
                                          {{$ad->name}}
                                        @endif
                                      @endforeach
                                      </td>

                                      <td>
                                      @foreach ($ad_user as $ad)
                                        @if($t->ad_user_id==$ad->id)
                                          {{$ad->name}}
                                        @endif
                                      @endforeach
                                      </td>

                                      <td>{{$t->type}}</td>
                                      <td>{{$t->category}}</td>
                                      <td>{{$t->location}}</td>
                                      <td>
                                      @if ($t->status=='ABIERTO')
                                        <span class="label label-success">ABIERTO</span>
                                      @else
                                        <span class="label label-danger">CERRADO</span>
                                      @endif
                                      </td>
                                      <td>{{date_format(date_create($t->created),"d-m-Y H:i:s")}}</td>
                                      <td>{{date_format(date_create($t->updated),"d-m-Y H:i:s")}}</td>
                                      <td> 
                                      <button class="btn btn-info" onclick="VerTicket('<?php echo $t->cpv_tickets_id; ?>');"> <span class="fa fa-eye"> Ver</span>
                                      </button>
                                      </td>
                                    </tr>
                                    @endif

                                  @elseif($t->createdby==$user || $t->ad_user_id==$user)

                                    @if($t->status=='CERRADO')
                                    <tr class="tbody">
                                      <td>{{$t->cpv_tickets_id}}</td>

                                      <td>
                                      @foreach ($ad_user as $ad)
                                        @if($t->createdby==$ad->id)
                                          {{$ad->name}}
                                        @endif
                                      @endforeach
                                      </td>

                                      <td>
                                      @foreach ($ad_user as $ad)
                                        @if($t->ad_user_id==$ad->id)
                                          {{$ad->name}}
                                        @endif
                                      @endforeach
                                      </td>

                                      <td>{{$t->type}}</td>
                                      <td>{{$t->category}}</td>
                                      <td>{{$t->location}}</td>
                                      <td>
                                      @if ($t->status=='ABIERTO')
                                        <span class="label label-success">ABIERTO</span>
                                      @else
                                        <span class="label label-danger">CERRADO</span>
                                      @endif
                                      </td>
                                      <td>{{date_format(date_create($t->created),"d-m-Y H:i:s")}}</td>
                                      <td>{{date_format(date_create($t->updated),"d-m-Y H:i:s")}}</td>
                                      <td> 
                                      <button class="btn btn-info" onclick="VerTicket('<?php echo $t->cpv_tickets_id; ?>');" > <span class="fa fa-eye"> Ver</span>
                                      </button>
                                      </td>
                                    </tr>
                                    @endif

                                @endif

                              @endforeach
                              </tbody>
                            </table>
                          </div><!-- /.box-header -->
                        <div class="box-body"  id="contenidoWeb">
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