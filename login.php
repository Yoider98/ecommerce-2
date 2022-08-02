<!DOCTYPE html>
<head>
    <title>Sistema Ecommerce</title>
    <meta charset="UTF-8">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700&display=swap" rel="stylesheet">
    <link href="fontawesome-free-5.15.2-web/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
        <header class="header-content">
        <a href="index.php"><div class="logo-place"><img src="assets/fruverco.png" alt=""></div></a>
        </header>
    <div class="main-content">
        <div class="content-page">
            <div>
                <form action="servicios/login.php" method="POST">
                    <h3>Iniciar Sesión</h3>
                    <input type="text" name="emausu" placeholder="Correo electronico">
                    <input type="password" name="pasusu" placeholder="Contraseña">
                        <?php
                            if(isset($_GET['e'])){
                                switch ($_GET['e']) {
                                    case '1':
                                        echo '<p>Error de Conexión</p>';
                                        break;
                                    case '2':
                                        echo '<p>Email Invalido</p>';
                                        break;
                                    case '3':
                                        echo '<p>Contraseña Incorrecta</p>';
                                        break;
                                    default:
                                        break;
                                }
                            }
                        ?>
                    <button type="submit">Iniciar Sesion</button>
                </form>
            </div>

            <div>
                <form action="servicios/registrar.php" method="POST">
                    <h3>Regístrate</h3>
                    <input type="text" name="emausur" placeholder="Correo electronico">
                    <input type="password" name="pasusur" placeholder="Contraseña">
                    <input type="password" name="pasusu2r" placeholder="Confirmar Contraseña">
                        <?php
                            if(isset($_GET['er'])){
                                switch ($_GET['er']) {
                                    case '1':
                                        echo '<p>Error de Conexión</p>';
                                        break;
                                    case '2':
                                        echo '<p>Email ya está siendo usado</p>';
                                        break;
                                    case '3':
                                        echo '<p>Las contraseñas no coinciden</p>';
                                        break;
                                    default:
                                        break;
                                }
                            }
                        ?>
                    <button type="submit">Crear Cuenta</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>