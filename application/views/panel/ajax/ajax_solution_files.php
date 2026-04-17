<?php if ($solution_images): foreach ($solution_images as $solution_image): ?>
        <div class="file-img-container">
            <div class="file-img-container-option">
                <a href="javascript:void(0)" class="file_edit_btn" title="Delete"
                   onclick="solution_file_delete('<?= $solution_image->id ?>')"><i class="fas fa-trash"></i> </a> <a
                   href="<?= base_url('panel/solution/edit_file/' . $solution_image->solution_id . '/' . $solution_image->id) ?>"
                   class="file_edit_btn" title="Edit" data-file-title="<?= $solution_image->title ?>"><i
                        class="fas fa-edit"></i> </a>
            </div>
            <img src="<?= base_url('assets/uploads/solution/thumb_' . $solution_image->file) ?>" class="img-fluid"/>
            <div class="file-img-title"><span title="<?= $solution_image->title ?>"><?= $solution_image->title ?: '--' ?></span>
            </div>
        </div>
        <?php
    endforeach;
endif;
?>