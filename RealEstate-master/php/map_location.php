<h4><span class="glyphicon glyphicon-map-marker"></span> Localidad de la propiedad</h4>
        <input type="hidden" id="latitude" value="<?php echo $GIA['latitude']; ?>" />
        <input type="hidden" id="longitude" value="<?php echo $GIA['longitude']; ?>" />
        <input type="hidden" id="title_art" value="<?php echo $GIA['title']; ?>" />
       
         <script>
          function LoadMap() {
            well.style.height='300px';
            
            var mapOptions3 = {
              center: new google.maps.LatLng(document.getElementById("latitude").value, document.getElementById("longitude").value),
              zoom: 13,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            
            var map = new google.maps.Map(document.getElementById("well"),mapOptions3);     
                
              //marcador con la ubicación de la Universidad
            // var place = new google.maps.LatLng(23.1368,-82.3816);
            // var marker = new google.maps.Marker({
            //     position: place
            //     , map: map
            //     , title: 'Pulsa aquí'
            //     , animation: google.maps.Animation.DROP,});
                
            //marcador en el centro del mapa
            var marker2 = new google.maps.Marker({
              position: map.getCenter(),
              map: map, 
            });
              
            //globo de informacion del marcador 2
            var popup = new google.maps.InfoWindow({
              content: document.getElementById("title_art").value});
            popup.open(map, marker2); 
              
            //globo de informacion al dar un clic en el marcador 2
            function showInfo() {
              map.setZoom(16);
              map.setCenter(marker.getPosition());

              var contentString = 'Ubicación Actual';
              var infowindow = new google.maps.InfoWindow({
                content: 'Aqui es donde estudio, lee mas información en: <a href="http://norfipc.com">NorfiPC</a>'});
             infowindow.open(map,marker);
            }
        
            //Dispara accion al dar un clic en el marcador    
            google.maps.event.addListener(marker, 'click', showInfo);

            //Este bloque es funcional.
              // well.style.height='300px';
              // var mapOptions2 = {
              //   center: new google.maps.LatLng(document.getElementById("latitude").value, document.getElementById("longitude").value),
              //   zoom: 13,
              //   mapTypeId: google.maps.MapTypeId.ROADMAP
              // };

              // var map = new google.maps.Map(document.getElementById("well"),mapOptions2);  

              // //marcador en el centro del mapa
              // var marker2 = new google.maps.Marker({
              //   position: map.getCenter(),
              //   title: 'La tienda Carlos III', 
              //   map: map, 
              // });
            //Acá acaba el bloque

            //marcador con la ubicación de la Universidad
            // var place = new google.maps.LatLng(23.1368,-82.3816);
            // var marker = new google.maps.Marker({
            //   position: place, 
            //   title: 'La Universidad de la Habana', 
            //   map: map, 
            // });



            // well.style.height='300px';

            // var mapOptions = {
            //   center: new google.maps.LatLng(document.getElementById("latitude").value, document.getElementById("longitude").value),
            //   zoom: 15,
            //   mapTypeId: google.maps.MapTypeId.ROADMAP
            // };

            // var map = new google.maps.Map(document.getElementById("well"),mapOptions);
          }   
        </script>

        <div id="well">
          
        </div>

    <script src="https://maps.google.com/maps/api/js?key= AIzaSyA_OJ9Y274q4iC6QBxcX_MAferoYTfZC_w&sensor=false&callback=LoadMap"></script>