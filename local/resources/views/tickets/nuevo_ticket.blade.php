@extends('includes.header')
@section('content')
<!-- page content -->
        <div class="right_col" role="main">

            <div class="page-title">
              <div class="title_left">
                <h3>Crear Nueva Solicitud de Tickets</h3>
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
                            <form action="{{url('crear_tickets')}}" id="formulario" method="POST">

                              <div class="row show-grid">
                                  <div class="span4">Tipo</div>
                                  <div class="span5"> 
                                    <select name="tipo" id="tipo" class="form-control" onchange="carga_categoria();" required="required">
                                      <option value="">Seleccione</option>
                                      <option value="1">Informática</option>
                                      <option value="2">Mantención</option>
                                    </select>
                                  </div>
                                </div><br>

                                <div class="row show-grid">
                                  <div class="span4">Dependencia</div>
                                  <div class="span5"> 
                                    <select name="lugar" id="lugar" class="form-control" required>
                                      <option value="">Seleccione</option>
                                      <option value="0">Otro</option>
                                      @foreach ($eo_grade as $eo)
                                        <option value="{{$eo->id}}">{{$eo->name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div><br>

                              <div id="otro_lugar_div" hidden="hidden">
                                <div class="row show-grid" >
                                  <div class="span4">Otra Dependencia</div>
                                  <div class="span5"> 
                                   <input type="text" name="otro_lugar" class="form-control" id="otro_lugar" style="width: 100%;">
                                  </div>
                                </div><br>
                              </div>

                                <div class="row show-grid">
                                  <div class="span4">Categoria</div>
                                  <div class="span5"> 
                                    <select name="categoria" id="categoria" class="form-control" required="required">
                                    </select>
                                  </div>
                                </div><br>

                                <div id="otra_categoria_div" hidden="hidden">
                                <div class="row show-grid">
                                  <div class="span4">Otra Categoria</div>
                                  <div class="span5"> 
                                   <input type="text" name="otra_categoria" class="form-control" id="otra_categoria" style="width: 100%;">
                                  </div>
                                </div><br>
                                </div>

                                <div class="row show-grid">
                                  <div class="span4">Mensaje</div>
                                  <div class="span5"> 
                                    <textarea class="form-control" name="mensaje" id="mensaje" rows="10" maxlength="500" required="required"></textarea>
                                  </div>
                                </div><br>

                                {{csrf_field()}}

                                <div class="row show-grid">
                                  <div class="span4"></div>
                                  <div class="span5"> 
                                    <input type="submit" id="new_ticket" class="btn btn-primary btn-block">
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