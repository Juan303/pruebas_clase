<form class="form-inline" action="" method="post">
    <small>Orden:</small>
    <select class="custom-select mr-2 ml-2 custom-select-sm" name="orden" id="orden">
        <option value="precio">Precio</option>
        <option value="nombre">Nombre</option>
    </select>
        <select class="custom-select mr-2 custom-select-sm" name="tipo" id="tipo">
        <option value="ASC">Ascendente</option>
        <option value="DESC">Descendente</option>
    </select>
    <button class="form-control btn-sm btn btn-success" type="submit" name="ordenar">Ordenar</button>
</form>
<form class="form-inline mt-2 mb-2" action="" method="post">
    <small>Buscar:</small>
    <input type="text" name="texto" class="ml-2 mr-2 form-control form-control-sm">
    <button class="form-control btn-sm btn btn-success" type="submit" name="buscar">Buscar</button>
</form>