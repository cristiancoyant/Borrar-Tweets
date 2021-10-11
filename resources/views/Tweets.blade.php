@extends('layout.plantilla')
@section('titled' , 'Formulario')
@section('content')
@section('logout')
<form action="{{route('Logout')}}" method="get">
    @csrf
<button class="btn ">Logout</button>
</form>
@endsection
@section('ImagenPerfil')
<img src="{{$perfil}}" class="logo-perfil" alt="Foto de Perfil" />
@endsection
@section('Home')
<form action="{{route('regreso')}}"><button class="btn">Home</button></form>
@endsection
<div class="center">
    <section id="content">

           <h1 class="subheader">Parametros</h1>

           <form class="mid-form formulario-eliminar" action="{{route('Destroy')}}" method="POST" >
            @csrf
                <div class="form-group">
                    <label for="nombre">Cuenta de Twitter</label>
                    <input type="text" name="nombre" readonly  value="{{'@'.$usuario}}"/>
                </div>

                <div class="form-group">
                    <label for="apellidos">Edad de los Tweets</label>
                   <select name="Edad" id="Estilo" required >
                    <option  value="0" disabled selected>Seleccionar Edad</option>
                       <option value="1" >Tweets de hace mas de una semana</option>
                       <option value="2">Tweets de hace mas de dos semanas</option>
                       <option value="3">Tweets de hace mas de un mes</option>
                       <option value="4">Tweets de hace mas de dos meses</option>
                       <option value="5">Tweets de hace mas de tres meses</option>

                   </select>
                </div>
                <div class="form-group">
                </div>

                <div class="clearfix"></div>
                  <br>
                    <button type="submit"  class="btn-success" >Borrar</button>
               
           </form>
           <form action="{{route('Posteo')}}" method="POST" class="enviar">
            @csrf
            <label  style="position: absolute;top: 55%;left: 50%;">Te gusto mi trabajo ? Recomendalo en tu perfil<a href="https://twitter.com/{{$usuario}}" style="text-decoration: none; text-color:none;"> {{$usuario}}</a></label> <br><br>
             <button class="btn-success" style="position: absolute;top: 60%;left: 60%;">Postear </button>
        </form>                                     
    </section>
    @section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
      'Eliminados',
      'Se borraron exitosamente',
      'success'
    )
        </script>
    @endif
    @if (session('enviado') == 'ok')
    <script>
        Swal.fire(
  'Posteado',
  'Gracias por recomendarme en tu perfil',
  'success'
)
    </script>
@endif


    @endsection
@endsection