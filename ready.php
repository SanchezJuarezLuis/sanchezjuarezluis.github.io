
<?php
error_reporting(E_ALL^ E_NOTICE);
session_start();
require_once 'vendor/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

$config = require_once 'config.php';

$consumer_key = 'e2IKHEeJq0l01TDFg1mzVt6aT';
$consumer_secret = 'rt0wQv0mdDrKJ5p0PFcNR7RSmlSeUKfYaYhxjYaAlIBSMSEi6l';




$oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');


if(!empty('oauth_verifier') && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
  
?>
<!DOCTYPE>
<html>
<head>
<meta charset="utf-8">
 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->


 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

     <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

	    <!-- <script src="http://pagination.js.org/dist/2.1.2/pagination.min.js"></script> -->




        <link rel="stylesheet" type="text/css" href="estilo2.css">



<!--   <link rel="stylesheet" type="text/css" href="metro/css/metro.min.css">
    <link rel="stylesheet" type="text/css" href="boot/css/bootstrap.min.css"> -->




<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
 <script src="superlooper.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  

<title>Striker</title>
</head>
<body>

  <!-- Page Layout here -->
    <div class="row">

      <div class="col s3" id="panel1">
        <!-- Grey navigation panel -->



        <img  class="striker" src="img/striker1.png"/> 
       
    


     <p><a href="https://www.facebook.com/StriikerPop"> <img    class="face" src="img/face.png"/>
LUIS SANCHEZ JUAREZ</p></a>
<!-- 	 
<div class="card">
  <div class="card-header"><p><img src="img/user.png" class="imgRedonda"> usuario</p></div>
  <div class="card-body">Content</div> 
  <!<div class="card-footer">Footer</div>-->



<ul class="">
        <li> <button   class="btn-floating btn-large green darken-3 pulse" ><i class="material-icons">chevron_right</i></button><p>Realiza la busqueda de videos</p></li>
      <li><button class="btn-floating btn-large red darken-4 pulse"  ><i class="material-icons">voice_chat</i></button><p>Ubica en el mapa los videos con Lozalizacion</p></li>
    <li><button   class="btn-floating btn-large cyan pulse" ><i class="material-icons">person_pin</i></button><p>Busa Twitts y actualiza el mapa para ver aquellos con ubicacion</p></li>
       
      </ul>
	 
	 
   <img  class="twti" src="img/twit.png"/>
      <img  class="gog" src="img/gog.jpg"/>
    


    <br>
  <p>&copy; Copyright Striker 2017 </p>

      </div>

      <div class="col s9">
        <!-- Teal page content <h2 class="titu">BuscaPop</h2> -->
 <div class="caja">
	
 <div class="caja-input">

         <div id="formula" class="col s12 m9 l9 xl9">
     
	  
	  
       <input type="text"   id="busqueda"  class="input-field col s12" placeholder="termino de busqueda" required>
    
       <input   id="tamanio" class="input-field col s6" placeholder="cantidad"  required>
       <br></br>
        <br></br>

      <button   class="btn-floating btn-large green darken-3 pulse" id="speak"><i class="material-icons">chevron_right</i></button>
      <button class="btn-floating btn-large red darken-4 pulse"  id="busq" onclick="obtener_videoUb()" ><i class="material-icons">voice_chat</i></button>
    <button   class="btn-floating btn-large cyan pulse" id="twt3"><i class="material-icons">person_pin</i></button> 
 
 
 
 <ul class="tabs">
        <li class="tab col s3 xl3"><a href="#formula2">Videos</a></li>
        <li class="tab col s3 xl3"><a href="#map">Mapa</a></li>
        <li class="tab col s3 xl3"><a href="#twt">Twits</a></li>

       
      </ul>
	  
	  
<div id="formula2" class="col-sm3">
<!-- <h5>Videos Relacionados</h5> -->
<div class="force-overflow">
<div id="id02" class="scrollbar"></div>
</div>
</div>

<div id="twt" class="col-sm3" >
<!-- <h5>Twits relacionados</h5> -->
 <div class="force-overflow">
<div id="id01" class="scrollbar">
</div>

</div>
</div>




<div id="mpa" class="col-sm3">
 <!-- <h5>Resultados de busqueda</h5> -->
  <div id="map" class="col s12 m9 l9 xl9">
 
  </div>
</div>

<br>



 
          

      </div>

</div>


      </div>

   

</div>
</div>
     


</div>

          

</body>


</html>

<script>
    var div2=document.getElementById("id02");
    var btUbica=document.getElementById("speak");
var tamanio1;
var busqueda1;

var arr =[];

     ////////////////////77

    var ar_video;
    var tamanio;
    var ar_obj= new Array();
  var ar_video_link;

//metodo que busca por palabra clave
function busqueda_p(){

deleteMarkers();
clearMarkers();

//busqueda1= .value;

busqueda1= document.getElementById("busqueda").value;
tamanio1= document.getElementById("tamanio").value;

ar_video= new Array(tamanio);

ar_video_link= new Array(tamanio);


if(busqueda1=="" || tamanio==""){
    console.log("no hay datos de busqueda");

}else{
   

    var xmlhttp=new XMLHttpRequest();
    var url="https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults="+tamanio1+"&q="+busqueda1+"&type=video&key=AIzaSyByOiuXHJYNRx1ajzihEvsa0PB6jCV2eGA";
xmlhttp.onreadystatechange= function(){
    if (this.readyState== 4 && this.status==200) {

        var resultado1=JSON.parse(this.responseText);

        obtener_video(obtenerIdTitulo(resultado1));
      // obtener_twit( realizaProceso(busqueda1));
       //obtenerUbicaciontwt(realizaProceso(busqueda1));

    }
};
}

xmlhttp.open("GET", url, true);
xmlhttp.send();
}


    ///obtiene el ID y titulo del video

function obtenerIdTitulo(arr){

var out="";
var i;

for(i = 0;i<arr.items.length;i++){
out+= 'numero='+i+'<p>'+arr.items[i].snippet.title+'</p>';
ar_video[i]=arr.items[i].id.videoId;
}

//document.getElementById("id01").innerHTML=out;
return ar_video;
    }


    function obtener_video(ar_video){
    //clearMarkers();
    var xmlhttp = new XMLHttpRequest();
    var url2 = "https://www.googleapis.com/youtube/v3/videos?part=recordingDetails%2Cplayer&id="+ar_video+"&key=AIzaSyByOiuXHJYNRx1ajzihEvsa0PB6jCV2eGA";

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myArr = JSON.parse(this.responseText);
    
        obtener_videx(myArr);
        
    }
};
xmlhttp.open("GET", url2, true);
xmlhttp.send();

    }

