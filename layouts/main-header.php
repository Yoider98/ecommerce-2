<header class="header-content">
        <a href="index.php">
            <div class="logo-place"><img src="assets/fruverco.png" alt=""></div>
        </a>
        <div class="search-place">
            <input type="text" id="idbusqueda" class="idbusqueda-text" placeholder="¿Qué quieres agregar a tu canasta?" value="<?php if(isset($_GET['text'])){ echo $_GET['text'];}else{'';}?>">
            <button class="btn-main btn-search" onclick="search_producto()"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
        <div class="option-place">
            <?php
                    if(isset($_SESSION['codusu'])){
                        echo '<div class="item-option" onclick="mostrar_opciones()"><i class="fas fa-user-circle" aria-hidden="true"></i><p>'.$_SESSION['nomusu'].'</p></div>';
                    }else{
                ?>
            <div class="item-option" title="Registrarme"><a href="login.php"><i class="fas fa-user-plus"
                        aria-hidden="true"></i></a></div>
           
            <?php
                }
                ?>
            <div class="item-option" title="Mis productos">
                <a href="carrito.php"><i class="fas fa-shopping-cart" aria-hidden="true"></i></a>
            </div>
            </div>
        </div>
        <div class="menu-movil">
                <div class="item-option" onclick="mostrar_opciones()"><i class="fas fa-bars"></i></div>
        </div>
    </header>

    <script type="text/javascript">
        function mostrar_opciones(){
            if(document.getElementById("control-menu").style.display=="none"){
                document.getElementById("control-menu").style.display="block";
            }else{
                document.getElementById("control-menu").style.display="none";
            }    
        }
    </script>
    <div class="menu-opciones" id="control-menu" style="display:none;">
        <?php
            if(isset($_SESSION['codusu'])){
            ?>
                <ul>
                    <li>
                        <a href="historial.php">
                            <div class="menu-opcion">Historial de compras</div>
                        </a>
                    </li>
                    <li>
                        <a href="cerrar_sesion.php">
                            <div class="menu-opcion">Cerrar Sesion</div>
                        </a>
                    </li>
                </ul>
                <?php
            }else{
                ?>
                    <ul>
                        <li>
                            <a href="login.php">
                                <div class="menu-opcion">Iniciar Sesion</div>
                            </a>
                        </li>
                        <li>
                            <a href="carrito.php">
                                <div class="menu-opcion">Carrito</div>
                            </a>
                        </li>
                    </ul>
                <?php
            }
            ?>
    </div>