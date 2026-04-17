<div class="form-group col-sm-12 col-md-4 mb-4">
    <label for="productAttribute<?= $attribute->id ?>"><?= $attribute->title ?> <?=$attribute->is_required==1?'<span class="text-danger">*</span>':''?></label>
    <select class="custom-select col-sm-12" id="productAttribute<?= $attribute->id ?>" name="productAttribute<?= $attribute->id ?>">
        <option value="">None</option>
        <?php
        if ($attribute_values):
            foreach ($attribute_values as $attribute_value):
                ?>
                <option value="<?= $attribute_value->id ?>" <?php if (!empty($product_attributes_value) && in_array($attribute_value->id, $product_attributes_value)) echo 'selected'; ?>><?= $attribute_value->attribute_value ?></option>
                <?php
            endforeach;
        endif;
        ?>
    </select>
    <?php echo form_error('productAttribute' . $attribute->id); ?>
</div>