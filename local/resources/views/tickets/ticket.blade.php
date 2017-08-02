@extends('includes.header')
@section('content')
<!-- page content -->
        <div class="right_col" role="main" >
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

                          <div class="box-header with-border">
                            <table width="100%" height="100%" id="ticketdata" class="table">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Usuario</th>
                                  <th>Asignado</th>
                                  <th>Tipo</th>
                                  <th>Categoria</th>
                                  <th>Lugar</th>
                                  <th>Estado</th>
                                  <th>Hora Creación</th>
                                  <th>Acción</th>
                                </tr>
                              </thead>

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