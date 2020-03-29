@extends('layouts.app')

@section('title')
    - Lista samochodów
@endsection

@section('content')

    <div class="container">

        @if($errors->any())
            <div class="w3-panel w3-yellow w3-display-container py-3">
                <span onclick="this.parentElement.style.display='none'" class="w3-button w3-small w3-display-topright">&times;</span>
                <p>{{$errors->first()}}</p>
            </div>
        @endif

        <div class="row justify-content-end pb-4">
            <div class="col-1">
                <a href="/cars/create" class="w3-button w3-hover-green w3-black">+Dodaj</a>
            </div>
        </div>
        <div class="row">


            @forelse($cars as $car)
                <div class="w3-card card m-1 @if(1 % 5 == 0){{-- bg-danger text-white--}} w3-orange @endif"
                     style="width:32%">
                    <img class="w3-border-bottom w3-border-dark card-img-top"
                         {{--src="https://cdn.pixabay.com/photo/2016/04/01/09/11/car-1299198_960_720.png"--}}
                         @if($car->photo == '' || !$car->photo)
                             src="{{asset('photos/default.png')}}"
                         @else
                             src="{{asset($car->photo)}}"
                         @endif
                         alt="Car photo" style="width:100%">
                    <div class="card-body">
                        <h4 class="card-title h3">{{$car->name}}</h4>
                        <p class="card-text h6"> Ostatni zarejestrowany
                            przebieg: {{number_format($car->mileage,0,".",' ')}} km</p>
                        <a href="/cars/{{$car->id}}" class="{{--btn btn-primary --}}stretched-link"></a>
                    </div>
                </div>
            @empty
                <div class="alert alert-info col-12">Wygląda na to że nie dodałeś/dodałaś jeszcze żadnego samochodu.
                </div>
            @endforelse

            {{--    @for($i=0; $i<80;$i++)
                    <div class="w3-card card --}}{{--col-3 --}}{{--m-1 @if($i % 5 == 0)--}}{{-- bg-danger text-white--}}{{-- w3-orange @endif"
                         style="width:32%">
                        <img class="w3-border-bottom w3-border-dark card-img-top"
                             --}}{{--src="https://cdn.pixabay.com/photo/2016/04/01/09/11/car-1299198_960_720.png"--}}{{--
                             @if($i % 7 == 0)
                             src="https://scontent-waw1-1.xx.fbcdn.net/v/t1.15752-9/s2048x2048/65654282_437290767118960_2532904259272310784_n.jpg?_nc_cat=102&_nc_sid=b96e70&_nc_ohc=La8pO0HjZf0AX_gZRLF&_nc_ht=scontent-waw1-1.xx&_nc_tp=7&oh=5631e9ada1f18579a40508c4437040df&oe=5EA29749"
                             --}}{{--src="https://ocdn.eu/images/pulscms/MmM7MDA_/e9bc37a6fe5390cc421a92e01eadf815.jpg"--}}{{--
                             @else
                             --}}{{--src="https://cdn.pixabay.com/photo/2016/04/01/09/11/car-1299198_960_720.png"--}}{{--
                             src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTDxzZex8EwEq_MQk7goFmsVgPyvBuEujerlM2nXh7a8Xhq8gle"
                             @endif
                             alt="Card image"
                             style="width:100%">
                        <div class="card-body">
                            <h4 class="card-title">Moje ulubione auto</h4>
                            <p class="card-text">Some example text some example text. John Doe is an architect and
                                engineer</p>
                            <a href="/cars/1" class="--}}{{--btn btn-primary --}}{{--stretched-link"></a>
                        </div>
                    </div>
                @endfor--}}
        </div>
    </div>
@endsection