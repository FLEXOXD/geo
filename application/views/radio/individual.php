<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista individual</title>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!--Api google -->
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2LiA3m_PbBeCUxOQz3V3h247JSAeAaB0&libraries=places&callback=initMap"></script>

</head>

<body>

    <div class="text-center" class="row">
        <a class="btn btn-primary" href="<?php echo site_url("radios/index"); ?>">Volver</a>
    </div>
    <div>
        <div id="mapa" class=" " style="height:800px; width:100%px;
            border:2px solid black;">

        </div>

    </div>

    <script type="text/javascript">
        var Niagara = {
            lat: -0.512119302442686,
            lng: -78.56818758566463,
            zoom: 18,
            fillColor: "yellow"

        };
        var Arupos = {
            lat: -0.512119302442686,
            lng: -78.56818758566463,


        };
        var Vicente = {
            lat: -0.512119302442686,
            lng: -78.56818758566463,
        };


        function initMap() {
            var id = document.getElementById('id_dq)');

            <?php if ($radioIndividual) : ?>
                <?php foreach ($radioIndividual->result() as $radioTemporal) : ?>
                    var myOptions = {
                zoom: 15,
                center: <?php echo $radioTemporal->ubicacion_dq; ?>,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            //Mapas Dentro del modal



            map = new google.maps.Map(document.getElementById('mapa'), myOptions);


                    var latitud_longitud = new google.maps.LatLng(<?php echo $radioTemporal->ubicacion_dq; ?>);
                    console.log(latitud_longitud);



                    <?php if ($id_rd = $radioTemporal->id_dq) : ?>
                        marker = new google.maps.Marker({
                            position: <?php echo $radioTemporal->ubicacion_dq; ?>,
                            map: map,
                            title: '<?php echo $radioTemporal->nombre_dq; ?>'
                        });
                        graficarCirculo();
                    <?php endif; ?>















































                <?php endforeach; ?>



            <?php endif; ?>




        }
    </script>
    <script>
        $(function() {
            $('[data-toggle="popover"').popover()
        });
    </script>
    <script type="text/javascript">
        function graficarCirculo() {



            <?php if ($radioIndividual) : ?>
                <?php foreach ($radioIndividual->result() as $radioTemporal) : ?>

                    var latitud_longitud = new google.maps.LatLng(<?php echo $radioTemporal->ubicacion_rd; ?>);
                    console.log(latitud_longitud);
                    var radio = <?php echo $radioTemporal->rango_rd; ?>;
                    var circulo = new google.maps.Circle({
                        strokeColor: "#0000ff",
                        strokeOpacity: "0.7",
                        steokeWeight: 2,
                        fillColor: "<?php echo $radioTemporal->color_rd; ?>",
                        fillOpacity: "0.5",
                        map: map,
                        center: <?php echo $radioTemporal->ubicacion_rd; ?>,
                        radius: radio * 100
                        //Default es en metros y se multiplica para que sea km
                    });
                    console.log("<?php echo $radioTemporal->color_rd; ?>");
                    marker = new google.maps.Marker({
                        position: <?php echo $radioTemporal->ubicacion_rd; ?>,
                        map: map,
                        title: '<?php echo $radioTemporal->nombre_rd; ?>'

                    });


                <?php endforeach; ?>



            <?php endif; ?>
        }
    </script>
</body>

</html>
