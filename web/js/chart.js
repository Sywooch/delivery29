var chart = {
	items:[],
	calcTotal: function () {
		var total = chart.getDeliveryPrice();
		for (x in this.items)
		{
			var s = this.items[x].price*this.items[x].count;
			total += s;
		}
		return total;
	},
	getSum:function() {
		return this.price*this.count;
	},
	initLoad: function ()
	{
		if (!chart.loaded)
		{
			chart.loaded = true;
			chart.afterLoad();
		}
	},
	hasItems: function () {
		if (this.items.length > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	},
	"defIdRewrite":"",
	setDefId: function (id) {
		this.defIdRewrite = id;
	},
	removeAll:function () {
		this.items = [];
		saveChart();
	},
	"zones":deliveryZones,
	"activeZone":getSaveDeliveryZone(),
	getActiveZone: function ()
	{
		if (this.activeZone == false)
		{
			for (var x in chart.zones)
			{
				return chart.zones[x];
			}
		}
		else
		{
			for (var x in chart.zones)
			{
				if (chart.zones[x].id == chart.activeZone)
				{
					return chart.zones[x];
				}
			}
			//Hotfix zone not found
			chart.activeZone = false;
			return chart.getActiveZone();
		}
	},
	isActiveZone: function () 
	{
		var activeZone = chart.getActiveZone();
		return activeZone.id == this.id;
	},
	getDeliveryPrice: function () {
		var activeZone = chart.getActiveZone();
		return activeZone.delivery_price;
	},
	setActiveZone:function(id)
	{
		chart.activeZone = id;
		chart.defaultRewrite();
		saveDeliveryZone(id);
	},
	defaultRewrite:function () {},
	loaded : false,
	afterLoad:function () {}
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
	saveChart();
	loadTpl('/mst/basket.mst', chart, "#basket");
}

function printChart(tpl, id)
{
	loadTpl(tpl, chart, id);
}

function saveChart()
{
	if(typeof(Storage) !== "undefined") {
		localStorage.setItem("items", JSON.stringify(chart.items));
	} else {
		//
	}
}

function loadChart()
{
	if(typeof(Storage) !== "undefined") {
		try {

			var d = JSON.parse(localStorage.getItem('items'));
			if (typeof(d) == "object" && d.length > 0)
			{
				chart.items = d;
			}
		} catch (e) 
		{

		}
	} else {
		//
	}
}

function getSaveDeliveryZone()
{
	if(typeof(Storage) !== "undefined") {
		try {
			var z = localStorage.getItem("deliveryZone");
			if (z != null)
			{
				return z;
			}
			else
			{
				return false;
			}
		} catch (e) 
		{
			return false;
		}
	} else {
		//
	}

	return false;
}


function saveDeliveryZone(id)
{
	if(typeof(Storage) !== "undefined") {
		try {
			localStorage.setItem("deliveryZone", id);
		} catch (e) 
		{
			return false;
		}
	} else {
		//
	}

	return false;
}

function setDeliveryPrice(price)
{
	chart.deliveryPrice = price;
}