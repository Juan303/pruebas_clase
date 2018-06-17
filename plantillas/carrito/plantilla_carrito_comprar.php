
<h5 class="text-center">Mi cesta<?=$msj_carrito;?></h5>
<?php if(isset($_SESSION['carrito'])){ ?>
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
                <td class="text-right text-light bg-dark">10€</td>
            </tr>
             <tr>
                <td colspan="2"></td>
                <td class="text-right text-light bg-dark">IVA:</td>
                <td class="text-right text-light bg-dark"><?=number_format(($total+10)*0.21,2,',','.');?>€</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="text-right text-light bg-dark">TOTAL:</td>
                <td class="text-right text-light bg-dark"><?=number_format((($total+10)*0.21)+($total+10),2,',','.');?>€</td>
            </tr>
            <tr>
                <td colspan="3">
                    <a href="?vaciar_carrito" class="btn btn-sm btn-warning">Realizar Pedido</a>
                    <a href="?validar_compra=1" class="btn btn-sm btn-success">Comprar</a>
                </td>
            </tr>
            
        </tfoot>   
        
    </table>
    
<?php } ?>