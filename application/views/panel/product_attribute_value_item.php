<tr>
    <td><?= $sl_no ?></td>
    <td><?= $attribute_value ?></td>
    <?php if ($controller_config['disable_attr_value_order'] != TRUE): ?>
        <td>
            <select class="custom-select" id="value_order<?= $value_id ?>"
                    name="value_order<?= $value_id ?>">
                <option value="">--</option>
                <?php
                if ($value_count):
                    for ($i = 1; $i <= $value_count; $i++):
                        ?>
                        <option value="<?= $i ?>" <?= $value_order == $i ? 'selected' : '' ?>><?= $i ?></option>
                        <?php
                    endfor;
                endif;
                ?>
            </select>
        </td>
    <?php endif; ?>
    <td>
        <a href="<?= site_url('panel/product_attribute/edit_value/' . $attribute_id . '/' . $value_id) ?>" title='Edit'
           class="btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
           <?php if ($controller_config['disable_delete_attr_value'] !== TRUE): ?>
            <a href="#" class="btn-sm btn-danger trigger_alert_modal" data-title="Confirm"
               data-desc="Are you sure want to delete this?"
               data-redirect="<?= site_url('panel/product_attribute/delete_attr_value/' . $value_id . '/' . $attribute_id) ?>" title='Delete'><i
                    class="fas fa-trash-alt"></i></a>
            <?php endif; ?>
    </td>
</tr>