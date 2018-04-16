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
   
 // $valorFun1=$_GET['valorFun'];
$valorFun=$_GET['valorFun'];


//para realizar las petic..
$conexion = new TwitterOAuth($consumer_key, $consumer_secret,$_SESSION['oauth_token'] , $_SESSION['oauth_verifier']);



//.........................realizando solic a api............

//$contenido = $conexion->get("search/tweets", ["q" =>"$valor","count"=>100,"geocode"=>"17.0617628,-96.742761,100000mi",  "lang" => "es",]);
$contenido = $conexion->get("search/tweets", ["q" =>$valorFun,"count"=>100, "geocode"=>"17.0617628,-96.742761,100000km","lang" => "es","result_type" => "recent",]);


$contenidoStatuses = $contenido->statuses;
// $json = file_get_contents($contenidoStatuses);
//$conten = json_decode($json);
//$conten=$contenido;
//var_dump($contenidoStatuses);


 $data_array = array();
        foreach($contenidoStatuses as $tweet){
 $values = array(
                'screen_name' => $tweet->user->screen_name,
                'text' => $tweet->text,
                'longitud' => $tweet->place->bounding_box->coordinates[0][0][0],
                'latitud' =>$tweet->place->bounding_box->coordinates[0][0][1],
                );
                array_push($data_array, $values); 

        }
//var_dump($data_array[0]);
       // var_dump($data_array[0]["screen_name"]);

 header('Content-Type: application/json; charset=UTF-8');
 echo json_encode($data_array);
//print_r($conv);
//echo "luis";

// $html = "";
// $i = 1;

// foreach($contenidoStatuses as $tweet){
//  if($tweet->place!=NULL&&$tweet->place->bounding_box!=NULL){


//   //$html .= "<hr>";
//     $html .= $i . ">>> ";
//   $html .= $tweet->user->screen_name;
//  //$html .= $tweet->created_at;
//     $html .= $tweet->text."--->";

//     $html.=$tweet->place->bounding_box->coordinates[0][0][0]."--";
//      $html.=$tweet->place->bounding_box->coordinates[0][0][1];
//      $html .= "<hr>";
//     $i ++; 
  
   
  
//  }
// }
//echo $html;






}else{
	echo "ha ocurrio un error";

}


