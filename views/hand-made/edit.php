<?php
/* @var $this yii\web\View */
use app\models\HandMadeItem;
use yii\helpers\Url;

/**
 * @var HandMadeItem $item
 * @var bool $new
 */
if ($new) {
    $this->title = "Создание товара";
} else {
    $this->title = "Редактирование товара " . $item->slug . " #" . $item->id;
}
?>
<div class="container js-edit-item">
    <input type="hidden" name="id" value="<?=$item->id?>">
    <div class="col-sm-6">
        <label for="preview">Основное фото</label>

        <div id="preview" class="js-uploader" data-w="200" data-h="200">
            <div class="row">
                <div class="col-sm-6">
                    <p class="js-status"></p>
                    <label for="by-url">Загрузить по ссылке</label>
                    <input id="by-url" name="by-url" type="text" class="js-url form-control">
                    <label for="by-file">Загрузить c диска</label>
                    <input id="by-file" name="by-file" type="file" class="js-file form-control">
                    <button class="btn btn-default form-control js-start-btn">Загрузить</button>
                </div>
                <div class="col-sm-6">
                    <img src="<?= $item->getPreview(200, 200) ?>" class="thumbnail js-image">
                    <input type="hidden" name="preview_id" class="js-input" value="<?=$item->preview_id?>">
                </div>
            </div>
        </div>

        <label for="gallery">Дополнительные фотографии</label>
        <div id="gallery" class="js-uploader" data-strategy="append" data-w="100" data-h="100">
            <div class="row js-image-list">
            <?php foreach($item->images as $image):?>
                <img src="<?=$image->getUrl(100,100)?>" class="thumbnail js-remove-image inline-100" data-id="<?=$image->id?>">
            <?php endforeach?>
            </div>
            <p class="js-status"></p>
            <label for="by-url">Загрузить по ссылке</label>
            <input id="by-url" name="by-url" type="text" class="js-url form-control">
            <label for="by-file">Загрузить c диска</label>
            <input id="by-file" name="by-file" type="file" class="js-file form-control">
            <button class="btn btn-default form-control js-start-btn">Загрузить</button>
        </div>
    </div>
    <div class="col-sm-6">
        <label for="active">Товар доступен</label>
        <input type="checkbox" id="active" name="active" value="1"
               <?php if ($item->active): ?>checked="checked"<?php endif; ?>>
        <br>
        <label for="name">Название</label>
        <input id="name" name="name" value="<?= $item->name ?>" class="form-control">
        <label for="slug">slug</label>
        <input id="slug" name="slug" value="<?= $item->slug ?>" class="form-control">
        <label for="price">Цена руб (без копеек)</label>
        <input id="price" name="price" value="<?= $item->price ?>" class="form-control">
        <label for="discount">Наценка %</label>
        <input id="discount" name="discount" value="<?= $item->discount ?>" class="form-control">
        <label for="short_description">Краткое описание</label>
        <textarea id="short_description" rows="5" name="short_description" class="form-control"><?= $item->short_description ?></textarea>
        <label for="description">Описание</label>
        <textarea id="description" rows="5" name="description" class="form-control"><?= $item->description ?></textarea>
        <br>
        <button class="btn btn-lg btn-primary js-save">Сохранить</button>
    </div>
</div>
<?php
$this->registerJsFile(Url::to(['/js/hand-made/edit-page.js']));
?>
