<?php
    if ($_SESSION["rol_id"]==1){
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="blue-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Inicio</span>
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
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\Contratos\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Contratos</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\Servicios\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Servicios</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\Cobros\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Cobros</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\Clientes\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Clientes</span>
                        </a>
                    </li>
                    <li class="blue-dirty">
                        <a href="..\MntUsuario\">
                            <span class="glyphicon glyphicon-th"></span>
                            <span class="lbl">Usuarios</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }
?>
