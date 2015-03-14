var deliveryPrice = 150;

var chart = {
	items:[],
	"deliveryPrice": deliveryPrice,
	calcTotal: function () {
		var total = this.deliveryPrice
		for (x in this.items)
		{
			var s = this.items[x].price*this.items[x].count;
			total += s;
		}
		return total;
	},
	getSum:function() {
		return this.price*this.count;
	}
};
var tplCache = {}

function getItemInChartId(id)
{
	for (var i=0;i<chart.items.length;i++)
	{
		if ( chart.items[i].id == id )
		{
			return i;
		}
	}
	return false;
}

function addToChart(id)
{
	if (getItemInChartId(id) === false)
	{
		var productName = $('#product-'+id).attr('data-name');
		var productPrice = $('#product-'+id).attr('data-price');
		chart.items.push ({
			"name":productName,
			"price":productPrice,
			"id":id,
			"count":1
		});
	}
	else
	{
		var id = getItemInChartId(id);
		chart.items[id].count++;
	}
	rewriteChart();
}

function removeFromChart(id)
{
	if (getItemInChartId(id) !== false)
	{
		var id = getItemInChartId(id);
		chart.items[id].count--;
		if (chart.items[id].count <= 0)
		{
			chart.items.splice(id, 1);
		}	
	}
	rewriteChart();
}

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

function rewriteChart()
{
	loadTpl('/mst/basket.mst', chart, "#basket");
}
