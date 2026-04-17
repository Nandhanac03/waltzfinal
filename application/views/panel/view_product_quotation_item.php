<tr>
    <td><?= $quotation_item_sl_no ?></td>
    <td><?= $quotation_product->product_name ?>
        <?php if ($quotation_properties): ?>
            <ul class="list-unstyled">
                <?php foreach ($quotation_properties as $quotation_property): ?>
                    <li><?= $quotation_property->attribute . ' : ' . $quotation_property->attribute_value ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </td>
    <td><?= $quotation_product->product_code ?></td>
    <td><?= $quotation_product->units_in_stock > 0 ? 'In Stock' : 'Out of stock' ?></td>
    <td>
        <?php if ($quotation->quotation_status == 'P'): ?>
            <input type="text" required name="qp_unit_price<?= $quotation_detail->id ?>" class="allow_decimal" value="<?= $quotation_detail->quotation_selling_price ?>" style="width:100px;" onchange="$('#total_price_pq<?= $quotation_detail->id ?>').html(parseFloat(this.value *<?= $quotation_detail->quotation_quantity ?>).toFixed(2))">
        <?php else: ?>
            <?= $quotation_detail->quotation_selling_price ?>
        <?php endif; ?>
    </td>
    <td><?= $quotation_detail->quotation_quantity ?></td>
    <td><?= config_item('CURRENCY') ?> <span id="total_price_pq<?= $quotation_detail->id ?>"><?= number_format($quotation_detail->quotation_quantity * $quotation_detail->quotation_selling_price,2) ?></span></td>
</tr>
