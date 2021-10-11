<?php

namespace App\Http\Controllers;
@session_start();
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\MediaController;
use App\Models\SocialAuth;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon as SupportCarbon;
use phpDocumentor\Reflection\Location;
use PhpParser\Node\Expr\Cast\Unset_;
use SebastianBergmann\CodeCoverage\Driver\Selector;

use function GuzzleHttp\Promise\all;

class TweetController extends Controller
{
    private $consumerKey = 'VIkDmZm6tXMHjWoAdlf3UgIHL' ;
    private $consumerSecrete = 'ydOgVZmi26U9iFEFt9tqcOYBIjOirijXoSjHChTzRDw8s76RLv';

    public function regreso(){  
    return view('HomeLogin');
    }

public function DestroyTweets(Request $request){

  $access_token =  $_SESSION['oauth_token'];
      $access_token_secret = $_SESSION['oauth_token_secret'];  
    $twitter_connect =  new TwitterOAuth($this->consumerKey, $this->consumerSecrete ,$access_token , $access_token_secret );
     $twitter_connect->get("account/verify_credentials");
      $mensaje = $twitter_connect->get(path:"statuses/user_timeline");
      foreach ($mensaje as $elemento){
        $creacion = $elemento->created_at; 
      $valor1= Carbon::now()->subWeek(1);
             $valor2= Carbon::now()->subWeek(2);
             $valor3= Carbon::now()->subWeek(3);
             $valor4 = Carbon::now()->subMonth(1);
             $valor5 = Carbon::now()->subMonth(2);
             $valor6=  Carbon::now()->subMonth(3);
             $valor7= Carbon::now()->subMonth(4) ;
             $semana1 = (Carbon::create($creacion)->between($valor1, $valor2));
             $semana2 = (Carbon::create($creacion)->between($valor2 , $valor3));
             $mes1 = (Carbon::create($creacion)->between($valor4 , $valor5));
             $mes2 = (Carbon::create($creacion)->between($valor5 , $valor6));
             $mes3 = (Carbon::create($creacion)->between($valor6 , $valor7));
             $mes6= Carbon::now()->subMonth(6);
              $mes5 = (Carbon::create($creacion)->between($valor7, $mes6));
   $select = $request->get('Edad');
if($select == '0'){
redirect()->route('home.tweets')->with('eliminados' , 'false');
}
if($select == '1'){
  if($semana1 == true){
    $datos1 = $elemento->id;  
    $twitter_connect->post(path: 'statuses/destroy' , parameters:['id' => $datos1]);
    }else{
      view('Tweets')->with('eliminados' , 'false');
    }
}
if($select == '2'){
  if($semana2 == true){
    $datos2 = $elemento->id;  
    $twitter_connect->post(path: 'statuses/destroy' , parameters:['id' => $datos2]);
    }
}
if($select == '3'){
  if($mes1 == true){
    $datos3 = $elemento->id;  
    $twitter_connect->post(path: 'statuses/destroy' , parameters:['id' => $datos3]);
    }
}
if($select == '4'){
  if($mes2 == true){
    $datos4 = $elemento->id;  
    $twitter_connect->post(path: 'statuses/destroy' , parameters:['id' => $datos4]);
    }
}
if($select == '5'){
  if($mes3 == true){
    $datos5 = $elemento->id;  
    $twitter_connect->post(path: 'statuses/destroy' , parameters:['id' => $datos5]);
    }
}
  }
  return redirect()->route('home.tweets')->with('eliminar' , 'ok');
}
}

