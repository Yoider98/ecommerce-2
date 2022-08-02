<?php
    session_start(); 
    if (!isset($_SESSION['codusu'])) {
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<head>
    <title>Sistema Ecommerce</title>
    <meta charset="UTF-8">
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
            <h3>Mi Carrito</h3>
            <div class="body-pedido" id="space-list">
            </div>
            <input class="input-procesar_compra"type="text" id="dirusu" placeholder="Dirección">
            <br>
            <input class="input-procesar_compra"type="text" id="telusu" placeholder="Telefono">
            <br>
            <h4>Tipos de pago</h4>
            <div class="metodo-pago">
                <input type="radio" name="tipopago" value="1" id="tipo1">
                <label for="tipo1">Pago por transferencia</label>
            </div>
            <div class="metodo-pago">
                <input type="radio" name="tipopago" value="2" id="tipo2">
                <label for="tipo2">Pago con tarjeta</label>
            </div>
            <button onclick="procesar_compra()" style="margin-top: 5px">Procesar Compra</button>
        </div>
    </div>
    <script type="text/javascript" src="layouts/main-scripts.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                url:'servicios/pedido/get_proprocesar.php',
                type:'POST',
                data:{},
                success:function(data){
                    console.log(data);
                    let html='';
                    let sumaMonto=0;
                    for(var i=0; i < data.datos.length; i++){
                        html+=
                        '<div class="item-pedido">'+
                            '<div class="pedido-img">'+
                                '<img src="assets/'+data.datos[i].rutimapro+'">'+
                            '</div>'+
                            '<div class="pedido-detalle">'+
                                '<h3>'+data.datos[i].nompro+'</h3>'+
                                '<p><b>Precio:</b> $/'+data.datos[i].prepro+'</p>'+
                                '<p><b>Fecha:</b>'+data.datos[i].fecped+'</p>'+
                                '<p><b>Estado:</b>'+data.datos[i].estado+'</p>'+
                                '<p><b>Dirección:</b>'+data.datos[i].dirusuped+'</p>'+
                                '<p><b>Teléfono:</b>'+data.datos[i].telusuped+'</p>'+
                                '<button class="btn-eliminar" onclick="eliminar_producto('+data.datos[i].codped+')">Eliminar </button>'+
                            '</div>'+
                        '</div>';
                        sumaMonto+=parseInt(data.datos[i].prepro)+1;
                    }
                    document.getElementById("space-list").innerHTML=html;
                },
                error:function(err){
                    console.error(err);
                }
            });
        });

        function eliminar_producto(codped){
            $.ajax({
                      url:'servicios/pedido/eliminar-pedido.php',
                      type:'POST',
                      data:{
                            codped:codped,
                                },
                                success:function(data){
                                    console.log(data);
                                    if(data.state){
                                        window.location.reload();
                                    }else{
                                        alert(data.detail);
                                    }
                                },
                                error:function(err){
                                    console.error(err);
                                }
                            });
        }

        function procesar_compra(){
            let dirusu=document.getElementById("dirusu").value;
            let telusu=$("#telusu").val();
            let tipopago=1;
            if(document.getElementById("tipo2").checked){
                tipodepago = 2; 
            }
            if((dirusu=="") || (telusu=="")){ //tener cuidado con la escritura del OR logico dentro del if
                alert("Complete los campos para poder procesar su compra");
            }else{
                if(!document.getElementById("tipo1").checked &&
                    !document.getElementById("tipo2").checked){
                        alert("Seleccione un método de pago");
                    }else{
                        
                                $.ajax({
                                url:'servicios/pedido/confirm.php',
                                type:'POST',
                                data:{
                                    dirusu:dirusu,
                                    telusu:telusu,
                                    tipopago:tipopago
                                },
                                success:function(data){
                                    console.log(data);
                                    if(data.state){
                                        window.location.href="pedido.php";
                                    }else{
                                        alert(data.detail);
                                    }
                                },
                                error:function(err){
                                    console.error(err);
                                }
                            });
                        }
                }
        }
    </script> 
</body>
</html>