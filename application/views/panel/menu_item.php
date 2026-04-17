<tr>
    <td><?= $sl_no ?></td>
    <td><?= $title ?></td>
    <!-- <td>
        <select class="custom-select" id="menu_order_<?= $menu_id ?>" name="menu_order_<?= $menu_id ?>">
            <option value="">--</option>
            <?php
            if ($menu_count) :
                for ($i = 1; $i <= $menu_count; $i++) :
            ?>
                    <option value="<?= $i ?>" <?= $menu_order == $i ? 'selected' : '' ?>><?= $i ?></option>
            <?php
                endfor;
            endif;
            ?>
        </select>
    </td> -->
    <td>
        <a href="<?= site_url('panel/menu/edit/' . $menu_id) ?>" title='Edit' class="btn-sm btn-primary"><i class="fas fa-user-edit"></i></a>
        <?php if ($controller_config['disable_menu_delete'] !== TRUE) : ?>
            <a href="#" class="btn-sm btn-danger trigger_alert_modal" data-title="Confirm" data-desc="Are you sure want to delete this?" data-redirect="<?= site_url('panel/menu/delete/' . $menu_id) ?>" title='Delete'><i class="fas fa-trash-alt"></i></a>
        <?php endif; ?>
    </td>
</tr>