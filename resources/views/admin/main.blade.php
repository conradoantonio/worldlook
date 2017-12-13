<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', isset($title) ? $title .' | HomeCuts' : 'HomeCuts')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="{{ asset('plugins/pace/pace-theme-flash.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('plugins/jquery-scrollbar/jquery.scrollbar.css')}}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('plugins/boostrapv3/css/bootstrap.min.css')}}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('plugins/boostrapv3/css/bootstrap-theme.min.css')}}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.css')}}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css')}}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/custom.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/responsive.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/custom-icon-set.css')}}" type="text/css"/>
    {{-- <link rel="stylesheet" href="{{ asset('css/select2.min.css')}}" type="text/css"/> --}}
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap-datepicker/css/datepicker.css')}}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ios7-switch.css') }}">
</head>

<body>

    <div class="header navbar navbar-inverse">
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class="navbar-inner">
            <!-- BEGIN NAVIGATION HEADER -->
            <div class="header-seperation"> 
                <!-- BEGIN MOBILE HEADER -->
                <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">    
                    <li class="dropdown">
                        <a id="main-menu-toggle" href="#main-menu" class="">
                            <div class="iconset top-menu-toggle-white"></div>
                        </a>
                    </li>        
                </ul>
                <!-- END MOBILE HEADER -->
                <!-- BEGIN LOGO --> 
                <a href="<?php echo url();?>/dashboard">
                    <img src="{{ asset('img/logo.png') }}" class="logo" alt="" data-src="{{ asset('img/logo.png') }}" data-src-retina="{{ asset('img/logo.png') }}" width="70" height="30"/>
                </a>
                <!-- END LOGO --> 
                <!-- BEGIN LOGO NAV BUTTONS -->
                <ul class="nav pull-right notifcation-center">  
                    <li class="dropdown" id="header_task_bar">
                        <a href="<?php echo url();?>/dashboard" class="dropdown-toggle active" data-toggle="">
                            <div class="iconset top-home"></div>
                        </a>
                    </li>               
                </ul>
                <!-- END LOGO NAV BUTTONS -->
            </div>
            <!-- END NAVIGATION HEADER -->
            <!-- BEGIN CONTENT HEADER -->
            <div class="header-quick-nav"> 
                <!-- BEGIN HEADER LEFT SIDE SECTION -->
                <div class="pull-left"> 
                    <!-- BEGIN SLIM NAVIGATION TOGGLE -->
                    <ul class="nav quick-section">
                        <li class="quicklinks">
                            <a href="#" class="" id="layout-condensed-toggle">
                                <div class="iconset top-menu-toggle-dark"></div>
                            </a>
                        </li>
                    </ul>
                    <!-- END SLIM NAVIGATION TOGGLE -->                         
                </div>
                <!-- END HEADER LEFT SIDE SECTION -->
                <!-- BEGIN HEADER RIGHT SIDE SECTION -->
                <div class="pull-right"> 
                    <div class="chat-toggler">  
                        <!-- BEGIN NOTIFICATION CENTER -->
                        <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom" data-content="">
                            <div class="user-details"> 
                                <div class="username">
                                    <span class="badge badge-important"></span><span>{{Auth::user()->user}}</span>                                  
                                </div>                      
                            </div> 
                            <div class="iconset"></div>
                        </a>    
                        
                        <!-- END NOTIFICATION CENTER -->
                        <!-- BEGIN PROFILE PICTURE -->
                        <div class="profile-pic"> 
                            <img src="{{ asset(Auth::user()->foto_usuario) }}" alt="" data-src="{{ asset(Auth::user()->foto_usuario) }}" data-src-retina="{{ asset(Auth::user()->foto_usuario) }}" width="35" height="35" /> 
                        </div>  
                        <!-- END PROFILE PICTURE -->                
                    </div>
                    <!-- BEGIN HEADER NAV BUTTONS -->
                    <ul class="nav quick-section">
                        <!-- BEGIN SETTINGS -->
                        <li class="quicklinks"> 
                            <a data-toggle="dropdown" class="dropdown-toggle pull-right" href="#" id="user-options">                        
                                <div class="iconset top-settings-dark"></div>   
                            </a>
                            <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="user-options">
                                <li><a data-toggle="modal" data-target="#cambiar_foto_usuario_sistema" href="#"><i class="fa fa-picture-o" aria-hidden="true"></i> Cambiar foto perfil</a></li>
                                <li><a data-toggle="modal" data-target="#change-pass" href="#"><i class="fa fa-key" aria-hidden="true"></i> Cambiar contraseña</a></li>
                                <li class="divider"></li>  
                                <li class="loggingOut"><a href="#"><i class="fa fa-power-off"></i> Cerrar sesión</a></li>
                            </ul>
                        </li>
                        <!-- END SETTINGS -->
                    </ul>
                    <!-- END HEADER NAV BUTTONS -->
                </div>
                <!-- END HEADER RIGHT SIDE SECTION -->
            </div> 
            <!-- END CONTENT HEADER --> 
        </div>
        <!-- END TOP NAVIGATION BAR --> 
    </div>
    <!-- END HEADER -->
        
    <!-- BEGIN CONTENT -->
    <div class="page-container row-fluid">
        <!-- BEGIN SIDEBAR -->
        <!-- BEGIN MENU -->
        <div class="page-sidebar menu-picture" id="main-menu"> 
            <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
            <!-- BEGIN MINI-PROFILE -->
            <div class="user-info-wrapper"> 
                <div class="profile-wrapper">
                    <img src=" {{ asset(Auth::user()->foto_usuario) }}" alt="" data-src=" {{ asset(Auth::user()->foto_usuario) }}" data-src-retina=" {{ asset(Auth::user()->foto_usuario) }}" width="69" height="69" />
                </div>
                <div class="user-info">
                    <div class="greeting">Bienvenido</div>
                    <div class="username"><span class="semi-bold">{{Auth::user()->user}}</span></div>
                    <div class="status">Status<a href="#"><div class="status-icon green"></div>Online</a></div>
                </div>
            </div>
            <!-- END MINI-PROFILE -->
            <!-- BEGIN SIDEBAR MENU --> 
            <p class="menu-title">Secciones<span class="pull-right"><a href=""><i class="fa fa-refresh"></i></a></span></p>
            <ul>    
                <!-- BEGIN SELECTED LINK -->
                <li class="start {{$menu == 'Inicio' ? 'active' : ''}}">
                    <a href="<?php echo url();?>/dashboard">
                        <i class="icon-custom-home"></i>
                        <span class="title">Inicio</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <!-- END SELECTED LINK -->

                <!-- BEGIN SINGLE LINK -->
                {{-- <li class="{{$menu == 'Servicios' ? 'active' : ''}}">
                    <a href="{{url('pedidos')}}">
                        <i class="fa fa-cubes" aria-hidden="true"></i>
                        <span class="title">Servicios</span>
                    </a>
                </li>--}}
                <!-- END SINGLE LINK -->

                <!-- BEGIN SINGLE LINK -->
                {{-- <li class="{{$menu == 'Estilistas' ? 'active' : ''}}">
                    <a href="{{url('estilistas')}}">
                        <i class="fa fa-male" aria-hidden="true"></i>
                        <span class="title">Estilistas</span>
                    </a>
                </li> --}}
                <!-- END SINGLE LINK -->
    
                <!-- BEGIN SINGLE LINK -->
                {{-- <li class="{{$menu == 'Productos' ? 'active' : ''}}">
                    <a href="{{url('productos')}}">
                        <i class="fa fa-suitcase" aria-hidden="true"></i>
                        <span class="title">Productos</span>
                    </a>
                </li> --}}
                <!-- END SINGLE LINK -->

                <!-- BEGIN SINGLE LINK -->
                {{-- <li class="{{$menu == 'Imágenes' ? 'active' : ''}}">
                    <a href="{{url('cargar_imagenes')}}">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        <span class="title">Cargar imágenes</span>
                    </a>
                </li> --}}
                <!-- END SINGLE LINK -->

                <!-- BEGIN SINGLE LINK -->
                {{-- <li class="{{$menu == 'Menu app' ? 'active' : ''}}">
                    <a href="{{url('menu_app')}}">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="title">Menu app</span>
                    </a>
                </li> --}}
                <!-- END SINGLE LINK -->

                <!-- BEGIN SINGLE LINK -->
                {{-- <li class="{{$menu == 'Subcategorías app' ? 'active' : ''}}">
                    <a href="{{url('subcategorias_app')}}">
                        <i class="fa fa-th-list" aria-hidden="true"></i>
                        <span class="title">Subcategorías</span>
                    </a>
                </li> --}}
                <!-- END SINGLE LINK -->

                <!-- BEGIN SINGLE LINK -->
                {{-- <li class="{{$menu == 'Modificar categorías' ? 'active' : ''}}">
                    <a href="{{url('configurarcion_servicios')}}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        <span class="title">Modificar categorías</span>
                    </a>
                </li> --}}
                <!-- END SINGLE LINK -->

                <!-- BEGIN ONE LEVEL MENU -->
                {{-- <li class="{{$menu == 'Cupones' ? 'open start' : ''}}">
                    <a href="javascript:;">
                        <i class="fa fa-ticket" aria-hidden="true"></i>
                        <span class="title">Cupones</span>
                        <span class="{{$menu == 'Cupones' ? 'arrow open' : 'arrow'}}"></span>
                    </a>
                    <ul class="sub-menu" style="{{$menu == 'Cupones' ? 'display: block;' : ''}}">
                        <li class="{{$title == 'Cupones Generales' ? 'active' : ''}}"><a href="{{url('cupones/generales')}}">Cupones generales</a></li> 
                        <li class="{{$title == 'Cupones Individuales' ? 'active' : ''}}"><a href="{{url('cupones/individuales')}}">Cupones individuales</a></li>
                    </ul>
                </li> --}}
                <!-- END ONE LEVEL MENU -->

                <!-- BEGIN SINGLE LINK -->
                <li class="{{$menu == 'Ionic' ? 'active' : ''}}">
                    <a href="<?php echo url();?>/notificaciones_app">
                        <i class="fa fa-bell" aria-hidden="true"></i>
                        <span class="title">Notificaciones app</span>
                    </a>
                </li>
                <!-- END SINGLE LINK -->

                <!-- BEGIN SINGLE LINK -->
                {{-- <li class="{{$menu == 'Galería' ? 'active' : ''}}">
                    <a href="{{url('galeria')}}">
                        <i class="fa fa-camera-retro" aria-hidden="true"></i>
                        <span class="title">Galería</span>
                    </a>
                </li> --}}
                <!-- END SINGLE LINK -->
                
                <!-- BEGIN ONE LEVEL MENU -->
                <li class="{{$menu == 'Usuarios' ? 'open start' : ''}}">
                    <a href="javascript:;">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="title">Usuarios</span>
                        <span class="{{$menu == 'Usuarios' ? 'arrow open' : 'arrow'}}"></span>
                    </a>
                    <ul class="sub-menu" style="{{$menu == 'Usuarios' ? 'display: block;' : ''}}">
                        <li class="{{$title == 'Usuarios Sistema' ? 'active' : ''}}"><a href="{{url('/usuarios/sistema')}}">Usuarios (sistema)</a></li> 
                        <li class="{{$title == 'Usuarios App' ? 'active' : ''}}"><a href="{{url('/usuarios/app')}}">Usuarios (app)</a></li> 
                    </ul>
                </li>
                <!-- END ONE LEVEL MENU -->
                
                <!-- BEGIN SELECTED LINK -->
                {{-- <li class="{{$menu == 'Configuraciones' ? 'active' : ''}}">
                    <a href="javascript:;">
                        <i class="fa fa-cogs" aria-hidden="true"></i>
                        <span class="title">Configuraciones</span>
                        <span class="{{$menu == 'Configuraciones' ? 'arrow open' : 'arrow'}}"></span>
                    </a>
                    <ul class="sub-menu" style="{{$menu == 'Configuraciones' ? 'display: block;' : ''}}">
                        <li class="{{$title == 'Preguntas frecuentes' ? 'active' : ''}}"><a href="{{url('configuracion/preguntas_frecuentes')}}">Preguntas frecuentes</a></li>
                    </ul>
                </li> --}}
                <!-- END SELECTED LINK -->

                <!-- BEGIN SINGLE LINK -->
                <li class="loggingOut">
                    <a href="#">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        <span class="title">Cerrar sesión</span>
                    </a>
                </li>
                <!-- END SINGLE LINK -->
                <!-- BEGIN SINGLE LINK -->
                <li class="">
                    <a href="#">
                        <i class="" aria-hidden="true"></i>
                        <span class="title"></span>
                    </a>
                </li>
                <!-- END SINGLE LINK --> 
                <!-- END ONE LEVEL MENU -->     
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        </div>
        <!-- BEGIN SCROLL UP HOVER -->
        <a href="#" class="scrollup">Scroll</a>
        <!-- END SCROLL UP HOVER -->
        <!-- END MENU -->
        <!-- END SIDEBAR --> 
        <!-- BEGIN PAGE CONTAINER-->

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo-form-cambiar-contra-main" id="change-pass">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="titulo-form-cambiar-contra-main">Cambio de contraseña para usuario {{auth()->user()->user}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" id="id" value="{{auth()->user()->id}}">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="actualPassword">Contraseña actual</label>
                                    <input type="password" class="form-control" id="actualPassword" placeholder="Escribe la contraseña actual">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="newPassword">Nueva contraseña</label>
                                    <input type="password" class="form-control" id="newPassword" placeholder="Contraseña nueva">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="confirmPassword">Confirmar contraseña</label>
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirmar contraseña">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="cambiar-password">Cambiar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo-form-cambiar-contra-main" id="cambiar_foto_usuario_sistema">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="titulo-form-cambiar-contra-main">Cambio de foto de perfil para {{auth()->user()->user}}</h4>
                    </div>
                    <form id="cargar_foto_usuario" action="<?php echo url();?>/usuarios/sistema/guardar_foto_usuario_sistema" enctype="multipart/form-data" method="POST">
                        <div class="modal-body">
                            <input type="hidden" id="token" name="_token" empresa-id="{{auth()->user()->empresa_id}}" base-url="<?php echo url();?>" value="{{csrf_token()}}">
                            <div class="row">
                                <div class="col-sm-12 col-xs-12 hidden">
                                    <div class="form-group">
                                        <label for="id">ID</label>
                                        <input type="text" id="id" name="id" value="{{auth()->user()->id}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Cargar foto perfil</label>
                                        <input type="file" class="" name="foto_usuario_sistema" id="foto_usuario_sistema" size="5120">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="guardar-foto-usuario-sistema">Guardar</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    

        <script src="{{ asset('js/jquery.js') }}"></script>
        <script src="{{ asset('js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('js/lightbox.js') }}"></script>

        <!-- BEGIN CORE JS FRAMEWORK--> 
        <!--<script src="{{ asset('plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script>--> 
        <script src="{{ asset('plugins/boostrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/breakpoints.js') }}" type="text/javascript"></script> 
        <script src="{{ asset('plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script> 
        <script src="{{ asset('plugins/jquery-block-ui/jqueryblockui.js') }}" type="text/javascript"></script> 
        <!-- END CORE JS FRAMEWORK --> 
        <!-- BEGIN PAGE LEVEL JS -->    
        <script src="{{ asset('plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/pace/pace.min.js') }}" type="text/javascript"></script>  
        <script src="{{ asset('plugins/jquery-numberAnimate/jquery.animateNumbers.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/chart.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type='text/javascript'></script>

        <!-- END PAGE LEVEL PLUGINS -->     

        <!-- BEGIN CORE TEMPLATE JS -->
        <script src="{{ asset('js/core.js') }}" type="text/javascript"></script> 
        <script src="{{ asset('js/chat.js') }}" type="text/javascript"></script> 
        <script src="{{ asset('js/demo.js') }}" type="text/javascript"></script> 
        <!-- END CORE TEMPLATE JS --> 


        <div class="page-content">
            <main style="padding-top:60px;">
                <section>
                    @yield('content')
                </section>
            </main>
        </div>
        <!-- END PAGE CONTAINER -->
    </div>
    <!-- END CONTENT --> 
    <!-- BEGIN CORE JS FRAMEWORK--> 


    <script type="text/javascript">
        var baseUrl = "{{url('')}}";
        window.b_url = "{{url('')}}";
        $('#change-pass, #cambiar_foto_usuario_sistema').on('hidden.bs.modal', function (e) {
            $('#change-pass div.form-group').removeClass('has-error');
            $('input.form-control').val('');
            $('input#foto_usuario_sistema').val('');
        });

        $('body').delegate('button#cambiar-password','click', function() {
            $('#change-pass div.form-group').removeClass('has-error');//Remueve los errores de los campos

            if ($('div#change-pass input#actualPassword').val() == '' ||
                $('div#change-pass input#newPassword').val() == '' ||
                $('div#change-pass input#confirmPassword').val() == '') {//Si algún campo está vacío no pasa
                $('div#change-pass input#actualPassword').val() == '' ? $('div#change-pass input#actualPassword').parent().addClass('has-error') : ''
                $('div#change-pass input#newPassword').val() == '' ? $('div#change-pass input#newPassword').parent().addClass('has-error') : ''
                $('div#change-pass input#confirmPassword').val() == '' ? $('div#change-pass input#confirmPassword').parent().addClass('has-error') : ''
                swal({
                    title: "Llene todos los campos antes de continuar.",
                    type: "error",
                    showConfirmButton: true,
                });
            }
            else {
                var id = $('div#change-pass input#id').val();
                var token = '{{ csrf_token() }}';
                var user = '{{ Auth::user()->user }}';
                var actualPassword = $('div#change-pass input#actualPassword').val();
                var newPassword = $('div#change-pass input#newPassword').val();
                var confirmPassword = $('div#change-pass input#confirmPassword').val();

                changePassword(id,user,actualPassword,newPassword,confirmPassword,token);
            }
        });

        function changePassword(id,user,actualPassword,newPassword,confirmPassword,token) {
            $.ajax({
                method: "POST",
                url: "{{url('/usuarios/sistema/change_password')}}",
                data:{
                    "id":id,
                    "user":user,
                    "actualPassword":actualPassword,
                    "newPassword":newPassword,
                    "confirmPassword":confirmPassword,
                    "_token":token
                },
                success: function(data) {
                    $('div#change-pass div.form-group').removeClass('has-error');

                    if (data == 'contra cambiada') {
                        swal({
                            title: "Contraseña modificada con éxito",
                            type: "success",
                            showConfirmButton: true,
                        });
                    } else if (data == 'contra nueva diferentes') {
                        swal({
                            title: "Las contraseñas deben ser iguales, corrijala antes de continuar",
                            type: "error",
                            showConfirmButton: true,
                        });
                        $('div#change-pass input#newPassword, div#change-pass input#confirmPassword').parent().addClass('has-error');
                    } else if (data == 'contra erronea') {
                        swal({
                            title: "Debe proporcionar la contraseña actual para poder cambiarla",
                            type: "error",
                            showConfirmButton: true,
                        });
                        $('div#change-pass input#actualPassword').parent().addClass('has-error');
                    }
                    //$('#guardar-usuario-sistema').show();
                },
                error: function(xhr, status, error) {
                    swal({
                        title: "<small>Error!</small>",
                        text: "Ha ocurrido un error mientras se cambiaba la contraseña, porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                        html: true
                    });
                }
            });
        }

        mb = 0;
        fileExtension = ['jpg', 'jpeg', 'png'];
        var msgError = '';
        var regExprAlphNum = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_\s .]{2,50}$/i;
        var btn_enviar_foto = $("#guardar-foto-usuario-sistema");
        btn_enviar_foto.on('click', function() {
            msgError = '';
            inputs = [];
            validarFotoUsuarioMain($('input#foto_usuario_sistema')) == false ? inputs.push('Foto perfil') : ''

            if (inputs.length == 0) {
                $('#guardar-foto-usuario-sistema').submit();
            } else {
                swal("Corrija el siguiente campo para continuar: ", msgError);
                return false;
            }
        });

        $('input#foto_usuario_sistema').bind('change', function() {
            if ($(this).val() != '') {

                kilobyte = (this.files[0].size / 1024);
                mb = kilobyte / 1024;

                archivo = $(this).val();
                extension = archivo.split('.').pop().toLowerCase();

                if ($.inArray(extension, fileExtension) == -1 || mb >= 5) {
                    swal({
                        title: "Archivo no válido",
                        text: "Debe seleccionar una imágen con formato jpg, jpeg o png, y debe pesar menos de 5MB",
                        type: "error",
                        closeOnConfirm: false
                    });
                }
            }
        });

        function validarFotoUsuarioMain(campo) {
            archivo = $(campo).val();
            extension = archivo.split('.').pop().toLowerCase();

            if ($.inArray(extension, fileExtension) == -1 || mb >= 5) {
                $(campo).parent().addClass("has-error");
                msgError = msgError + $(campo).parent().children('label').text() + '\n';
                return false;
            } else {
                $(campo).parent().removeClass("has-error");
                return true;
            }
        }

        $('body').delegate('.loggingOut','click', function() {
            swal({
                title: "¿Desea cerrar la sesión?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Salir",
                cancelButtonText: "Cancelar",
                closeOnConfirm: false
            },
            function() {
                window.location.href = "<?php echo url();?>/logout";
            });
        });
    </script>

</body>

</html>