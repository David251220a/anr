<!DOCTYPE html>
<html>
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ANR | www.anr.com</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
   <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
   <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}"> 
   <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
   <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js" defer></script>

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

      <header class="main-header">

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
                  <small class="bg-red">Online</small>
                  <span class="hidden-xs">{{ Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    
                    <p>
                      {{ Auth::user()->name }}
                      <small>Sistema Desarrollado</small>
                    </p>
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
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

          <!-- sidebar menu: : style can be found in sidebar.less -->          
          <ul class="sidebar-menu">
            <li class="header"></li>
            
            <li id="pvotacion" name="pvotacion" class="treeview">
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

            <li id="pconsulta" name="pconsulta" class="treeview">
              <a href="#">
                <i class="fa fa-inbox"></i>
                <span>Consulta</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                <li><a href="{{url('consulta/votos_intendente')}}"><i class="fa fa-circle-o"></i> Votos Intendente</a></li>
                <li><a href="{{url('consulta/votos_consejal')}}"><i class="fa fa-circle-o"></i> Votos Consejal</a></li>
                
              </ul>
            </li>                       

            <li id="pAcceso1" name="pAcceso1" class="treeview">
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

            <li id="#" name="#" class="treeview">
              <a href="{{url('acceso/reset')}}">
                <i class="fa fa-refresh"></i> <span>Cambio Contraseña</span>                
              </a>              
            </li>

            <li>
              <a href="{{url('acceso/auditoria')}}">
                <i class="fa fa-cogs"></i> <span>Auditoria</span>                
              </a>              
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





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
                                <input type="hidden" id="prol" name="prol"  value="{{Auth::user()->id_rol}}" class="form-control">
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
    @stack('scripts')
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-select.min.js')}}"></script>

   
    
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>-->
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="{{asset('js/app.min.js')}}"></script>
    
  </body>

</html>

<script type="text/javascript">

  $(document).ready(function(){

    ocultar();    
  
  });

  function ocultar(){

    var id_rol = document.getElementById("prol").value;

    //console.log(id_rol);


    if (id_rol == 2){
            
      $("#pAcceso1").remove();

    }

  
  }
    
</script>



