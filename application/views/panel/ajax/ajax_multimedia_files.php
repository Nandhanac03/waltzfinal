<?php if ($multimedia_images): foreach ($multimedia_images as $multimedia_image): ?>
        <div class="file-img-container">
            <div class="file-img-container-option">
                <a href="javascript:void(0)" class="file_edit_btn" title="Delete"
                   onclick="multimedia_file_delete('<?= $multimedia_image->id ?>')"><i class="fas fa-trash"></i> </a> <a
                   href="javascript:void(0)" class="file_edit_btn" title="Edit"
                   data-file-title="<?= $multimedia_image->title ?>"
                   onclick="multimedia_file_edit(this, '<?= $multimedia_image->id ?>')"><i class="fas fa-edit"></i> </a>
            </div>
            <img src="<?= base_url('assets/uploads/news/thumb_' . $multimedia_image->file) ?>" class="img-fluid"/>
            <div class="file-img-title"><span
                    title="<?= $multimedia_image->title ?>"><?= $multimedia_image->title ?: '--' ?></span>
            </div>
        </div>
        <?php
    endforeach;
endif;
?>