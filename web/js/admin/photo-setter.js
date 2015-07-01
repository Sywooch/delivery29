/**
 * Created by iVan on 02.07.2015.
 */

function PhotoSetter($box) {
    this.$box = $box;
    this.$input = $box.find('input');
    this.$btn = $box.find('button');
    this.id = $box.data('id');
    var self = this;
    this.$btn.click( function () {
        self.start();
        self.upload(self.$input.val());
    } );
}

PhotoSetter.prototype.start = function () {
    this.$btn.attr('disabled', 'disabled');
};
PhotoSetter.prototype.end = function () {
    $('.js-item-photo-'+this.id).attr('src', this.$input.val());
    this.$btn.attr('disabled', false);
};

PhotoSetter.prototype.upload = function (url) {
    var self = this;
    $.ajax({
        'method':'GET',
        'data':{'url':url,'id':this.id},
        'url':'/adm-product/set-photo'
    }).always( function () {
        self.end();
    } );
};