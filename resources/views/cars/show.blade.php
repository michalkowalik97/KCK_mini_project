@extends('layouts.app')

@section('title')
    - {{$car->name}}
@endsection

@section('links')
    @component('components.links',
    ['links'=>["Podsumowanie"=>"/cars/".$car->id,"Koszty"=>"/car/".$car->id."/costs", "Statystyki"=>"/car/".$car->id."/stats"],
    'active'=>"Podsumowanie"]
    )
    @endcomponent

@endsection

@section('content')
    <div class="container {{--px-5--}}">

        @if(session("message"))
            <div class="w3-container py-3 w3-panel w3-blue{{--alert alert-info--}}">
                {{session("message")}}
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-1">
                <a href="/cars/" class="w3-button w3-hover-green w3-black w3-small" ><i
                            class="fas fa-arrow-left text-white "></i> Powrót do listy</a>
            </div>

            <div class="col-12 col-lg-1 offset-lg-9 mt-3 mt-lg-0">
                <form action="/cars/{{$car->id}}" method="post">
                    @csrf
                    @method("DELETE")
                    <button  class="w3-button w3-hover-red w3-black w3-small text-decoration-none confirm" data-txt="Czy na pewno chcesz uusnąć samochód?"><i
                                class="fas fa-trash text-white"></i> Usuń samochód</button>
                </form>

            </div>

        </div>
        <div class="row ">
            <div class="col-12 col-lg-4 mr-0  mr-lg-5  pt-1 mb-5 mb-lg-0 w3-border w3-border-blue">
              <span class="float-right"> <a
                          href="/cars/{{$car->id}}/edit/photo"
                          class="w3-button w3-hover-green w3-black w3-tiny">Edytuj zdjęcie</a></span>


                <img @if($car->photo == '' || !$car->photo)
                     src="{{asset('photos/default.png')}}"
                     @else
                     src="{{asset($car->photo)}}"
                     @endif
                     alt="Car photo" style="width:100%">
                <div class="my-2"><span class="h3">{{$car->renderName()}}</span>

                    <span class="float-right"> <a
                                href="/cars/{{$car->id}}/edit"
                                class="w3-button w3-hover-green w3-black w3-tiny">Edytuj</a></span></div>

                <dl class="dl-horizontal">
                    <dt>Aktualny przebieg:</dt>
                    <dd>{{number_format($car->mileage,0,".",' ')}} km</dd>


                </dl>
            </div>
            <div class="col-12   col-lg-7 mr-0 ml-lg-4  pt-1 w3-border w3-border-blue">
                <div class="my-2"><span class="h3">Podsumowanie:</span> <span class="float-right"> <a
                                href="/car/{{$car->id}}/cost/add" class="w3-button w3-hover-green w3-black w3-tiny">Dodaj <i
                                    class="fas fa-plus"></i></a>
                        <a
                                href="/car/{{$car->id}}/costs" class="w3-button w3-hover-green w3-black w3-tiny">Szczegóły</a></span>
                </div>
                <table class="table">
                    <tr>
                        <td>Wydatki ogółem:</td>
                        <td class="font-weight-bold">{{rand(1000,100000)}} zł</td>
                    </tr>
                    <tr>
                        <td>Wydatki na paliwo:</td>
                        <td>{{rand(100,10000)}} zł</td>
                    </tr>
                    <tr>
                        <td>Wydatki na utrzymanie samochodu:</td>
                        <td>{{rand(100,10000)}} zł</td>
                    </tr>
                    <tr>
                        <td>Tutaj coś jeszcze:</td>
                        <td>{{rand(100,10000)}} zł</td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="row {{--pr-5--}}mr-lg-1  ">
            <div class="col-12  mt-5 w3-border w3-border-blue">
                <div class="my-2"><span class="h3">Koszty paliwa:</span> <span class="float-right"> <a
                                href="/car/{{$car->id}}/fuel/add" class="w3-button w3-hover-green w3-black w3-tiny">Dodaj <i
                                    class="fas fa-plus"></i></a>
                        <a
                                href="/car/{{$car->id}}/fuel" class="w3-button w3-hover-green w3-black w3-tiny">Szczegóły</a></span>
                </div>

                <table class="table">
                    <tr>
                        <td>Wydatki na paliwo ogółem:</td>
                        <td class="font-weight-bold">{{rand(1000,100000)}} zł</td>
                    </tr>
                    <tr>
                        <td>Wydatki na paliwo w bieżącym miesiącu:</td>
                        <td>{{rand(100,10000)}} zł</td>
                    </tr>
                    <tr>
                        <td>Wydatki na benzynę:</td>
                        <td>{{rand(100,10000)}} zł <span class="badge badge-success">PB</span></td>
                    </tr>
                    <tr>
                        <td>Wydatki na LPG:</td>
                        <td>{{rand(100,10000)}} zł <span class="badge badge-primary">LPG</span></td>
                    </tr>
                    <tr>
                        <td>Średnie miesięczne wydatki na paliwo:</td>
                        <td>{{rand(100,10000)}} zł</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection

