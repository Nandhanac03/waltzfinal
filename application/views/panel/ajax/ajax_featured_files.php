<?php if ($featured_images): foreach ($featured_images as $featured_image): ?>
        <div class="file-img-container">
            <div class="file-img-container-option">
                <a href="javascript:void(0)" class="file_edit_btn" title="Delete"
                   onclick="featured_file_delete('<?= $featured_image->id ?>')"><i class="fas fa-trash"></i> </a> <a
                   href="javascript:void(0)" class="file_edit_btn" title="Edit"
                   data-file-title="<?= $featured_image->title ?>"
                   data-file-description="<?= $featured_image->description ?>"
                   onclick="featured_file_edit(this, '<?= $featured_image->id ?>')"><i class="fas fa-edit"></i> </a>
            </div>
            <img src="<?= base_url('assets/uploads/news/thumb_' . $featured_image->file) ?>" class="img-fluid"/>
            <div class="file-img-title"><span title="<?= $featured_image->title ?>"><?= $featured_image->title ?: '--' ?></span>
            </div>
        </div>
        <?php
    endforeach;
endif;
?>