@extends('layouts.app')

@section('title')
    - Lista samochodów
@endsection

@section('content')

    <div class="container">
        <div class="row justify-content-end pb-4">
            <div class="col-1">
                <a href="/costs/create" class="w3-button w3-hover-green w3-black">+Dodaj</a>
            </div>
        </div>
        <div class="row {{--align-items-center align-content-center align-self-center--}} {{--justify-content-center--}}">
            <div class="col-2 sidenav w3-border"> @for($i=0;$i<15;$i++) side panel @endfor </div>
            <div class="col-10 w3-border">  @for($i=0;$i<1500;$i++) content @endfor </div>


        </div>
    </div>
@endsection