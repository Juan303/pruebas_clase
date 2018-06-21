
<h5 class="text-center">Mi cesta<?=$msj_carrito;?></h5>
<?php 
    if(isset($_SESSION['carrito'])){ 
        $id_transporte = "";
        $gastos_envio = "";
        if(isset($_POST['actualizar_gastos'])){
            $id_transporte = $_POST['gastos_envio'];
            $gastos_envio = precio_transporte($conexion, $_POST['gastos_envio']);
        }
    ?>
    <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">Artículo</th>
                <th class="text-right" scope="col">Precio/u</th>
                <th class="text-right" scope="col">Cantidad</th>
                <th class="text-right" scope="col">Total</th>
            </tr>
        </thead>
        <?php 
            $total = 0; 
            foreach($_SESSION['carrito'] as $indice => $valor){ 
        ?>
                <tr>
                    <td><?=$indice;?></td>
                    <td class="text-right"><?=number_format(($valor['precio']/$valor['cantidad']),2,',','.'); $total += $valor['precio'];?>€</td>
                    <td class="text-right"><?=$valor['cantidad'];?></td>
                    <td class="text-right"><?=number_format($valor['precio'],2,',','.');?>€</td>
                </tr>   
        <?php } ?>
        <tfoot>
            <tr>
                <td colspan="2"></td>
                <td class="text-right text-light bg-dark">Sub total:</td>
                <td class="text-right text-light bg-dark"><?=number_format($total,2,',','.');?>€</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-right text-light bg-dark">Gastos de envio:</td>
                <td class="text-right text-light bg-dark"><?=$gastos_envio;?>€</td>
            </tr>
             <tr>
                <td colspan="2"></td>
                <td class="text-right text-light bg-dark">IVA:</td>
                <td class="text-right text-light bg-dark"><?=number_format(($total+$gastos_envio)*0.21,2,',','.');?>€</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-right text-light bg-dark">TOTAL:</td>
                <td class="text-right text-light bg-dark"><?=number_format((($total+$gastos_envio)*0.21)+($total+$gastos_envio),2,',','.');?>€</td>
            </tr>
            <tr>
                <td colspan="3">
                    <a href="?vaciar_carrito" class="btn btn-sm btn-warning">Realizar Pedido</a>
                    <a href="?validar_compra=1&id_transporte=<?=$id_transporte;?>" class="btn btn-sm btn-success">Comprar</a>
                </td>
            </tr>
            
        </tfoot>   
        
    </table>
    <div class="row">
        <div class="col-6">
            <h5>Envio:</h5>
            <p>Selecciona un metodo de envio.</p>
            <form method="post" action="">
                <select name="gastos_envio" class="custom-select mb-1">
                    <?php
                        $transportes = list_registros($conexion, 'transporte', 'nombre', "ASC", 'todos');
                        while($transporte = mysqli_fetch_array($transportes)){
                    ?>
                    <option value="<?=$transporte['id'];?>"><?=$transporte['nombre'];?></option>
                    <?php } ?>
                </select>
                <button class="btn btn-sm btn-info" name="actualizar_gastos" type="submit" value="Actualizar">Actualizar</button>
            </form>
        </div>
    </div>
    
    
<?php } ?>