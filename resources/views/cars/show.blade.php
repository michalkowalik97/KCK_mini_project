@extends('layouts.app')

@section('title')
    - {{$car->name}}
@endsection

@section('links')
    @component('components.links',
    ['links'=>["Koszty"=>"/car/".$car->id."/costs", "Statystyki"=>"/car/".$car->id."/stats"],
    'active'=>""]
    )
    @endcomponent

@endsection

@section('content')
    <div class="container {{--px-5--}}">
        <div class="row ">
            <div class="col-12 col-xl-4 mr-0  mr-xl-5  pt-1 mb-5 mb-xl-0 w3-border w3-border-blue">
                <img @if($car->photo == '' || !$car->photo)
                     src="{{asset('photos/default.png')}}"
                     @else
                     src="{{asset($car->photo)}}"
                     @endif
                     alt="Car photo" style="width:100%">
                <div class="my-2"><span class="h3">{{$car->name}}</span>
                    <span class="badge badge-success">PB</span>
                    <span class="badge badge-primary">LPG</span>
                    <span class="float-right"> <a
                                href="/cars/{{$car->id}}/edit"
                                class="w3-button w3-hover-green w3-black w3-tiny">Edytuj</a></span></div>

                <dl class="dl-horizontal">
                    <dt>Aktualny przebieg:</dt>
                    <dd>{{number_format($car->mileage,0,".",' ')}} km</dd>


                </dl>
            </div>
            <div class="col-12   col-xl-7 mr-0 ml-xl-5  pt-1 w3-border w3-border-blue">
                <div class="my-2"><span class="h3">Podsumowanie:</span> <span class="float-right"> <a
                                href="/car/{{$car->id}}/stats/add" class="w3-button w3-hover-green w3-black w3-tiny">Dodaj+</a>
                        <a
                                href="/car/{{$car->id}}/stats" class="w3-button w3-hover-green w3-black w3-tiny">Szczegóły</a></span>
                </div>
                <table class="table">
                    <tr>
                        <td>Wydatki ogółem:</td>
                        <td class="font-weight-bold">xxxxx zł</td>
                    </tr>
                    <tr>
                        <td>Wydatki na paliwo:</td>
                        <td>xxx zł</td>
                    </tr>
                    <tr>
                        <td>Wydatki na utrzymanie samochodu:</td>
                        <td>xxx zł</td>
                    </tr>
                    <tr>
                        <td>Tutaj coś jeszcze:</td>
                        <td>xxx zł</td>
                    </tr>
                </table>

            </div>
        </div>
        <div class="row {{--pr-5--}} ">
            <div class="col-12   mt-5 w3-border w3-border-blue">
                <div class="my-2"><span class="h3">Koszty paliwa:</span> <span class="float-right"> <a
                                href="/car/{{$car->id}}/fuel/add" class="w3-button w3-hover-green w3-black w3-tiny">Dodaj+</a>
                        <a
                                href="/car/{{$car->id}}/fuel" class="w3-button w3-hover-green w3-black w3-tiny">Szczegóły</a></span>
                </div>

                <table class="table">
                    <tr>
                        <td>Wydatki na paliwo ogółem:</td>
                        <td class="font-weight-bold">xxxxx zł</td>
                    </tr>
                    <tr>
                        <td>Wydatki na paliwo w bieżącym miesiącu:</td>
                        <td>xxxxx zł</td>
                    </tr>
                    <tr>
                        <td>Wydatki na benzynę: </td>
                        <td>xxx zł <span class="badge badge-success">PB</span></td>
                    </tr>
                    <tr>
                        <td>Wydatki na LPG:</td>
                        <td>xxx zł <span class="badge badge-primary">LPG</span></td>
                    </tr>
                    <tr>
                        <td>Średnie miesięczne wydatki na paliwo:</td>
                        <td>xxx zł</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection

