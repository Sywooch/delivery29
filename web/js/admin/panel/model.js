
function createActiveBtns()
{
	$.each( $('.js-column-active'), createActiveBtn );
}

function createEditButton()
{
	$.each(
		$('.js-edit'), makeEditButton
	);
}

function makeEditButton(key, obj)
{
	var pId = $(obj).attr('data-id');
	loadTpl("/mst/admin/editBtn.mst", {'id':pId,'url':baseUrl}, obj);
}

function createActiveBtn( key, obj )
{
	var data = {
		"itemId":$(obj).attr('data-id'),
		"active":$(obj).text() == "1" ? true : false,
	};
	loadTpl('/mst/admin/activeBtn.mst', data ,obj);
}


var tplCache = {};
function loadTpl(tpl, data, id) {
	if (typeof(tplCache[tpl]) == "undefined")
	{	
	  $.get(tpl, function(template) {
	    tplCache[tpl] = template;
	    var rendered = Mustache.render(template, data);
	    $(id).html(rendered);
	  });	
	}
	else
	{
		var rendered = Mustache.render(tplCache[tpl], data);
	    $(id).html(rendered);
	}
}

function activate(id)
{
	var data = {
		'itemId':id,
		'active':true
	};
	loadTpl('/mst/admin/activeBtn.mst', data, $('#item-'+id).find('.js-column-active')[0]);
	$.post(baseUrl+"/edit/?id="+id, {"data[active]":1});
}

function deactivate(id)
{
	var data = {
		'itemId':id,
		'active':false
	};
	loadTpl('/mst/admin/activeBtn.mst', data, $('#item-'+id).find('.js-column-active')[0]);
	$.post(baseUrl+"/edit/?id="+id, {"data[active]":0});
}

function deleteItem(id)
{
	if (confirm("Элемент будет удален продолжить?")) 
	{
		$.get(baseUrl+'/delete/?id='+id);
		$('#item-'+id).fadeOut(200);
	}
}

document.addEventListener("DOMContentLoaded", function(event) { 
	createActiveBtns();
	createEditButton();
});