<!DOCTYPE html>
<html lang="es">
    <head>
        <link rel="shortcut icon" href="assets/images/icono.png" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('titled')</title>
            
        <!--HOJA DE ESTILOS-->
        <link rel="stylesheet" type="text/css" href="assets/css/styles.css" />

    </head>
    <body>
        <header id="header">
            <div class="center">
                <!-- LOGO -->
                <div id="logo">
                    <img src="assets/images/icono.png" class="app-logo" alt="Logotipo" />
                    <span id="brand">
                        <strong>Borrar</strong>Tweets
                    </span>
                </div>
                
                <!-- MENU -->
                <nav id="menu">
                    <ul>
                        <li>
                            @yield('Home')
                        </li>
                        <li></li>
                       
                        <li></li>
                        <li>
                            @yield('logout')
                        </li>  
                        <li></li>
                        <li>
                            @yield('ImagenPerfil')
                        </li>                          
                    </ul>
                </nav>

                <!--LIMPIAR FLOTADOS-->
                <div class="clearfix"></div>
            </div>
        </header>

        @yield('content')
        @yield('js')
    </body>
</html>