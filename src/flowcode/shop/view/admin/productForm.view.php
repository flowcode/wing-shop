<script type="text/javascript">
    function openKCFinder_singleFile() {
        window.KCFinder = {};
        window.KCFinder.callBack = function(url) {
            SetFileField(url);
            window.KCFinder = null;
        };
        window.open('/src/kcfinder/browse.php', 'Admin', 'height=500,width=600');
    }

    function SetFileField(fileUrl) {
        document.getElementById('search-image').value = fileUrl;
        addImage();
    }
    function addImage() {
        var imageUrl = document.getElementById('search-image').value;
        var imageTmpl = '<div class="image-container">';
        imageTmpl += '<button type="button" class="btn btn-mini btn-inverse pull-right" onclick="removeImage(this);"><li class="icon-remove icon-white pull-right"></li></button>';
        imageTmpl += '<div class="image">';
        imageTmpl += '    <img src="' + imageUrl + '"  width="95" height="95">';
        imageTmpl += '    <input type="hidden" name="images[]" value="' + imageUrl + '" />';
        imageTmpl += '</div>';
        imageTmpl += '</div>';
        $("#imageList").append(imageTmpl);
    }
</script>
<style>
    #imageList{
        display: table;
    }
    .image-container{
        float: left;
        width: 110px;
        height: 110px;
        margin: 5px;
        background-color: white;
    }
</style>
<form class="form-horizontal form">
    <input type="hidden" name="id" value="<?php echo $viewData["product"]->getId() ?>" />
    <div class="row-fluid">
        <div class="span6">
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
        </div>
        <div class="span6">
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
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Agregar nueva imagen</label>
        <div class="form-search">
            <div class="input-append">
                <input id="search-image" type="text" name="search-image" placeholder="Buscar nueva imagen" class="span3 search-query" value="">
                <button type="button" class="btn" onclick="openKCFinder_singleFile();" ><i class="icon-search icon-white"></i> Buscar</button>
            </div>
        </div>

        <div id="imageList" class="well">
            <?php foreach ($viewData['product']->getImages() as $image): ?>
                <div class="image-container">
                    <button type="button" class="btn btn-mini btn-inverse pull-right" onclick="removeVideo(this);"><li class="icon-remove icon-white pull-right"></li></button>
                    <div class="image">
                        <img src="<? echo $image->getPath(); ?>"  width='95' height='95'>
                        <input type='hidden' name='images[]' value='<?php echo $image->getPath(); ?>' />
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</form>

