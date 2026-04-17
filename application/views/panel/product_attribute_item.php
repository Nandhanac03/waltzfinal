<tr>
    <td><?= $sl_no ?></td>
    <td><?= $title ?></td>
    <?php if ($controller_config['disable_attribute_order'] != TRUE): ?>
        <td>
            <select class="custom-select" id="attribute_order_<?= $attribute_id ?>"
                    name="attribute_order_<?= $attribute_id ?>">
                <option value="">--</option>
                <?php
                if ($attribute_count):
                    for ($i = 1; $i <= $attribute_count; $i++):
                        ?>
                        <option value="<?= $i ?>" <?= $attribute_order == $i ? 'selected' : '' ?>><?= $i ?></option>
                        <?php
                    endfor;
                endif;
                ?>
            </select>
        </td>
    <?php endif; ?>
    <td>
        <a href="<?= site_url('panel/product_attribute/all_value/' . $attribute_id) ?>" title='Attribute Values'
           class="btn-sm btn-dark"><i class="fas fa-compress"></i></a> <a
            href="<?= site_url('panel/product_attribute/edit/' . $attribute_id) ?>" title='Edit'
            class="btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
            <?php if ($controller_config['disable_delete_attribute'] !== TRUE): ?>
            <a href="#" class="btn-sm btn-danger trigger_alert_modal" data-title="Confirm"
               data-desc="Are you sure want to delete this?"
               data-redirect="<?= site_url('panel/product_attribute/delete/' . $attribute_id) ?>" title='Delete'><i
                    class="fas fa-trash-alt"></i></a>
            <?php endif; ?>
    </td>
</tr>