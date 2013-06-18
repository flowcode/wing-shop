<form class="form-horizontal form">
    <input type="hidden" name="id" value="<?php echo $viewData["product"]->getId() ?>" />
    <div class="control-group">
        <label class="control-label" for="name">Name</label>
        <div class="controls">
            <input type="text" name="name" id="name" value="<?php echo $viewData["product"]->getName() ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="description">Description</label>
        <div class="controls">
            <input type="text" name="description" id="description" value="<?php echo $viewData["product"]->getDescription() ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="status">Status</label>
        <div class="controls">
            <input type="text" name="status" id="status" value="<?php echo $viewData["product"]->getStatus() ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Categorys</label>
        <div class="controls">
            <select multiple="multiple" name="categorys[]" style="height: 137px;">
                <?php foreach ($viewData["categorys"] as $product): ?>
                    <?php
                    $checked = "";
                    foreach ($viewData["product"]->getCategorys() as $postCategorys) {
                        if ($product->getId() == $postCategorys->getId()) {
                            $checked = "selected";
                            break;
                        }
                    }
                    ?>
                    <option <?php echo $checked; ?> value="<?php echo $product->getId(); ?>" ><?php echo $product; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Images</label>
        <div class="controls">
            <select multiple="multiple" name="images[]" style="height: 137px;">
                <?php foreach ($viewData["images"] as $product): ?>
                    <?php
                    $checked = "";
                    foreach ($viewData["product"]->getImages() as $postImages) {
                        if ($product->getId() == $postImages->getId()) {
                            $checked = "selected";
                            break;
                        }
                    }
                    ?>
                    <option <?php echo $checked; ?> value="<?php echo $product->getId(); ?>" ><?php echo $product; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

</form>

