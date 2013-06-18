<form class="form-horizontal form">
    <input type="hidden" name="id" value="<?php echo $viewData["productImage"]->getId() ?>" />
    <div class="control-group">
        <label class="control-label" for="name">Name</label>
        <div class="controls">
            <input type="text" name="name" id="name" value="<?php echo $viewData["productImage"]->getName() ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="description">Description</label>
        <div class="controls">
            <input type="text" name="description" id="description" value="<?php echo $viewData["productImage"]->getDescription() ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="path">Path</label>
        <div class="controls">
            <input type="text" name="path" id="path" value="<?php echo $viewData["productImage"]->getPath() ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Products</label>
        <div class="controls">
            <select multiple="multiple" name="products[]" style="height: 137px;">
                <?php foreach ($viewData["products"] as $productImage): ?>
                    <?php
                    $checked = "";
                    foreach ($viewData["productImage"]->getProducts() as $postProducts) {
                        if ($productImage->getId() == $postProducts->getId()) {
                            $checked = "selected";
                            break;
                        }
                    }
                    ?>
                    <option <?php echo $checked; ?> value="<?php echo $productImage->getId(); ?>" ><?php echo $productImage; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

</form>

