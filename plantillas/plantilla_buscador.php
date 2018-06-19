<div class="row">
<form class="form-inline col-sm-8 col-md-6 col-xl-7" action="" method="post">
    <small>Orden:</small>
    <select class="custom-select mr-1 ml-1 custom-select-sm" name="orden" id="orden">
        <option value="precio">Precio</option>
        <option value="nombre">Nombre</option>
    </select>
    <select class="custom-select mr-1 custom-select-sm" name="tipo" id="tipo">
        <option value="ASC">Ascendente</option>
        <option value="DESC">Descendente</option>
    </select>
    <button class="btn-sm btn btn-success" type="submit" name="ordenar"><i class="material-icons md-18">text_rotate_vertical</i></button>
</form>
<form class="form-inline mt-2 mb-2 col-sm-4 col-md-6 col-xl-5" action="" method="post">
     <div id="custom-search-input">
        <div class="input-group col-md-12">
            <input type="text" class="form-control form-control-sm" placeholder="Buscar" name="texto" />
            <span class="input-group-btn">
                <button class="btn btn-info btn-sm" type="submit" name="buscar">
                    <i class="material-icons md-18">search</i>
                </button>
            </span>
        </div>
    </div>

</form>
</div>



