
<h5 class="text-center">Mi cesta<?=$msj_carrito;?></h5>
<?php if(isset($_SESSION['carrito'])){ ?>
    <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">Artículo</th>
                <th class="text-right" scope="col">Precio</th>
                <th class="text-right" scope="col">Cantidad</th>
            </tr>
        </thead>
        <?php 
            $total = 0; 
            foreach($_SESSION['carrito'] as $indice => $valor){ 
        ?>
                <tr>
                    <td><?=$indice;?></td>
                    <td class="text-right"><?=number_format($valor['precio'],2,',','.'); $total += $valor['precio'];?>€</td>
                    <td class="text-right"><?=$valor['cantidad'];?></td>
                </tr>   
        <?php } ?>
        <tfoot>
            <tr class="table-dark">
                <td>Total:</td>
                <td class="text-right"><?=number_format($total,2,',','.');?>€</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3">
                    <a href="?vaciar_carrito" class="btn btn-sm btn-warning">Vaciar...</a>
                    <a href="validar_compra.php" class="btn btn-sm btn-success">Comprar</a>
                </td>
            </tr>
        </tfoot>   
        
    </table>
    
<?php } ?>