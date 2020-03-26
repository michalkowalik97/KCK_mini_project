@extends('layouts.app')

@section('title')
    - Lista samochodów
@endsection

@section('content')

    <div class="container">
        <div class="row {{--align-items-center align-content-center align-self-center--}} {{--justify-content-center--}}">


        @for($i=0; $i<89;$i++)
            <div class="card {{--col-3 --}}m-1 @if($i % 5 == 0) bg-danger text-white @endif" style="width:32%">
                <img class="card-img-top" {{--src="https://cdn.pixabay.com/photo/2016/04/01/09/11/car-1299198_960_720.png"--}} src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTDxzZex8EwEq_MQk7goFmsVgPyvBuEujerlM2nXh7a8Xhq8gle" alt="Card image"
                     style="width:100%">
                <div class="card-body">
                    <h4 class="card-title">Moje ulubione auto</h4>
                    <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                    <a href="https://www.google.com/" class="btn btn-primary stretched-link">See Profile</a>
                </div>
            </div>
        @endfor
    </div>
    </div>
@endsection