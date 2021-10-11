@extends('layout.plantilla')
@section('titled' , 'Home')
    
@section('content')
<div id="slider" class="slider-big">
    <h1>Bienvenido a mi pagina donde podras borrar tus Tweets de forma masiva</h1>
    <a href="{{route('login.twitter')}}" class="btn-white">Sing in With Twitter</a>
</div>
<br><br><br><br>
<footer id="footer">
    <div class="center">
        <p>
            &copy;Pagina para borrar tweets de Cristian Coyant
        </p>
    </div>
</footer>
@endsection