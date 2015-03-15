
function crateEditParams()
{
	$.each( $('.js-edit-param'), makeEdit );
}

function makeEdit(key, obj)
{
	var name = $(obj).attr('data-name');
	var value = $(obj).text();
	loadTpl('/mst/admin/params/editform.mst', {'name':name,'value':value}, obj);
}

function addParam()
{
	var name = prompt("Name = ");
	$('.js-add-row').append('<tr><td>'+name+'</td><td data-name="'+name+'" id="f'+name+'"></td></tr>');
	makeEdit(1, '#f'+name);
}

function createParam(name,value)
{
	$.get('/params/create', {'name':name,'value':value});
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

document.addEventListener("DOMContentLoaded", function(event) { 
	crateEditParams();
});