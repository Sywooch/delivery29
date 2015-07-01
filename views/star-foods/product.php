<div
    class="md-product"
    id="product-<?php echo $data->id?>"
    data-price="<?php echo $data->price?>"
    data-name="<?php echo $data->name?>"
    data-category_id="<?php echo $data->category_id?>">
    <div class="panel panel-default">
        <div class="panel-body">
            <p class="ptitle"><?php echo $data->name;?></p>
            <!--span class="label label-info price-text"><?php echo $data->price?> руб.</span>-->
            <img src="<?php echo $data->getImage(200,200);?>" class="fit-image js-item-photo-<?php echo $data->id?>" alt="<?php echo strip_tags($data->name)?>">
            <button class="btn btn-primary bold-text btn-wide btn-space-top js-onclick-basket" onclick="addToChart(<?php echo $data->id?>)"><span class="hidden-xs">В корзину</span><span class="visible-xs-inline glyphicon glyphicon-plus"></span> <?php echo $data->price?> руб.</button>
        </div>
        <?php if (!\Yii::$app->user->isGuest):?>
            <div class="js-set-photo-to" data-id="<?php echo $data->id?>">
                <input type="text" style="width: 75%; display: inline-block" placeholder="Url to image" class="form-control"><button class="btn btn-primary">OK</button>
            </div>
        <?php endif;?>
    </div>
</div>
