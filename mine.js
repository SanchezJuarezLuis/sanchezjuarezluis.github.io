 //var busqueda1=document.getElementById("busqueda");
//var tamanio= document.getElementById("tamanio");


var div2=document.getElementById("id02");


var btUbica=document.getElementById("speak");
var tamanio1;
var busqueda1;
     ////////////////////77

    var ar_video;
   
    var ar_obj= new Array();
  var ar_video_link;

//metodo que busca por palabra clave
function busqueda_p(){


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
       // realizaProceso(busqueda1.value);

    }
};
}

xmlhttp.open("GET", url, true);
xmlhttp.send();
};


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

deleteMarkers();
clearMarkers();
    var out2 = "";
    var i;
    for(i = 0; i < arro.items.length; i++) {
        out2+= arro.items[i].player.embedHtml;
    ar_video_link[i]=arro.items[i].player.embedHtml;
    }
    
   div2.innerHTML = out2;
  

}
////////////////////////////

function obtener_videx2(arro) {

deleteMarkers();
clearMarkers();


    var out2 = "";
    var i;
    for(i = 0; i < arro.items.length; i++) {
    out2+= arro.items[i].player.embedHtml;
  }
  
    div2.innerHTML = out2;
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

function obtenerUbicacion(arr) {

deleteMarkers();
clearMarkers();

    var out = "";
    var i;
   
    for(i = 0; i < arr.items.length; i++) {
    if(typeof arr.items[i].recordingDetails=='undefined'){
            
            console.log("sin resultados");
            
}else{
      initMap( arr.items[i].recordingDetails.location.latitude, arr.items[i].recordingDetails.location.longitude,arr.items[i].player.embedHtml);
    }
    
    }
    
   // document.getElementById("id02").innerHTML = out;
   
}

var markers = [];
  function initMap( lati, longi,frame ) {

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
          map: map
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

// function realizaProceso(search){
//         var parametros = {
//                 "valorFun" : search,
//         };
//         $.ajax({
//                 data:  parametros,
//                 url:   'callback.php',
//                 type:  'post',
//                 beforeSend: function () {
//                         $("#resultado").html("");
//                 },
//                 success:  function (response) {
//                         $("#contenido").html(response);
//                         var obj = JSON.parse(response);
//                         console.log(obj);
//                         //twitterF(obj);

//                 }
//         });
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











  

     //src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByOiuXHJYNRx1ajzihEvsa0PB6jCV2eGA&callback=initMap">
   
  
       
        
      //var texto1= "estos son los resultados relacionados a la busqueda";
      var text = document.querySelector('#busqueda');

      var speak = document.querySelector('#speak');
      //var speak=document.getElementById("speak");


      
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
        speech.text ="se muestran resultados de la busqueda relacionada a los terminos"+text;

        speechSynthesis.speak(speech);
      }
      }

       speak.onclick = function (e) {
      
         e.preventDefault();
       speaknow();
         busqueda_p();
       
      };

     //speak.onclick=doss(e);

      function doss(e){
       e.preventDefault();
        speaknow();
        busqueda_p();
     }


window.onload =busqueda_p();
window.onload=obtenerIdTitulo(arr);