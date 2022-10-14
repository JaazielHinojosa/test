<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <?php
    $randItem = 1;
    $rand = 1;//rand();
    ?>

    <script> var base_url = '{{url('')}}/';</script>
    <meta charset="utf-8" />
    <title>Lavandería</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Base Styles -->

    <!--begin::Page Vendors -->
    <link href="//www.amcharts.com/lib/3/plugins/export/export.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets_m/dist/default/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets_m/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets_m/search.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets_m/dist/default/assets/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets_m/flag-icon-css-master/css/flag-icon.min.css')}}" rel="stylesheet" type="text/css">
{{--<link rel="stylesheet" href="{{asset('assets/css/multiple-select.css')}}">--}}

<!--RTL version:<link href="assets/vendors/custom/fullcalendar/fullcalendar.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Page Vendors -->
    <link href="{{asset('assets_m/dist/default/assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />

    <!--RTL version:<link href="assets/vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
    <link href="{{asset('assets_m/dist/default/assets/demo/default/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets_m/css/estilos.css?rand='.$rand)}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets_m/css/jquery.Jcrop.min.css')}}" rel="stylesheet" type="text/css">

@yield('style')

<!--RTL version:<link href="assets/demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

    <!--end::Base Styles -->
    <link rel="shortcut icon" href="{{asset('rosie.ico')}}">
    <script src="{{asset('assets_m/dist/default/assets/vendors/base/vendors.bundle.js?rand='.$rand)}}" type="text/javascript"></script>
    <script src="{{asset('assets_m/js/jquery.Jcrop.min.js')}}" type="text/javascript"></script>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

    <!-- BEGIN: Header -->
    <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">

                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="{{url('/')}}" class="m-brand__logo-wrapper" style="position: relative;left: -46px;">
                                <img  id="logo" alt="rosie" src="{{url('assets/logo.png')}}" style="height: 70px"/>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">

                            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>

                            <!-- END -->

                            <!-- BEGIN: Topbar Toggler -->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>

                            <!-- BEGIN: Topbar Toggler -->
                        </div>
                    </div>
                </div>

                <!-- END: Brand -->
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                    <!-- BEGIN: Horizontal Menu -->
                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
                        <i class="la la-close"></i>
                    </button>
                    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                            <?php        /*
                        <?php
                                    $catalogosParaMenu = [];
                                    if(Auth::user()->type != 'admin')
                                    {

                                        $secciones = \App\Empresas::$secciones;
                                        $icons     = \App\Empresas::$icons;
                                        $keys      = \App\Empresas::$keys;
                                        $catalogos = \App\Empresas::$catalogos;
                                        $catalogosIcons = \App\Empresas::$catalogosIcons;
                                        $seccionesFree = \App\Empresas::$seccionesFree;

                                        //SI es usuario normal
                                        if(Auth::user()->type == 'usuario')
                                        {
                                            //secciones del usuario
                                            $userSecciones = \App\UserSecciones::where('user_id', \Auth::user()->id)->get();
                                            $userSeccionesPasadas = [];

                                            foreach ($userSecciones as  $userSeccione)
                                            {
                                                //Catalagos
                                                if(isset($catalogos[$userSeccione->seccion]) && $userSeccione->activo)
                                                $catalogosParaMenu[$userSeccione->seccion] = $catalogos[$userSeccione->seccion];//ejemplo ['usuarios'    => 'Catálogo de Usuarios']

                                                //Secciones
                                                if($userSeccione->activo)
                                                $userSeccionesPasadas[$userSeccione->seccion] = 1;
                                            }//if

                                            //Secciones de la empresa
                                            Auth::user()->empresa = \App\Empresas::find(Auth::user()->empresa_id);
                                        }
                                        else
                                        {
                                            //usuario admin de empresa
                                            $catalogosParaMenu = $catalogos;
                                        }//else

                                    }//IF
                                    ?>
                            @if(Auth::user()->type != 'admin' && count($catalogosParaMenu))
                                <li class="hover-blue m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon fa fa-book-open"></i>
                                        <span class="m-menu__link-text">@lang('app.Catálogos')</span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>

                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            @foreach ($catalogosParaMenu as $key => $catalogo)
                                                <?php $validacion = \App\Helpers\General::validarCatalogos($key);?>
                                                <!--li><a href="$validacion['url']}}" title data-original-title="$validacion['title']}}" data-placement="left" data-toggle="popover" data-html="true" data-content="$validacion['registro']}}" class=" tool $validacion['active']}}" data-tool="$key}}"><i class=""></i> </a></li-->
                                                <li class="m-menu__item " aria-haspopup="true">
                                                    <a href="{{url($key)}}" class="m-menu__link ">
                                                        <i class="m-menu__link-icon {{$catalogosIcons[$key]}}"></i>
                                                        <span class="m-menu__link-text">{{$catalogo}}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                @if(Auth::user()->type != 'usuario')
                                    <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">
                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                        <i class="m-menu__link-icon fa fa-list"></i>
                                        <span class="m-menu__link-text">@lang('app.Listas desplegables')</span>
                                        <i class="m-menu__hor-arrow la la-angle-down"></i>
                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                    </a>
                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                        <ul class="m-menu__subnav">
                                            @foreach(\App\Empresas::$catalogosGenerales AS $keyUrl =>$catalogosGenerales)
                                                <li class="m-menu__item m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true">
                                                    <?php $icon_class = '';
                                                        if(isset($icons[$keyUrl]))
                                                            $icon_class = $icons[$keyUrl];
                                                        else if(isset($catalogosIcons[$keyUrl]))
                                                            $icon_class = $catalogosIcons[$keyUrl];
                                                        else if($keyUrl=='proveedores_x')
                                                            $icon_class = "fa fa-clipboard-check";
                                                        else if($keyUrl=='indicadores_x')
                                                            $icon_class = "fa fa-check-circle";
                                                    ?>
                                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">
                                                        <i class="m-menu__link-icon {{$icon_class}}"></i>
                                                        <span class="m-menu__link-text">
                                                            @if(isset($secciones[$keyUrl]))
                                                                {{$secciones[$keyUrl]}}
                                                            @elseif(isset($catalogos[$keyUrl]))
                                                                {{$catalogos[$keyUrl]}}
                                                            @elseif($keyUrl=='proveedores_x')
                                                                @lang('app.Evaluaciones de Proveedores')
                                                            @elseif($keyUrl=='indicadores_x')
                                                                @lang('app.Indicadores de Desempeño')
                                                            @endif
                                                        </span>
                                                        <i class="m-menu__hor-arrow la la-angle-right"></i>
                                                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                                                    </a>
                                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right">
                                                        <span class="m-menu__arrow "></span>
                                                        <ul class="m-menu__subnav">
                                                            @foreach($catalogosGenerales AS $key =>$catalogos_)
                                                                <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true">
                                                                    <a href="{{url('catalogos_generales/'.$key)}}" class="m-menu__link ">
                                                                    <span class="m-menu__link-text">
                                                                        {{$catalogos_['subseccion']}}
                                                                        <span class="bold"> {{$catalogos_['nombre']}} </span>
                                                                    </span>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                @endif
                            @endif
                            */
                            ?>
                        </ul>
                    </div>

                    <!-- END: Horizontal Menu -->

                    <!-- BEGIN: Topbar -->
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click" aria-expanded="true">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="" class="m--img-rounded m--marginless" alt="">
												</span>
                                        <span class="m-topbar__username m--hide">Nick</span>
                                    </a>
                                    <div class="m-dropdown__wrapper" style="z-index: 101;">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust dropdown-list-profile"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__pic">
                                                        <img src="" class="m--img-rounded m--marginless" alt="">
                                                    </div>
                                                    <div class="m-card-user__details">
                                                        <span class="m-card-user__name m--font-weight-500">Hola</span>
                                                        <a href="javascript: void(0);" class="m-card-user__email m--font-weight-300 m-link"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                        <li class="m-nav__item">

                                                            <a class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" href=""
                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                            <form id="logout-form" action="" method="POST" style="display: none;">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- END: Topbar -->
                </div>
            </div>
        </div>
    </header>

    <!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <!-- BEGIN: Aside Menu -->
            <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1"
                 m-menu-scrollable="1" m-menu-dropdown-timeout="500"
                 style="position: relative;">
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                    {{--<li class="m-menu__item" aria-haspopup="true" >
                        <a  href="{{url('file')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon fa fa-download"></i>
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        Archivo txt
                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>--}}
                    <li class="m-menu__item" aria-haspopup="true" >
                        <a href="{{url('room')}}" class="m-menu__link ">
                            <i class="m-menu__link-icon fa fa-lightbulb"></i>
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text">
                                        Habitación
                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END: Aside Menu -->
        </div>

        <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- END: Subheader -->
            <div class="m-content">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- end:: Body -->

    <!-- begin::Footer -->
    <footer class="m-grid__item		m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">

                </div>
                <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                    <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    © 2018 POWERED BY WITS.
                                </span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- end::Footer -->

    <!-- end:: Page -->

