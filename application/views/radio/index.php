<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIrculos Referencialess</title>

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

<body class="container">

    <br>
    <h1 class="text-center"><b>RADIO GOOGLE MAPS</b></h1>
    <br>
    <div class="row">
        <div class="col-md-5">
            <legend class="text-center"><b>FORMULARIO</b></legend>
            <br>
            <form class="form-horizontal" action="<?php echo site_url('radios/guardar'); ?>" method="post">
              <div class="row">
          <div class="col-md-4 text-right">
            <label for="">NOMBRE DE LA RADIO</label>
          </div>
          <div class="col-md-7">
            <input type="text" name="nombre_dq" id="nombre_dq" value="" class="form-control" placeholder="INGRESE LOS DOS NOMBRE DE LA RADIO" required>
          </div>
        </div>
                <br>
                <div class="row">
            <div class="col-md-4 text-right">
              <label for="">LATITUD:</label>
            </div>
            <div class="col-md-7">
              <input type="text" name="latitud_dq" id="latitud_dq" value="" class="form-control" placeholder="MARQUE LA LATITUD" required>
            </div>
          </div>
          <br>
          <div class="row">
      <div class="col-md-4 text-right">
        <label for="">LONGITUD:</label>
      </div>
      <div class="col-md-7">
        <input type="text" name="longitud_dq" id="longitud_dq" value="" class="form-control" placeholder="MARQUE LA LONGITUD" required>
      </div>
    </div>              
                <br>
                <div id="mapa-1" style="border:2px solid black; height: 250px; width:100%;"></div>

                <br><br><b>RADIO</b>
                <input type="number" name="rango_dq" id="radio_dq" class="form-control" value="" placeholder="Ingrese en km" required>
                <br>
                <br>
                <b>COLOR DE RADIO</b>
                <input type="color" name="color_dq" id="color_dq" class="form-control" value="" placeholder="Ingrese el codigo de color" required>
                <br>
                <br>
                <div class="text-center">
                    <button type="submit" name="button" class="btn btn-primary ">GUARDAR</button>&nbsp&nbsp&nbsp<a href="<?php echo site_url('radios/index') ?>" class="btn btn-danger">
                        CANCELAR </a>
                </div>

            </form>
        </div>
        <div class="col-md-7 text-center">
            <legend class="text-center"><b>GRAFICAS</b></legend>
            <?php if ($listadoRadios) : ?>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">NOMBRE</th>
                            <th class="text-center">UBICACION</th>
                            <th class="text-center">RANGO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listadoRadios as $radioTemporal) : ?>
                            <tr>
                                <td class="text-center"> <?php echo $radioTemporal->id_dq; ?> </td>
                                <td class="text-center"> <?php echo $radioTemporal->nombre_dq; ?></td>
                                <td class="text-center"> <?php echo $radioTemporal->ubicacion_dq; ?></td>
                                <td class="text-center"> <?php echo $radioTemporal->rango_dq; ?></td>
                                <td>
                                    <a href="<?php echo site_url('radios/individual'); ?>/<?php echo $radioTemporal->id_dq; ?>"  class="btn btn-success">Ver</a>
                                    <a href="<?php echo site_url('radios/borrar'); ?>/<?php echo $radioTemporal->id_dq; ?>" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div id="mapa-circulo" style="border:2px solid black; height: 420px; width:100%;"></div>
            <?php else : ?>
                <div class="text-center">
                    <h5><b>NO EXISTEN VALORES PARA GRAFICAR EL RADIO</b></h5>
                </div>
            <?php endif; ?>
            <div hidden id="mapa-circulo2" style="border:2px solid black; height: 320px; width:100%;"></div>
        </div>
    </div>
    <script type="text/javascript">
        function initMap() {
            let latitudInput = document.getElementById('latitud_dq');
            let longitudInput = document.getElementById('longitud_dq');
            let mapaCirculo = document.getElementById('mapa-circulo');
            let colorInput = document.getElementById('color_dq');

            var latitud_longitud1 = new google.maps.LatLng(-0.512119302442686, -78.56818758566463);
            var mapa = new google.maps.Map(
                document.getElementById('mapa-1'), {
                    center: latitud_longitud1,
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            );

            var marker = new google.maps.Marker({
                position: latitud_longitud1,
                map: mapa,
                draggable: true,
                title: "Arrastrame"
            });
            latitudInput.value = marker.getPosition().lat();
            longitudInput.value = marker.getPosition().lng();

            google.maps.event.addListener(marker, 'dragend', function(event) {
                document.getElementById("latitud_dq").value = this.getPosition().lat();
                document.getElementById("longitud_dq").value = this.getPosition().lng();
            });

            //crear el Mapa
            var mapaCirculo1 = new google.maps.Map(
                mapaCirculo, {
                    center: latitud_longitud1,
                    zoom: 13,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            );

            let circuloIteracion;
            <?php if ($listadoRadios) : ?>
                <?php foreach ($listadoRadios as $elemento) : ?>
                    circuloIteracion = new google.maps.Circle({
                        strokeColor: '#FF0000',
                        strokeOpacity: 0.8,
                        strokeWeight: 2,
                        fillColor: "<?php echo $elemento->color_dq ?>",
                        fillOpacity: 0.35,
                        map: mapaCirculo1,
                        center: <?php echo $elemento->ubicacion_dq; ?>,
                        radius: parseFloat(<?php echo $elemento->rango_dq ?>) * 1000
                    })
                <?php endforeach; ?>
            <?php endif; ?>

          }
    </script>

</body>

</html>
