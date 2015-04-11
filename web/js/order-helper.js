/**
 * Created by iVan on 11.04.2015.
 */

OrderHelper = {
    tplCache: {},
    init: function () {
        $(document.body).append('<div class="order-helper" id="order-helper"></div>');
        OrderHelper.tpl("/mst//order-helper.mst",{},'#order-helper');
    },
    tpl: function (tpl, data, id) {
        if (typeof(OrderHelper.tplCache[tpl]) == "undefined") {
            $.get(tpl, function (template) {
                OrderHelper.tplCache[tpl] = template;
                var rendered = Mustache.render(template, data);
                $(id).html(rendered);
            });
        }
        else {
            var rendered = Mustache.render(tplCache[tpl], data);
            $(id).html(rendered);
        }
    },
    show: function () {
        $('#help-window').show();
    },
    hide: function (event) {
        if (event) {
            event.preventDefault();
        }
        $('#help-window').hide();
    },
    submit:function(event) {
        if (event) {
            event.preventDefault();
        }
        var data = $('#help-form').serialize();
        $.post("/help/help", data);
        alert("Ваше сообщение успешно отправлено");
        OrderHelper.hide();
    }
};

$(document).ready(
    function () {
        OrderHelper.init();
    }
);