 <nav class="navbar navbar-expand-md  navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item <?=$active;?>">
            <a class="btn btn-dark" href="?">Todos</a>
        </li>
        <?php 
            $categorias = list_categorias($conexion);
            while($categoria = mysqli_fetch_array($categorias)){ 
                $active = "";
                if(isset($_GET['categoria']) && $_GET['categoria'] == $categoria['id']){
                    $active = 'active';
                }
        ?>
            <li class="nav-item <?=$active;?>">
            <a class="nav-link" href="?categoria=<?=$categoria['id'];?>"><?=$categoria['nombre'];?></a>
            </li>
        <?php } ?>
    </ul>
</nav>