//obtiene el video y 0 reproductor mediante el arreglo de IDs que recibe

function obtener_videx(arro) {

<!-- deleteMarkers(); -->
<!-- clearMarkers(); -->
    var out2 = "";
    var i;
    for(i = 0; i < arro.items.length; i++) {
        out2+= arro.items[i].player.embedHtml;
    ar_video_link[i]=arro.items[i].player.embedHtml;
    }
    
    document.getElementById("id02").innerHTML = out2;
  

}
////////////////////////////

function obtener_videx2(arro) {

<!-- deleteMarkers(); -->
<!-- clearMarkers(); -->


    var out2 = "";
    var i;
    for(i = 0; i < arro.items.length; i++) {
    out2+= arro.items[i].player.embedHtml;
  }
  
    document.getElementById("id02").innerHTML = out2;
}




////////////////////////////

    function obtener_videoUb(){
    //clearMarkers();
    var xmlhttp = new XMLHttpRequest();
    var url3 = "https://www.googleapis.com/youtube/v3/videos?part=recordingDetails%2Cplayer&id="+ar_video+"&key=AIzaSyByOiuXHJYNRx1ajzihEvsa0PB6jCV2eGA";

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var myArr2 = JSON.parse(this.responseText);
    
        obtenerUbicacion(myArr2);
        
    }
};
xmlhttp.open("GET", url3, true);
xmlhttp.send();

    }

	var iconoyt="https://cdn4.iconfinder.com/data/icons/social-media-icons-the-circle-set/48/youtube_circle-32.png"
function obtenerUbicacion(arr) {

//deleteMarkers();
//clearMarkers();

    var out = "";
    var i;
   
    for(i = 0; i < arr.items.length; i++) {
    if(typeof arr.items[i].recordingDetails=='undefined'){
            
            console.log("sin resultados");

            
}else{
      initMap( arr.items[i].recordingDetails.location.latitude, arr.items[i].recordingDetails.location.longitude,arr.items[i].player.embedHtml,iconoyt);
    }
    
    }
    
   // document.getElementById("id02").innerHTML = out;
   
}

var markers = [];
  function initMap( lati, longi,frame,icono ) {

    var latLong = new google.maps.LatLng(lati, longi,frame);

       // var uluru = {lat: lati , lng: longi};
        //console.log(uluru);
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 5.5,
          center: {lat: 21.14, lng: -100.96}
          //center: latLong
        });
        var marker = new google.maps.Marker({
          position: latLong,
          map: map,
		  icon:icono
        });
        var infoWindow = new google.maps.InfoWindow({
    content:frame
  });
  
  marker.addListener('mouseover',function(){
    infoWindow.open(map,marker);
  })
        
       markers.push(marker);
       setMapOnAll(map);
       
    

      }
      //////////////////////////////////////////////////////////////////////////////////777
