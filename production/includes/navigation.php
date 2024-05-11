<div class="az-header">
    <div class="container">
        <div class="az-header-left">
            <a href="index.html" class="az-logo" style="text-transform: uppercase;"><span></span> THEMIS 1.0</a>
            <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
            <div class="az-header-menu-header">
                <a href="index.html" class="az-logo"><span></span>THEMIS 1.0</a>
                <a href="" class="close">&times;</a>
            </div><!-- az-header-menu-header -->
            <ul class="nav">
                <!--<li class="nav-item active show">
                    <a href="index.html" class="nav-link"><i class="typcn typcn-list-outline"></i> Dashboard</a>
                </li>-->
                <li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-th-list"></i>Módulos</a>
                    <nav class="az-menu-sub">
                        <a href="administracion.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Administración</a>
                        <a href="reasignacion_masiva.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link"> Reasignación masiva </a>
                        <a href="envios.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Envíos</a>
                        <a href="modificaciones.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Modificaciones</a>
                        <a href="solicitud_anuncio_radicado.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link"> Solicitud anuncio de radicado </a>
                        <a href="tablas_retencion_documental.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link"> Tablas de retención documental </a>
                        <a href="consulta_general.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link"> Consultas Generales </a>
                        <a href="transferencia_archivo.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link"> Transferencias documentales </a>
                        <a href="archivo.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link"> Archivo </a>
                        <a href="prestamo.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link"> Préstamo </a>

                    </nav>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-document"></i>Radicación</a>
                    <nav class="az-menu-sub">
                        <a href="radicacion_salida.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Salida</a>
                        <a href="radicacion_entrada.php<?php echo '?galletaAUX=' . $galleta; ?>"class="nav-link">Entrada</a>
                        <a href="modal_doble.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Comunicación Interna</a>
                        <a href="pqrsd.php<?php echo '?galletaAUX=' . $galleta; ?><?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Pqrsd</a>
                        <a href="masiva.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Masiva</a>
                        <a href="asociar_imagen_radicado.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Asociar imagen radicado</a>
                        <a href="asociar_anexo_radicado.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Asociar Anexo a radicado</a>
                        <a href="plantilla_radicado.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">plantilla radicado</a>
                        <a href="plantilla_reasignados.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Plantilla reasignados</a>
                        <a href="radicacion_email.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Radicación E-mail</a>
                        <a href="admon_tercero.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Admon tercero</a>
                    </nav>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-folder"></i>Carpetas</a>
                    <nav class="az-menu-sub">
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Carpetas Usuario</a>
                    <a href="radicacion_entrada.php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Entrada</a>
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Salida</a>
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Pqrsd</a>
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Vo.Bo</a>
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Devueltos</a>
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Reasignación masiva</a>
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Agendado</a>
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Agendado Vencido</a>
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Informados</a>
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link">Transacciones</a>
                    </nav>
                </li>
                <li class="nav-item">
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i>
                        Reportes</a>
                </li>
                <li class="nav-item">
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="nav-link"><i class="typcn typcn-key-outline"></i>
                        Contraseña</a>
                </li>
                <!--<li class="nav-item">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-book"></i> Components</a>
                    <div class="az-menu-sub">
                        <div class="container">
                            <div>
                                <nav class="nav">
                                    <a href="elem-buttons.html" class="nav-link">Buttons</a>
                                    <a href="elem-dropdown.html" class="nav-link">Dropdown</a>
                                    <a href="elem-icons.html" class="nav-link">Icons</a>
                                    <a href="table-basic.html" class="nav-link">Table</a>
                                </nav>
                            </div>
                        </div>
                </li>-->
            </ul>
        </div><!-- az-header-menu -->
        <div class="az-header-right">
            <a href="https://www.bootstrapdash.com/demo/azia-free/docs/documentation.html" target="_blank"
                class="az-header-search-link"><i class="far fa-file-alt"></i></a>
            <a href="" class="az-header-search-link"><i class="fas fa-search"></i></a>
            <div class="az-header-message">
                <a href="#"><i class="typcn typcn-messages"></i></a>
            </div><!-- az-header-message -->
            <div class="dropdown az-header-notification">
                <a href="" class="new"><i class="typcn typcn-bell"></i></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header mg-b-20 d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <h6 class="az-notification-title">Notifications</h6>
                    <p class="az-notification-text">You have 2 unread notification</p>
                    <div class="az-notification-list">
                        <div class="media new">
                            <div class="az-img-user"><img src="../img/faces/face2.jpg" alt=""></div>
                            <div class="media-body">
                                <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                                <span>Mar 15 12:32pm</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media new">
                            <div class="az-img-user online"><img src="../img/faces/face3.jpg" alt=""></div>
                            <div class="media-body">
                                <p><strong>Joyce Chua</strong> just created a new blog post</p>
                                <span>Mar 13 04:16am</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="az-img-user"><img src="../img/faces/face4.jpg" alt=""></div>
                            <div class="media-body">
                                <p><strong>Althea Cabardo</strong> just created a new blog post</p>
                                <span>Mar 13 02:56am</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="az-img-user"><img src="../img/faces/face5.jpg" alt=""></div>
                            <div class="media-body">
                                <p><strong>Adrian Monino</strong> added new comment on your photo</p>
                                <span>Mar 12 10:40pm</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                    </div><!-- az-notification-list -->
                    <div class="dropdown-footer"><a href="">View All Notifications</a></div>
                </div><!-- dropdown-menu -->
            </div><!-- az-header-notification -->
            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user"><img src="../img/faces/face1.jpg" alt=""></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="az-header-profile">
                        <div class="az-img-user">
                            <img src="../img/faces/face1.jpg" alt="">
                        </div><!-- az-img-user -->
                        <h6>Aziana Pechon</h6>
                        <span>Premium Member</span>
                    </div><!-- az-header-profile -->
                    <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
                    <a href=".php<?php echo '?galletaAUX=' . $galleta; ?>" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign
                        Out</a>
                </div><!-- dropdown-menu -->
            </div>
        </div><!-- az-header-right -->
    </div><!-- container -->
</div>