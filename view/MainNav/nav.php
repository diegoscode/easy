<?php
    if ($_SESSION["rol_id"]==1){
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="fa fa-globe"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="#">
                            <span class="fa fa-money"></span>
                            <span class="lbl">Pagos</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\PagoTransferencia\">
                        <span class="fa fa-chevron-right"></span>
                        <span class="lbl">Reportar Transferencia</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\PagoMovil\">
                        <span class="fa fa-chevron-right"></span>
                        <span class="lbl">Reportar Pago Movil</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\NuevoTicket\">
                            <span class="fa fa-ticket"></span>
                            <span class="lbl">Reportar Falla</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="fa fa-exclamation-triangle"></span>
                            <span class="lbl">Consultar Falla</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }else{
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="fa fa-globe"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\Contratos\">
                            <span class="fa fa-sticky-note-o"></span>
                            <span class="lbl">Contratos</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\Servicios\">
                            <span class="fa fa-gear"></span>
                            <span class="lbl">Servicios</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\Pagos\">
                            <span class="fa fa-money"></span>
                            <span class="lbl">Pagos</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\Clientes\">
                            <span class="fa fa-users"></span>
                            <span class="lbl">Clientes</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\MntUsuario\">
                            <span class="fa fa-user"></span>
                            <span class="lbl">Usuarios</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\Reportes\">
                            <span class="fa fa-file"></span>
                            <span class="lbl">Reportes</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="fa fa-ticket"></span>
                            <span class="lbl">Consultar Falla</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }
?>
