<tr>
    <td><?= $sl_no ?></td>
    <td><?= $title ?></td>
    <?php if ($controller_config['disable_delete_pr_group_order']!=TRUE): ?>
        <td>
            <select class="custom-select" id="group_order_<?= $group_id ?>" name="group_order_<?= $group_id ?>">
                <option value="">--</option>
                <?php
                if ($group_count):
                    for ($i = 1; $i <= $group_count; $i++):
                        ?>
                        <option value="<?= $i ?>" <?= $group_order == $i ? 'selected' : '' ?>><?= $i ?></option>
                        <?php
                    endfor;
                endif;
                ?>
            </select>
        </td>
    <?php endif; ?>
    <td>
        <a href="<?= site_url('panel/product_group/edit/' . $group_id) ?>" title='Edit' class="btn-sm btn-primary"><i
                class="fas fa-user-edit"></i></a>
            <?php if ($controller_config['disable_delete_pr_group'] !== TRUE): ?>
            <a href="#" class="btn-sm btn-danger trigger_alert_modal" data-title="Confirm"
               data-desc="Are you sure want to delete this?"
               data-redirect="<?= site_url('panel/product_group/delete/' . $group_id) ?>" title='Delete'><i
                    class="fas fa-trash-alt"></i></a>
            <?php endif; ?>
    </td>
</tr>