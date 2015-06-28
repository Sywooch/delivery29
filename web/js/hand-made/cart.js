/**
 * Created by iVan on 27.06.2015.
 */


function HandMadeCart() {
    this.modal = $('#hand-made-cart');
    this.controlBtn = $('#hand-made-cart-btn');
    var self = this;
    this.controlBtn.click( function () { self.show(); } );
    this.modal.find('.js-make-order').click( function () { self.openOrderForm(); } );
    this.items = [];
    this.loadItems();
    this.renderBtns();
    this.modal.find('*[data-mask]').each(function (k,v) { $(v).mask($(v).data('mask')); });
}

HandMadeCart.prototype.openOrderForm = function () {
    this.modal.find('#order-form').show();
    this.modal.find('#order-form input:first').focus();
    this.modal.find('.js-make-order').attr('disabled', 'disabled');
};

HandMadeCart.prototype.hideOrderForm = function () {
    this.modal.find('#order-form').hide();
    this.modal.find('.js-make-order').attr('disabled', false);
    //this.modal.find('#order-form input:first').focus();
};

HandMadeCart.prototype.show = function() {
    this.modal.modal('show');
    this.hideOrderForm();
    this.render();
};
HandMadeCart.prototype.render = function () {
    var template = $("#item-table").html();
    var rendered = Mustache.render(template, {'items':this.items});
    this.modal.find('.js-item-table').html(rendered);
    var self = this;
    this.modal.find('.js-item-table .js-cart-item-remove').click( function () {
        self.remove($(this).data('id'));
    } );
    this.renderBtns();
};

HandMadeCart.prototype.renderBtns = function() {
    if (this.isEmpty()) {
        this.modal.find('.js-or, .js-make-order').hide();
        this.controlBtn.attr('disabled','disabled');
        this.controlBtn.removeClass('btn-primary');
        this.controlBtn.addClass('btn-default');
        this.controlBtn.text('Корзина пуста');
    } else {
        this.modal.find('.js-or, .js-make-order').show();
        this.controlBtn.attr('disabled',false);
        this.controlBtn.addClass('btn-primary');
        this.controlBtn.removeClass('btn-default');
        this.controlBtn.text('Показать корзину');
    }
    this.controlBtn.show();
}

HandMadeCart.prototype.isEmpty = function() {
    return this.items.length == 0;
};

HandMadeCart.prototype.hide = function() {
    this.modal.modal('hide');
};
HandMadeCart.prototype.add = function(item) { this.items.push(item);  this.saveItems(); };
HandMadeCart.prototype.findAndRemove = function (id) {
    var item = $('.js-hand-made-item[data-id="'+id+'"]');
    if (item.length) {
        var controller = item.data('item');
        if (controller) {
            controller.removed();
        }
    }
};
HandMadeCart.prototype.remove = function(item) {
    var id;
    if (typeof item == "number") {
       id = item;
    } else {
        id = item.id
    }
    var index = false;
    for (var i = 0; i < this.items.length;i++) {
        if ( this.items[i].id === id ) {
            index = i; break;
        }
    }
    if (index !== false) {
        var itemDrop = this.items.splice(index,1);
        itemDrop = itemDrop[0];
        if (itemDrop.removed) {
            itemDrop.removed();
        } else {
            this.findAndRemove(itemDrop.id);
        }
    }
    this.render();
    this.saveItems();
};
HandMadeCart.prototype.order = function() {};
HandMadeCart.prototype.loadItems = function() {
    if (localStorage) {
        var str = false;
        if (str = localStorage.getItem("hand-made-cart")) {
            this.items = JSON.parse(str);
        }
    }
};
HandMadeCart.prototype.saveItems = function() {
    if (localStorage) {
        localStorage.setItem("hand-made-cart",JSON.stringify( this.items ) );
    }
};
HandMadeCart.prototype.hasId = function(id) {
    for(var i=0;i<this.items.length;i++) {
        var item = this.items[i];
        if (item.id == id) return true;
    }
    return false;
};

function HandMadeItem(item, cart) {
    this.getCart = function () {return cart;};
    this.getRoot =  function () {return item;};
    this.name = this.getName();
    this.id = this.getId();
    this.image = this.getImage();
    this.price = this.getPrice();
    this.priceFormatted = this.getPriceFormatted();
    var self = this;
    this.getRoot().find('.btn-buy').click( function () { self.buy();} );
    if (cart.hasId( this.getId() )) {
        this.added();
    }
}

HandMadeItem.prototype.buy = function() {
    if (this.getCart().hasId( this.id )) {
        this.getCart().show();
        return;
    }
    this.added();
    this.getCart().add(this);
    this.getCart().show()
};
HandMadeItem.prototype.added = function () {
    this.getRoot().find('.btn-buy').removeClass('btn-primary');
    this.getRoot().find('.btn-buy').addClass('btn-success');
    this.getRoot().find('.btn-buy').text('В корзине');
};

HandMadeItem.prototype.removed = function () {
    this.getRoot().find('.btn-buy').addClass('btn-primary');
    this.getRoot().find('.btn-buy').removeClass('btn-success');
    this.getRoot().find('.btn-buy').text('Купить');
};

HandMadeItem.prototype.getId = function () { return this.getRoot().data('id'); };
HandMadeItem.prototype.getName = function () { return this.getRoot().find('.js-name').text(); };
HandMadeItem.prototype.getImage = function () { return this.getRoot().find('.js-image').attr('src'); };
HandMadeItem.prototype.getPriceFormatted = function () { return this.getRoot().find('.js-price').text(); };
HandMadeItem.prototype.getPrice = function () { return this.getRoot().data('price'); };
(function () {
    var handMadeCart = new HandMadeCart();
    var arItems = $('.js-hand-made-item');
    arItems.each( function (k,v) {
        var $v = $(v);
        $v.data('item', new HandMadeItem($v, handMadeCart));
    } );
})();