</div>

<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<!-- end::Scroll Top -->

<!--begin::Base Scripts -->
<script src="{{asset('assets_m/dist/default/assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>

<!--end::Base Scripts -->

<!--begin::Page Vendors -->
<script src="{{asset('assets_m/dist/default/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Snippets -->
<script src="{{asset('assets_m/dist/default/assets/app/js/dashboard.js?rand='.$rand)}}" type="text/javascript"></script>
<script src="{{asset('assets_m/dist/default/assets/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_m/dist/default/assets/demo/default/custom/crud/datatables/extensions/buttons.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_m/dist/default/assets/demo/default/custom/crud/datatables/extensions/colreorder.js')}}" type="text/javascript"></script>
<script src="{{asset('assets_m/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
<script src="{{asset('assets_m/jquery.pulsate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/general.js?rand='.$rand)}}" type="text/javascript"></script>

<script >
    var Select2={init:function(){$("#m_select2_1, #m_select2_1_validate").select2({placeholder:"Select a state"}),$("#m_select2_2, #m_select2_2_validate").select2({placeholder:"Select a state"}),$("#m_select2_3, #m_select2_3_validate").select2({placeholder:"Select a state"}),$("#m_select2_4").select2({placeholder:"Select a state",allowClear:!0}),$("#m_select2_5").select2({placeholder:"Select a value",data:[{id:0,text:"Enhancement"},{id:1,text:"Bug"},{id:2,text:"Duplicate"},{id:3,text:"Invalid"},{id:4,text:"Wontfix"}]}),$("#m_select2_6").select2({placeholder:"Search for git repositories",allowClear:!0,ajax:{url:"https://api.github.com/search/repositories",dataType:"json",delay:250,data:function(e){return{q:e.term,page:e.page}},processResults:function(e,t){return t.page=t.page||1,{results:e.items,pagination:{more:30*t.page<e.total_count}}},cache:!0},escapeMarkup:function(e){return e},minimumInputLength:1,templateResult:function(e){if(e.loading)return e.text;var t="<div class='select2-result-repository clearfix'><div class='select2-result-repository__meta'><div class='select2-result-repository__title'>"+e.full_name+"</div>";return e.description&&(t+="<div class='select2-result-repository__description'>"+e.description+"</div>"),t+="<div class='select2-result-repository__statistics'><div class='select2-result-repository__forks'><i class='fa fa-flash'></i> "+e.forks_count+" Forks</div><div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> "+e.stargazers_count+" Stars</div><div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> "+e.watchers_count+" Watchers</div></div></div></div>"},templateSelection:function(e){return e.full_name||e.text}}),$("#m_select2_12_1, #m_select2_12_2, #m_select2_12_3, #m_select2_12_4").select2({placeholder:"Select an option"}),$("#m_select2_7").select2({placeholder:"Select an option"}),$("#m_select2_8").select2({placeholder:"Select an option"}),$("#m_select2_9").select2({placeholder:"Select an option",maximumSelectionLength:2}),$("#m_select2_10").select2({placeholder:"Select an option",minimumResultsForSearch:1/0}),$("#m_select2_11").select2({placeholder:"Add a tag",tags:!0}),$(".m-select2-general").select2({placeholder:"Select an option"}),$("#m_select2_modal").on("shown.bs.modal",function(){$("#m_select2_1_modal").select2({placeholder:"Select a state"}),$("#m_select2_2_modal").select2({placeholder:"Select a state"}),$("#m_select2_3_modal").select2({placeholder:"Select a state"}),$("#m_select2_4_modal").select2({placeholder:"Select a state",allowClear:!0})})}};jQuery(document).ready(function(){Select2.init()});

</script>

@yield('script')
<script>
    var last_not = {};
</script>
<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "7000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    var html = '';
    @foreach ($errors->all() as $error)
        html+= '{{ $error }}<br>';
    @endforeach

    if(html)
        toastr.error(html, "Error!");

    var message = ''
    @if(Session::has('message'))
        message += '{{Session::get('message')}}<br>';
    @endif

    if(message)
        toastr.success(message, "Éxito!");
</script>
<script src="{{asset('assets_m/js/notifications.js?rand='.$rand)}}"></script>


<!--end::Page Snippets -->
</body>
<!-- end::Body -->
</html>

