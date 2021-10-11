<?php

namespace App\Http\Controllers;
@session_start();
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Models\SocialAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\OAuth1\Client\Server\Twitter;
use PHPUnit\Framework\MockObject\Rule\Parameters;
use Carbon\Carbon;

class MediaController extends Controller
{
    //funciones privadas de la clase con los token de twitter
    private $consumerKey = 'VIkDmZm6tXMHjWoAdlf3UgIHL' ;
    private $consumerSecrete = 'ydOgVZmi26U9iFEFt9tqcOYBIjOirijXoSjHChTzRDw8s76RLv';
    //funcion que conceta con twitter
    public function connect_twitter(Request $request){
       
        $callback = route('Formulario') ;
        $twitter_connect = new TwitterOAuth($this->consumerKey, $this->consumerSecrete);

        $access_token = $twitter_connect->oauth(path:'oauth/request_token' , parameters:['oauth_callback'=>$callback]);
        $_SESSION['oauth_token'] = $access_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
        $_route = $twitter_connect->url(path:'oauth/authorize' , parameters:['oauth_token'=>$access_token['oauth_token']]);

        return redirect($_route);
    }
    //funcion de callback
    public function Twitter_cbk(Request $request)
    {
     $response= $request->all();
     $oauth_token = $response['oauth_token'];
     $oauth_verifier = $response['oauth_verifier'] ;
     
     $twitter_connect = new TwitterOAuth($this->consumerKey, $this->consumerSecrete , oauthToken:$_SESSION['oauth_token'] , oauthTokenSecret:$_SESSION['oauth_token_secret'] );

     $token =  $twitter_connect->oauth(path:'oauth/access_token' , parameters:['oauth_verifier'=>$oauth_verifier]);

        $_SESSION['oauth_token'] = $token['oauth_token'];
        $_SESSION['screen_name'] = $token['screen_name'];
        $_SESSION['oauth_token_secret'] = $token['oauth_token_secret'];

    
     SocialAuth::query()->updateOrCreate(
       ['twitter_screen_name' => $_SESSION['screen_name'] ],
       ['twitter_oauth_token'=> $_SESSION['oauth_token'], 
       'twitter_oauth_token_secrete' => $_SESSION['oauth_token_secret']] ,
    );

   return redirect()->route('home.tweets');
    }
   
    public function Postear(){
        $access_token =  $_SESSION['oauth_token'];
        $access_token_secret =  $_SESSION['oauth_token_secret'] ;
        $twitter_connect = new TwitterOAuth($this->consumerKey, $this->consumerSecrete, oauthToken:$access_token , oauthTokenSecret:$access_token_secret);
       $twitter_connect->setTimeouts(connectionTimeout:10 , timeout:15);
       $twitter_connect->post(path:'statuses/update',parameters:['status' => 'Te recomiendo que para borrar tus tweets uses BorrarTweet de Cristian Coyant echo con laravel http://example.com']);
       return redirect()->route('home.tweets')->with('enviado' , 'ok');
      }
    //funcion cierra sesion 
    public function Logout(Request $request)
    {
        @session_destroy();
        return redirect('/');
    }
    public function TweetsIndex(){
        $access_token =  $_SESSION['oauth_token'];
        $access_token_secret = $_SESSION['oauth_token_secret'];  
      $twitter_connect =  new TwitterOAuth($this->consumerKey, $this->consumerSecrete ,$access_token , $access_token_secret );
        $datos =$twitter_connect->get("account/verify_credentials");
        $perfil = $datos->profile_image_url;
        $usuario = $_SESSION['screen_name'];
        return view('Tweets' ,compact('usuario','perfil'));
      }
      }


