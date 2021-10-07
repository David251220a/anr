<!DOCTYPE html>
<html>
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- APIToken -->    
    
    <title>ANR | www.anr.com</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
   <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
   <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> 
   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
   {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
  

   <link rel="stylesheet" href="{{asset('css/form-step.css')}}">

   <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">

  </head>
  <body class="hold-transition skin-red sidebar-mini">

    <div class="wrapper">
      
      <header class="main-header ">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>ANR</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>ANR</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  @if (Auth::user())
                  
                    <small class="bg-red">Online</small>
                    <span class="hidden-xs">{{ Auth::user()->name}}</span>

                  @endif
                  
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    @if (Auth::user())
                      <p>
                        {{ Auth::user()->name }}
                        <small>Sistema Desarrollado</small>
                      </p>    
                    @endif
                    
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                    <a href="{{url ('/logout')}}" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
          
        
      </header>
      <!-- Left side column. contains the logo and sidebar -->      
      @if (Auth::user())

        <aside class="main-sidebar">
          <!-- sidebar: style can be found in sidebar.less -->
          <section class="sidebar">
            <!-- Sidebar user panel -->

            <!-- sidebar menu: : style can be found in sidebar.less -->          
            <ul class="sidebar-menu">
              <li class="header"></li>
              
              <li id="votacion" name="votacion" class="treeview">
                <a href="#">
                  <i class="fa fa-user-o"></i>
                  <span>Votacion</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="{{url('votacion/intendente')}}"><i class="fa fa-circle-o"></i> Intendente</a></li>
                  <li><a href="{{url('votacion/consejal')}}"><i class="fa fa-circle-o"></i> Consejal</a></li>
                </ul>
              </li>

              <li id="consulta" name="consulta" class="treeview">
                <a href="#">
                  <i class="fa fa-inbox"></i>
                  <span>Consulta</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">

                  <li id="padron"><a href="{{ route('consulta.index') }}"><i class="fa fa-circle-o"></i> Padron Comp</a></li>
                  <li id="padron_ver"><a href="{{ route('consulta.padron') }}"><i class="fa fa-circle-o"></i>Padron</a></li>
                  <li id="padron_voto"><a href="{{ route('consulta.voto_padron') }}"><i class="fa fa-circle-o"></i>Padron Voto</a></li>
                  <li id="padron_cel"><a href="{{ route('consulta.padron_celular') }}"><i class="fa fa-circle-o"></i>Padron Cel</a></li>
                  <li id="referente"><a href="{{ route('consulta.referente') }}"><i class="fa fa-circle-o"></i>Referentes</a></li>
                  @if (Auth::user())

                    @if ((Auth::user()->id == 1) ||  (Auth::user()->id == 2))

                      <li id="referente_intendente"><a href="{{ route('consulta.referente_intendente') }}"><i class="fa fa-circle-o"></i>Referentes Inte</a></li>
                    
                      @endif
                      
                  @endif
                  
                  @if (Auth::user())

                    @if ((Auth::user()->id == 1) ||  (Auth::user()->id == 2))

                      <li id="referente_consejal"><a href="{{ route('consulta.referente_consejal') }}"><i class="fa fa-circle-o"></i>Referentes Consejal</a></li>
                    
                      @endif
                      
                  @endif

                  <li id="aporedados"><a href=" {{ route('consulta.aporedado') }} "><i class="fa fa-circle-o"></i>Aporedados</a></li>
                  <li id="mesa"><a href="{{ route('electores') }}"><i class="fa fa-circle-o"></i> Mesa Habilitadas</a></li>
                  <li id="integrante_mesa"><a href="{{ route('consulta.integrante_mesa') }}"><i class="fa fa-circle-o"></i> Integrante Mesa</a></li>
                  <li id="voto_intendente"><a href="{{url('consulta/votos_intendente')}}"><i class="fa fa-circle-o"></i> Votos Intendente</a></li>                
                  <li id="voto_consejal"><a href="{{url('consulta/votos_consejal')}}"><i class="fa fa-circle-o"></i> Votos Consejal</a></li>
                  
                </ul>
              </li>                       

              <li id="reportes" name="reportes" class="treeview">
                <a href="#">
                  <i class="fa fa-folder"></i> <span>Reportes</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  
                  <li id="#"><a href="{{route('reportes.intendente')}}"><i class="fa fa-circle-o"></i> Intendente</a></li>
                  <li id="#"><a href="{{route('reportes.intendente_resumen')}}"><i class="fa fa-circle-o"></i> Intendente - General</a></li>
                  <li id="#"><a href="{{route('reportes.intendente_local')}}"><i class="fa fa-circle-o"></i> Intendente - Locales</a></li>
                  <li id="#"><a href="{{route('reportes.intendente_mesa')}}"><i class="fa fa-circle-o"></i> Intendente - Mesas</a></li>
                  <li id="#"><a href="{{route('reportes.consejal')}}"><i class="fa fa-circle-o"></i> Consejal</a></li>
                  <li id="#"><a href="{{route('reportes.consejal_lista')}}"><i class="fa fa-circle-o"></i> Consejal - Lista</a></li>
                  <li id="#"><a href="{{route('reportes.consejal_resumen')}}"><i class="fa fa-circle-o"></i> Consejal - General</a></li>
                  <li id="#"><a href="{{route('reportes.consejal_local')}}"><i class="fa fa-circle-o"></i> Consejal - Locales</a></li>
                  <li id="#"><a href="{{route('reportes.consejal_mesa')}}"><i class="fa fa-circle-o"></i> Consejal - Mesas</a></li>
                  
                </ul>
              </li>

              <li id="acceso" name="acceso" class="treeview">
                <a href="#">
                  <i class="fa fa-folder"></i> <span>Acceso</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li id="#"><a href="{{url('acceso/usuario')}}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                  <li id="#"><a href="{{url('acceso/reset')}}"><i class="fa fa-refresh"></i> Cambio de Contraseña</a></li>
                  <li id="#"><a href="{{url('acceso/auditoria')}}"><i class="fa fa-cogs"></i> Auditoria</a></li>
                  
                </ul>
              </li>

              <li id="reset" name="reset" class="treeview">
                <a href="{{url('acceso/reset')}}">
                  <i class="fa fa-refresh"></i> <span>Cambio Contraseña</span>                
                </a>              
              </li>

              <li id="auditoria">
                <a href="{{url('acceso/auditoria')}}">
                  <i class="fa fa-cogs"></i> <span>Auditoria</span>                
                </a>              
              </li>
                          
            </ul>
          </section>
          <!-- /.sidebar -->
        </aside>    
      
      @endif

      <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">
          
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Sistema ANR</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  	<div class="row">
	                  	<div class="col-md-12">
                              <!--Contenido-->
                                @yield('contenido')
                                @yield('scripts')
                                @if (Auth::user())
                                  <input type="hidden" id="prol" name="prol"  value="{{Auth::user()->id_rol}}" class="form-control">    
                                  <input type="hidden" id="id_user" name="id_user"  value="{{Auth::user()->id}}" class="form-control">
                                @endif
                                <input type="hidden" id="prol" name="prol"  value="0" class="form-control">    
                                <input type="hidden" id="id_user" name="id_user"  value="0" class="form-control">
                                
		                          <!--Fin Contenido-->
                           </div>
                        </div>
		                    
                  		</div>
                  	</div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2021-2021 <a href="#">ANR</a>.</strong> All rights reserved.
      </footer>

      
    <!-- jQuery 2.1.4 -->
   
      <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
      <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
      <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
      @stack('scripts')
      <!-- Bootstrap 3.3.5 -->
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
      <script src="{{asset('js/bootstrap-select.min.js')}}"></script>

      {{-- {!! Html::script('js/dropdown.js') !!}  --}}
      <script src="{{asset('js/dropdown.js')}}"></script>  
      <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>-->
      <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
      <!-- AdminLTE App -->
      <script src="{{asset('js/app.min.js')}}"></script>
    
  </body>

</html>

<script type="text/javascript">

  $(document).ready(function(){

    // var id_rol = document.getElementById("#prol").value();
    var id_rol = ((document.getElementById("prol")||{}).value)||"";
    var user = ((document.getElementById("id_user")||{}).value)||"";

    if(id_rol != 0){

      ocultar();    

    }
  
  });

  function ocultar(){

    var id_rol = document.getElementById("prol").value;
    var user = document.getElementById("id_user").value;

    // console.log(user);

    if (id_rol == 2){
            
      $("#acceso").remove();
      $("#votacion").remove();
      $("#reset").remove();
      $("#auditoria").remove();
      $("#referente_intendente").remove();
      $("#padron_voto").remove();
      
    }

    if (id_rol == 3){
            
      $("#acceso").remove();
      $("#votacion").remove();
      // $("#reset").remove();
      $("#aporedados").remove();
      // $("#mesa").remove();
      $("#auditoria").remove();
      $("#votacion").remove();
      $("#reportes").remove();
      $("#voto_intendente").remove();
      $("#voto_consejal").remove();
      $("#padron_ver").remove();
      $("#referente_intendente").remove();
      $("#integrante_mesa").remove();
      // $("#padron_voto").remove();
      
    }

    if (id_rol == 4){

      $("#acceso").remove();
      $("#votacion").remove();
      // $("#reset").remove();
      $("#aporedados").remove();
      $("#mesa").remove();
      $("#auditoria").remove();
      $("#votacion").remove();
      $("#reportes").remove();
      $("#voto_intendente").remove();
      $("#voto_consejal").remove();
      $("#padron_ver").remove();
      $("#referente_intendente").remove();
      $("#padron").remove();
      $("#padron_cel").remove();
      $("#referente").remove();
      $("#padron_voto").remove();

    }

    
  
  }
    
</script>



