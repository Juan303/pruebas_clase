<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="h1" href="index.php">Mi WEB</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <!--<li class="nav-item active">
                <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
            </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>-->
            <li class="nav-item">
                <a class="nav-link" href="productos.php">Productos</a>
            </li>
        </ul>
        <div>
        <?php
        $error = "";
        if(isset($_POST['email_login'])){
            $email = $_POST['email_login'];
            $pass = $_POST['pass'];
            if(!login($conexion, $email, $pass)){
                $error = "Nombre de usuario o contraseña incorrectos";
            }
        }
        else if(isset($_GET['salir'])){
            session_destroy();
            unset($_SESSION['email']);
            header("Location:index.php");
        }
        if(!isset($_SESSION['email'])) { ?>
            <form class="form-inline my-2 my-lg-0" method="post" action="">
                <input class="form-control mr-sm-2" type="text" placeholder="Correo electronico" name="email_login" aria-label="Email">
                <input class="form-control mr-sm-2" type="password" placeholder="Contraseña" name="pass" aria-label="pass">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Entrar</button>
            </form>
            <a class="text-success ml-1" href="registro.php">Registrarse</a>
            <p class="ml-1 text-danger font-weight-light font-italic">
                <?=$error;?>
            </p>
            <?php } else { ?>
               <ul class="navbar-nav">
                   <li class="nav-item dropdown">
                        <div class="btn-group">
                            <button class="btn btn-info dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?=$_SESSION['usuario'];?><span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="editar_cuenta.php">Mi cuenta</a>
                                <a class="dropdown-item" href="?salir=1">Salir</a>
                                <?php if(is_admin($conexion, $_SESSION['email'])){ ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="admin_usuarios.php">Editar usuarios</a>
                                    <a class="dropdown-item" href="admin_productos.php">Editar productos</a>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>