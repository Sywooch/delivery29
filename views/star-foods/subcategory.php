<div class="col-md-12">
<h3><?php echo $subcategory['name']?></h3>
<hr>
    <div class="row">
        <?php
            foreach ($subcategory['items'] as $product) {
                echo $this->render('product', array('data'=>$product));
            }
        ?>
    </div>
</div>