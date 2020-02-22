$( document ).ready(function() {


    function initialize() {


        var input = document.getElementById('district');
        var autocomplete =  new google.maps.places.Autocomplete(input);


        google.maps.event.addListener(autocomplete, 'place_changed', function () {

            var place = autocomplete.getPlace();

            var today = new Date();
            var now = today.getFullYear()+''+String(today.getMonth() + 1).padStart(2, '0')+''+String(today.getDate()).padStart(2, '0');

            fetch('https://api.foursquare.com/v2/venues/explore?client_id='+client_id+'&client_secret='+secret_id+'&v='+now+'&limit=50&ll='+place.geometry.location.lat()+','+place.geometry.location.lng()+'&intent=match')
                .then(function(response) {
                    response.json().then(function (places) {
                        $('#result').html('');
                        $.each(places.response.groups['0'].items, function(index, value) {
                            var place = '<div class="col-md-4"><div class="card box-shadow mb-3"><div class="card-header">'+value.venue.name+'</div>\<div class="card-body"><h5 class="card-title">'+value.venue.categories[0].name+'</h5>';
                            if(typeof(value.venue.location.address) != "undefined" && value.venue.location.address !== null) {
                                place += '<p class="card-text">Adres: '+ value.venue.location.address+'</p>';
                            }
                            place +='<a  target="_blank" href="https://www.google.com/maps/place/'+value.venue.location.lat+','+value.venue.location.lng+'" class="btn mr-1 btn-outline-info">Beni Oraya Götür</a><button type="button" data-toggle="modal"data-toggle="modal" data-target="#placeDetailsModal" data-id="'+value.venue.id+'" class="btn btn-outline-success">Daha Fazla Bilgi</button></div></div></div>';
                            $('#result').append(place);

                        });
                    })
                })
                .catch(function(error) {
                    alert(error)
                });
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);


    $('#placeDetailsModal').on('show.bs.modal', function (event) {
        var modal = $(this);
        var button = $(event.relatedTarget);
        var placeId= button.data("id");
        var today = new Date();
        var now = today.getFullYear()+''+String(today.getMonth() + 1).padStart(2, '0')+''+String(today.getDate()).padStart(2, '0');



        fetch('https://api.foursquare.com/v2/venues/'+placeId+'?client_id='+client_id+'&client_secret='+secret_id+'&v='+now+'')
            .then(function(response) {
                response.json().then(function (places) {

                    modal.find('.modal-title').text(places.response.venue.name);

                    var modalBody = '';

                    if(typeof(places.response.venue.contact.phone) != "undefined" && places.response.venue.contact.phone !== null) {
                        modalBody += '<p>İletişim Bilgisi: <a href="tel:'+places.response.venue.contact.phone+'">'+places.response.venue.contact.formattedPhone+'</a></p>';
                    }

                    modalBody += '<p>Foursquare Adresi: <a target="_blank" href="'+places.response.venue.canonicalUrl+'">'+places.response.venue.canonicalUrl+'</a></p>';
                    if(typeof(places.response.venue.url) != "undefined" && places.response.venue.url !== null) {
                        modalBody += '<p>Mekan Websitesi: <a target="_blank" href="' + places.response.venue.url + '">' + places.response.venue.url + '</a></p>';
                    }
                    if(typeof(places.response.venue.price) != "undefined" && places.response.venue.price !== null) {
                        modalBody += '<p>Fiyat Bilgisi: ' + places.response.venue.price.message + '</p>';
                    }

                    modalBody += '<p>Beğenme: '+places.response.venue.likes.summary+'</p>';

                    modal.find('.modal-body').html(modalBody);



                })
            })
            .catch(function(error) {alert(error)});
    })

});
