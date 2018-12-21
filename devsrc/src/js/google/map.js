$(document).ready(function () {
	var today = new Date()
  var dd = today.getDate()
  var mm = today.getMonth() + 1 // January is 0!
  var yyyy = today.getFullYear()

  if (dd < 10) {
    dd = '0' + dd
  }

  if (mm < 10) {
    mm = '0' + mm
  }

  today = yyyy + '-' + mm + '-' + dd
	// funcion que inicia el mapa
  function initialize (idmap) {
    console.log($('#' + idmap).attr('data-hotels'))
    var textoVerMapa = (lang === 'es') ? 'Ver en Google maps' : 'View On Google Maps'

    var zoom = 15
    var myCenter = new google.maps.LatLng($('#' + idmap).attr('data-coorx'), $('#' + idmap).attr('data-coory'))
    var namehotel = $('#' + idmap).attr('data-namehotel')
    namehotel = namehotel.replace(/\s+/g, '+')
    namehotel = namehotel.replace(/'/g, '')
    // console.log(namehotel)
    var hoteles = [
      [$('#' + idmap).attr('data-namehotel'), 100, $('#' + idmap).attr('data-coorx'), $('#' + idmap).attr('data-coory'), $('#' + idmap).attr('data-pin'), 1]
    ]
    var infoWindowContent = [
      ['<div class="map-container_info_hotel">' +
      '<h3 class="' + $('#' + idmap).attr('data-uri') + '">' + $('#' + idmap).attr('data-namehotel') + '</h3>' +
      '<p>' + $('#' + idmap).attr('data-direccion') + '</p>' +
      '<a target="_blank" style="color: #006e9a; font-weight: 700;" class="text-center" href="https://www.google.com/maps/place/' + namehotel + '/@' + $('#' + idmap).attr('data-coorx') + ',' + $('#' + idmap).attr('data-coory') + ',' + zoom + 'z/data=!3m1!4b1!4m7!3m6!1s' + $('#' + idmap).attr('data-locationmap') + '!5m1!1s' + today + '!8m2!3d' + $('#' + idmap).attr('data-coorx') + '!4d' + $('#' + idmap).attr('data-coory') + '?hl=en-US">' + textoVerMapa + '</a>' +
      '</div>']
    ]
    var mapProp = { // propiedades del MAPA
      center: myCenter,
      zoom: zoom,
      scrollwheel: false,
      zoomControl: true,
      zoomControlOptions: {
        position: google.maps.ControlPosition.LEFT_BOTTOM
      },
      mapTypeControl: false,
      scaleControl: false,
      streetViewControl: false,
      rotateControl: false,
      fullscreenControl: false,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    // pasa las propiedades del mapa
    var map = new google.maps.Map(document.getElementById(idmap), mapProp)

    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i
    for (i = 0; i < hoteles.length; i++) {
      // console.log(hoteles[i]);
      var position = new google.maps.LatLng(hoteles[i][2], hoteles[i][3])
        // bounds.extend(position);// si se desea centrar a todos los marcadores
      marker = new google.maps.Marker({
        map: map,
        position: position,
        label: hoteles[i][0],
        icon: {
          url: hoteles[i][4],
          scaledSize: new google.maps.Size(30, 30),
          labelOrigin: new google.maps.Point(hoteles[i][1], 15)
        },
        zIndex: hoteles[i][5],
        mapTypeControlOptions: {
          mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
        }
      })

        // Allow each marker to have an info window
      google.maps.event.addListener(marker, 'click', (function (marker, i) {
        return function () {
          infoWindow.setContent(infoWindowContent[i][0])
          infoWindow.open(map, marker)
        }
      })(marker, i))
        // Automatically center the map fitting all markers on the screen
        // map.fitBounds(bounds);// si se desea centrar a todos los marcadores
    }
  }
	// funcion que inicia al dar click en el thumbnail
	  function initializeMapRemoveThumbnail () {
	    $('.map_img_cont').click(function () {
	      // al dar click se llama a funcion inicial
	      // verifica si no esta inicializado anteriormente
	      var $imagemap = $(this)
	      if (!document.getElementById('mapToInsert').firstChild) {
	        console.log($imagemap)
	        $imagemap.hide()
	        $('#mapToInsert').removeClass('insert-map').addClass('inserted-map')
	        initialize('mapToInsert')
	      }
	    })
	  }
	google.maps.event.addDomListener(window, 'load', initializeMapRemoveThumbnail)
})