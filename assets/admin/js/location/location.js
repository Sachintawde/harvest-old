// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete_1;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete_1 = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('c_adrs')),
      {types: ['geocode']});

  autocomplete_2 = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement} */(document.getElementById('edit_c_adrs')),
    {types: ['geocode']});
  
  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete_1.addListener('place_changed', fillInAddress_1);
  autocomplete_2.addListener('place_changed', fillInAddress_2);
}


function fillInAddress_1() {
  // Get the place details from the autocomplete object.
  var place_1 = autocomplete_1.getPlace();

  console.log(place_1);

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place_1.address_components.length; i++) {
    var addressType = place_1.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place_1.address_components[i][componentForm[addressType]];
      $('#address_1 #'+addressType).val(val);

      $('#address_1 #'+addressType).closest(".nk-int-st").addClass("nk-toggled");

      console.log($('#address_1 #'+addressType).val(val));

    }
  }
}

function fillInAddress_2() {
  // Get the place details from the autocomplete object.
  var place_2 = autocomplete_2.getPlace();

  console.log(place_2);

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place_2.address_components.length; i++) {
    var addressType = place_2.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place_2.address_components[i][componentForm[addressType]];
      $('#address_2 #'+addressType).val(val);

      $('#address_2 #'+addressType).closest(".nk-int-st").addClass("nk-toggled");

      console.log($('#address_2 #'+addressType).val(val));

    }
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete_1.setBounds(circle.getBounds());
      autocomplete_2.setBounds(circle.getBounds());
    });
  }
}

