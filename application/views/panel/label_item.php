<tr>
    <td><?= $sl_no ?></td>
    <td><?= $title ?></td>
    <td><?= $keyword ?></td>
    <?php if ($controller_config['disable_label_edit'] !== TRUE || $controller_config['disable_label_delete'] !== TRUE): ?>
    <td>
        <?php if ($controller_config['disable_label_edit'] !== TRUE): ?>
            <a href="<?= site_url('panel/label/edit/' . $label_id) ?>" title='Edit' class="btn-sm btn-primary"><i
                    class="fas fa-user-edit"></i></a> 
            <?php endif; ?>
            <?php if ($controller_config['disable_label_delete'] !== TRUE): ?>
            <a href="#" class="btn-sm btn-danger trigger_alert_modal"
               data-title="Confirm"
               data-desc="Are you sure want to delete this?"
               data-redirect="<?= site_url('panel/label/delete/' . $label_id) ?>"
               title='Delete'><i class="fas fa-trash-alt"></i></a>
            <?php endif; ?>
    </td>
    <?php endif; ?>
</tr>