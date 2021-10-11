@extends('layout.plantilla')
@section('titled' , 'Home')
@section('logout')
<form action="{{route('Logout')}}" method="GET">
    @csrf
<button class="btn ">Logout</button>
</form>
@endsection
@section('Home')
<form action="{{route('home.tweets')}}"><button class="btn">Tweets</button></form>
@endsection

@section('content')
    
<div id="slider" class="slider-big">
    <h1>Ya has iniciado sesion en esta pagina</h1>
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