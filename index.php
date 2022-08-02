<?php
    session_start();
?>
<!DOCTYPE html>

<head>
    <title>Sistema Ecommerce</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700&display=swap" rel="stylesheet">
    <link href="fontawesome-free-5.15.2-web/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/estilos.css">

</head>

<body>
    <?php include("layouts/main-header.php") ?>
    <div>
        <a href="index.php"><img  class="banner-principal" src="assets/Barnner.png" alt=""></a>
    </div>
    <div class="main-content">
        <div class="content-page">

            <div class="title-section">Productos <strong>Destacados</strong></div>
            <div class="product-list" id="space-list">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="layouts/main-scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.ajax({
                url: 'servicios/producto/get_all_products.php ',
                type: 'POST',
                data: {},
                success: function (data) {
                    console.log(data);
                    let html = '';
                    for (var i = 0; i < data.datos.length; i++) {
                        html +=
                            '<div class="product-box">' +
                            '<a href="producto.php?p=' + data.datos[i].codpro + '">' +
                            '<div class="product">' +
                            '<img src="assets/' + data.datos[i].rutimapro + '">' +
                            '<div class="detail-title">' + data.datos[i].nompro + '</div>' +
                            '<div class="detail-description">' + data.datos[i].despro + '</div>' +
                            '<div class="detail-price">' + "$" + data.datos[i].prepro + '</div>' +
                            '</div>' +
                            '</a>' +
                            '</div>';
                    }
                    document.getElementById("space-list").innerHTML = html;
                },
                error: function (err) {
                    console.error(err);
                }
            });
        });
        /*function formato_precio(valor){*/
            //120.000
            //let svalor = valor.toString();
            //let array=svalor.split(".");
            //return "$/. "+array[0]+".<span>"+array[1]+"</span>";
        //}-----FUNCION FORMATO PRECIO
    </script>

    

</body>

</html>