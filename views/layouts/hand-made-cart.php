<div class="modal fade" id="hand-made-cart" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Корзина</h4>
            </div>
            <div class="modal-body">
                <div class="js-item-table">
                </div>

                <div style="text-align: center">
                    <a
                        href="<?=\Yii::$app->urlManager->createUrl(['/hand-made'])?>"
                        class="btn btn-default"
                        >
                        Продолжить покупки
                    </a>
                    <span class="js-or">или</span>
                    <button class="js-make-order btn btn-primary">Оформить заказ</button>
                </div>

                <div style="display: none" id="order-form">
                    <br>
                    <form action="<?=\Yii::$app->urlManager->createUrl(['/order/make'])?>" class="form-horizontal">
                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">Адрес доставки</label>
                            <div class="col-sm-9">
                                <input data-error-text="Введите адрес" data-required="true" type="text" class="form-control" id="address" name="address" placeholder="улица дом (корпус) квартира">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">Телефон</label>
                            <div class="col-sm-9">
                                <input data-error-text="Введите телефон" data-required="true" type="text" class="form-control" id="phone" data-mask="+7(999) 999 99 99" name="tel" placeholder="+7">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment" class="col-sm-3 control-label">Комментарий</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="comment" rows="3" placeholder="Не обязятельно" name="comment"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary">Оформить заказ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="tpl/mst" id="item-table">
    <table class="table item-list">
    <!--<thead>
        <tr>
            <th>
            </th>
            <th></th>
            <th></th>
        </tr>
    <thead>-->
    <tbody>
        {{#items}}
            <tr>
                <td class="image">
                    <img class="thumbnail" src="{{image}}">
                </td>
                <td class="name">
                    <span class="name">{{name}}</span>
                </td>
                <td class="price">
                <span>{{priceFormatted}}</span>
                <button title="Удалить из корзины" class="js-cart-item-remove btn btn-xs" data-id="{{id}}"><span class="glyphicon glyphicon-trash"></span></button></td>
            </tr>
        {{/items}}
        {{^items}}
            <tr>
                <td colspan="3">Ваша корзина пуста</td>
            </tr>
        {{/items}}
    </tbody>
    </table>
</script>