<form class="form-horizontal form">
    <input type="hidden" name="id" value="<?php echo $viewData["productCategory"]->getId() ?>" />
    <div class="control-group">
        <label class="control-label" for="name">Name</label>
        <div class="controls">
            <input type="text" name="name" id="name" value="<?php echo $viewData["productCategory"]->getName() ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="description">Description</label>
        <div class="controls">
            <input type="text" name="description" id="description" value="<?php echo $viewData["productCategory"]->getDescription() ?>"/>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Products</label>
        <div class="controls">
            <select multiple="multiple" name="products[]" style="height: 137px;">
                <?php foreach ($viewData["products"] as $productCategory): ?>
                    <?php
                    $checked = "";
                    foreach ($viewData["productCategory"]->getProducts() as $postProducts) {
                        if ($productCategory->getId() == $postProducts->getId()) {
                            $checked = "selected";
                            break;
                        }
                    }
                    ?>
                    <option <?php echo $checked; ?> value="<?php echo $productCategory->getId(); ?>" ><?php echo $productCategory; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

</form>

