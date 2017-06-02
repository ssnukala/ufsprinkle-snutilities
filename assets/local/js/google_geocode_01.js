// check for Geolocation support
jQuery(document).ready(function () {

    if (navigator.geolocation) {
        console.log('Geolocation is supported!');
    } else {
        console.log('Geolocation is not supported for this Browser/OS.');
    }
//    var infoWindow = new google.maps.InfoWindow;

//    jQuery('.btn_curloc').click(function () {
//        googleGetCurrentAddress(this);
//        return false;
//    });
//
    jQuery(".geocomplete").geocomplete({
        details: "form",
//          blur: true, country: "US",
//            administrative_area_level_1: 'TX',
        types: ["geocode", "establishment"]
//                types: ["geocode", "locality"] ,geocodeAfterResult: true
    }).bind("geocode:result", function (event, result) {
        var thisform = jQuery(this).closest("form");
        var thisformid =thisform.attr('id');
        var addrcomp =result.address_components;
    setValueIfExists(thisformid + ' input[name*="address_line1"]', addrcomp[0].short_name + " " + addrcomp[1].short_name);
    setValueIfExists(thisformid + ' input[name*="address_city"]', addrcomp[3].short_name);
    setValueIfExists(thisformid + ' input[name*="address_state"]', addrcomp[5].short_name);
    setValueIfExists(thisformid + ' input[name*="address_zip"]', addrcomp[7].short_name);
    setValueIfExists(thisformid + ' input[name*="address_country"]', addrcomp[6].short_name);
    
//            thisform.submit();
        console.log(result);
    });

});
/*
function googleGetCurrentAddress(thisbtn, google_testmap) {
    // Try HTML5 geolocation.
//        var thisbtnid = jQuery(thisbtn);
    var thisform = $(thisbtn).closest('form');
    var thisformid = thisform.attr('id');
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
//        var address = document.getElementById('address').value;
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var geoparam = {'location': latlng};
            googleCodeAddress(geoparam, thisformid, google_testmap);
            if (!(typeof google_testmap === "undefined" || google_testmap === null)) {
                infoWindow.setPosition(pos);
                infoWindow.setContent('Location found.');
                google_testmap.setCenter(pos);
            }
        }, function () {
            handleGoogleLocationError(true, infoWindow, google.maps.LatLng(-33.863276, 151.207977));
        });
    } else {
        // Browser doesn't support Geolocation
        handleGoogleLocationError(false, infoWindow, google.maps.LatLng(-33.863276, 151.207977));
    }
}

function handleGoogleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
}

function googleCodeAddress(geocode_param, thisformid, google_testmap) {
    var geocoder;
    geocoder = new google.maps.Geocoder();
    geocoder.geocode(geocode_param, function (results, status) {
        if (status === 'OK') {
            setAddrFormData(thisformid, results[0]);
            if (!(typeof google_testmap === "undefined" || google_testmap === null)) {
                google_testmap.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: google_testmap,
                    position: results[0].geometry.location
                });
            }
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function setAddrFormData(thisformid, data) {
    var par_formid = thisformid;
    this_location = data;
    jQuery.each(data.address_components, function (key, value) {
//                    console.log(value);
        if (value.types[0] === 'postal_code')
            this_zip = value.short_name;
        if (value.types[0] === 'street_number')
            this_street_no = value.short_name;
        if (value.types[0] === 'route')
            this_street_name = value.short_name;
        if (value.types[0] === 'locality')
            this_city = value.short_name;
        if (value.types[0] === 'administrative_area_level_1')
            this_state = value.short_name;
        setValueIfExists(par_formid + ' input[name=' + value.types[0] + ']', value.short_name);
    });
    setValueIfExists(par_formid + ' input[name=place_id]', data.place_id);
    setValueIfExists(par_formid + ' input[name=formatted_address]', data.formatted_address);
    setValueIfExists(par_formid + ' input[name=lat]', data.geometry.location.lat);
    setValueIfExists(par_formid + ' input[name=lng]', data.geometry.location.lng);
    setValueIfExists(par_formid + ' input[name=formatted_address]', data.formatted_address);
    setValueIfExists(par_formid + ' input[name=full_address]', this_street_no + " " + this_street_name + "," + this_city + "," + this_state + " " + this_zip);
    setValueIfExists(par_formid + ' input[name=address_line1]', this_street_no + " " + this_street_name);
    setValueIfExists(par_formid + ' input[name=city]', this_city);
    setValueIfExists(par_formid + ' input[name=state]', this_state);
    setValueIfExists(par_formid + ' input[name=zip]', this_zip);
    setValueIfExists('search_property_id_i', '');
    var var_hideform = false;
    jQuery("#" + par_formid).submit();
}*/