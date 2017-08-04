@extends('includes.header')
@section('content')
<!-- page content -->
        <div class="right_col" role="main" style="min-height: 771px;">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Reporte Excel</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <ol class="breadcrumb">
                        <li class="active"></li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <?php /*?><div class="x_title">
                    <h2></h2>
                    <div class="clearfix"></div>
                   </div>
                   <?php */?>
                   <div class="x_content">
                      <div class="row">
                            
                        <!-- Your Page Content Here -->
        
            <div class="box-header with-border">
                <h3 class="box-title">Busqueda de Reporte en Excel</h3>
                <hr/>
              <form action="{{url('reportexcel')}}" method="POST">
              
                         <table style="width: 60%">
                            <tr>
                                <td style="margin: 7px;padding: 7px;width: 250px;" align="center">Fecha Inicio</td>
                                <td style="margin: 7px;padding: 7px;width: 250px;" align="center">Fecha Fin</td>
                                <td style="margin: 7px;padding: 7px;width: 80px;"></td>
                                <td style="margin: 7px;padding: 7px;width: 80px;"></td>
                            </tr>
                            <tr>
                                <td align="center" style="margin: 7px;padding: 7px;">
                                  <input class="form-control form_date" type="text" name="fecha_inicio" style="width: 250px;">
                                </td>
                                <td align="center" style="margin: 7px;padding: 7px;">
                                  <input class="form-control form_date" type="text" name="fecha_fin" style="width: 250px;">
                                </td>
                                <td align="center" style="margin: 7px;padding: 7px;">
                                  <div class="form-group">
                                    <div class="iradio_flat-green">
                                      <label>
                                        <input type="radio" class="flat" checked name="radio" value="1">Tickets
                                      </label>
                                    </div>
                                  </div>
                                </td>
                                <td align="center" style="margin: 7px;padding: 7px;">
                                  <div class="form-group">
                                      <div class="iradio_flat-green">
                                        <label>
                                          <input type="radio" class="flat" name="radio" value="2">Dependencias
                                        </label>
                                      </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="padding: 15px;" colspan="1" align="center"><button class="btn btn-primary btn-block">Buscar</button></td>
                            </tr>
                        </table>
                  {{csrf_field()}}
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
        </div>
        <!-- /page content -->
@endsection