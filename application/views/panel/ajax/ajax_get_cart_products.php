<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="8"><h3>Cart Products</h3></th>
        </tr>
        <tr>
            <th>Sl.No.</th>
            <th  width="10%">Product</th>
            <th>Code</th>
            <th  width="30%">Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Available</th>
            <th>Option</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($cart_products): $i = 0;
            $total_price = 0;
            foreach ($cart_products as $cart_product):
                $i++;
                $total_price += $cart_product->cart_quantity * $cart_product->selling_price;
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td>
                        <?php if ($cart_product->product_cover): ?>
                            <img src="<?= base_url('assets/uploads/product/thumb_' . $cart_product->product_cover) ?>"
                                 width="150">
                             <?php else: ?>
                            <img src="<?= base_url('assets/web/images/no_image.png') ?>" alt=""  width="150">
                        <?php endif; ?>
                    </td>
                    <td>
                        <?= $cart_product->product_code ?>
                    </td>
                    <td>
                        <a href="<?= base_url('product/info/' . $cart_product->id . '/' . $cart_product->title_slug) ?>" target="_blank"><?= $cart_product->product_name ?></a>
                    </td>
                    <td><input type="text" class="form-control" style="width:50px;"name="product_required_quantity_<?= $cart_product->id ?>" value="<?= $cart_product->cart_quantity ?>" onchange="update_required_stock(<?= $cart_product->id ?>, this.value)"></td>
                    <td><?= config_item('CURRENCY') ?> <?= $cart_product->selling_price ?></td>
                    <td><?= $cart_product->units_in_stock >= $cart_product->cart_quantity ? 'In Stock' : 'Out of Stock' ?></td>
                    <td>
                        <button  class="btn btn-danger" onclick="ajax_remove_cart_product(<?= $cart_product->id ?>)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php
            $sub_total = $total_price;
            $vat_amount = $sub_total * ($panel_setting->vat / 100);
            $grand_total = $total_price + $vat_amount + $shipping_charge->rate;
            ?>
            <tr>                                                        
                <td colspan="5" align="right"><label>Sub Total</label></td>
                <td colspan="3" align="left"><?= config_item('CURRENCY') ?> <?= $total_price ?></td>
            </tr>
            <tr>
                <td colspan="5" align="right"><label>Vat(<?= $panel_setting->vat ?>%)</label></td>
                <td colspan="3" align="left"><?= config_item('CURRENCY') ?> <?= $vat_amount ?></td>
            </tr>
            <tr>
                <td colspan="5" align="right"><label>Shipping Charge</label></td>
                <td colspan="3" align="left"><?= config_item('CURRENCY') ?> <?= $shipping_charge->rate ?></td>
            </tr>
            <tr>
                <td colspan="5" align="right"><label>Grand Total</label></td>
                <td colspan="3" align="left"><?= config_item('CURRENCY') ?> <?= $grand_total ?> </td>
            </tr>
        <?php else: ?>
            <tr><td colspan="8" align="center">Cart is empty.</td></tr>
        <?php endif; ?>
    </tbody>
</table>