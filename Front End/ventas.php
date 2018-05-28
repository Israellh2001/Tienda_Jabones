<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Natural Beauty</title>
    <link rel="icon" href="img/icono.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/foooter.css">
    <link rel="stylesheet" href="css/ventas.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--CONECCION CON FIREBASE-->
       <script src="https://www.gstatic.com/firebasejs/4.13.0/firebase.js"></script>
    <script>
    // configurar conexion con Firebase
    var config = {
    apiKey: "AIzaSyAKBIuhbYnWG9Iq45SKLNRZGphcBHOgyTY",
    authDomain: "shampoo-matizados.firebaseapp.com",
    databaseURL: "https://shampoo-matizados.firebaseio.com",
    projectId: "shampoo-matizados",
    storageBucket: "shampoo-matizados.appspot.com",
    messagingSenderId: "345778643787"
  };


    firebase.initializeApp(config);

    </script>

  </head>
  <body>

    <?php
    if(isset($_GET['exito'])) {
      $resultado = $_GET['exito'];
	   if($resultado=="true"){?>
       <script type="text/javascript">
         swal({
           title: "Tu compra se ha realizado con exito",
           text:"gracias por tu visita",
           type: "success",
           confirmButtonText:"Aceptar"
         });
       </script><?php
     }if($resultado=="false"){?>
        <script>
          swal({
            title: "Se ha cancelado la compra",
            text:"gracias por tu visita",
            type: "error",
            confirmButtonText:"Aceptar"
          });
        </script><?php
      }
	  }?>

    <div class="Pagina">
      <!-- Barra de navegación -->
      <nav>
        <div class="menuIcon"> <!-- Icono de menú cuando el tamaño es reducido -->
          <i class="fa fa-bars fa-2x"></i>
        </div>
        <div class="logo">
          LOGO
        </div>
        <div class="menu">
          <ul>
            <li><a href="index.html" class="link">Inicio</a></li>
            <li><a href="ventajas.html" class="link">Producto</a></li>
            <li><a href="ventas.php" class="link">Tienda</a></li>
            <li><a href="areas.html" class="link">Departamentos</a></li>
            <li><a href="nosotros.html" class="link">Nosotros</a></li>
          </ul>
        </div>
      </nav>


      <!-- Contenido -->
      <div class="contenido" id="indice">

            <script>
              var name = "";
                    // cargar datos desde firebase
                    var dbRef = firebase.database().ref().child("Producto");
                        dbRef.on("child_added",function(snapshot){

                        console.log(snapshot.val());
                        var articulo=document.createElement("article");
                        var data=snapshot.val();

                        /*
                        var contenido="<div class='producto1'><blockquote><CENTER><h4 class='hotel'>"+data.Nombre+"</h4></CENTER><img src='img/shampoo.jpg'><CENTER><a>Contenido:"+data.Cantidad+"</a></CENTER><CENTER><a>Precio: "+data.Precio+"</a></CENTER><CENTER><a>Envio: $50.00</a></CENTER><div class='wrapper'><form action='pagar.php' method='post'><input type='hidden' name='producto' value="+data.Nombre+"><input type='hidden' name='precio' value="+data.Precio+"><input type='hidden' name='envio' value='50'><div class='btn'><button type='submit'>Comprar</button></div></form></div></blockquote></div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
                        */
                        var ml="f";
                        if(data.Cantidad=="60ml"){
                          ml="s";
                        }else{
                          ml="c";
                        }

                        var nom = data.Nombre.split(" ");
                        var categoria = nom[3];
                        console.log("Ultimo: "+categoria);

                        var contenido =
                        "<div class='producto' id="+ml+" category="+categoria+">"+
                          "<div class='tarjeta'>"+
                            "<div class='titulo'>"+
                              "<h4 class='nombre'>"+data.Nombre+"</h4>"+
                            "</div>"+
                            "<div class='cuadro'>"+
                              "<CENTER><img src='img/productos/shampoo.jpg'></CENTER>"+
                            "</div><br>"+
                            "<CENTER><a>Contenido :"+data.Cantidad+"</a></CENTER>"+
                            "<CENTER><a>Precio: "+data.Precio+"</a></CENTER>"+
                            "<CENTER><a>Envio: $50.00</a></CENTER>"+
                            "<div class='wrapper'>"+
                              "<form action='pagar.php' method='post'>"+
                                "<input type='hidden' name='producto' value="+data.Nombre+">"+
                                "<input type='hidden' name='precio' value="+data.Precio+">"+
                                "<input type='hidden' name='envio' value='50'>"+
                                "<center><div class='btn'>"+
                                  "<center><button type='submit'><b>Comprar</b></button></center>"+
                                "</div></center>"+
                              "</form>"+
                            "</div>"+
                          "</div>"+
                        "</div>"+
                        "<br>";

                        articulo.innerHTML=contenido;
                        document.getElementById("productos").appendChild(articulo);
            });
            </script>

            <div id="productos"></div>
            <div class="espacio"></div>
    </div>


    <!-- Menu responsivo -->
    <script type="text/javascript">
      $(document).ready(function(){
        $(".menuIcon").on("click",function(){
          $("nav ul").toggleClass("showing");
        });
      });

      $(window).on("scroll",function(){
        if($(window).scrollTop()){
          $('nav').addClass('black');
          $('a').addClass('white');
          $('a::hover').addClass('white');
        }else{
          $('nav').removeClass('black');
          $('a').removeClass('white');
          $('a::hover').removeClass('white');
        }
      });
    </script>
-
    <!-- Pie de página -->
    <footer>
      <div class="footer-container">
        <div class="footer-main">
          <div class="footer-columna">
            <h3>Contáctanos</h3>
            <span class="fa fa-map-marker"><p>Prototipo</p></span><br>
            <span class="fa fa-phone"><p>(+51) 449 278 2024</p></span><br>
            <span class="fa fa-envelope"><p>info@honeyclean.com</p></span>
          </div>
          <div class="footer-columna">
            <h3>Honey Clean</h3>
            <p>Honey Clean es una empresa...</p>
          </div>
        </div>
      </div>
      <div class="footer-copy-redes">
        <div class="main-copy-redes">
          <div class="footer-copy">
            &copy; 2018 Honey Clean
          </div>
          <div class="footer-redes">
            <a href="#" class="fa fa-facebook"></a>
            <a href="#" class="fa fa-twitter"></a>
            <a href="#" class="fa fa-google-plus"></a>
            <a href="#" class="fa fa-github"></a>
          </div>
        </div>
      </div>
    </footer>
  </body>

  <script type="text/javascript">/*
    $(".article").ready(function(){
      var tam = $("#productos article").innerHeight();
      console.log("Tamaño: "+ tam);
      $("#productos").height(tam*3.1);


      $(window).resize(function(){
        var tam2 = $("#productos").innerHeight();
        console.log("Tamaño: "+ tam2);
        $("#productos").height(tam+tam2*.8);
      });
    });*/
  </script>
</html>
