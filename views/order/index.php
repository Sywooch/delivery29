<?php
/* @var $this yii\web\View */
$this->title = 'Оформление заказа';
?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>Проверьте состав вашего заказа</h3><hr>
            <div id="chart-data">
                <p>Подождите корзина загружается....</p>
            </div>
            <h3>Если все верно, введите ваш адрес и телефон</h3><hr>
            <form id="order-from" onsubmit="makeOrder(); return false;" class="form-horizontal">
                <div class="form-group" id="address">
                    <label for="address" class="col-sm-3 control-label">Адрес</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="address" placeholder="">
                        <span class="js-error-text text-danger"></span>
                    </div>
                </div>
                <div class="form-group" id="tel">
                    <label for="tel" class="col-sm-3 control-label">Телефон</label>
                    <div class="col-sm-9">
                        <input type="tel" name="tel" class="form-control" placeholder="+7(xxx) xxx xx xx">
                        <span class="js-error-text text-danger"></span>
                    </div>
                </div>
                <div class="form-group" id="comment">
                    <label for="comment" class="col-sm-3 control-label">Комментарий (необязательно)</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="comment"
                                  placeholder="Ваш комментарий к заказу...."></textarea>
                    </div>
                </div>
                <div class="form-group" style="text-align: center">
                    <div class="">
                        <button type="submit" class="btn btn-success btn-wide">Заказать</button>
                        <label class="js-error-message text-danger"></label>
                        <label class="js-make-order-loader text-info" style="display:none">Пожалуйста подождите</label>
                        <label class="js-make-order-success text-success" style="display:none">Заказ успешно
                            оформлен</label>
                    </div>
                </div>
            </form>
<!--            <div class="panel panel-default">-->
<!--                <div class='panel-body'>-->
<!--                    <h3 style="margin-top:0">Как оформить заказ?</h3>-->
<!--                    <ul>-->
<!--                        <li>-->
<!--                            Введите ваш адрес и контактный телефон.-->
<!--                        </li>-->
<!--                        <li>Нажмите кнопку оформить</li>-->
<!--                        <li>Дождитесь звонка нашего оператора</li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--            </div>-->
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        loadChart();
        printChart('/mst/basket/order.mst', '#chart-data');
        chart.defaultRewrite = function () {
            printChart('/mst/basket/order.mst', '#chart-data');
        };
        $.fn.serializeObject = function () {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function () {
                if (o[this.name] !== undefined) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
    });

    function clearError( obj )
    {
        $(obj).removeClass("has-error");
        $(obj).find(".js-error-text").text(' ');
        $('.js-error-message').text(' ');
    }

    function setError(obj, message)
    {
        scrollTo(obj);
        $(obj).addClass("has-error");
        $(obj).find(".js-error-text").text(message);
        $(obj).find("input").focus();
        $(obj).find("input").keydown( function () { clearError(obj); } );
    }

    function validate(key, value, all) {
        switch (key) {
            case "tel":
                if (typeof(value) != "string" || value.length < 9) {
                    setError("#tel", "Обязательно введите ваш телефон");
                    return false;
                }
                break;

            case "address":
                if (typeof(value) != "string" || value.length < 5) {
                    setError("#address", "Обязательно укажите адрес");
                    return false;
                }
                break;
        }
        return true;
    }

    function scrollTo(obj)
    {
            $('html, body').animate({
                scrollTop: $(obj).offset().top
            }, 200);
    }

    function makeOrder() {
        try {
            $('.js-error-message').text(" ");
            $('.has-error').removeClass("has-error");
            var data = $('#order-from').serializeObject();
            data.zone_id = $('#delivery-zone').val();
            for (var x in data) {
                if (!validate(x, data[x], data)) {
                    $('.js-error-message').text("Пожалуйста запоните обязательные поля");
                    return false;
                }
            }
            data.items = chart.items;
            $('.js-make-order-loader').fadeIn(200);
            postOrder(data);
        } catch (e) {
            alert("Упс, при оформлении заказа произошла ошибка, попробуйте позже");
            console.log(e);
        }
    }

    function postOrder(data) {
        $.post("/order/make", {"data": data}, function (data) {
            chart.removeAll();
            $('.js-make-order-success').fadeIn(200);
            window.location = "/order/success?id=" + data.response;

        }, "json").fail(function () {
            alert("При оформлении заказа возникла проблема, попробуйте позже");
        })
            .always(function () {
                $('.js-make-order-loader').fadeOut(200);
            });
    }
</script>