/*
  function realizaProceso(search){
          var parametros = {
                  "valorFun" : search,
           };
           $.ajax({
                   data:  parametros,
                   //datatype:"json",
                  url:   'callback.php',
                   type:  'post',
                   beforeSend: function () {
                           $("#valorFun").html("");
                  },
                  success:  function (response) {
                           $("#contenidoStatuses").html(response);
                          var obj = JSON.parse(response);
                          console.log(obj);
                           //twitterF(obj);
                  }
          });
  }*/

 function realizaProceso(search){



    var url4 = "http://localhost/twitter4/callback.php?valorFun=" + search;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            var obj = JSON.parse(this.responseText);
            //console.log(obj);
            obtener_twit(obj);


            //arr.push(obj);
            //for (var i=0; i< obj.statuses.length; i++){
              //agregar_a_lista_tweets(obj.statuses[i]);
            //}
            //if(contador_twits < ntwits){
            //  if(obj.search_metadata.next_results !== undefined){ solicitud_twitter("http://localhost:3000/twitter"+obj.search_metadata.next_results, ntwits);  }
            //}
            //desplegar_tweets(arreglo_de_tweets);
          } else {
            console.log("error");
          }
      }
    };
    xhr.open('GET',url4, true);
    xhr.send();
    //return arr;



  }
var iconotw="https://cdn4.iconfinder.com/data/icons/social-media-icons-the-circle-set/48/twitter_circle-32.png";

  function obtener_twit(arro) {


    var out3 = "";
    var i;
    for(i = 0; i < arro.length; i++) {
        //out3+= "<p class=\"box-blue\">"+arro[i].text+"</p><br>";

  out3+=   
"<div class=\"card\">"+
  "<div class=\"card-header\"><p><img src=\"img/user.png\" class=\"imgRedonda\">"+arro[i].screen_name+"</p></div>"+
  "<div class=\"card-body\">"+"<p class=\"box-blue\">"+arro[i].text+"</p></div>"+
  "</div>";


      
     // obtenerUbicaciontwt(arro[i].latitud,arro[i].longitud,arro[i].text);
  console.log(arro[i].text);
        console.log(arro[i].latitud);
        console.log(arro[i].longitud);
        

if(arro[i].latitud!=null&arro[i].longitud!=null){
        initMap( arro[i].latitud, arro[i].longitud,arro[i].text,iconotw);

    }

    }
    
    document.getElementById("id01").innerHTML = out3;
  
function paginacion(){


}
}







 
 function obtenerUbicaciontwt(lati,long,text) {

//deleteMarkers();
//clearMarkers();

    var out = "";
    var i;
   
   // for(i = 0; i < arr.length; i++) {
    if(latitud==null){
            
            console.log("sin resultados");
            
}else{
      initMap( lati, long,text);
    }
    
   // }
    
   // document.getElementById("id02").innerHTML = out;
   
}

// function obtener_twit(arro) {


//     var out3 = "";
//     var i;
//     for(i = 0; i < arro.length; i++) {
//         out3+= "<div class=\"col s12 m8 offset-m2 l6 offset-l3\">"+
//           "<div class=\"card-panel grey lighten-5 z-depth-1\">"+
//           "<div class=\"row valign-wrapper\">"+
//             "<div class=\"col s2\">"+
//             "<img src=\"images/yuna.jpg\" alt=\"\" class=\"circle responsive-img\">"+
//             "</div>"
//             "<div class=\"col s10\">"
//               "<span class=\"black-text\">"+
//                arro[i].text+
//             "</div>"+
//           "</div>"+
//         "</div>"+
//       "</div>";
            


//         console.log(arro[i].text);
//         console.log(arro[i].screen_name);
    
//     }
    
//     document.getElementById("id01").innerHTML = out3;
  

// }













function setMapOnAll(map) {

        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(map);
        }
}
    
     function deleteMarkers() {
        clearMarkers();
        markers = [];
      }
      
      function clearMarkers() {
        setMapOnAll(null);
      }


</script>








  
</script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByOiuXHJYNRx1ajzihEvsa0PB6jCV2eGA&callback=initMap">
   </script>
  
       
          <script>
      //var texto1= "estos son los resultados relacionados a la busqueda";
      var text = document.querySelector('#busqueda');

      var speak = document.querySelector('#speak');
      
      function speaknow () {
        if(typeof text=="undefined"){
           var speech = new SpeechSynthesisUtterance();
        speech.rate = .7;
        speech.pitch = -2;
        speech.volume = 1;
        speech.voice =speechSynthesis.getVoices()[0];
        speech.text ="por favor introduce un termino de busqueda";

        speechSynthesis.speak(speech);
        }else{
        var speech = new SpeechSynthesisUtterance();
        speech.rate = .7;
        speech.pitch = -2;
        speech.volume = 1;
        speech.voice =speechSynthesis.getVoices()[0];
        speech.text ="se muestran resultados de la busqueda relacionada a los terminos"+text.value;

        speechSynthesis.speak(speech);
      }
      }

      speak.onclick = function (e) {
      
        e.preventDefault();
        speaknow();
        busqueda_p();
        <!-- realizaProceso(); -->
		<!-- obtener_videoUb(); -->
       
      };
	  
var twt3 = document.querySelector('#twt3');

 twt3.onclick = function (e) {
 busqueda1=document.getElementById("busqueda").value;
       obtener_twit( realizaProceso(busqueda1));
     
        //realizaProceso(); 
		<!-- obtener_videoUb(); -->
       
      };



    </script>
	<?php
	}else{
	header('Location: index.html');
	}?>

