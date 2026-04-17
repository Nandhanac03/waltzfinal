<tr>
    <td><?= $order_item_sl_no ?></td>
    <td><?= $order_product->product_name ?>
        <?php if ($order_product_properties): ?>
            <ul class="list-unstyled">
                <?php foreach ($order_product_properties as $order_product_property): ?>
                    <li><?= $order_product_property->attribute . ' : ' . $order_product_property->attribute_value ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </td>
    <td><?= $order_detail->selling_price ?></td>
    <td><?= $order_detail->quantity ?></td>
    <td><?= $order_detail->total ?></td>
</tr>
