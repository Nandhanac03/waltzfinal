<?php if ($product_images): foreach ($product_images as $product_image): ?>
        <div class="file-img-container">
            <div class="file-img-container-option">
                <a href="javascript:void(0)" class="file_edit_btn" title="Delete"
                   onclick="product_file_delete('<?= $product_image->id ?>')"><i class="fas fa-trash"></i> </a> <a
                   href="<?= base_url('panel/product/edit_file/' . $product_image->product_id . '/' . $product_image->id) ?>"
                   class="file_edit_btn" title="Edit" data-file-title="<?= $product_image->title ?>"><i
                        class="fas fa-edit"></i> </a>
            </div>
            <img src="<?= base_url('assets/uploads/product/thumb_' . $product_image->file) ?>" class="img-fluid"/>
            <div class="file-img-title"><span title="<?= $product_image->title ?>"><?= $product_image->title ?: '--' ?></span>
            </div>
        </div>
        <?php
    endforeach;
endif;
?>