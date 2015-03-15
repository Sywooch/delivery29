
function createEditButton()
{
	$.each(
		$('.js-edit'), makeEditButton
	);
}

function deleteProduct(id)
{
	if (confirm("Продукт будет удален продолжить?")) 
	{
		$.get('/admin/delete/?id='+id);
		$('#product-'+id).fadeOut(200);
	}
}

function makeEditButton(key, obj)
{
	var pId = $(obj).attr('data-id');
	loadTpl("/mst/admin/product/editBtn.mst", {'id':pId}, obj);
}


function loadTpl(tpl, data, id) {
  $.get(tpl, function(template) {
    var rendered = Mustache.render(template, data);
    $(id).html(rendered);
  });
}

document.addEventListener("DOMContentLoaded", function(event) { 
	createEditButton();
});
