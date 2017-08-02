@extends('includes.header')
@section('content')
<?php $count=1;?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Listado de Tickets</h3>
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
                              
                            </tr>
                          </tbody>
                        </table>

                          <div class="box-header with-border">
                            <table width="100%" height="100%" class="table table-hover table-condensed">
                              <thead>
                                <tr>
                                  <td>#</td>
                                  <td>Usuario</td>
                                  <td>Asignado</td>
                                  <td>Tipo</td>
                                  <td>Categoria</td>
                                  <td>Lugar</td>
                                  <td>Estado</td>
                                  <td>Hora Creación</td>
                                  <td>Acción</td>
                                </tr>
                              </thead>
                              <tbody>
                                
                                <tr class="tbody">
                                  <td>{{$tk['cpv_tickets_id']}}</td>
                        
                                  <td>
                                  {{$tk['createdby']}}
                                  </td>

                                  <td>
                                  {{$tk['ad_user_id']}}
                                  </td>

                                  <td>{{$tk['type']}}</td>
                                  <td>{{$tk['category']}}</td>
                                  <td>{{$tk['location']}}</td>
                                  <td>
                                  @if ($tk['status']=='ABIERTO')
                                    <span class="label label-success">ABIERTO</span>
                                  @else
                                    <span class="label label-danger">CERRADO</span>
                                  @endif
                                  </td>
                                  <td>{{date_format(date_create($tk['created']),"d-m-Y H:i:s")}}</td>
                                  <td> 
                                  <button class="btn btn-info" onclick="VerTicket('{{URL::to('/')}}/pdf/tickets-','<?php echo $tk['cpv_tickets_id']; ?>');" > <span class="fa fa-eye"> Ver</span>
                                  </button>
                                  {{$tk['ad_user_id']}}
                                  <button class="btn btn-danger" onclick="DelTicket('<?php echo $tk['cpv_tickets_id']; ?>');" data-toggle="modal" data-target="#ModalCerrar"> <span class="fa fa-window-close"> Cerrar</span></button> 
                               
                                  </td>
                                </tr>
                            
                              </tbody>
                            </table>
                          </div><!-- /.box-header -->

                         

                         

                          <div class="modal fade" id="ModalCerrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h3 class="modal-title" style="color: white;">Cierre de Tickets</h3>
                                </div>
                                <div class="modal-body">
                                <div class="span5"><h2>Detalle de lo utilizado para dar conclusión al ticket</h2></div>
                                
                                <div class="row show-grid">
                                  <div class="span4"> <h3>Comentario</h3></div>
                                  <div class="span5"> 
                                    <textarea class="form-control" name="mensaje" id="mensaje" rows="10" maxlength="500" required="required"></textarea>
                                  </div>
                                </div><br>

                                <input type="hidden" name="id_tick" id="id_tick" value="">

                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-danger" id="load" data-dismiss="modal" onclick="CerrarTicket();">Cerrar Ticket</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                                </div>
                              </div>
                            </div>
                          </div>

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