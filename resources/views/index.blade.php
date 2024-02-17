@extends('layouts.principal')

@section('content')
    <div class="home-side">
        <h1 class="title">PHP Challenge</h1>
        <h2 class="subTitle centered">by <img src={{ asset('img/broobe.png') }} alt=""></h2>
    </div>
    <div class="home-side">
        <p class="description">
            El siguiente challenge consta de desarrollar un sistema que permita utilizar la API de <em><b>google speed page insights</b></em> para mostrar las métricas principales de las categorías seleccionadas.
        </p>
        <a href="{{ route('home') }}" class="btn btn-comenzar">COMENZAR!</a>
    </div>
    <video src="{{ asset('video/laptop.mp4') }}" class="video" autoplay muted loop></video>
@endsection