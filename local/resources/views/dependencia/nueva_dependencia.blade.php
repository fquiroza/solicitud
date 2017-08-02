@extends('includes.header')
@section('content')
<!-- page content -->
        <div class="right_col" role="main">

            <div class="page-title">
              <div class="title_left">
                <h3>Crear Nueva Solicitud de Dependencia</h3>
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
                            <form action="{{url('crear_dependencia')}}" id="formulario" method="POST">

                                <div class="row show-grid">
                                  <div class="span4">Lugar</div>
                                  <div class="span5"> 
                                    <select name="lugar" id="lugar" class="form-control" required="required">
                                      <option value="">Seleccione</option>
                                      <option value="0">Otro</option>
                                      <option value="1">Auditorio</option>
                                      <option value="2">Sala</option>
                                      <option value="3">Bliblioteca</option>
                                      <option value="4">Cancha</option>
                                      <option value="5">Patio</option>
                                      <option value="6">Cuadrante</option>
                                    </select>
                                  </div>
                                </div><br>

                              <div id="otro_lugar_div" hidden="hidden">
                                <div class="row show-grid" >
                                  <div class="span4">Otro Lugar</div>
                                  <div class="span5"> 
                                   <input type="text" name="otro_lugar" class="form-control" id="otro_lugar" style="width: 100%;">
                                  </div>
                                </div><br>
                              </div>

                                <div class="row show-grid">
                                  <div class="span4">Fecha desde</div>
                                  <div class="span5"> 
                                    <input class="form-control form_datetime"  data-date-format="yyyy-mm-dd hh:ii" type="text" name="fecha_desde" id="fecha_desde" style="width:100%" required>
                                  </div>
                                </div><br>

                                <div class="row show-grid">
                                  <div class="span4">Fecha Hasta</div>
                                  <div class="span5"> 
                                    <input class="form-control form_datetime"  data-date-format="yyyy-mm-dd hh:ii" type="text" name="fecha_hasta" id="fecha_hasta" style="width:100%" required>
                                  </div>
                                </div><br>

                                <div class="row show-grid">
                                  <div class="span4">Nombre Responsable a Cargo</div>
                                  <div class="span5"> 
                                   <input type="text" name="responsable" class="form-control" id="responsable" style="width: 100%;" maxlength="50" required="required">
                                  </div>
                                </div><br>

                                <div class="row show-grid">
                                  <div class="span4">Cargo que desempeña</div>
                                  <div class="span5"> 
                                   <input type="text" name="cargo" class="form-control" id="cargo" maxlength="250" style="width: 100%;" required="required">
                                  </div>
                                </div><br>

                                <div class="row show-grid">
                                  <div class="span4">Requerimiento</div>
                                  <div class="span5 boxes"> 
                                    <input type="checkbox" name="cuentas[]" value="1">Audio<br/>
                                    <input type="checkbox" name="cuentas[]" value="2">PC<br/>
                                    <input type="checkbox" name="cuentas[]" value="3">Data<br/>
                                    <input type="checkbox" name="cuentas[]" value="4">Amplificación<br/>
                                  </div>
                                </div><br>

                                <div class="row show-grid">
                                  <div class="span4">Detalle</div>
                                  <div class="span5"> 
                                    <textarea class="form-control" name="detalle" id="detalle" rows="10" maxlength="490" required="required"></textarea>
                                  </div>
                                </div><br>

                                {{csrf_field()}}

                                <div class="row show-grid">
                                  <div class="span4"></div>
                                  <div class="span5"> 
                                    <input type="submit" class="btn btn-primary btn-block" id="new_dependencia">
                                  </div>
                                </div><br>

                                
                            </form> 
                          </div><!-- /.box-header -->
                        <div class="box-body">
                          <div class="auto_box">
                                

                          </div><!-- /.box -->  
                        </div>
                        <div class="box-footer clearfix">

                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>

        </div>
        <!-- /page content -->
@endsection