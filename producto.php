<?php
    session_start()
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
    <div class="main-content">
        <div class="content-page">
        <section>
            <div class="parte1">
                <img  id="idimg" src="assets/iphonex.jpg"> 
            </div>
            <div class="parte2">
                <h2 id="idtitle">NOMBRE PRINCIPAL</h2>
                <h1 id="idprice">$/. 200.<span>999</span></h1>
                <h3 id="iddescription">Descripción del producto</h3>
                <button onclick="iniciar_compra()">Comprar</button>
            </div>
        </section>
            <div class="title-section">Productos Destacados</div>
            <div class="product-list" id="space-list">
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/main-scripts.js"></script>
    <script type="text/javascript">
        var p='<?php echo $_GET['p']; ?>';
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                url:'servicios/producto/get_all_products.php ',
                type:'POST',
                data:{},
                success:function(data){
                    console.log(data);
                    let html='';
                    for(var i=0; i < data.datos.length; i++){
                        if(data.datos[i].codpro==p){
                            document.getElementById("idimg").src="assets/"+data.datos[i].rutimapro;
                            document.getElementById("idtitle").innerHTML=data.datos[i].nompro;
                            document.getElementById("idprice").innerHTML="$"+data.datos[i].prepro;
                            document.getElementById("iddescription").innerHTML=data.datos[i].despro;
                        }
                        html+=
                '<div class="product-box">'+
                '<a href="producto.php?p='+data.datos[i].codpro+'">'+
                        '<div class="product">'+
                            '<img src="assets/'+data.datos[i].rutimapro+'">'+
                            '<div class="detail-title">'+data.datos[i].nompro+'</div>'+
                            '<div class="detail-description">'+data.datos[i].despro+'</div>'+
                            '<div class="detail-price">'+"$"+data.datos[i].prepro+'</div>'+
                        '</div>'+
                    '</a>'+
                '</div>';
                    }
                    document.getElementById("space-list").innerHTML=html;
                },
                error:function(err){
                    console.error(err);
                }
            });
        });
        /* -----FORMATO PRECIO
        function formato_precio(valor){
            //120.000
            let svalor = valor.toString();
            let array=svalor.split(".");
            return "$/. "+array[0]+".<span>"+array[1]+"</span>";
        }
        */ 
        function iniciar_compra(){
            $.ajax({
                url:'servicios/compra/validar_inicio_compra.php ',
                type:'POST',
                data:{
                    codpro:p
                },
                success:function(data){
                    console.log(data);
                    if(data.state) {
                        alert(data.detail);
                    }else{
                        alert(data.detail);
                        if(data.open_login){
                            open_login();
                        }
                    }
                },
                error:function(err){
                    console.error(err);
                }
            });
        }
        function open_login(){
            window.location.href="login.php";
        }
    </script>
</body>
</html>