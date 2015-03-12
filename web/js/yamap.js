var myMap;
var C_DELAY_TIME = 60*5*1000;
var disableNotice = false;
ymaps.ready(init);
function init () {

    if ( typeof(initCenter) == "undefined" )
    {
        var initCenter = [59.934462, 30.331814]; //невский проспект
        var initZoom = 10;
    }

    if ( typeof(initZoom) == "undefined" )
    {
        var initZoom = 10;
    }

    myMap = new ymaps.Map('yamap', {
        center: initCenter, 
        zoom: initZoom,
        type: 'yandex#map',
        controls: ['smallMapDefaultSet']
    });
    $('.js-updateInLocation').click(setNewLocation);

    $(pointData).each( addPoint );
}


function cordFromText(text)
{
    var c = text.split(',');
    return [c[0], c[1]];
}

function setNewLocation(el)
{
    myMap.setCenter( cordFromText( el.target.text ) );
}

var x;
function onMarkClick(ev)
{
    var id = ev.get("target").properties.get("objId");
    // console.log(id);
    showId(id);
    disableNotice = true;
}

function getObj(id) {
    for (var i = 0; i < pointData.length; i++)
    {
        if (pointData[i].id == id)
        {
            return pointData[i];
        }
    }
}

function showId(id)
{
    var post = getObj(id);
    $("#pointView #date").text( post.date );
    $("#pointView #text").text( post.text );
    $("#pointView #photo").attr( "src", post.photo );
    $("#pointView .js-url").attr( "href", post.url );
    $("#pointView").fadeIn();
}

function addPoint( id, obj, sNotice )
{
    var now = new Date();
    var pointTime = new Date(obj.date);
    var d =  now.getTime() - pointTime.getTime(); 
    if ( d < C_DELAY_TIME ) {
        var waitTime = C_DELAY_TIME - d;
        setTimeout( function () {addPoint(id, obj, true)}, waitTime+10 );
        // console.log(waitTime+" "+id);
        return;
    }
    var o = new ymaps.Placemark([obj.lat, obj.lon], {
           }, {
            preset: 'islands#circleIcon',
            iconColor: '#0095b6',
        });
    o.events.add(['click'], onMarkClick);
    o.properties.set("objId", obj.id)
    myMap.geoObjects.add(
        o
    );

    if (sNotice === true)
    {
        showNotice(id, obj);
    }
}

function showNotice(id, obj)
{
    if (!disableNotice)
    {
        showId(id);
    }
}