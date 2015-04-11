/**
 * Created by iVan on 11.04.2015.
 */
$(document).ready(
    function () {
        $('.js-onclick-basket').click(onClickMacDack);
    }
);
var toBasketTimer;
function setDesktopToBasket(obj) {
    var toBasket = $('#desktop-to-basket');
    var x = obj.offset().left;
    var y = obj.offset().top;
    y = y+obj.outerHeight()+5;
    toBasket.css({
        'left': x+"px",
        'top': y+"px",
        'width': obj.outerWidth()
    });
    toBasket.fadeIn();
    clearTimeout(toBasketTimer);
    toBasketTimer = setTimeout( function () {
        toBasket.fadeOut();
    }, 9000 );
}

function onClickMacDack() {
    setDesktopToBasket($(this));
    var x = $(this).attr('data-lock');
    var obj = this;
    x = parseInt(x);
    var timer = $(this).attr('data-timer');
    clearTimeout(timer);
    if (x > 0) {
        x++;
        $(this).attr('data-lock', x);
        $(this).text("В корзине +"+x);
        timer = setTimeout( function () {
            $(obj).attr('data-lock', 0);
            $(obj).text( $(obj).attr('data-old-text') );
            $(obj).addClass('btn-primary');
            $(obj).removeClass('btn-success');
        }, 2500 );
        $(this).attr('data-timer', timer);
        return;
    }
    $(this).attr('data-lock', 1);
    var text = $(this).text();
    $(this).attr('data-old-text', text);
    $(this).text("В корзине");
    $(this).removeClass('btn-primary');
    $(this).addClass('btn-success');
    timer = setTimeout( function () {
        $(obj).text( $(obj).attr('data-old-text') );
        $(obj).attr('data-lock', 0);
        $(obj).addClass('btn-primary');
        $(obj).removeClass('btn-success');
    }, 2500 );
    $(this).attr('data-timer', timer);
}
