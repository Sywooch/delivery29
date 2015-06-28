/**
 * Created by iVan on 27.06.2015.
 */


function FileUploader(item) {
    this.rootItem = item;
    this.w = item.data('w');
    this.h = item.data('h');
    this.$image = item.find('.js-image');
    this.$input = item.find('.js-input');
    this.$status = item.find('.js-status');
    this.strategy = item.data('strategy');
    this.status("");
    var self = this;
    item.find('.js-start-btn').click( function () { self.start() } );
    this.setRemoveableItem();
}

FileUploader.prototype.status = function(text) {
  this.$status.text(text);
};

FileUploader.prototype.start = function () {
    this.status("Загружаем");
    var urlValue = this.getUrl();
    var fileValue = this.getFile();
    if (urlValue) {
        this.startUrl(urlValue);
    } else if(fileValue) {
        this.startFile(fileValue);
    } else {
        this.status("Ничего не выбрано");
    }
};

FileUploader.prototype.startFile = function(file) {
    var data = this.getData("");
    var fData = new FormData();
    fData.append('image', this.rootItem.find('.js-file')[0].files[0]);
    for (var key in data) {
        fData.append(key, data[key]);
    }
    var self = this;
    $.ajax({
        'url':'/media/upload?return=Y&w='+data.w+"&h="+data.h,
        'method':'POST',
        'data':fData,
        'type':'text',
        processData: false,
        contentType: false,
        'success':function(data) {
            var id = parseInt(data);
            if (id > 0) {
                data = data.split('|');
                if (data.length >= 2) {
                    self.successUpload(data[0],data[1]);
                } else {
                    self.errorUpload("Неверный файл. Разрешен только jpg или png");
                }
            } else {
                self.errorUpload("Очень пложой файл");
            }
        },
        'error':function() {
            self.errorUpload("Ошибка сервера");
        }
    });
};

FileUploader.prototype.getUrl = function () {
    return this.rootItem.find('.js-url').val();
};
FileUploader.prototype.setUrl = function (val) {
    return this.rootItem.find('.js-url').val(val);
};
FileUploader.prototype.getFile = function () {
    return this.rootItem.find('.js-file').val();
};

FileUploader.prototype.getData = function(url) {
    return {
        'url':url,
        'w':this.w,
        'h':this.h,
        'return':'Y',
        '_csrf':$('meta[name="csrf-token"]').attr('content')
    };
};

FileUploader.prototype.startUrl = function (url) {
    var data = this.getData(url);
    var self = this;
    $.ajax(
        {
            'url':'/media/upload-url',
            'method':'GET',
            'data':data,
            'type':'text',
            'success':function (data) {
                var id = parseInt(data);
                    if (id > 0) {
                        data = data.split('|');
                        if (data.length >= 2) {
                            self.successUpload(data[0],data[1]);
                            self.setUrl("");
                        } else {
                            self.errorUpload("Неверный url");
                        }
                    } else {
                        self.errorUpload("Неверный url");
                    }
                }
            ,
            'error':function () {
                self.errorUpload("Ошибка сервера");
            }
        }
    );
};

FileUploader.prototype.errorUpload = function(text) {
    this.status(text);
};

FileUploader.prototype.successUpload = function(id, url) {
    this.status("Загружено "+id);
    if (this.strategy == "append") {
        this.appendImage(url, id);
    } else {
        this.setImage(url);
        this.setField(id);
    }
};

FileUploader.prototype.appendImage = function(url,id){
    this.rootItem.find('.js-image-list').append('<img src="'+url+'" class="thumbnail js-remove-image inline-100" data-id="'+id+'">');
    this.setRemoveableItem();
};

FileUploader.prototype.setRemoveableItem = function () {
  this.rootItem.find('.js-remove-image').click( function () {
      $(this).remove();
  } )
};

FileUploader.prototype.setImage = function (src) {
    this.$image.attr('src',src);
};

FileUploader.prototype.setField = function (id) {
    this.$input.val(id);
};



function ItemEditor(item) {
    this.rootItem = item;
    this.initFileUploader();
    var self = this;
    item.find('.js-save').click( function () { self.save(); } )
}

ItemEditor.prototype.initFileUploader = function () {
    this.rootItem.find('.js-uploader').each( function (key, obj) {
        var $obj = $(obj);
        $obj.data('uploader', new FileUploader($obj));
    });
};

ItemEditor.prototype.save = function () {
    var data = {};
    this.rootItem.find('.js-save').text("Сохраняем...");
    this.rootItem.find('.js-save').attr('disabled', 'disabled');
    var arInput = this.rootItem.find('input, textarea');
    for(var i = 0; i < arInput.length;i++) {
        var $input = $(arInput[i]);
        if ($input.attr('type') == 'checkbox') {
            if ($input.prop('checked')) {
                data[$input.attr('name')] = $input.val();
            }
        } else {
            data[$input.attr('name')] = $input.val();
        }

    }
    var arAddImage = this.rootItem.find('.js-remove-image');
    data.images = [];
    for (var j = 0; j < arAddImage.length; j++) {
        data.images.push( $(arAddImage[j]).data('id') );
    }
    data._csrf = $('meta[name="csrf-token"]').attr('content');
    var self = this;
    $.ajax({
        'url':'/hand-made/save-item',
        'data':data,
        'method':'POST',
        'type':'text',
        'success':function (data) {
            alert('Успешно сохранено!');
            window.location = data
        },
        'error':function () {
            alert('Сохранить не удалось (');
            self.rootItem.find('.js-save').attr('disabled', false);
            self.rootItem.find('.js-save').text('Сохранить');
        }
    });
};

( function () {
    var r = new ItemEditor($('.js-edit-item'));
} )();